<?php
if (isset($_GET['edit_account'])) {
    $user_session_name = $_SESSION['username'];
    $select_query = "SELECT * FROM `user_table` WHERE username='$user_session_name'";
    $result_query = mysqli_query($conn, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);

    $user_id = $row_fetch["user_id"];
    $user_name = $row_fetch["username"];
    $user_email = $row_fetch["user_email"];
    $user_address = $row_fetch["user_address"];
    $user_mobile = $row_fetch["user_mobile"];
}
if (isset($_POST['user_update'])) {
    $update_id = $user_id;

    $user_name = $_POST["user_name"];
    $user_email = $_POST["user_email"];
    $user_address = $_POST["user_address"];
    $user_mobile = $_POST["user_mobile"];

    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    move_uploaded_file($user_image_tmp, "./user_images/$user_image");

    //update query
    $update_data = "UPDATE `user_table` SET username = '$user_name', user_email='$user_email', user_image='$user_image', user_address='$user_address', user_mobile='$user_mobile' WHERE user_id='$update_id'";
    $result_query_update = mysqli_query($conn, $update_data);
    if ($result_query_update) {
        echo "<script>alert('Cập nhật thành công!!')</script>";
        echo "<script>window.open('logout.php','_self')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .note {
        animation-name: scaleNote;
        animation-duration: 2s;
        /* Độ dài của hiệu ứng */
        animation-iteration-count: infinite;
        /* Lặp vô hạn */
        animation-direction: alternate;
        /* Lặp ngược lại sau khi hoàn thành */
        animation-timing-function: ease-in-out;
        /* Kiểu chuyển tiếp */
    }

    @keyframes scaleNote {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }

        100% {
            transform: scale(1);
        }
    }
</style>

<body>
    <h1 class="text-center text-success">Chỉnh sửa thông tin</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-outline mb-4">
            <input name="user_name" type="text" class="form-control w-50 m-auto" value="<?php echo $user_name ?>">
        </div>
        <div class="form-outline mb-4">
            <input name="user_email" type="email" class="form-control w-50 m-auto" value="<?php echo $user_email ?>">
        </div>
        <div class="form-outline mb-4 d-flex w-50 m-auto">
            <input name="user_image" type="file" class="form-control m-auto">
            <img class="edit_profile ml-2" src="./user_images/<?php echo $user_image ?>" alt="Loading">
        </div>
        <div class="form-outline mb-4">
            <input value="<?php echo $user_address ?>" name="user_address" type="text" class="form-control w-50 m-auto">
        </div>
        <div class="form-outline mb-4">
            <input value="<?php echo $user_mobile ?>" name="user_mobile" type="text" class="form-control w-50 m-auto">
        </div>
        <input name="user_update" type="submit" class="bg-info py-2 px-3 border-0">
    </form>
    <h2 class="text-danger mt-3 note">
        <span class="font-weight-bold">Lưu ý:</span> Hệ thống sẽ tự động đăng xuất người dùng khi có bất kỳ thay đổi dữ liệu nào.
    </h2>

</body>

</html>