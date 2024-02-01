<?php
session_start();
require_once('../../utils/utility.php');
require_once('../../database/dbhelper.php');

if(!empty($_POST)) {
	$action = getPost('action');

	switch ($action) {
		case 'delete':
		deleteCategory();
		break;
	}
}

function deleteCategory() {
	$category_id = getPost('category_id');
    $sql = "SELECT COUNT(*) as count FROM Books WHERE category_id = $category_id";
    $result = executeResult($sql);

    if ($result[0]['count'] > 0) {
        $response = [
            'success' => false,
            'message' => "Không thể xóa vì danh mục còn sách liên quan."
        ];
    } else {
        $sql = "UPDATE Category SET deleted = 1 WHERE category_id = $category_id";
        execute($sql);
        $response = [
            'success' => true,
            'message' => "Đã xóa danh mục thành công."
        ];
    }

    // Trả về kết quả dưới dạng JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}