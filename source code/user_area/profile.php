<?php
include('../includes/connect.php');
include('../functions/common_functions.php');
session_start();
// include('product_details.php');
?>
<?php
// $select_query = "SELECT * FROM `products` order by rand() LIMIT 0,9";
// $result_query = $conn->query($select_query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wellcome <?php echo $_SESSION['username'] ?></title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<style>
    body {
        overflow-x: hidden;
    }

    .profile_img {
        width: 90%;
        border-radius: 50%;
        margin: auto;
        display: block;
        object-fit: contain;
    }

    .border_profile {
        border-top-left-radius: 60%;
        border-top-right-radius: 60%;
    }

    .edit_profile {
        width: 100px;
        height: 100px;
        object-fit: contain;
    }
</style>

<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img class="logo" src="https://th.bing.com/th/id/OIP.hfML5tVVBY69HBz1mpONIgHaH_?rs=1&pid=ImgDetMain" alt="">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../display_all.php">Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">My Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../cart.php">
                                <i class="fa fa-cart-arrow-down"></i><sup><?php cart_item() ?></sup>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Total Price: <?php total_cart_price() ?></a>
                        </li>
                    </ul>
                    <form class="d-flex" action="../search_product.php" method="GET">
                        <input name="search_data" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <!-- <button class="btn btn-outline-success" type="submit">Search</button> -->
                        <input name="search_data_product" class="btn btn-outline-light" type="submit" value="Search">
                    </form>
                </div>
            </div>
        </nav>

        <!-- calling cart function -->
        <?php
        cart();
        ?>
        <!-- second child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">
                <?php
                if (!isset($_SESSION['username'])) {
                    echo
                    "<li class='nav-item'>
                        <a class='nav-link' href='#'>Welcome Guest</a>
                    </li>";
                } else {
                    echo
                    "<li class='nav-item'>
                        <a class='nav-link' href='#'>Welcome " . $_SESSION['username'] . " </a>
                    </li>";
                }
                if (!isset($_SESSION['username'])) {
                    echo
                    "<li class='nav-item'>
                        <a class='nav-link' href='./user_area/user_login.php'>Login</a>
                    </li>";
                } else {
                    echo
                    "<li class='nav-item'>
                        <a class='nav-link' href='logout.php'>Logout</a>
                    </li>";
                }
                ?>
            </ul>
        </nav>


        <!-- third child -->
        <div class="bg-light">
            <h3 class="text-center">HỆ THÔNG BÁN LẺ ĐIỆN THOẠI</h3>
            <p class="text-center">Hoàng Long</p>
        </div>

        <!-- fourth child -->
        <div class="row">
            <div class="col-md-2">
                <ul class="navbar-nav bg-secondary text-center border_profile">
                    <li class="nav-item bg-info border_profile">
                        <a href="#" class="nav-link text-light">
                            <h4>Your profile</h4>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav bg-secondary text-center " style="height: 100vh;">
                    <?php
                    $user_name = $_SESSION['username'];
                    // $user_id = $_SESSION['user_id'];
                    $user_image = "SELECT * FROM `user_table` WHERE username = '$user_name'";
                    $user_image = mysqli_query($conn, $user_image);
                    $row_image = mysqli_fetch_array($user_image);
                    $user_image = $row_image['user_image'];

                    echo
                    " <li class='nav-item mt-2'>
                        <img class='profile_img' src='./user_images/$user_image' alt=''>
                    </li>";
                    ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link text-light">
                            Pending orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="profile.php?edit_account" class="nav-link text-light">
                            Edit account
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="profile.php?my_orders" class="nav-link text-light">
                            My orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="profile.php?delete_account" class="nav-link text-light">
                            Delete my account
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link text-light">
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10 text-center">
                <?php
                get_user_order_details();
                if (isset($_GET['edit_account'])) {
                    // echo"HIHIHHIIIH";
                    include('edit_account.php');
                }
                if (isset($_GET['my_orders'])) {
                    // echo"HIHIHHIIIH";
                    include('user_orders.php');
                }
                if (isset($_GET['delete_account'])) {
                    // echo"HIHIHHIIIH";
                    include('delete_account.php');
                }
                ?>
            </div>
        </div>


        <!-- footer -->
        <?php
        include('../includes/footer.php')
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>