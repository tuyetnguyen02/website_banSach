<?php
$title = 'Thêm Danh mục';
$baseUrl = '../';
require_once('../layouts/header.php');

require_once('form_add.php');
?>
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<div class="row" style="margin-top: 20px; margin: 50px;">
	<div class="col-md-12 table-responsive">
		<h3 class="text-blue">Thêm Danh mục</h3>
		<div class="panel panel-primary">
			<div class="panel-body">
				<form method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-3 col-12" style="border: solid grey 1px; padding-top: 10px; padding-bottom: 10px;">
							<div class="form-group">
								<label for="category_name">Tên danh mục:</label>
								<input required="true" type="text" class="form-control" id="category_name" name="category_name" value="">
								<input type="text" name="category_id" value="<?=$category_id?>" hidden="true">
							</div>
						</div>
						<div class="col-md-9 col-12">
							<button class="btn btn-success">Thêm</button>
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