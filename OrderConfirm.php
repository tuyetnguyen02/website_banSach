<?php
    require_once('database/dbhelper.php');
    $id = $_GET['order_id'];
    echo $id;
    $status = "Thành công";
    $sql = "UPDATE orders SET status = '$status' WHERE order_id = $id";
    // $delete = executeResult($sql, true);
    execute($sql);

    echo "<script>location.href = 'order.php';</script>";
?>