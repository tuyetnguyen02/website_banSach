<?php
$title = 'Quản Lý Danh mục';
$baseUrl = '../';
require_once('../layouts/header.php');

$sql = "select * from Publisher where deleted = 0";
$data = executeResult($sql);
?>
<!-- Simple Datatable start -->
<div class="card-box mb-30" style="margin: 30px;">
	<div class="pd-20">
		<h4 class="text-blue h4">Quản lý Nhà xuất bản</h4>
	</div>
	<!-- Thêm Danh mục mới button -->
	<div class="row">
		<div class="col-md-3">
			<a href="add.php" class="btn btn-primary" style="font-size: 10px; padding: 5px 10px;">
				<i class="dw dw-add"></i> Thêm Nhà xuất bản
			</a>
		</div>
	</div>
	<div class="pb-20">
		<table class="data-table table stripe hover" style="width: 1197px;">
			<thead>
				<tr>
					<th>STT</th>
					<th class="table-plus">Tên</th>
					<th>Địa chỉ</th>
					<th>Liên hệ</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$index = 0;
				foreach($data as $item) {
					echo '<tr>
					<td>'.(++$index).'</td>
					<td class="table-plus">'.$item['publisher_name'].'</td>
					<td>'.$item['publisher_address'].'</td>
					<td>'.$item['publisher_phone'].'</td>
					<td>
					<div class="dropdown">
					<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
					<i class="dw dw-more"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
					<a class="dropdown-item" href="editor.php?publisher_id='.$item['publisher_id'].'"><i class="dw dw-edit2"></i> Sửa</a>
					<a class="dropdown-item" href="#" onclick="deletePublisher('.$item['publisher_id'].')"><i class="dw dw-delete-3"></i> Xóa</a>
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

<script type="text/javascript">
	function deletePublisher(publisher_id) {
        option = confirm('Bạn có chắc chắn muốn xoá danh mục này không?')
        if (!option) return;

        $.post('form_api.php', {
            'publisher_id': publisher_id,
            'action': 'delete'
        }, function (data) {
            // Xử lý kết quả từ server
            if (data.success) {
                if (confirm(data.message)) {
                    location.reload();
                }
            } else {
                alert(data.message);
            }
        }, 'json');
    }
</script>
<?php
require_once('../layouts/footer.php');
?>