<?php
if (isset($_GET['edit_category'])) {
    $edit_category = $_GET['edit_category'];
    $get_cat = "SELECT * FROM `categories` WHERE category_id='$edit_category'";
    $result = mysqli_query($conn, $get_cat);
    $row = mysqli_fetch_assoc($result);
    $category_title = $row['category_tittle'];
    // echo ''.$category_title.'';
}
if (isset($_POST['edit_cat'])) {
    $cat_title = $_POST['category_title'];
    $update_query = "UPDATE `categories` SET category_tittle='$cat_title' WHERE category_id=$edit_category";
    $result_cat = mysqli_query($conn, $update_query);
    if($result_cat){
        echo"<script>alert('Category đã được cập nhật thành công!!!!')</script>";
        echo"<script>window.open('./index.php?view_categories','_self')</script>";
    }
}
?>
<div class="container mt-3">
    <h1 class="text-center">Chỉnh sửa loại sản phẩm</h1>
    <form action="" method="POST" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="category_title" class="form-label">Tên loại sản phẩm</label>
            <input value="<?php echo $category_title ?>" type="text" name="category_title" id="category_title" class="form-control" required="required">
        </div>
        <input name="edit_cat" type="submit" value="Cập nhật loại sản phẩm" class="btn btn-info px-3 mb-3">
    </form>
</div>