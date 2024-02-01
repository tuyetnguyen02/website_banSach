<?php
$title = 'Thanh toán';
require_once('layouts/header.php');

if (!isset($_SESSION['user_name'])) {
    echo "<script>window.location.href = 'admin/authen/user_login.php';</script>";
}
$taikhoan = $_SESSION['user_name'];
$sql_khachhang = "SELECT * FROM login WHERE username = '".$taikhoan."'";
$khachhang = executeResult($sql_khachhang, true);

$mkh = $khachhang['user_id'];
$sql_donhang = "SELECT * FROM orders WHERE  user_id = ".$mkh." ORDER BY user_id DESC";
$donhang = executeResult($sql_donhang);

?>

<!-- Checkout Form s-->
<div class="page-section inner-page-sec-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                    <!-- My Account Tab Content Start -->
                            <!-- Single Tab Content Start -->
                                <div class="myaccount-content">
                                    <h3>Đơn Hàng</h3>
                                    <div class="myaccount-table table-responsive text-center">
                                        <table class="table table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Mã Đơn</th>
                                                    <th>Ngày Đặt</th>
                                                    <th>Tổng Tiền</th>
                                                    <th>Trạng Thái</th>
                                                    <th>Xem</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while($item  = current($donhang)){ ?>
                                                    <tr>
                                                        <td><?php echo $item['order_id']; ?></td>
                                                        <td><?php echo $item['date_of_purchase']; ?></td>
                                                        <td><?php echo number_format($item['total_price']); ?>đ</td>
                                                        <td><?php echo $item['status']; ?></td>
                                                        <td><?php if($item['status']=="Chờ xác nhận"){echo '<a href="deleteOrder.php?order_id='.$item['order_id'].'">Huỷ đơn</a>';}
                                                        if($item['status']=="Đang giao hàng"){echo '<a href="OrderConfirm.php?order_id='.$item['order_id'].'">Đã nhận</a>';}?></td> 
                                                    </tr>
                                                <?php next($donhang); } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <!-- Single Tab Content End -->
                    <!-- My Account Tab Content End -->
                
            </div>
        </div>
    </div>
</div>



<?php
require_once('layouts/footer.php');
?>
