<?php
if (isset($_GET['delete_payment'])) {
    $delete_id = $_GET['delete_payment'];

    $delete_payment = "DELETE FROM `user_payments` WHERE payment_id=$delete_id";
    $result_product = mysqli_query($conn, $delete_payment);
    if ($result_product) {
        echo "<script>alert('Payment đã được xóa thành công!!!')</script>";
        echo "<script>window.open('./index.php?list_payment','_self')</script>";
    }
}
