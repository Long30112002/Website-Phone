<h3 class="text-center text-success">Tất cả đơn thanh toán</h3>
<table class="table table-bordered mt-5 text-center">

    <thead class="bg-info">
        <?php
        $select_user_payments = "SELECT * FROM `user_payments`";
        $result = mysqli_query($conn, $select_user_payments);
        $row_counts = mysqli_num_rows($result);
        echo "
            <tr>
                <th>STT</th>
                <th>Số hóa đơn</th>
                <th>Thành tiền</th>
                <th>Phương thức thanh toán</th>
                <th>Thời gian</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody class='bg-secondary text-light'>";

        if ($row_counts == 0) {
            echo "<h4 class='bg-danger text-center mt-5'>Không có đơn đặt hàng nào ở đây!!!</h4>";
        } else {
            $number = 0;
            while ($row_data = mysqli_fetch_assoc($result)) {
                $payment_id = $row_data['payment_id'];
                $order_id = $row_data['order_id'];

                $invoice_number = $row_data['invoice_number'];
                $amount = $row_data['amount'];
                $payment_mode = $row_data['payment_mode'];
                $date = $row_data['date'];
                $number++;
                echo
                "<tr>
                    <td>$number</td>
                    <td>$invoice_number</td>
                    <td>$amount</td>
                    <td>$payment_mode</td>
                    <td>$date</td>
                    <td>
                        <a type='button' class='text-success deleteButton' data-toggle='modal' data-target='#exampleModal' href='index.php?delete_brand=$payment_id' data-brand-name='$invoice_number'>
                            <i class='fa-solid fa-trash'></i>
                        </a>
                    </td>
                </tr>";
            }
        }
        ?>
        </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                Bạn có chắc chắn muốn xóa payment<strong><label class="brand-name" id="deleteBrandName"></label></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><a href="./index.php?view_categories" class="text-light text-decoration-none">Hủy</a></button>
                <button type="button" class="btn btn-primary"><a id="deleteLink" href="index.php?delete_brand=<?php echo $brand_id ?>" class="text-light text-decoration-none">Xóa</a></button>
            </div>
        </div>
    </div>
</div>

<script>
    function setDeleteUrlAndBrandName(url, brandName) {
        document.getElementById('deleteLink').href = url;
        document.getElementById('deleteBrandName').innerText = " " + brandName;
    }
    var deleteButtons = document.getElementsByClassName('deleteButton');
    for (var i = 0; i < deleteButtons.length; i++) {
        deleteButtons[i].onclick = function() {
            var deleteUrl = this.getAttribute('href');
            var brandName = this.getAttribute('data-brand-name');
            setDeleteUrlAndBrandName(deleteUrl, brandName);
        };
    }
</script>