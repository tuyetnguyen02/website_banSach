<?php
if(!empty($_POST)) {
	$publisher_id = '';
	$publisher_name = getPost('publisher_name');
	$publisher_address = getPost('publisher_address');
	$publisher_phone = getPost('publisher_phone');

	//insert
	$sql = "INSERT INTO Publisher (publisher_name, publisher_address, publisher_phone) VALUES  ('$publisher_name', '$publisher_address', '$publisher_phone')";
	execute($sql);

	// header('Location: index.php');
	echo "<script>location.href = 'index.php';</script>";
	die();
}