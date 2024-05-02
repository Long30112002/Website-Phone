<h3 class="text-center text-success">Tất cả đơn đặt hàng</h3>
<table class="table table-bordered mt-5 text-center">

    <thead class="bg-info">
        <?php
        $select_user_order = "SELECT * FROM `user_order`";
        $result = mysqli_query($conn, $select_user_order);
        $row_counts = mysqli_num_rows($result);
        echo "
            <tr>
                <th>STT</th>
                <th>Số tiền đến hạn</th>
                <th>Số hóa đơn</th>
                <th>Số hóa đơn</th>
                <th>Tổng sản phẩm</th>
                <th>Trạng thái</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody class='bg-secondary text-light'>";

        if ($row_counts == 0) {
            echo "<h4 class='bg-danger text-center mt-5'>Không có đơn đặt hàng nào ở đây!!!</h4>";
        } else {
            $number = 0;
            while ($row_data = mysqli_fetch_assoc($result)) {
                $order_id = $row_data['order_id'];
                $user_id = $row_data['user_id'];
                $amount_due = $row_data['amount_due'];
                $invoice_number = $row_data['invoice_number'];
                $total_products = $row_data['total_products'];
                $order_date = $row_data['order_date'];
                $order_status = $row_data['order_status'];
                $number++;
                echo
                "<tr>
                    <td>$number</td>
                    <td>$amount_due</td>
                    <td>$invoice_number</td>
                    <td>$order_date</td>
                    <td>$total_products</td>
                    <td>$order_status</td>
                    <td>
                        <a type='button' class='text-success deleteButton' data-toggle='modal' data-target='#exampleModal' href='index.php?delete_orders=$order_id' data-brand-name='$invoice_number'>
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
                Bạn có chắc chắn muốn xóa<strong><label class="brand-name" id="deleteBrandName"></label></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><a href="./index.php?list_orders" class="text-light text-decoration-none">Hủy</a></button>
                <button type="button" class="btn btn-primary"><a id="deleteLink" href="index.php?delete_orders=<?php echo $brand_id ?>" class="text-light text-decoration-none">Xóa</a></button>
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