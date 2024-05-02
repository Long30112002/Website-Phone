<?php
if(isset($_GET['delete_category'])){
    $delete_id = $_GET['delete_category'];

    $delete_categories = "DELETE FROM `categories` WHERE category_id=$delete_id";
    $result_categories = mysqli_query($conn, $delete_categories);
    if($result_categories){
        echo "<script>alert('Category đã được xóa thành công!!!')</script>";
        echo "<script>window.open('./index.php?view_categories','_self')</script>";
    }
}

