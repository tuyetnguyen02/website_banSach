<?php
if(!empty($_POST)) {
	$book_id = '';
	$ISBN = getPost('ISBN');
	$book_name = getPost('book_name');
	$author = getPost('author');
	$img_path = moveFile('thumbnail');
	// $img = basename($img_path);
	$img_extension = strtolower(pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION));
	$img = $ISBN . '.' . $img_extension;
	$detail = getPost('detail');
	$episode = getPost('episode');
	$year = getPost('year');
	$price = getPost('price');
	$num_pages = getPost('num_pages');
	$publisher_id = getPost('publisher_id');
	$category_id = getPost('category_id');
	// $created_at = $updated_at = date('Y-m-d H:s:i');

	// Check: select a new picture
	if (!empty($_FILES['thumbnail']['name'])) {

		// Kiểm tra xem đã tồn tại ảnh trùng tên trong thư mục hay chưa
		$targetPath = $img_path;

		// Đổi tên file thành ISBN + định dạng ảnh
		$newPath = pathinfo('../'.$targetPath);
		$newPath = $newPath['dirname'] . '/' . $img;

		rename('../'.$targetPath, $newPath);

	}

	// Kiểm tra xem sách có tồn tại trong cơ sở dữ liệu hay không (theo ISBN)
	$sqlCheckExistence = "SELECT COUNT(*) as count FROM Books WHERE ISBN = '$ISBN'";
	$result = executeResult($sqlCheckExistence);

	if ($result[0]['count'] > 0) {
        // Nếu sách đã tồn tại, hiển thị thông báo và không thực hiện thêm mới
		echo "Sách với ISBN $ISBN đã tồn tại. Không thể thêm mới.";
	}
	else{
		//insert
		$sql = "INSERT INTO Books (ISBN, book_name, img, author, detail, price, year, episode, num_pages, category_id, publisher_id) VALUES  ('$ISBN', '$book_name', '$img', '$author', '$detail', $price, $year, $episode, $num_pages, $category_id, $publisher_id)";
		execute($sql);
		
		// header('Location: index.php');
		echo "<script>location.href = 'index.php';</script>";
		die();
	}
}