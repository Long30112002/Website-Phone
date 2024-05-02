<?php
include('../includes/connect.php');
include('../functions/common_functions.php');
session_start();
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

<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">
            Trang đăng nhập ADMIN
        </h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6">
                <img class="img-fluid" src="https://wallpapercave.com/wp/wp4140937.jpg" alt="Loading">
            </div>
            <div class="col-lg-6">
                <form action="" method="POST">
                    <div class="form-outline w-50  mb-4">
                        <label for="username" class="form-label">Tên tài khoán</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Nhập vào tên tài khoản của bạn" required="required">
                    </div>
                    <div class="form-outline w-50  mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Nhập vào mật khẩu của bạn" required="required">
                    </div>
                    <div class="form-outline w-50  mb-4">
                        <?php
                        if (!empty($error)) {
                            echo "<div class='alert alert-danger w-50'>$error</div>";
                        }
                        ?>
                        <input type="submit" name="admin_login" value="Đăng nhập" class="bg-info py-2 px-3 border-0">
                        <p class="small fw-bold mt-2 pt-1">Bạn chưa có tài khoản?<a href="admin_register.php" class="link-danger">Đăng kí</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php
if (isset($_POST['admin_login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $select_query = "SELECT * FROM `admin_table` WHERE admin_name = '$username'";
    $result = mysqli_query($conn, $select_query);
    $row_count = mysqli_num_rows($result);

    //get pass indatabase to verify
    $row_data = mysqli_fetch_assoc($result);

    if ($row_count > 0) {
        $_SESSION['admin_name'] = $username;
        if (password_verify($password, $row_data['admin_password'])) {
            if ($row_count == 1) {
                $_SESSION['admin_name'] = $username;
                echo "<script>alert('Đăng nhập thành công')</script>";
                echo "<script>window.open('index.php','_self')</script>";
            }
        } else {
            echo "<script>alert('Thông tin tài khoản không chính xác!!!')</script>";
        }
    } else {
        echo "<script>alert('Thông tin tài khoản không chính xác!!!')</script>";
    }
}
?>