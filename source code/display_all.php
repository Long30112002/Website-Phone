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


<style>
    body {
        overflow-x: hidden;
    }

    .pagination .page-numbers a {
        display: inline-block;
        text-decoration: none;
        color: #111111;
        padding: 10px 20px;
        border: thin solid #555;
        font-size: 18px;
    }

    .pagination .page-numbers a.active {
        background-color: #0d81cd;
        color: #fff;
        border: thin solid #0d81cd;
    }

    .pagination .page-numbers a:focus {
        border: 1px solid #00ff00;
    }

    .page-info {
        text-align: center;
        font-size: 18px;
        font-weight: bold;
    }

    .pagination {
        margin-top: 20px;
        justify-content: center;
    }

    .content p {
        margin-bottom: 25px;
    }

    .page-numbers {
        display: inline-block;
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
                            <a class="nav-link active" aria-current="page" href="index.php">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_all.php">Tất cả sản phẩm</a>
                        </li>
                        <?php
                        if (isset($_SESSION['username'])) {
                            echo
                            "<li class='nav-item'>
                                <a class='nav-link' href='./user_area/profile.php'>Tài khoản của tôi</a>
                            </li>";
                        } else {
                            echo
                            "<li class='nav-item'>
                                <a class='nav-link' href='./user_area/user_register.php'>Đăng kí</a>
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
                    <form class="d-flex" action="search_product.php" method="GET">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Tìm kiếm</button>
                    </form>
                </div>
            </div>
        </nav>


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
        <div class="row pb-2">
            <div class="col md-10">
                <div class="row">
                    <?php
                    get_all_products();
                    get_unique_categories();
                    get_unique_brands();
                    ?>
                    <div class="page-info">
                        <?php
                        if (!isset($_GET['page-nr'])) {
                            $page = 1;
                        } else {
                            $page = $_GET['page-nr'];
                        }
                        ?>
                        Showing <?php echo $page ?> of <?php echo $pages ?>
                    </div>
                    <div class="pagination mb-2">
                        <div class="page-numbers mr-2">
                            <a href="?page-nr=1">First</a>
                            <?php
                            if (isset($_GET['page-nr']) && $_GET['page-nr'] > 1) {
                            ?>
                                <a href="?page-nr=<?php echo $_GET['page-nr'] - 1 ?>">Previous</a>
                            <?php
                            } else {
                            ?>
                                <a>Previous</a>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="page-numbers">
                            <?php
                            for ($counter = 1; $counter <= $pages; $counter++) {
                            ?>
                                <a href="?page-nr=<?php echo $counter ?>"><?php echo $counter ?></a>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="page-numbers ml-2">
                            <?php
                            if (!isset($_GET['page-nr'])) {
                            ?>
                                <a href="?page-nr=2">Next</a>
                                <?php
                            } else {
                                if ($_GET['page-nr'] >= $pages) {
                                ?>
                                    <a>Next</a>
                                <?php
                                } else {
                                ?>
                                    <a href="?page-nr=<?php echo $_GET['page-nr'] + 1 ?>">Next</a>
                            <?php
                                }
                            }
                            ?>
                            <a href="?page-nr=<?php echo $pages ?>">Last</a>
                        </div>
                    </div>
                    <!-- <script>
                        let links = document.querySelectorAll('.pagination .page-numbers > a');
                        let bodyId = parseInt(document.body.id) - 1;
                        links[bodyId].classList.add("active");
                    </script> -->
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