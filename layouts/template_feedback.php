
<div class="container mt-4">
    <!-- List feedback -->
    <hr>
    <!-- <div class="tg-sectionhead">
		<h3>Đánh giá sản phẩm</h3>
	</div> -->
    
    <h3 class="text-danger">Khách hàng đánh giá : </h3>
    <hr>
    
    <?php    if(isset($_SESSION['user_name'])): ?>
        <form method="post" class='form text-center' action="">
            <textarea  class="text" cols="150" rows ="5" name="feedback_input"></textarea>
            <br>
            <!-- <input type="hidden" name="book_id" value="<?=$GET['book_id']?>" > -->
            <input type="submit" class="btn btn-primary" value="Gửi đánh giá" name="feedback_submit">
        </form>
    <?php else : ?>
        <div class="text-center font-weight-bold">
            <a href="http://localhost/website_bookstore1/admin/authen/user_login.php" 
            class="btn btn-primary btn-lg">Đăng nhập để đánh giá</a>    
        </div>
    <?php endif; ?>
    <br>
    <?php foreach($feedback_list as $feedback): ?>
    <div>
        <div class="d-flex align-items-center">
            <img class="my-2 img-thumbnail" src="../../../website_bookstore1/admin/authen/userimg/user1.jpg" width='40' height="60">
            <span class="fs-4 mx-2">
                <b><?=$feedback['name']?></b>
            </span>
            <br>
            
            
        </div>
        <div class="alert alert-info fs-4 ms-4" role="alert">
            <?=$feedback['review_content']?>
        </div>
            <span class="ms-4">
                Ngày đánh giá: <?=$feedback['review_date']?>
            </span>
        <hr>
        <br>
    </div>
    <?php endforeach; ?>
    
    
</div>