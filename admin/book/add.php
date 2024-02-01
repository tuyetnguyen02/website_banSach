<?php
$title = 'Thêm Sách mới';
$baseUrl = '../';
require_once('../layouts/header.php');

require_once('form_add.php');

$sql = "select * from Category";
$categoryItems = executeResult($sql);

$sql = "select * from Publisher";
$publisherItems = executeResult($sql);
?>
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<div class="row" style="margin-top: 20px; margin: 50px;">
	<div class="col-md-12 table-responsive">
		<h3 class="text-blue">Thêm Sách mới</h3>
		<div class="panel panel-primary">
			<div class="panel-body">
				<form method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-3 col-12" style="border: solid grey 1px; padding-top: 10px; padding-bottom: 10px;">
							<div class="form-group">
								<label for="ISBN">ISBN:</label>
								<input required="true" type="text" class="form-control" id="ISBN" name="ISBN" value="">
							</div>
							<div class="form-group">
								<label for="thumbnail">Ảnh bìa:</label>
								<input type="file" class="form-control" id="thumbnail" name="thumbnail" accept=".jpg, .png, .jpeg/*" required>
								<img id="thumbnail_img" src="" style="max-height: 160px; margin-top: 5px; margin-bottom: 15px;">
							</div>
							<div class="form-group">
								<label for="price">Tác giả:</label>
								<input required="true" type="text" class="form-control" id="author" name="author" value="">
							</div>
							<div class="form-group">
								<label for="publisher">Nhà xuất bản:</label>
								<select class="form-control" name="publisher_id" id="publisher_id" required="true">
									<option value="">-- Chọn --</option>
									<?php
									foreach($publisherItems as $item) {
										// if($item['publisher_id'] == $bookItem['publisher_id']) {
										// 	echo '<option selected value="'.$item['publisher_id'].'">'.$item['publisher_name'].'</option>';
										// } else {
										echo '<option value="'.$item['publisher_id'].'">'.$item['publisher_name'].'</option>';
										// }
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="year">Năm xuất bản:</label>
								<input required="true" type="number" class="form-control" id="year" name="year" value="">
							</div>
							<div class="form-group">
								<label for="category">Danh mục:</label>
								<select class="form-control" name="category_id" id="category_id" required="true">
									<option value="">-- Chọn --</option>
									<?php
									foreach($categoryItems as $item) {
										// if($item['category_id'] == $bookItem['category_id']) {
										// 	echo '<option selected value="'.$item['category_id'].'">'.$item['category_name'].'</option>';
										// } else {
										echo '<option value="'.$item['category_id'].'">'.$item['category_name'].'</option>';
										// }
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="episode">Tập:</label>
								<input required="true" type="number" class="form-control" id="episode" name="episode" value="">
							</div>
							<div class="form-group">
								<label for="num_pages">Số trang:</label>
								<input required="true" type="number" class="form-control" id="num_pages" name="num_pages" value="">
							</div>
							<div class="form-group">
								<label for="price">Giá:</label>
								<input required="true" type="number" class="form-control" id="price" name="price" value="">
							</div>
							<!-- <div class="form-group">
								<label for="discount">Giảm Giá:</label>
								<input required="true" type="text" class="form-control" id="discount" name="discount" value="<?=$discount?>">
							</div> -->
							<!-- <div class="form-group">
								<label for="price">Số lượng bán:</label>
								<input required="true" type="text" class="form-control" id="price" name="price" value="<?=$num_sell?>" readonly>
							</div> -->
						</div>
						<div class="col-md-9 col-12">
							<div class="form-group">
								<label for="book_name">Tên Sách:</label>
								<input required="true" type="text" class="form-control" id="book_name" name="book_name" value="">
								<!-- <input type="text" name="book_id" value="" hidden="true"> -->
							</div>
							<div class="form-group">
								<label for="pwd">Mô tả:</label>
								<textarea class="form-control" rows="5" name="detail" id="detail" required></textarea>
							</div>

							<button class="btn btn-success">Thêm</button>
						</div> 
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- <script type="text/javascript">
	function updateThumbnail() {
		$('#thumbnail_img').attr('src', $('#thumbnail').val())
	}
</script> -->
<script type="text/javascript">
    // Sử dụng sự kiện change cho trường input file
	$('#thumbnail').on('change', function() {
        // Kiểm tra nếu có chọn tệp hình ảnh
		if (this.files && this.files[0]) {
			var reader = new FileReader();

			reader.onload = function(e) {
                // Thiết lập nguồn ảnh cho thẻ img
				$('#thumbnail_img').attr('src', e.target.result);
			}

            // Đọc dữ liệu của tệp hình ảnh
			reader.readAsDataURL(this.files[0]);
		}
	});
</script>
<script>
	$('#detail').summernote({
		placeholder: 'Nhập nội dung dữ liệu',
		tabsize: 2,
		height: 300,
		toolbar: [
			['style', ['style']],
			['font', ['bold', 'underline', 'clear']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['table', ['table']],
			['insert', ['link', 'picture', 'video']],
			['view', ['fullscreen', 'codeview', 'help']]
			]
	});
</script>
<?php
require_once('../layouts/footer.php');
?>