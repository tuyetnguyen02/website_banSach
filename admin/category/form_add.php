<?php
if(!empty($_POST)) {
	$category_id = '';
	$category_name = getPost('category_name');

	//insert
	$sql = "INSERT INTO Category (category_name) VALUES  ('$category_name')";
	execute($sql);

	// header('Location: index.php');
	echo "<script>location.href = 'index.php';</script>";
	die();
}