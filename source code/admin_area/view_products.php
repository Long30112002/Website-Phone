<style>
    body {
        overflow-x: hidden;
    }

    .pagination .page-numbers a {
        display: inline-block;
        text-decoration: none;
        color: #111111;
        padding: 10px 20px;
        border: thin solid #555;
        border-radius: 10%;
    }

    .pagination .page-numbers a.active {
        background-color: #0d81cd;
        color: #fff;
        border: thin solid #0d81cd;
    }

    .pagination .page-numbers a:focus {
        border: 1px solid #00ff00;
    }

    .page-info {
        text-align: center;
        font-weight: bold;
    }

    .pagination {
        margin-top: 20px;
        justify-content: center;
    }

    .page-numbers {
        display: inline-block;
    }

</style>
<h1 class="text-center text-success">Tất cả sản phẩm</h1>
<table class="table table-bordered">
    <thead class="bg-secondary">
        <tr class="text-center">
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Giá sản phẩm</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Chỉnh sửa</th>
            <th>Xóa</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-light">
        <?php
        ?>
        <?php
        global $conn;
        $start = 0;
        $rows_per_page = 4;
        $records = $conn->query("SELECT * FROM `products`");
        $nr_of_rows = $records->num_rows;
        $pages = ceil($nr_of_rows / $rows_per_page);
        $number = 0;

        if (isset($_GET['page-nr'])) {
            $page = $_GET['page-nr'] - 1;
            $start = $page * $rows_per_page;
        }
        // $result = $conn->query("SELECT * FROM products LIMIT $start, $rows_per_page");
        $get_products = "SELECT * FROM `products` LIMIT $start, $rows_per_page";
        $result = mysqli_query($conn, $get_products);
        $number = 0;

        while ($row = mysqli_fetch_assoc($result)) {
            $product_id = $row['product_id'];
            $product_tittle = $row['product_tittle'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];
            $status = $row['status'];
            $number++;
        ?>
            <tr class='text-center'>
                <td><?php echo $number; ?></td>
                <td><?php echo $product_tittle; ?></td>
                <td><img src='./product_images/<?php echo $product_image1; ?>' alt='Loading' class='product_img'></td>
                <td><?php echo $product_price; ?></td>
                <td>
                    <?php
                    $get_counts = "SELECT * FROM `orders_pending` WHERE product_id='$product_id'";
                    $result_counts = mysqli_query($conn, $get_counts);
                    $row_count = mysqli_num_rows($result_counts);
                    echo $row_count;
                    ?>
                <td><?php echo $status; ?></td>
                <td>
                    <a href='index.php?edit_product=<?php echo $product_id; ?>' class='text-success'>
                        <i class='fa-solid fa-pen-to-square'></i>
                    </a>
                </td>
                <td>
                    <a type="button" class="text-success deleteButton" data-toggle="modal" data-target="#exampleModal" href="index.php?delete_product=<?php echo $product_id ?>" data-brand-name="<?php echo $product_id ?>">
                        <i class='fa-solid fa-trash'></i>
                    </a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<div class="page-info m-auto">
    <?php
    if (!isset($_GET['page-nr'])) {
        $page = 1;
    } else {
        $page = $_GET['page-nr'];
    }
    ?>
    Showing <?php echo $page ?> of <?php echo $pages ?>
</div>
<div class="pagination mb-2">
    <div class="pagination mb-2 m-auto">
        <div class="page-numbers mr-2">
            <a href="?view_products&page-nr=1">First</a>
            <?php
            if (isset($_GET['page-nr']) && $_GET['page-nr'] > 1) {
            ?>
                <a href="?view_products&page-nr=<?php echo $_GET['page-nr'] - 1 ?>">Previous</a>
            <?php
            } else {
            ?>
                <a>Previous</a>
            <?php
            }
            ?>
        </div>
        <div class="page-numbers">
            <?php
            for ($counter = 1; $counter <= $pages; $counter++) {
            ?>
                <a href="?view_products&page-nr=<?php echo $counter ?>"><?php echo $counter ?></a>
            <?php
            }
            ?>
        </div>
        <div class="page-numbers ml-2">
            <?php
            if (!isset($_GET['page-nr'])) {
            ?>
                <a href="?view_products&page-nr=2">Next</a>
                <?php
            } else {
                if ($_GET['page-nr'] >= $pages) {
                ?>
                    <a>Next</a>
                <?php
                } else {
                ?>
                    <a href="?view_products&page-nr=<?php echo $_GET['page-nr'] + 1 ?>">Next</a>
            <?php
                }
            }
            ?>
            <a href="?view_products&page-nr=<?php echo $pages ?>">Last</a>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                Bạn có chắc chắn muốn xóa<strong><label class="brand-name" id="deleteBrandName"></label></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><a href="./index.php?view_categories" class="text-light text-decoration-none">Hủy</a></button>
                <button type="button" class="btn btn-primary"><a id="deleteLink" href="index.php?delete_brand=<?php echo $brand_id ?>" class="text-light text-decoration-none">Xóa</a></button>
            </div>
        </div>
    </div>
</div>

<script>
    function setDeleteUrlAndBrandName(url, brandName) {
        document.getElementById('deleteLink').href = url;
        document.getElementById('deleteBrandName').innerText = " " + brandName;
    }
    var deleteButtons = document.getElementsByClassName('deleteButton');
    for (var i = 0; i < deleteButtons.length; i++) {
        deleteButtons[i].onclick = function() {
            var deleteUrl = this.getAttribute('href');
            var brandName = this.getAttribute('data-brand-name');
            setDeleteUrlAndBrandName(deleteUrl, brandName);
        };
    }
</script>