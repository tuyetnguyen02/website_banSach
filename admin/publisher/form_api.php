<?php
session_start();
require_once('../../utils/utility.php');
require_once('../../database/dbhelper.php');

if(!empty($_POST)) {
	$action = getPost('action');

	switch ($action) {
		case 'delete':
		deletePublisher();
		break;
	}
}

function deletePublisher() {
	$publisher_id = getPost('publisher_id');
    $sql = "SELECT COUNT(*) as count FROM Books WHERE publisher_id = $publisher_id";
    $result = executeResult($sql);

    if ($result[0]['count'] > 0) {
        $response = [
            'success' => false,
            'message' => "Không thể xóa vì NXB còn sách liên quan."
        ];
    } else {
        $sql = "UPDATE Publisher SET deleted = 1 WHERE publisher_id = $publisher_id";
        execute($sql);
        $response = [
            'success' => true,
            'message' => "Đã xóa NXB thành công."
        ];
    }

    // Trả về kết quả dưới dạng JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}