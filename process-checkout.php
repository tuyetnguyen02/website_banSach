<?php 
require_once('utils/utility.php');
require_once('database/dbhelper.php');

// tao don order vaof database
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$sanpham = $_POST['sanpham'];
	$diachi = $_POST['diachi'];
	$makhachhang = $_POST['makhachhang'];
	$tongtien = $_POST['tongtien'];
	$soluong = $_POST['soluong'];
	$sodienthoai = $_POST['sodienthoai'];

	// $sql_insert = "INSERT INTO `donhang`(`makhachhang`, `tongtien`, `diachi`) VALUES ('".$makhachhang."','".$tongtien."','".$diachi."')";
	// $insert = queryExecute($connect,$sql_insert);
	$sql_insert = "INSERT INTO address (`user_id`, `address`, `mobile`) VALUES ('".$makhachhang."','".$diachi."', '".$sodienthoai."')";
	// $insert = mysqli_query($connect,$sql_insert);
	execute($sql_insert);

	$sql_idmax = "SELECT MAX(address_id) as max_address_id FROM address";
	$idmax = executeResult($sql_idmax, true);

		$trangthai = "Chờ xác nhận";

		$date_of_purchase = date("Y-m-d"); // Lấy ngày hiện tại

		for ($i=0; $i < count($sanpham); $i++) { 
			$masanpham = $sanpham[$i]['masanpham'];
			$giatien = str_replace(',','.',$sanpham[$i]['giaban']) * 1000;
			$sql_insert_ct = "INSERT INTO orders ( `book_id`, `price`, `quantity`,`user_id`, `total_price`, `address_id`,`status`, `date_of_purchase`) 
			VALUES ('".$masanpham."','".$giatien."','".$soluong[$i]."','".$makhachhang."','".$tongtien."','".$idmax['max_address_id']."','".$trangthai."', '".$date_of_purchase."')";
				// $insert_ct = mysqli_query($connect,$sql_insert_ct);
				execute($sql_insert_ct);
			}

		}
	?>