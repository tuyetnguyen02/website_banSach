<?php
session_start();
require_once('../../utils/utility.php');
require_once('../../database/dbhelper.php');

if(!empty($_POST)) {
	$action = getPost('action');

	switch ($action) {
		case 'delete':
		deleteBook();
		break;
	}
}

function deleteBook() {
	$book_id = getPost('book_id');
    $sql = "SELECT COUNT(*) as count FROM Orders WHERE book_id = $book_id";
    $result = executeResult($sql);

    if ($result[0]['count'] > 0) {
        $response = [
            'success' => false,
            'message' => "Không thể xóa vì có đơn đặt hàng liên quan."
        ];
    } else {
        $sql = "UPDATE Books SET deleted = 1 WHERE book_id = $book_id";
        execute($sql);
        $response = [
            'success' => true,
            'message' => "Đã xóa sách thành công."
        ];
    }

    // Trả về kết quả dưới dạng JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}