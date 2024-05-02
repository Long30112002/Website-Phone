<?php
include('../includes/connect.php');
include('../functions/common_functions.php');
@session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<style>
    body {
        overflow: hidden;
    }
</style>

<body>
    <div class="container-fuild my-3">
        <h2 class="text-center">User Login</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="POST">
                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label">Username</label>
                        <input for="user_username" type="text" id="user_username" placeholder="Enter your username" autocomplete="off" name="user_username" class="form-control" required="required" />
                    </div>

                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input for="user_password" type="password" id="user_password" placeholder="Enter your password" autocomplete="off" name="user_password" class="form-control" required="required" />
                    </div>

                    <div class="mt-4 pt-2">
                        <input name="user_login" type="submit" value="Login" class="bg-info py-2 px-3 border-0">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Bạn chưa có tài khoản?<a class="text-danger" href="user_register.php">Đăng ký ngay</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php
function verifyPassword($plainPassword, $hashedPassword)
{
    return password_verify($plainPassword, $hashedPassword);
}

if (isset($_POST['user_login'])) {
    $user_name = $_POST['user_username'];
    $user_password = $_POST['user_password'];

    $select_query = "SELECT * FROM `user_table` WHERE username = '$user_name'";
    $result = mysqli_query($conn, $select_query);
    $row_count = mysqli_num_rows($result);


    //get pass indatabase to verify
    $row_data = mysqli_fetch_assoc($result);


    $user_ip = getIPAddress();

    //cart items
    $select_query_cart = "SELECT * FROM `cart_details` WHERE ip_address = '$user_ip'";
    $select_cart = mysqli_query($conn, $select_query_cart);
    $row_count_cart = mysqli_num_rows($select_cart);

    if ($row_count > 0) {
        $_SESSION['username'] = $user_name;
        if (password_verify($user_password, $row_data['user_password'])) {
            if ($row_count == 1 and $row_count_cart == 0) {
                $_SESSION['username'] = $user_name;
                echo "<script>alert('Đăng nhập thành công')</script>";
                echo "<script>window.open('profile.php','_self')</script>";
            } else {
                $_SESSION['username'] = $user_name;
                echo "<script>alert('Đăng nhập thành công')</script>";
                echo "<script>window.open('payment.php','_self')</script>";
            }
        } else {
            echo "<script>alert('Thông tin tài khoản không chính xác!!!')</script>";
        }
    } else {
        echo "<script>alert('Thông tin tài khoản không chính xác!!!')</script>";
    }
}
?>