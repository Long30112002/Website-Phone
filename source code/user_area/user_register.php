<?php
include('../includes/connect.php');
include('../functions/common_functions.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<?php
$user_username = '';
$user_email = '';
$user_password = '';
$confirm_user_password = '';
$user_address = '';
$user_contact = '';
$error = '';


if (isset($_POST['user_register'])) {
    $user_username = $_POST['user_username'];

    $user_email = $_POST['user_email'];

    $user_password = $_POST['user_password'];
    $hash_password = password_hash($user_password, PASSWORD_DEFAULT);

    $confirm_user_password = $_POST['confirm_user_password'];

    $user_address = $_POST['user_address'];

    $user_contact = $_POST['user_contact'];

    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];

    $user_ip = getIPAddress();

    //select query
    $select_query = "SELECT * FROM `user_table` WHERE username='$user_username' or user_email='$user_email'";
    $result = mysqli_query($conn, $select_query);
    $rows = mysqli_num_rows($result);
    // if (empty($user_username)) {
    //     $error = 'Vui lòng nhập username';
    // } elseif (empty($user_email)) {
    //     $error = 'Vui lòng nhập email';
    // } elseif (empty($user_image)) {
    //     $error = 'Vui lòng chọn avatar';
    // } elseif (empty($user_password)) {
    //     $error = 'Vui lòng nhập vào mật khẩu';
    // } elseif (empty($confirm_user_password)) {
    //     $error = 'Vui lòng nhập vào xác nhận mật khẩu';
    // } elseif (empty($user_address)) {
    //     $error = 'Vui lòng nhập vào địa chỉ';
    // } elseif (empty($user_contact)) {
    //     $error = 'Vui lòng nhập vào số điện thoại';
    // } else
    if ($rows > 0) {
        echo "<script>alert('Tên người dùng hoặc email đã tồn tại')</script>";
    } elseif ($user_password != $confirm_user_password) {
        echo "<script>alert('Mật khẩu không khớp')</script>";
    } else {
        //insert
        move_uploaded_file($user_image_tmp, "./user_images/$user_image");
        $insert_query = "INSERT INTO `user_table` (username, user_email, user_password, user_image, user_ip, user_address, user_mobile)	values ('$user_username', '$user_email', '$hash_password', '$user_image', '$user_ip', '$user_address', '$user_contact')";
        $sql = mysqli_query($conn, $insert_query);
        echo "<script>alert('Đăng kí thành công')</script>";

        //reset input
        $user_username = '';
        $user_email = '';
        $user_password = '';
        $confirm_user_password = '';
        $user_address = '';
        $user_contact = '';
    }



    //select cart item
    $select_cart_items = "SELECT * FROM `cart_details` WHERE ip_address='$user_ip'";
    $result_cart = mysqli_query($conn, $select_cart_items);
    $row_count = mysqli_num_rows($result_cart);

    if ($row_count > 0) {
        $_SESSION['username'] = $user_username;
        echo "<script>alert('Bạn có sản phẩm trong giỏ hàng')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
    } else {
        echo "<script>window.open('../index.php','_self')</script>";
    }
}

if (isset($_POST['go_back'])) {
    echo "<script>window.open('../index.php','_self')</script>";
}
?>

<body>
    <div class="container-fuild my-3">
        <h2 class="text-center">New User Register</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label">Username</label>
                        <input value="<?= $user_username ?>" for="user_username" type="text" id="user_username" placeholder="Enter your username" autocomplete="off" name="user_username" class="form-control" required="required"/>
                    </div>
                    <div class="form-outline mb-4">
                        <label for="user_email" class="form-label">Email</label>
                        <input value="<?= $user_email ?>" for="user_email" type="email" id="user_email" placeholder="Enter your email" autocomplete="off" name="user_email" class="form-control" required="required"/>
                    </div>

                    <div class="form-outline mb-4">
                        <label for="user_image" class="form-label">User image</label>
                        <input type="file" id="user_image" name="user_image" class="form-control">
                    </div>

                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input value="<?= $user_password ?>" for="user_password" type="password" id="user_password" placeholder="Enter your password" autocomplete="off" name="user_password" class="form-control" required="required"/>
                    </div>

                    <div class="form-outline mb-4">
                        <label for="confirm_user_password" class="form-label">Confirm Password</label>
                        <input value="<?= $confirm_user_password ?>" for="confirm_user_password" type="password" id="confirm_user_password" placeholder="Confirm your password" autocomplete="off" name="confirm_user_password" class="form-control" required="required"/>
                    </div>

                    <div class="form-outline mb-4">
                        <label for="user_address" class="form-label">Address</label>
                        <input value="<?= $user_address ?>" for="user_address" type="text" id="user_address" placeholder="Enter your address" autocomplete="off" name="user_address" class="form-control" required="required" />
                    </div>

                    <div class="form-outline mb-4">
                        <label for="user_contact" class="form-label">Contact</label>
                        <input value="<?= $user_contact ?>" for="user_contact" type="text" id="user_contact" placeholder="Enter your mobile phone" autocomplete="off" name="user_contact" class="form-control" required="required" />
                    </div>
                    <div class="mt-4 pt-2">
                        <!-- <?php
                        // if (!empty($error)) {
                        //     echo "<div class='alert alert-danger'>$error</div>";
                        // }
                        ?> -->
                        <input name="user_register" type="submit" value="Register" class="bg-info py-2 px-3 border-0">
                        <input name="go_back" type="submit" value="Quay lại" class="bg-info py-2 px-3 border-0">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Bạn đã có tài khoản?<a class="text-danger" href="user_login.php">Đăng nhập ngay</a></p>
                    </div>
                    <div class="mt-4 pt-2">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>