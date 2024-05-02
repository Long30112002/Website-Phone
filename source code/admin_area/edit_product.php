<?php
if (isset($_GET['edit_product'])) {
    $edit_id = $_GET['edit_product'];
    // echo''.$eidt_id.'';
    $get_data = "SELECT * FROM `products` WHERE product_id=$edit_id";
    $result = mysqli_query($conn, $get_data);

    $row = mysqli_fetch_assoc($result);
    $product_tittle = $row['product_tittle'];


    $product_description = $row['product_description'];
    $product_keywords = $row['product_keywords'];
    $category_id = $row['category_id'];
    $brand_id = $row['brand_id'];

    $product_image1 = $row['product_image1'];
    $product_image2 = $row['product_image2'];
    $product_image3 = $row['product_image3'];
    $product_price = $row['product_price'];
    $date = $row['date'];
    $status = $row['status'];


    //fetching category name
    $select_category = "SELECT * FROM `categories` WHERE category_id =$category_id";
    $result_category = mysqli_query($conn, $select_category);
    $row_category = mysqli_fetch_assoc($result_category);
    $category_title = $row_category['category_tittle'];
    // echo $category_title;

    //fetching category name
    $select_brand = "SELECT * FROM `brands` WHERE brand_id =$brand_id";
    $result_brand = mysqli_query($conn, $select_brand);
    $row_brand = mysqli_fetch_assoc($result_brand);
    $brand_title = $row_brand['brand_tittle'];
    // echo $category_title;
}
?>

<div class="container mt-5">
    <h1 class="text-center">Edit Product</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto">
            <label for="product_title" class="form-label">Tên sản phẩm</label>
            <input value="<?php echo $product_tittle; ?>" type="text" id="product_title" name="product_title" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto">
            <label for="product_desc" class="form-label">Mô tả sản phẩm</label>
            <input value="<?php echo $product_description; ?>" type="text" id="product_desc" name="product_desc" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto">
            <label for="product_keywords" class="form-label">Từ khóa sản phẩm</label>
            <input value="<?php echo $product_keywords; ?>" type="text" id="product_keywords" name="product_keywords" class="form-control" required="required">
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_category" class="form-label">Loại sản phẩm</label>
            <select name="product_category" class="form-select" id="">
                <option value="<?php echo $category_id ?>"><?php echo $category_title ?></option>
                <?php
                $select_category_all = "SELECT * FROM `categories`";
                $result_category_all = mysqli_query($conn, $select_category_all);
                while ($row_category_all = mysqli_fetch_assoc($result_category_all)) {
                    $category_title = $row_category_all['category_tittle'];
                    $category_id = $row_category_all['category_id'];
                    echo "<option value='$category_id'>$category_title</option>";
                };
                ?>

            </select>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_band" class="form-label">Mức giá sản phẩm</label>
            <select name="product_band" class="form-select" id="">
                <option value="<?php echo $brand_id ?>"><?php echo $brand_title ?></option>
                <?php
                $select_brand_all = "SELECT * FROM `brands`";
                $result_brand_all = mysqli_query($conn, $select_brand_all);
                while ($row_brand_all = mysqli_fetch_assoc($result_brand_all)) {
                    $brand_title = $row_brand_all['brand_tittle'];
                    $brand_id = $row_brand_all['brand_id'];
                    echo "<option value='$brand_id'>$brand_title</option>";
                };
                ?>
            </select>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_img1" class="form-label">Hình ảnh 1</label>
            <div class="d-flex">
                <input type="file" id="product_img1" name="product_img1" class="form-control w-90 m-auto" required="required">
                <img class="product_img" src="./product_images/ <?php echo $product_image1; ?>" alt="Loading">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_img2" class="form-label">Hình ảnh 2</label>
            <div class="d-flex">
                <input type="file" id="product_img2" name="product_img2" class="form-control w-90 m-auto" required="required">
                <img class="product_img" src="./product_images/ <?php echo $product_image2; ?>" alt="Loading">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_img3" class="form-label">Hình ảnh 3</label>
            <div class="d-flex">
                <input type="file" id="product_img3" name="product_img3" class="form-control w-90 m-auto" required="required">
                <img class="product_img" src="./product_images/ <?php echo $product_image3; ?>" alt="Loading">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_price" class="form-label">Giá sản phẩm</label>
            <input value="<?php echo $product_price; ?>" type="text" id="product_price" name="product_price" class="form-control" required="required">
        </div>
        <div class="text-center">
            <input type="submit" name="edit_product" value="Update product" class="btn btn-info px-3 mb-3">
        </div>
    </form>
</div>


<!-- editing products -->
<?php
if (isset($_POST['edit_product'])) {
    $product_title = $_POST['product_title'];
    $product_desc = $_POST['product_desc'];
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_category'];
    $product_band = $_POST['product_band'];
    $product_price = $_POST['product_price'];

    $product_img1 = $_FILES['product_img1']['name'];
    $product_img2 = $_FILES['product_img2']['name'];
    $product_img3 = $_FILES['product_img3']['name'];

    $tmp_img1 = $_FILES['product_img1']['tmp_name'];
    $tmp_img2 = $_FILES['product_img2']['tmp_name'];
    $tmp_img3 = $_FILES['product_img3']['tmp_name'];

    if (
        $product_title == '' or $product_desc == '' or $product_keywords == '' or $product_category == ''
        or $product_band == '' or $product_img1 == '' or $product_img2 == '' or $product_img3 == '' or $product_price == ''
    ) {
        echo "<script>alert('Vui lòng nhập đầy đủ các giá trị!!!')</script>";
    } else {
        move_uploaded_file($tmp_img1, "./product_images/$product_img1");
        move_uploaded_file($tmp_img2, "./product_images/$product_img2");
        move_uploaded_file($tmp_img3, "./product_images/$product_img3");

        $update_products = "UPDATE `products` SET product_tittle = '$product_title', product_description='$product_desc', 
        product_keywords='$product_keywords', category_id='$category_id', brand_id='$brand_id',
        product_image1='$product_img1', product_image2='$product_img2', product_image3='$product_img3',
        product_price='$product_price', date=NOW() WHERE product_id=$edit_id";
        $result_update = mysqli_query($conn, $update_products);
        if ($result_update) {
            echo "<script>alert('Cập nhật thành công')</script>";
            echo "<script>window.open('./index.php?view_products','_self')</script>";
        }
    }
}
?>

<!-- delete products -->
