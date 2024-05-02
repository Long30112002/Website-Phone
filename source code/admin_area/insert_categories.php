<?php
include('../includes/connect.php');
if (isset($_POST['insert_cat'])) {
    $category_tittle = $_POST['cat_title'];

    //select data from dtb
    $select_query = "SELECT * FROM `categories` where category_tittle='$category_tittle'";
    $result_select = mysqli_query($conn, $select_query);
    $number = mysqli_num_rows($result_select);
    if ($number > 0) {
        echo "<script>alert('This have inside in database')</script>";
    } else {
        $insert_query = "INSERT into `categories` (category_tittle) value('$category_tittle')";
        $result_insert = mysqli_query($conn, $insert_query);
        if ($result_insert) {
            echo "<script>alert('Insert successfull')</script>";
            echo "<script>window.open('./index.php?view_categories','_self')</script>";
        }
    }
}
?>
<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bt-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input name="cat_title" type="text" class="form-control" placeholder="Thêm loại sản phẩm" aria-label="categories" aria-describedby="basic-addon1">
    </div>

    <div class="input-group w-10 mb-2 m-auto">
        <input class="bg-info border-0 p-2 my-2" name="insert_cat" value="Thêm loại sản phẩm" type="submit">
        <!-- <button class="bg-info p-2 my-3 border-0">Insert Categories</button> -->
    </div>
</form>