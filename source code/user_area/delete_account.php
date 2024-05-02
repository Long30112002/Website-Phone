<h3 class="text-danger mb-4">Xóa tài khoản</h3>
<form action="" method="POST" class="mt-5">
    <div class="form-outline mb-4">
        <input name="delete_account" value="Xóa tài khoản" type="submit" class="form-control w-50 m-auto">
    </div>

    <div class="form-outline mb-4">
        <input name="dont_delete" value="Không xóa tài khoản" type="submit" class="form-control w-50 m-auto">
    </div>
</form>

<?php
$username_session = $_SESSION['username'];
if (isset($_POST['delete_account'])) {
    $delete_query = "DELETE FROM `user_table` WHERE username='$username_session'";
    $result = mysqli_query($conn, $delete_query);
    if ($result) {
        session_destroy();
        echo "<script>alert('Xóa tài khoản thành công!!!')</script>";
        echo "<script>window.open('../index.php','_self')</script>";
    }
}
if (isset($_POST['dont_delete'])) {
    echo "<script>window.open('profile.php','_self')</script>";
}

?>