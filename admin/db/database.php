<?php
    $conn = mysqli_connect("localhost", "root","", "testcartandorder3");

    if(mysqli_connect_errno()){
        echo "Fail to connect: ". mysqli_connect_error();
    }
?>