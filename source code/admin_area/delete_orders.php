<?php
if (isset($_GET['delete_orders'])) {
    $delete_id = $_GET['delete_orders'];

    $delete_orders = "DELETE FROM `user_order` WHERE order_id=$delete_id";
    $result_product = mysqli_query($conn, $delete_orders);
    if ($result_product) {
        echo "<script>alert('Order đã được xóa thành công!!!')</script>";
        echo "<script>window.open('./index.php?list_orders','_self')</script>";
    }
}
