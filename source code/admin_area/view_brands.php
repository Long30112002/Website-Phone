<h3 class="text-center text-success">Tất cả mức giá sản phẩm</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <tr class="text-center">
            <th>STT</th>
            <th>Mức giá</th>
            <th>Chỉnh sửa</th>
            <th>Xóa</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-light">
        <?php
        $select_brand = "SELECT * FROM `brands`";
        $result = mysqli_query($conn, $select_brand);
        $number = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $brand_id = $row['brand_id'];
            $brand_title = $row['brand_tittle'];
            $number++;
        ?>
            <tr class="text-center">
                <td><?php echo $number ?></td>
                <td><?php echo $brand_title ?></td>
                <td>
                    <a href='index.php?edit_brand=<?php echo $brand_id ?>' class='text-success'>
                        <i class='fa-solid fa-pen-to-square'></i>
                    </a>
                </td>
                <td>
                    <a type="button" class="text-success deleteButton" data-toggle="modal" data-target="#exampleModal" href="index.php?delete_brand=<?php echo $brand_id ?>" data-brand-name="<?php echo $brand_title ?>">
                        <i class='fa-solid fa-trash'></i>
                    </a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

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