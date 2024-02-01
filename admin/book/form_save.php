<?php
if(!empty($_POST)) {
	$book_id = getPost('book_id');
	$ISBN = getPost('ISBN');
	$book_name = getPost('book_name');
	$author = getPost('author');
	$img_path = moveFile('thumbnail');
	// $img = basename($img_path);
	$img_extension = strtolower(pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION));
	$img = $ISBN . '.' . $img_extension;
	$detail = getPost('detail');
	$year = getPost('year');
	$price = getPost('price');
	$num_pages = getPost('num_pages');
	$publisher_id = getPost('publisher_id');
	$category_id = getPost('category_id');
	// $created_at = $updated_at = date('Y-m-d H:s:i');

	// Kiểm tra xem đã chọn ảnh mới hay chưa
	if (!empty($_FILES['thumbnail']['name'])) {

		// Kiểm tra xem đã tồn tại ảnh trùng tên trong thư mục hay chưa
		$targetPath = $img_path;

		// Đổi tên file thành $img
		$newPath = pathinfo('../'.$targetPath);
		$newPath = $newPath['dirname'] . '/' . $img;

		// if (file_exists($newPath)) {
        // Nếu tồn tại, xóa ảnh cũ trước khi di chuyển ảnh mới vào
		// 	unlink($targetPath);
		// }

		// Đổi tên file thành $img
		// $newPath = pathinfo('../'.$targetPath);
		// $newPath = $newPath['dirname'] . '/' . $img;

		rename('../'.$targetPath, $newPath);

	}

	// if($book_id > 0) {
		//update
		if(!empty($_FILES['thumbnail']['name'])) {
			$sql = "update Books set book_name = '$book_name', author = '$author', img = '$img', detail = '$detail', year = '$year', price = '$price', num_pages = '$num_pages', publisher_id = '$publisher_id', category_id = '$category_id' where book_id = $book_id";
		} else {
			// $sql = "update Books set title = '$title', price = $price, discount = $discount, description = '$description', updated_at = '$updated_at', category_id = '$category_id' where id = $id";
			$sql = "update Books set book_name = '$book_name', author = '$author', detail = '$detail', year = '$year', price = '$price', num_pages = '$num_pages', publisher_id = '$publisher_id', category_id = '$category_id' where book_id = $book_id";
		}

		execute($sql);

		// header('Location: index.php');
		echo "<script>location.href = 'editor.php?book_id=$book_id';</script>";
		die();

		// Kiểm tra xem trang đã được reload chưa
		// if (!isset($_SESSION['reloaded'])) {
        // // Nếu chưa, thì reload và đặt biến cờ
		// 	$_SESSION['reloaded'] = true;
		// 	echo '<script type="text/javascript">location.reload();</script>';
		// 	die();
		// }
	// } else {
	// 	//insert
	// 	$sql = "insert into Product(thumbnail, title, price, discount, description, updated_at, created_at, deleted, category_id) values ('$img', '$title', '$price', '$discount', '$description', '$updated_at', '$created_at', 0, $category_id)";
	// 	execute($sql);

	// 	header('Location: index.php');
	// 	die();
	// }
}