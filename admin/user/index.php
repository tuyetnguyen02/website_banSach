<?php
$title = 'Quản Lý Người Dùng';
$baseUrl = '../';
require_once('../layouts/header.php');

$sql = "select * from Login where deleted = 0";
$data = executeResult($sql);
?>
<!-- Simple Datatable start -->
<div class="card-box mb-30" style="margin: 30px;">
	<div class="pd-20">
		<h4 class="text-blue h4">Quản lý Người dùng</h4>
	</div>
	<div class="pb-20">
		<table class="data-table table stripe hover" style="width: 1197px;">
			<thead>
				<tr>
					<th>STT</th>
					<th>Tên đăng nhập</th>
					<th>Mật khẩu</th>
					<th class="table-plus">Tên</th>
					<th>SĐT</th>
					<th>Email</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$index = 0;
				foreach($data as $item) {
					echo '<tr>
					<td>'.(++$index).'</td>
					<td>'.$item['username'].'</td>
					<td>'.$item['password'].'</td>
					<td class="table-plus">'.$item['name'].'</td>
					<td>'.$item['mobile'].'</td>
					<td>'.$item['email'].'</td>
					<td>
					<div class="dropdown">
					<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
					<i class="dw dw-more"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
					<a class="dropdown-item" href="../order/index.php?user_id='.$item['user_id'].'"><i class="dw dw-delete-3"></i> Đơn đặt hàng</a>
					</div>
					</div>
					</td>
					</tr>';
				}
				?>
			</tbody>
		</table>
	</div>
</div>
<!-- Simple Datatable End -->
<?php
require_once('../layouts/footer.php');
?>