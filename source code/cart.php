<?php
include('includes/connect.php');
include('functions/common_functions.php');
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
    <title>Website computer</title>
    <!-- bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="style.css">

</head>
<style>
    .cart_img {
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
                            <a class="nav-link" href="#">
                                <i class="fa fa-cart-arrow-down"></i><sup><?php cart_item() ?></sup>
                            </a>
                        </li>
                    </ul>
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

        <!-- fourth child table -->
        <div class="container">
            <div class="row">
                <form action="" method="POST">
                    <table class="table table-bordered text-center">

                        <tbody>
                            <!-- //php code -->
                            <?php
                            $total_price = 0;
                            $get_ip_add = getIPAddress();
                            $cart_query = "SELECT * FROM `cart_details` where ip_address='$get_ip_add'";
                            $result = mysqli_query($conn, $cart_query);
                            $result_count = mysqli_num_rows($result);
                            if ($result_count > 0) {
                                echo
                                "<thead>
                                    <tr>
                                        <th>Product title</th>
                                        <th>Product Image</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Remove</th>
                                        <th>Operations</th>
                                    </tr>
                                </thead>";
                                while ($row = mysqli_fetch_array($result)) {
                                    $product_id = $row['product_id'];
                                    $select_products = "SELECT * FROM `products` where product_id='$product_id'";
                                    $result_products = mysqli_query($conn, $select_products);

                                    while ($row_price = mysqli_fetch_array($result_products)) {
                                        $product_price = array($row_price['product_price']);

                                        $price_table = $row_price['product_price'];
                                        $product_tittle = $row_price['product_tittle'];
                                        $product_image = $row_price['product_image1'];

                                        $product_values = array_sum($product_price);
                                        $total_price += $product_values;
                                        // $file_path = "admin_area/product_images/ ";

                            ?>
                                        <tr>
                                            <td><?php echo $product_tittle; ?></td>
                                            <td><img class="cart_img" src="admin_area/product_images/ <?php echo $product_image; ?>" alt=""></td>
                                            <td><input class="form-input w-50" type="text" name="qty"></td>
                                            <?php

                                            // $get_ip_add = getIPAddress();
                                            // $quantities = $_POST['qty'];
                                            // $total_price = $total_price * $quantities;
                                            // echo ($total_price);

                                            if (isset($_POST['update_cart'])) {
                                                $quantities = $_POST['qty'];
                                                $update_cart = "UPDATE `cart_details` SET quantity = '$quantities' where ip_address = '$get_ip_add'";
                                                $result_products_quantity = mysqli_query($conn, $update_cart);
                                                $total_price = $total_price * $quantities;
                                            }
                                            ?>
                                            <td><?php echo $price_table; ?></td>
                                            <td>
                                                <input type="checkbox" name="removeitem[]" value="<?php echo $product_id; ?>">
                                            </td>
                                            <td>
                                                <input name="update_cart" type="submit" value="Update" class="bg-info px-3 border-0 py-2 mx-3 mt-2">
                                                <input name="remove_cart" type="submit" value="Remove" class="bg-info px-3 border-0 py-2 mx-3 mt-2">
                                            </td>
                                        </tr>
                            <?php
                                    }
                                }
                            } else {
                                echo "<h2 class='text-danger text-center'>Ôi không!! Bạn không có sản phẩm nào hết!!</h2>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="d-flex mb-5">
                        <?php
                        $get_ip_add = getIPAddress();
                        $cart_query = "SELECT * FROM `cart_details` where ip_address='$get_ip_add'";
                        $result = mysqli_query($conn, $cart_query);
                        $result_count = mysqli_num_rows($result);
                        if ($result_count > 0) {
                            echo
                            "
                            <h4 class='px-3'>Subtotal: <strong class='text-info'>$total_price</strong></h4>
                            <input name='continue_shopping' type='submit' value='Continue Shopping' class='bg-info px-3 border-0 py-2 mx-3 mt-2'>
                            <button class='bg-secondary text-light px-3 border-0 py-2 mt-2'><a class='text-light text-decoration-none' href='./user_area/checkout.php'>Checkout</a></button>
                            ";
                        } else {
                            echo
                            "
                            <input name='continue_shopping' type='submit' value='Continue Shopping' class='bg-info px-3 border-0 py-2 mx-3 mt-2'>
                            ";
                        }
                        if (isset($_POST['continue_shopping'])) {
                            echo "<script>window.open('index.php','_self')</script>";
                        }
                        ?>
                    </div>
            </div>
        </div>
        </form>

        <!-- function remove  -->
        <?php
        function remove_cart_item()
        {
            global $conn;

            if (isset($_POST['remove_cart'])) {
                if ($_POST['removeitem'] == '') {
                    echo "<script>alert('Vui lòng lựa chọn sản phẩm để xóa!!!')</script>";
                    echo "<script>window.open('cart.php','_self')</script>";
                }
                foreach ($_POST['removeitem'] as $remove_id) {
                    // echo $remove_id;
                    $delete_query = "DELETE FROM `cart_details` where product_id=$remove_id";
                    $run_delete =  mysqli_query($conn, $delete_query);
                    if ($run_delete) {
                        echo "<script>window.open('cart.php','_self')</script>";
                    }
                }
            }
        }
        // echo $remove_item = remove_cart_item();
        remove_cart_item();
        ?>
        <?php
        include('./includes/footer.php')
        ?>
    </div>
    <!-- footer -->



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>