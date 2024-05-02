<?php
include('../includes/connect.php');
include('../functions/common_functions.php');
// echo"HELLO";
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    echo $user_id;
}

// getting total item
$get_ip_add = getIPAddress();
$total_price = 0;
$cart_query_price = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_add'";
$result_cart_price = mysqli_query($conn, $cart_query_price);
$invoice_number = mt_rand();
// echo $invoice_number;
$status = 'pending';

$count_products = mysqli_num_rows($result_cart_price);

while ($row_price = mysqli_fetch_array($result_cart_price)) {
    $product_id = $row_price['product_id'];
    $select_product =  "SELECT * FROM `products` WHERE product_id = $product_id";
    $run_price = mysqli_query($conn, $select_product);

    while ($row_product_price = mysqli_fetch_array($run_price)) {
        $product_price = array($row_product_price['product_price']);
        $product_values = array_sum($product_price);
        $total_price += $product_values;
    }
}


//getting quantity 
$get_carts = "SELECT * FROM `cart_details`";
$run_carts = mysqli_query($conn, $get_carts);
$get_item_quantity = mysqli_fetch_array($run_carts);

$quantity = $get_item_quantity['quantity'];

if ($quantity == 0) {
    $quantity = 1;
    $subtotal = $total_price;
} else {
    $quantity = $quantity;
    // $quantityTemp = $quantity;
    $subtotal = $total_price * $quantity;
}

$insert_orders = "INSERT INTO `user_order`(user_id, amount_due, invoice_number, total_products, order_date, order_status)
values ($user_id, $subtotal, $invoice_number, $count_products, NOW(), '$status')";
$result_query = mysqli_query($conn, $insert_orders);
if ($result_query) {
    echo "<script>alert('Orders are submitted successfully')</script>";
    echo "<script>window.open('profile.php','_self')</script>";
}


//order pendding
$insert_pending_orders = "INSERT INTO `orders_pending`(user_id, invoice_number, product_id, quantity, order_status)
values ($user_id, $invoice_number, $product_id, $quantity, '$status')";
$result_peding = mysqli_query($conn, $insert_pending_orders);


//delete items
$empty_carts = "DELETE FROM `cart_details` WHERE ip_address = '$get_ip_add'";
$result_delete = mysqli_query($conn, $empty_carts);
