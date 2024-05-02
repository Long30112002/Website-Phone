<?php
include('../includes/connect.php');
include('../functions/common_functions.php');
@session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=h1, initial-scale=1.0">
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
    img {
        width: 100%;
        /* height: 100%; */
        margin: auto;
        display: block;
    }
</style>

<body>
    <!-- //code to access id  -->
    <?php
    // $user_ip = getIPAddress();
    $user_ip = $_SESSION['username'];
    $get_user = "SELECT * FROM `user_table` WHERE username='$user_ip'";
    $result = mysqli_query($conn, $get_user);
    $run_query = mysqli_fetch_array($result);
    $user_id = $run_query['user_id'];

    ?>
    <div class="container">
        <h2 class="text-center text-info">Payment options</h2>
        <!--  kiem tra id hien tai -->
        <!-- <?php
        // echo "<h2>$user_id</h2>"
        ?> -->
        <div class="row d-flex justify-content-center align-items-center my-2">
            <div class="col-md-6">
                <a href="https://www.paypal.com/vn/home" target="_blank"><img src="https://th.bing.com/th/id/R.abcd00f9b410db42665e7c7627c62bca?rik=Apr2Uz7sjemIfw&pid=ImgRaw&r=0" alt="Loading"></a>
            </div>
            <div class="col-md-6">
                <a href="order.php?user_id=<?php echo $user_id ?>">
                    <h2 class="text-center">Thanh toán khi nhận hàng.</h2>
                </a>
            </div>
        </div>
    </div>
</body>

</html>