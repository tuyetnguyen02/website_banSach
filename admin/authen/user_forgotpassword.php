
<!doctype html>
	<html class="no-js" lang="zxx">
    <!-- Head -->
    <?php
        include("../layout/head.php");
        include("../db/database.php");

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;
	 
        require '../PHPMailer/Exception.php';
        require '../PHPMailer/PHPMailer.php';
        require '../PHPMailer/SMTP.php';
        
        if(isset($_POST["userforgot"])){
            $email = $_POST['email'];
            if(empty($email)){
                $_SESSION['login_error'] = "Email không được để trống";
            }
            else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $_SESSION['login_error'] = "Sử dụng Email hợp lệ";
            }
            else{
                $sql_forgot_password = mysqli_query($conn, "Select * from login where email = '$email' LIMIT 1");
                $count = mysqli_num_rows($sql_forgot_password);
                $row = mysqli_fetch_array($sql_forgot_password);
                if($count == 0){
                    $_SESSION['login_error'] = "Email này không thuộc bất kỳ user nào";
                }
                else{                                                
                    $mail = new PHPMailer(true);
                    try{
                        //Server settings
                        $mail->SMTPDebug = false;
                        $mail->isSMTP();
                        $mail->SMTPSecure = 'tls';
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 587;
                        $mail->SMTPOptions = array(
                            'ssl' => array(
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                                'allow_self_signed' => true
                            )
                        );
                        $mail->Username = 'nhdcupcake@gmail.com';
                        $mail->Password = 'mfmcrnzwspzdoesr'; 
                    
                        $mail->setFrom('nhdcupcake@gmail.com', 'Manager'); 
                        $mail->addAddress($row['email'], $row['username']);

                        $mail->isHTML(true); 
                        $mail->Subject = 'Password Recover'; 
                        $mail->Body = 'Mật khẩu của bạn là: ' . $row['password']; 
                    
                        $mail->send();
                        $_SESSION['login_error'] = "Message has been sent";
                        // echo "<script>location.href = 'user_login.php';</script>";
                    } catch(Exception $e){
                        $_SESSION['login_error'] = "Failed to sent the message";
                    }
                }
            }
        }
    ?>
<body class="tg-home tg-homevtwo">

	<div id="tg-wrapper" class="tg-wrapper tg-haslayout">
        <!-- Header -->
		<?php
            include("../layout/login_header.php");
        ?>

		
		<!--************************************
				Main Start
		*************************************-->
		<main id="tg-main" class="tg-main tg-haslayout">
			<section class="tg-sectionspace tg-haslayout">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section class="vh-100" style="background-color: #9A616D;">
                                <div class="container py-5 h-100">
                                    <div class="row d-flex justify-content-center align-items-center h-100">
                                    <div class="col col-xl-10">
                                        <div class="card" style="border-radius: 1rem;">
                                        <div class="row g-0">
                                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                            <img src="../assets_user/images/img1.jpg"
                                                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                                            </div>
                                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                            <div class="card-body p-4 p-lg-5 text-black">

                                                <form method="POST">

                                                    <div class="d-flex align-items-center mb-3 pb-1">
                                                        <strong class="tg-logo"><a href="index-2.html"><img src="../assets_user/images/logo.png" alt="company name here"></a></strong>
                                                    </div>
                                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px; font-size: 20px;">Quên mật khẩu</h5>
                                                    <div class="form-outline mb-4">
                                                        <input id="idEmail" class="form-control form-control-lg" name="email"/>
                                                        <label class="form-label" for="idEmail">Nhập Email</label>
                                                    </div>
                                                    <?php
                                                        // Kiểm tra nếu có thông báo lỗi, hiển thị trong div
                                                        if (isset($_SESSION['login_error'])) {
                                                            echo '<div class="alert alert-danger">' . $_SESSION['login_error'] . '</div>';
                                                            // Xóa thông báo lỗi sau khi đã hiển thị
                                                            unset($_SESSION['login_error']);
                                                        }
                                                    ?>
                                                    <div class="pt-1 mb-4">
                                                        <input class="btn btn-dark btn-lg btn-block" name="userforgot" type="submit" value="Gửi"></input>
                                                    </div>
                                                    <div class="d-flex justify-content-center mb-4">
                                                        <span style="font-size: 20px;">Hoặc</span>
                                                    </div>
                                                    <div class="pt-1 mb-4">
                                                        <a class="btn btn-outline-primary btn-lg btn-block" href="user_login.php">Đăng nhập</a>
                                                    </div>
                                                </form>

                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </section>
						</div>
					</div>
				</div>
			</section>
		</main>
		<!--************************************
				Main End
		*************************************-->

        <!-- Footer -->
		<?php
            include("../layout/login_footer.php");
        ?>
	</div>

    <!-- Script -->
	<?php
        include("../layout/script.php");
    ?>
</body>

</html>