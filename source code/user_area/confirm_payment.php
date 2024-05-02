<?php
include('../includes/connect.php');
session_start();

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    // echo $order_id;
    $select_data = "SELECT * FROM `user_order` WHERE order_id='$order_id'";
    $result = mysqli_query($conn, $select_data);
    $row = mysqli_fetch_assoc($result);
    $invoice_number = $row['invoice_number'];
    $amount_due = $row['amount_due'];
}

if (isset($_POST['confirm_payment'])) {
    $invoice_number = $_POST['invoice_number'];
    $amount = $_POST['amount'];
    $payment_mode = $_POST['payment_mode'];
    $insert_query = "INSERT INTO `user_payments` (order_id , invoice_number, amount, payment_mode) 
    values($order_id, $invoice_number, $amount, '$payment_mode')";
    $result = mysqli_query($conn, $insert_query);
    if ($result) {
        echo "<h3 class='text-center text-light'>Xác nhận thanh toán thành công</h3>";
        echo "<script>window.open('profile.php','_self')</script>";
    }
    $update_orders = "UPDATE `user_order` SET order_status='Complete' WHERE order_id=$order_id";
    $result = mysqli_query($conn, $update_orders);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang thanh toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>

<body class="bg-secondary">
    <div class="container my-5">
        <h1 class="text-center text-light">Xác nhận thanh toán</h1>
        <form action="" method="POST">
            <div class="form-outline text-center w-50 m-auto">
                <input name="invoice_number" type="text" class="form-control w-50 m-auto" value="<?php echo $invoice_number ?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="" class="text-light">Thành tiền</label>
                <input name="amount" type="text" class="form-control w-50 m-auto" value="<?php echo $amount_due ?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="" class="text-light">Chọn phương thức thanh toán</label>
                <select class="form-select w-50 m-auto" name="payment_mode" id="">
                    <option>Lựa chọn</option>
                    <option>UPI</option>
                    <option>Netbanking</option>
                    <option>Paypal</option>
                    <option>Cash on Delivery</option>
                    <option>Payoffline</option>
                </select>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="submit" name="confirm_payment" class="bg-info py-2 px-3 border-0" value="Confirm"></input>
            </div>
        </form>
    </div>
</body>

</html>