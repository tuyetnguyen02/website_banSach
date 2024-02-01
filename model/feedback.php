<?php 
    include_once 'pdo.php';

    function feedback_list($id){
        $sql = "SELECT * FROM reviews rv INNER JOIN login lg ON rv.user_id=lg.user_id WHERE book_id=?";
        return pdo_query($sql,$id);
    }
    function check_login($email, $pass){
        $sql = "SELECT * FROM login WHERE username=? AND password=? " ;
        return pdo_query_one($sql, $email, $pass );
    }
    function review_add($feedback_input,$id,$book_id){
        $sql = "INSERT INTO `reviews`(review_content, user_id, book_id) 
        VALUES ('$feedback_input','$id','$book_id')" ;
        return pdo_execute($sql);
    }

?>