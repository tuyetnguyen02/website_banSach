<?php
$title = 'Quản Lý Đơn hàng';
$baseUrl = '../';
require_once('../layouts/header.php');

// Số lượng sách hiển thị trên mỗi trang
// define('BOOKS_PER_PAGE', 5);

$user_id = getGet('user_id');
if($user_id != '' && $user_id > 0) {
	$sql = "SELECT * FROM orders inner join login on orders.user_id = login.user_id WHERE orders.user_id = $user_id";
	$orderItems = executeResult($sql);
} else {
	$sql = "SELECT * FROM orders inner join login on orders.user_id = login.user_id";
	$orderItems = executeResult($sql);
}


// $sql = "SELECT * FROM orders inner join login on orders.user_id = login.user_id";
// $orderItems = executeResult($sql);

?>
<!-- Simple Datatable start -->
<div class="card-box mb-30" style="margin: 30px;">
	<div class="pd-20">
		<h4 class="text-blue h4">Quản lý Đơn Hàng</h4>
	</div>
	<!-- Thêm Sách mới button -->

	<div class="pb-20">
		<table class="data-table table stripe hover" style="width: 1197px;">
			<thead>
				<tr>
					<th>Order ID</th>
					<th>Tổng giá</th>
					<th>Số lượng</th>
					<th>UserID</th>
					<th>BookID</th>
					<th>Trạng thái</th>
					<th class="datatable-nosort">Thao tác</th>
				</tr>
			</thead>
			<tbody>
				<?php while($item  = current($orderItems)){ ?>
					<tr>
						<td><?php echo $item['order_id']; ?></td>
						<td><?php echo number_format($item['total_price']); ?>đ</td>
						<td><?php echo $item['quantity']; ?></td>
						
						<td><?php echo $item['user_id']; ?></td>
						<td><?php echo $item['book_id']; ?></td>
						<td><?php echo $item['status']; ?></td>
						<td>
							<div class="dropdown"><?php if($item['status']=="Chờ xác nhận"){echo '
							<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
							<i class="dw dw-more"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
							<a class="dropdown-item" href="DeleteOrder.php?order_id='.$item['order_id'].'"><i class="dw dw-delete-3"></i> Huỷ đơn</a>
							<a class="dropdown-item" href="OrderConfirm.php?order_id='.$item['order_id'].'"><i class="dw dw-edit2"></i> Gửi đơn</a>
							</div>';}?>
						</div>
					</td>

				</tr>
				<?php next($orderItems); } ?>
			</tbody>
		</table>
	</div>
	
</div>
<?php
require_once('../layouts/footer.php');
?>