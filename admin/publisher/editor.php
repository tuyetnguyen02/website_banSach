<?php
$title = 'Sửa Nhà xuất bản';
$baseUrl = '../';
require_once('../layouts/header.php');

$publisher_id = $publisher_name = $publisher_address = $publisher_phone = '';
require_once('form_save.php');

$publisher_id = getGet('publisher_id');
if($publisher_id != '' && $publisher_id > 0) {
	$sql = "
	SELECT *
	FROM Publisher
	WHERE publisher_id = $publisher_id
	";
	$publisherItem = executeResult($sql, true);
	if($publisherItem != null) {
		$publisher_name = $publisherItem['publisher_name'];
		$publisher_address = $publisherItem['publisher_address'];
		$publisher_phone = $publisherItem['publisher_phone'];
	} else {
		$publisher_id = 0;
	}
} else {
	$publisher_id = 0;
}

?>
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<div class="row" style="margin-top: 20px; margin: 50px;">
	<div class="col-md-12 table-responsive">
		<h3 class="text-blue">Sửa Nhà xuất bản</h3>
		<div class="panel panel-primary">
			<div class="panel-body">
				<form method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-3 col-12" style="border: solid grey 1px; padding-top: 10px; padding-bottom: 10px;">
							<div class="form-group">
								<label for="publisher_name">Tên:</label>
								<input required="true" type="text" class="form-control" id="publisher_name" name="publisher_name" value="<?=$publisher_name?>">
								<input type="text" name="publisher_id" value="<?=$publisher_id?>" hidden="true">
							</div>
							<div class="form-group">
								<label for="publisher_name">Địa chỉ:</label>
								<input required="true" type="text" class="form-control" id="publisher_address" name="publisher_address" value="<?=$publisher_address?>">
							</div>
							<div class="form-group">
								<label for="publisher_name">Liên hệ:</label>
								<input required="true" type="text" class="form-control" id="publisher_phone" name="publisher_phone" value="<?=$publisher_phone?>">
							</div>
						</div>
						<div class="col-md-9 col-12">
							<button class="btn btn-success">Lưu</button>
						</div> 
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
require_once('../layouts/footer.php');
?>