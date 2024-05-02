<?php
if(isset($_GET['delete_brand'])){
    $delete_id = $_GET['delete_brand'];

    $delete_brands = "DELETE FROM `brands` WHERE brand_id= '$delete_id'";
    $result_brands = mysqli_query($conn, $delete_brands);
    if($result_brands){
        echo "<script>alert('Brands đã được xóa thành công!!!')</script>";
        echo "<script>window.open('./index.php?view_brands','_self')</script>";
    }
}

