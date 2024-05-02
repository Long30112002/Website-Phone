<?php
include('../includes/connect.php');
if (isset($_POST['insert_product'])) {
    $product_tittle = $_POST['product_title'];
    $description = $_POST['description'];
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_category'];
    $product_brands = $_POST['product_brands'];
    $product_price = $_POST['product_price'];
    $product_status = 'true';

    // images
    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];

    //image tmp name
    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];
    $temp_image3 = $_FILES['product_image3']['tmp_name'];

    //empty condition
    if (
        $product_tittle == '' or $description == '' or $product_keywords == '' or $product_category == ''
        or $product_brands == '' or $product_price == '' or $product_image1 == '' or $product_image2 == ''
        or $product_image3 == ''
    ) {
        echo "<script>alert('Please fill all the fields')</script>";
        exit();
    } else {
        move_uploaded_file($temp_image1, "./product_images/ $product_image1");
        move_uploaded_file($temp_image2, "./product_images/ $product_image2");
        move_uploaded_file($temp_image3, "./product_images/ $product_image3");

        //insert
        $insert_product =
            "INSERT INTO 
        `products` 
        (product_tittle,
        product_description,
        product_keywords,
        category_id,
        brand_id,
        product_image1,
        product_image2,
        product_image3,
        product_price,
        date,
        status) 
        values(
            '$product_tittle', 
            '$description', 
            '$product_keywords', 
            '$product_category', 
            '$product_brands', 
            '$product_image1',
            '$product_image2',
            '$product_image3',
            '$product_price',
            NOW(),
            '$product_status')";
        $result_query = mysqli_query($conn, $insert_product);
        if ($result_query) {
            echo "<script>alert('Insert product successfull')</script>";
            echo "<script>window.open('./index.php?view_products','_self')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Thêm sản phẩm</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <!-- title -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Tên sản phẩm</label>
                <input type="text" name="product_title" class="form-control" id="product_title" placeholder="Nhập tên sản phẩm" autocapitalize="off" required="required">
            </div>

            <!-- description -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="description" class="form-label">Mô tả sản phẩm</label>
                <input type="text" name="description" class="form-control" id="description" placeholder="Nhập mô tả sản phẩm" autocapitalize="off" required="required">
            </div>

            <!-- keywords -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keywords" class="form-label">Từ khóa sản phẩm</label>
                <input type="text" name="product_keywords" class="form-control" id="product_keywords" placeholder="Nhập vào từ khóa sản phẩm" autocapitalize="off" required="required">
            </div>

            <!-- categories -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_category" id="" class="form-select">
                    <option value="">Chọn loại sản phẩm</option>
                    <?php
                    $select_query = "SELECT * FROM `categories`";
                    $result_query = mysqli_query($conn, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $category_tittle = $row['category_tittle'];
                        $category_id = $row['category_id'];
                        echo "<option value='$category_id'>$category_tittle</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- brands -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_brands" id="" class="form-select">
                    <option value="">Chọn mức giá</option>
                    <?php
                    $select_query = "SELECT * FROM `brands`";
                    $result_query = mysqli_query($conn, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $brand_tittle = $row['brand_tittle'];
                        $brand_id = $row['brand_id'];
                        echo "<option value='$brand_id'>$brand_tittle</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- image 1 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image1" class="form-label">Hình ảnh 1</label>
                <input type="file" name="product_image1" class="form-control" id="product_image1" required="required">
            </div>

            <!-- image 2 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image2" class="form-label">Hình ảnh 2</label>
                <input type="file" name="product_image2" class="form-control" id="product_image2" required="required">
            </div>

            <!-- image 3 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image3" class="form-label">Hình ảnh 3</label>
                <input type="file" name="product_image3" class="form-control" id="product_image3" required="required">
            </div>

            <!-- price -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Giá sản phẩm</label>
                <input type="text" name="product_price" class="form-control" id="product_price" placeholder="Enter product price" autocapitalize="off" required="required">
            </div>

            <!-- price -->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_product" class="btn btn-info mb-3 px-3" value="Thêm sản phẩm">
            </div>
        </form>
    </div>
</body>

</html>