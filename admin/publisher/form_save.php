<?php
if(!empty($_POST)) {
	$publisher_id = getPost('publisher_id');
	$publisher_name = getPost('publisher_name');
	$publisher_address = getPost('publisher_address');
	$publisher_phone = getPost('publisher_phone');

	$sql = "update Publisher set publisher_name = '$publisher_name', publisher_address = '$publisher_address', publisher_phone = '$publisher_phone' where publisher_id = $publisher_id";

	execute($sql);

		// header('Location: index.php');
	echo "<script>location.href = 'editor.php?publisher_id=$publisher_id';</script>";
	die();

}