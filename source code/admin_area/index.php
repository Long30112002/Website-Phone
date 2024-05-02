<?php
include('../includes/connect.php');
include('../functions/common_functions.php');
session_start();
if (!isset($_SESSION['admin_name'])) {
    header('Location: admin_login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>
<style>
    body {
        overflow-x: hidden;
    }

    .product_img {
        width: 10%;
        object-fit: contain;
    }
</style>

<body>
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="https://th.bing.com/th/id/OIP.hfML5tVVBY69HBz1mpONIgHaH_?rs=1&pid=ImgDetMain" class="logo" alt="">
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="" class="nav-link">Chào mừng <?php echo $_SESSION['admin_name'] ;  ?></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>

        <!-- second child -->
        <div class="bg-light">
            <h3 class="text-center p-2">Chi tiết quản lý
            </h3>
        </div>

        <!-- third child -->
        <div class="row">
            <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
                <div class="p-3">
                    <a href="">
                        <img src="https://th.bing.com/th/id/OIP.hfML5tVVBY69HBz1mpONIgHaH_?rs=1&pid=ImgDetMain" alt="" class="admin_image">
                    </a>
                    <!-- <p class="text-light text-center">Admin Name</p> -->
                    <p class="text-light text-center">
                        <?php
                        if (!isset($_SESSION['admin_name'])) {
                            echo
                            "<p class='text-light text-center'>Tên Admin</p>";
                        } else {
                            echo
                            "<p class='text-light text-center'>Admin " . $_SESSION['admin_name'] . "</p>";
                        }
                        ?>
                    </p>
                </div>

                <div class="button text-center m-auto">
                    <button class="my-3"><a href="insert_product.php" class="nav-link text-light bg-info my-1">Thêm sản phẩm</a></button>
                    <button><a href="index.php?view_products" class="nav-link text-light bg-info my-1">Xem sản phẩm</a></button>
                    <button><a href="index.php?insert_category" class="nav-link text-light bg-info my-1">Thêm loại sản phẩm</a></button>
                    <button><a href="index.php?view_categories" class="nav-link text-light bg-info my-1">Xem loại sản phẩm</a></button>
                    <button><a href="index.php?insert_brand" class="nav-link text-light bg-info my-1">Thêm giá tiền sản phẩm</a></button>
                    <button><a href="index.php?view_brands" class="nav-link text-light bg-info my-1">Xem giá tiền sản phẩm</a></button>
                    <button><a href="index.php?list_orders" class="nav-link text-light bg-info my-1">Tất cả đơn đặt hàng</a></button>
                    <button><a href="index.php?list_payment" class="nav-link text-light bg-info my-1">Tất cả đơn thanh toán</a></button>
                    <button><a href="index.php?list_users" class="nav-link text-light bg-info my-1">Danh sách người dùng</a></button>
                    <button><a href="logout.php" class="nav-link text-light bg-info my-1">Đăng xuất</a></button>
                </div>
            </div>
        </div>
        <!-- fourth child -->
        <div class="container my-5">
            <?php
            //insert
            if (isset($_GET['insert_category'])) {
                include('insert_categories.php');
            }
            if (isset($_GET['insert_brand'])) {
                include('insert_brands.php');
            }

            //view
            if (isset($_GET['view_products'])) {
                include('view_products.php');
            }
            if (isset($_GET['view_categories'])) {
                include('view_categories.php');
            }
            if (isset($_GET['view_brands'])) {
                include('view_brands.php');
            }
            if (isset($_GET['list_orders'])) {
                include('list_orders.php');
            }
            if (isset($_GET['list_payment'])) {
                include('list_payment.php');
            }
            if (isset($_GET['list_users'])) {
                include('list_users.php');
            }

            //edit
            if (isset($_GET['edit_product'])) {
                include('edit_product.php');
            }
            if (isset($_GET['edit_category'])) {
                include('edit_category.php');
            }
            if (isset($_GET['edit_brand'])) {
                include('edit_brand.php');
            }

            //delete
            if (isset($_GET['delete_category'])) {
                include('delete_category.php');
            }
            if (isset($_GET['delete_brand'])) {
                include('delete_brand.php');
            }
            if (isset($_GET['delete_product'])) {
                include('delete_product.php');
            }
            if (isset($_GET['delete_orders'])) {
                include('delete_orders.php');
            }
            ?>
        </div>

        <!-- footer -->
        <?php
        include('../includes/footer.php')
        ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>


</body>

</html>