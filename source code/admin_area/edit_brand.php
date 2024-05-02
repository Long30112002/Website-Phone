<?php
if (isset($_GET['edit_brand'])) {
    $edit_brand = $_GET['edit_brand'];
    $get_brand = "SELECT * FROM `brands` WHERE brand_id='$edit_brand'";
    $result = mysqli_query($conn, $get_brand);
    $row = mysqli_fetch_assoc($result);
    $brand_title = $row['brand_tittle'];
    // echo ''.$category_title.'';
}
if (isset($_POST['edit_brand'])) {
    $brand_title = $_POST['brand_title'];
    $update_query = "UPDATE `brands` SET brand_tittle='$brand_title' WHERE brand_id=$edit_brand";
    $result_brand = mysqli_query($conn, $update_query);
    if($result_brand){
        echo"<script>alert('Brand đã được cập nhật thành công!!!!')</script>";
        echo"<script>window.open('./index.php?view_brands','_self')</script>";
    }
}
?>
<div class="container mt-3">
    <h1 class="text-center">Chỉnh sửa giá tiền</h1>
    <form action="" method="POST" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="brand_title" class="form-label">Mức giá</label>
            <input value="<?php echo $brand_title ?>" type="text" name="brand_title" id="brand_title" class="form-control" required="required">
        </div>
        <input name="edit_brand" type="submit" value="Cập nhật giá tiền" class="btn btn-info px-3 mb-3">
    </form>
</div>