<?php
include('../includes/connect.php');
include('../functions/common_functions.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    body {
        overflow: hidden;
    }
</style>
<?php
$username = '';
$email = '';
$password = '';
$confirm_password = '';


if (isset($_POST['admin_registration'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];

    $password = $_POST['password'];
    $hash_password = password_hash($password, PASSWORD_DEFAULT);
    $confirm_password = $_POST['confirm_password'];

    //select query
    $select_query = "SELECT * FROM `admin_table` WHERE admin_name='$username' or admin_email='$email'";
    $result = mysqli_query($conn, $select_query);
    $rows = mysqli_num_rows($result);
    if (empty($username)) {
        $error = 'Vui lòng nhập username';
    } elseif (empty($email)) {
        $error = 'Vui lòng nhập email';
    } else if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        $error = 'Email không hợp lệ';
    } elseif (empty($password)) {
        $error = 'Vui lòng nhập vào mật khẩu';
    } elseif (empty($confirm_password)) {
        $error = 'Vui lòng nhập vào xác nhận mật khẩu';
    } elseif ($rows > 0) {
        $error = 'Tên người dùng hoặc email đã tồn tại';
    } elseif ($password != $confirm_password) {
        $error = 'Mật khẩu không khớp';
    } else {
        //insert
        $insert_query = "INSERT INTO `admin_table` (admin_name, admin_email, admin_password)
        values ('$username', '$email', '$hash_password')";
        $sql = mysqli_query($conn, $insert_query);
        echo "<script>alert('Đăng kí thành công')</script>";

        //reset input
        $username = '';
        $email = '';
        $password = '';
        $confirm_password = '';
    }
}
?>

<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">
            Trang đăng kí ADMIN
        </h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6">
                <img class="img-fluid" src="https://wallpapercave.com/wp/wp4140937.jpg" alt="Loading">
            </div>
            <div class="col-lg-6 ">
                <form action="" method="POST">
                    <div class="form-outline w-50 mb-4">
                        <label for="username" class="form-label">Tên tài khoán</label>
                        <input value="<?= $username ?>" type="text" id="username" name="username" class="form-control" placeholder="Nhập vào tên tài khoản của bạn">
                    </div>
                    <div class="form-outline w-50 mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input value="<?= $username ?>" type="text" id="email" name="email" class="form-control" placeholder="Nhập vào email của bạn">
                    </div>
                    <div class="form-outline w-50 mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input value="<?= $password ?>" type="password" id="password" name="password" class="form-control" placeholder="Nhập vào mật khẩu của bạn">
                    </div>
                    <div class="form-outline w-50 mb-4">
                        <label for="confirm_password" class="form-label">Password</label>
                        <input value="<?= $confirm_password ?>" type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Xác nhạn lại mật khẩu của bạn">
                    </div>
                    <div class="form-outline mb-4">
                        <?php
                        if (!empty($error)) {
                            echo "<div class='alert alert-danger w-50'>$error</div>";
                        }
                        ?>
                        <input type="submit" name="admin_registration" value="Đăng kí" class="bg-info py-2 px-3 border-0">
                        <p class="small fw-bold mt-2 pt-1">Bạn đã có tài khoản?<a href="admin_login.php" class="link-danger">Đăng nhập</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>