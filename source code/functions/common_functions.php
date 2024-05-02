<?php
// include('./includes/connect.php');
function getProduct()
{
    global $conn;
    if (!isset($_GET['category'])) {
        if (!isset($_GET['brand'])) {
            $select_query = "SELECT * FROM `products` order by rand() LIMIT 0,9";
            $result_query = $conn->query($select_query);
            while ($row = mysqli_fetch_assoc($result_query)) {
                // $file_path = "admin_area/product_images/ ";

                $product_id = $row['product_id'];
                $product_title = $row['product_tittle'];
                $product_description = $row['product_description'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $category_id = $row['category_id'];
                $brand_id = $row['brand_id'];
                echo
                "<div class='col-md-4 mb-2'>
            <div class='card'>
            <img src='admin_area/product_images/$product_image1' class=' card-img-top' alt='$product_title'>
                <div class='card-body'>
                    <h5 class='card-title'>$product_title</h5>
                    <p class='card-text'>$product_description</p>
                    <p class='card-text'>Price: $product_price</p>
                    <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to card</a>
                    <a href='product_details.php?product_id=$product_id' class='btn btn-secondary mt-2'>View more</a>
                    </div>
                </div>
        </div>";
            }
        }
    }
}
function get_all_products()
{
    global $conn;
    global $pages;
    global $page;
    $start = 0;
    $row_per_page = 6;
    $records = $conn->query("SELECT * FROM `products`");
    $nr_of_rows = $records->num_rows;
    $pages = ceil($nr_of_rows / $row_per_page);

    if (isset($_GET['page-nr'])) {
        $page = $_GET['page-nr'] - 1;
        $start = $page * $row_per_page;
    }

    if (!isset($_GET['category'])) {
        if (!isset($_GET['brand'])) {
            // $select_query = "SELECT * FROM `products` order by rand()";
            $select_query = "SELECT * FROM `products` LIMIT $start, $row_per_page";
            $result_query = $conn->query($select_query);
            while ($row = mysqli_fetch_assoc($result_query)) {
                // $file_path = "admin_area/product_images/ ";

                $product_id = $row['product_id'];
                $product_title = $row['product_tittle'];
                $product_description = $row['product_description'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $category_id = $row['category_id'];
                $brand_id = $row['brand_id'];
                echo
                "<div class='col-md-4 mb-2'>
                    <div class='card'>
                    <img src='admin_area/product_images/$product_image1' class=' card-img-top' alt='$product_title'>
                        <div class='card-body'>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text'>$product_description</p>
                            <p class='card-text'>Price: $product_price</p>
                            <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to card</a>
                            <a href='product_details.php?product_id=$product_id' class='btn btn-secondary mt-2'>View more</a>
                            </div>
                        </div>
                </div>";
            }
        }
    }
}

function get_unique_categories()
{
    global $conn;
    if (isset($_GET['category'])) {
        $category_id = $_GET['category'];
        $select_query = "SELECT * FROM `products` where category_id = $category_id";
        $result_query = mysqli_query($conn, $select_query);

        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows == 0) {
            echo "<h2 class='text-center text-danger'>This category is not available for this</h2>";
        }
        while ($row = mysqli_fetch_assoc($result_query)) {
            // $file_path = "admin_area/product_images/ ";

            $product_id = $row['product_id'];
            $product_title = $row['product_tittle'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];
            echo
            "<div class='col-md-4 mb-2'>
            <div class='card'>
            <img src='admin_area/product_images/$product_image1' class=' card-img-top' alt='$product_title'>
                <div class='card-body'>
                    <h5 class='card-title'>$product_title</h5>
                    <p class='card-text'>$product_description</p>
                    <p class='card-text'>Price: $product_price</p>
                    <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to card</a>
                    <a href='product_details.php?product_id=$product_id' class='btn btn-secondary mt-2'>View more</a>
                    </div>
                </div>
        </div>";
        }
    }
}

function get_unique_brands()
{
    global $conn;
    if (isset($_GET['brand'])) {
        $brand_id = $_GET['brand'];
        $select_query = "SELECT * FROM `products` where brand_id = $brand_id";
        $result_query = mysqli_query($conn, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows == 0) {
            echo "<h2 class='text-center text-danger'>This category is not available for this</h2>";
        }
        while ($row = mysqli_fetch_assoc($result_query)) {
            // $file_path = "admin_area/product_images/ ";

            $product_id = $row['product_id'];
            $product_title = $row['product_tittle'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];
            echo
            "<div class='col-md-4 mb-2'>
            <div class='card'>
            <img src='admin_area/product_images/$product_image1' class=' card-img-top' alt='$product_title'>
                <div class='card-body'>
                    <h5 class='card-title'>$product_title</h5>
                    <p class='card-text'>$product_description</p>
                    <p class='card-text'>Price: $product_price</p>
                    <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to card</a>
                    <a href='product_details.php?product_id=$product_id' class='btn btn-secondary mt-2'>View more</a>
                    </div>
                </div>
        </div>";
        }
    }
}


function getBrand()
{
    global $conn;
    $select_query = "SELECT * FROM `brands`";
    $result_query = $conn->query($select_query);
    while ($row = mysqli_fetch_assoc($result_query)) {
        $brand_tittle = $row['brand_tittle'];
        $brand_id = $row['brand_id'];
        echo
        "<li class='nav-item'>
            <a href='index.php?brand=$brand_id' class='nav-link text-light'>
                $brand_tittle
            </a>
        </li>";
    }
}



function getCategories()
{
    global $conn;
    $select_query = "SELECT * FROM `categories`";
    $result_query = $conn->query($select_query);
    while ($row = mysqli_fetch_assoc($result_query)) {
        $category_tittle = $row['category_tittle'];
        $category_id = $row['category_id'];
        echo
        "<li class='nav-item'>
            <a href='index.php?category=$category_id' class='nav-link text-light'>
                $category_tittle
            </a>
        </li>";
    }
}


function search_product()
{
    global $conn;
    if (isset($_GET['search_data_product'])) {
        $search_data_value = $_GET['search_data'];
        $search_query = "SELECT * FROM `products` WHERE product_keywords LIKE '%$search_data_value%' OR product_tittle LIKE '%$search_data_value%'";
        $result_query = mysqli_query($conn, $search_query);

        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows == 0) {
            echo "<h2 class='text-center text-danger'>This category is not available for this</h2>";
        }
        while ($row = mysqli_fetch_assoc($result_query)) {
            // $file_path = "admin_area/product_images/ ";

            $product_id = $row['product_id'];
            $product_title = $row['product_tittle'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];
            echo
            "<div class='col-md-4 mb-2'>
            <div class='card'>
            <img src='admin_area/product_images/$product_image1' class=' card-img-top' alt='$product_title'>
                <div class='card-body'>
                    <h5 class='card-title'>$product_title</h5>
                    <p class='card-text'>$product_description</p>
                    <p class='card-text'>Price: $product_price</p>
                    <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to card</a>
                    <a href='product_details.php?product_id=$product_id' class='btn btn-secondary mt-2'>View more</a>
                    </div>
                </div>
        </div>";
        }
    }
}


function view_details()
{
    global $conn;
    if (isset($_GET['product_id'])) {
        if (!isset($_GET['category'])) {
            if (!isset($_GET['brand'])) {
                $product_id = $_GET['product_id'];
                $select_query = "SELECT * FROM `products` where product_id=$product_id";
                $result_query = $conn->query($select_query);
                while ($row = mysqli_fetch_assoc($result_query)) {
                    // $file_path = "admin_area/product_images/ ";

                    $product_id = $row['product_id'];
                    $product_title = $row['product_tittle'];
                    $product_description = $row['product_description'];
                    $product_image1 = $row['product_image1'];
                    $product_image2 = $row['product_image2'];
                    $product_image3 = $row['product_image3'];
                    $product_price = $row['product_price'];
                    $category_id = $row['category_id'];
                    $brand_id = $row['brand_id'];
                    echo
                    "<div class='col-md-4 mb-2'>
                        <div class='card'>
                        <img src='admin_area/product_images/$product_image1' class=' card-img-top' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>Price: $product_price</p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-info mt-2'>Add to card</a>
                                <a href='index.php' class='btn btn-secondary'>Go back</a>
                                </div>
                            </div>
                    </div>
                    <div class='col-md-8'>
                        <div class='row'>
                            <div class='cold-md-12'>
                                <h4 class='text-center text-info mb-5'>
                                    Related products
                                </h4>
                            </div>
                            <div class='col-md-6'>
                                <img src='admin_area/product_images/$product_image2' class=' card-img-top' alt='$product_title'>
                            </div>
                            <div class='col-md-6'>
                                <img src='admin_area/product_images/$product_image3' class=' card-img-top' alt='$product_title'>
                            </div>
                        </div>
                    </div>";
                }
            }
        }
    }
}

// function get ip address
function getIPAddress()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// cart function 
function cart()
{
    if (isset($_GET['add_to_cart'])) {
        global $conn;
        $get_ip_add = getIPAddress();
        $get_product_id = $_GET['add_to_cart'];

        $select_query = "SELECT * FROM `cart_details` where ip_address = '$get_ip_add' 
        and product_id = '$get_product_id'";
        $result_query = mysqli_query($conn, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows > 0) {
            echo "<script>alert('Sản phẩm đã có trong vào giỏ hàng.')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        } else {
            $insert_query = "INSERT INTO `cart_details` (product_id, ip_address, quantity) 
            values ($get_product_id, '$get_ip_add', 0)";

            $result_query = mysqli_query($conn, $insert_query);
            echo "<script>alert('Thêm sản phẩm thành công.')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }
    }
}


// function to get cart item num
function cart_item()
{
    if (isset($_GET['add_to_cart'])) {
        global $conn;
        $get_ip_add = getIPAddress();

        $select_query = "SELECT * FROM `cart_details` where ip_address = '$get_ip_add'";
        $result_query = mysqli_query($conn, $select_query);

        $count_cart_items = mysqli_num_rows($result_query);
    } else {
        global $conn;
        $get_ip_add = getIPAddress();

        $select_query = "SELECT * FROM `cart_details` where ip_address = '$get_ip_add'";
        $result_query = mysqli_query($conn, $select_query);

        $count_cart_items = mysqli_num_rows($result_query);
    }
    echo $count_cart_items;
}


//total price function

function total_cart_price()
{
    global $conn;
    $total_price = 0;
    $get_ip_add = getIPAddress();
    $cart_query = "SELECT * FROM `cart_details` where ip_address='$get_ip_add'";
    $result = mysqli_query($conn, $cart_query);
    while ($row = mysqli_fetch_array($result)) {
        $product_id = $row['product_id'];
        $select_products = "SELECT * FROM `products` where product_id='$product_id'";
        $result_products = mysqli_query($conn, $select_products);

        while ($row_price = mysqli_fetch_array($result_products)) {
            $product_price = array($row_price['product_price']);
            $product_values = array_sum($product_price);
            $total_price += $product_values;
        }
    }
    echo $total_price;
}



//get user order details
function get_user_order_details()
{
    global $conn;
    $user_name = $_SESSION['username'];
    $get_details = "SELECT * FROM `user_table` WHERE username = '$user_name'";
    $result = mysqli_query($conn, $get_details);
    while ($row = mysqli_fetch_array($result)) {
        $user_id = $row['user_id'];
        if (!isset($_GET['edit_account'])) {
            if (!isset($_GET['my_orders'])) {
                if (!isset($_GET['delete_account'])) {
                    $get_orders = "SELECT * FROM `user_order` WHERE user_id = '$user_id' and order_status ='pending'";
                    $result_order = mysqli_query($conn, $get_orders);
                    $row_count = mysqli_num_rows($result_order);
                    if ($row_count > 0) {
                        echo
                        "<h3 class='text-center text-success mt-5 mb-2'>Bạn có
                            <span class='text-danger'>$row_count</span> đơn đặt hàng
                        </h3>
                        <p class='text-center'><a href='profile.php?my_orders' class='text-dark'>Chi tiết đơn đặt hàng</a></p>
                        ";
                    } else {
                        echo
                        "<h3 class='text-center text-success mt-5 mb-2'>
                            <span class='text-danger'>Bạn không có sản phẩm đặt hàng nào ở đây.</span>
                        </h3>
                        <p class='text-center'><a href='../index.php' class='text-dark'>Khám giá các đơn hàng</a></p>
                        ";
                    }
                }
            }
        }
    }
}
