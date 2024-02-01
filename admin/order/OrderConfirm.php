<?php
    require_once('../../database/dbhelper.php');
    $id = $_GET['order_id'];
    echo $id;
    $status = "Đang giao hàng";
    $sql = "UPDATE orders SET status = '$status' WHERE order_id = $id";
    // $delete = executeResult($sql, true);
    execute($sql);

    echo "<script>location.href = 'index.php';</script>";
?>