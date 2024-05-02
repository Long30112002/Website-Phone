<?php
if(isset($_GET['delete_product'])){
    $delete_id = $_GET['delete_product'];

    $delete_product = "DELETE FROM `products` WHERE product_id=$delete_id";
    $result_product = mysqli_query($conn, $delete_product);
    if($result_product){
        echo "<script>alert('Sản phẩm đã được xóa thành công!!!')</script>";
        echo "<script>window.open('./index.php?view_products','_self')</script>";
    }
}

