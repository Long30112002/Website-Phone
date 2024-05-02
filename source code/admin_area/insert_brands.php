<?php
include('../includes/connect.php');
if (isset($_POST['insert_brand'])) {
    $brand_tittle = $_POST['brand_tittle'];

    //select data from dtb
    $select_query = "SELECT * FROM `brands` where brand_tittle = '$brand_tittle'";
    $result_select = mysqli_query($conn, $select_query);
    $number = mysqli_num_rows($result_select);
    if ($number > 0) {
        echo "<script>alert('Dữ liệu đã có trong database')</script>";
    } else {
        $insert_query = "INSERT into `brands` (brand_tittle) value('$brand_tittle')";
        $result_insert = mysqli_query($conn, $insert_query);
        if ($result_insert) {
            echo "<script>alert('Insert successfull')</script>";
            echo "<script>window.open('./index.php?view_brands','_self')</script>";
        }
    }
}
?>
<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bt-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input name="brand_tittle" type="text" class="form-control" placeholder="Thêm giá tiền" aria-label="brands" aria-describedby="basic-addon1">
    </div>

    <div class="input-group w-10 mb-2 m-auto">
        <input class="bg-info border-0 p-2 my-2" 
        name="insert_brand" 
        value="Thêm giá tiền" type="submit" placeholder="Thêm giá tiền">
        <!-- <button class="bg-info p-2 my-3 border-0">Insert Brands</button> -->
    </div>
</form>