<?php
include('includes/connect.php');
include('functions/common_functions.php');
session_start();
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
    <title>Website computer</title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

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
                            <a class="nav-link active" aria-current="page" href="index.php">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_all.php">Tất cả sản phẩm</a>
                        </li>
                        <?php
                        if (isset($_SESSION['username'])) {
                            echo
                            "<li class='nav-item'>
                                <a class='nav-link' href='./user_area/profile.php'>My Account</a>
                            </li>";
                        } else {
                            echo
                            "<li class='nav-item'>
                                <a class='nav-link' href='./user_area/user_register.php'>Register</a>
                            </li>";
                        }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Liên hệ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php">
                                <i class="fa fa-cart-arrow-down"></i><sup><?php cart_item() ?></sup>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Tổng tiền:100</a>
                        </li>
                    </ul>
                    <form class="d-flex" action="" method="GET">
                        <input name="search_data" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <!-- <button class="btn btn-outline-success" type="submit">Search</button> -->
                        <input name="search_data_product" class="btn btn-outline-light" type="submit" value="Search">
                    </form>
                </div>
            </div>
        </nav>
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
                        <a class='nav-link' href='#'>Chào mừng quý khách</a>
                    </li>";
                } else {
                    echo
                    "<li class='nav-item'>
                        <a class='nav-link' href='#'>Chào mừng " . $_SESSION['username'] . " </a>
                    </li>";
                }
                if (!isset($_SESSION['username'])) {
                    echo
                    "<li class='nav-item'>
                        <a class='nav-link' href='./user_area/user_login.php'>Đăng nhập</a>
                    </li>";
                } else {
                    echo
                    "<li class='nav-item'>
                        <a class='nav-link' href='./user_area/logout.php'>Đăng xuất</a>
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
        <div class="row px-1">
            <div class="col md-10">
                <div class="row">
                    <?php
                    search_product();
                    get_unique_categories();
                    get_unique_brands();
                    ?>
                </div>
            </div>

            <div class="col-md-2 bg-secondary p-0 mb-2">
                <!-- Brand1 -->
                <ul class="navbar-nav me-auto text-center">
                    <li class="nav-item bg-info">
                        <a href="" class="nav-link text-light">
                            <h4>Mức giá sản phẩm</h4>
                        </a>
                    </li>
                    <?php
                    //code
                    getBrand();
                    ?>
                </ul>

                <ul class="navbar-nav me-auto text-center">
                    <li class="nav-item bg-info">
                        <a href="" class="nav-link text-light">
                            <h4>Loại sản phẩm</h4>
                        </a>
                    </li>
                    <?php
                    //code
                    getCategories();
                    ?>
                </ul>
            </div>
        </div>

        <!-- footer -->
        <?php
        include('./includes/footer.php')
        ?>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>