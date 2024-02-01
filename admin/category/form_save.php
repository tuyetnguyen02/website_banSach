<?php
if(!empty($_POST)) {
	$category_id = getPost('category_id');
	$category_name = getPost('category_name');
	
	$sql = "update Category set category_name = '$category_name' where category_id = $category_id";

	execute($sql);

		// header('Location: index.php');
	echo "<script>location.href = 'editor.php?category_id=$category_id';</script>";
	die();

}