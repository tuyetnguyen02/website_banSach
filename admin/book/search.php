<?php
$title = 'Quản Lý Sách';
$baseUrl = '../';
require_once('../layouts/header.php');

// Số lượng sách hiển thị trên mỗi trang
define('BOOKS_PER_PAGE', 5);

if(isset($_GET['search'])){
	$searchTerm = $_GET['search'];
	$sql = "select Books.*, Category.category_name as category_name from Books left join Category on Books.category_id = Category.category_id WHERE book_name LIKE '%$searchTerm%' OR author LIKE '%$searchTerm%' OR ISBN LIKE '%$searchTerm%'";
	$bookItems = executeResult($sql);
}
else{
	echo "<script>location.href = 'index.php';</script>";
	exit();
}

// $sql = "select Books.*, Category.category_name as category_name from Books left join Category on Books.category_id = Category.category_id";
// $bookItems = executeResult($sql);

	// Lấy số trang từ tham số truyền vào
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

	// Tính toán chỉ số của sách để hiển thị trên trang hiện tại
$startIndex = ($page - 1) * BOOKS_PER_PAGE;
$endIndex = $startIndex + BOOKS_PER_PAGE - 1;
$totalBooks = count($bookItems);
$totalPages = ceil($totalBooks / BOOKS_PER_PAGE);

	// Kiểm tra và giới hạn chỉ số cuối cùng
if ($endIndex >= $totalBooks) {
	$endIndex = $totalBooks - 1;
}
?>
<!-- Simple Datatable start -->
<div class="card-box mb-30" style="margin: 30px;">
	<div class="pd-20">
		<h4 class="text-blue h4">Quản lý Sách</h4>
	</div>
	<!-- Thêm Sách mới button -->
	<div class="row">
		<div class="col-md-6">
			<a href="add.php" class="btn btn-primary" style="font-size: 10px; padding: 5px 10px;">
				<i class="dw dw-add"></i> Thêm Sách mới
			</a>
		</div>
		<div class="col-md-6 text-right">
			<form class="tg-formtheme tg-formsearch" action="search.php" method="GET">
				<label class="form-inline">Tìm kiếm: <input type="text" name="search" class="form-control form-control-sm" placeholder="Theo tên, tác giả, ISBN" aria-controls="DataTables_Table_0" required></label>
			</form>
		</div>
	</div>
	<div class="pb-20">
		<table class="data-table table stripe hover" style="width: 1197px;">
			<thead>
				<tr>
					<th>STT</th>
					<th class="datatable-nosort">Hình ảnh</th>
					<th class="table-plus">Tên</th>
					<th>Tác giả</th>
					<th>Năm xuất bản</th>
					<th>Danh mục</th>
					<th>Giá</th>
					<th class="datatable-nosort">Thao tác</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$index = 0;
				for ($i = $startIndex; $i <= $endIndex; $i++) {
					echo '<tr>
					<td>'.(++$index).'</td>
					<td><img src="../assets/images/'.$bookItems[$i]['img'].'" alt="'.$bookItems[$i]['book_name'].'" style="width: 100px; height: auto;"></td>
					<td class="table-plus">'.$bookItems[$i]['book_name'].'</td>
					<td>'.$bookItems[$i]['author'].'</td>
					<td>'.$bookItems[$i]['year'].'</td>
					<td>'.$bookItems[$i]['category_name'].'</td>
					<td>'.$bookItems[$i]['price'].'</td>
					<td>
					<div class="dropdown">
					<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
					<i class="dw dw-more"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
					<a class="dropdown-item" href="editor.php?book_id='.$bookItems[$i]['book_id'].'"><i class="dw dw-edit2"></i> Sửa</a>
					<a class="dropdown-item" href="#" onclick="deleteProduct('.$bookItems[$i]['book_id'].')"><i class="dw dw-delete-3"></i> Xóa</a>
					</div>
					</div>
					</td>
					</tr>';
				}
				?>
			</tbody>
		</table>
	</div>
	<?php
													// Hiển thị sách trên trang hiện tại
	echo '<div class="tg-productgrid">';
	for ($i = $startIndex; $i <= $endIndex; $i++) {
    												// Hiển thị thông tin sách tại đây
    												// ...
	}
	echo '</div>';

													// Hiển thị phân trang
	echo '<div class="tg-pagenavigation">';
	if ($page > 1) {
		echo '<a href="?page=' . ($page - 1) . '">&laquo; Trang trước</a>';
	}
												 // Số trang hiển thị xung quanh trang hiện tại
	$range = 3;
	$ellipsis = false;
	for ($i = 1; $i <= $totalPages; $i++) {
		if ($i == $page) {
			$activeClass = 'class="active"';
			echo '<a href="?page=' . $i . '" ' . $activeClass . '><strong>' . $i . '</strong></a>';
			$ellipsis = true;
		} elseif (($i >= $page - $range && $i < $page) || ($i > $page && $i <= $page + $range)) {
			echo '<a href="?page=' . $i . '">' . $i . '</a>';
			$ellipsis = true; 
		}
	}

												// Hiển thị dấu "..." và số trang lớn nhất nếu có
	if ($ellipsis && $totalPages > ($page + $range)) {
		echo '<span>...</span>';
		echo '<a href="?page=' . $totalPages . '">' . $totalPages . '</a>';
	}

	if ($page < $totalPages) {
		echo '<a href="?page=' . ($page + 1) . '">Trang sau &raquo;</a>';
	}

	echo '</div>';
	?>
</div>
<!-- Simple Datatable End -->

<!-- <script type="text/javascript">
	function deleteProduct(book_id) {
		option = confirm('Bạn có chắc chắn muốn xoá sản phẩm này không?')
		if(!option) return;

		$.post('form_api.php', {
			'id': id,
			'action': 'delete'
		}, function(data) {
			location.reload()
		})
	}
</script> -->
<?php
require_once('../layouts/footer.php');
?>