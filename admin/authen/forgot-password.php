<?php 
	include("header/headerforlogin.php");
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	 
	require '../PHPMailer/Exception.php';
	require '../PHPMailer/PHPMailer.php';
	require '../PHPMailer/SMTP.php';
?>
<!DOCTYPE html>
<html>



<body>
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="login.html">
					<img src="../assets/vendors/images/deskapp-logo.svg" alt="">
				</a>
			</div>
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6">
					<img src="../assets/vendors/images/forgot-password.png" alt="">
				</div>
				<div class="col-md-6">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">Quên mật khẩu</h2>
						</div>
						<h6 class="mb-20">Điền Email của bạn</h6>
						<form method="post">
							<div class="input-group custom">
								<input type="text" class="form-control form-control-lg" placeholder="Email" name="forgotemail">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
								</div>
							</div>
                            <?php 
                                    include("../db/database.php");
                                    if(isset($_POST["forgotadminpass"])){
                                        $email = $_POST['forgotemail'];
                                        if(empty($email)){
                                            echo '<p style="color: red;">Email không được để trống</p>';
                                        }
                                        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                                            echo '<p style="color: red;">Sử dụng Email hợp lệ</p>';
                                        }
                                        else{
                                            $sql_forgot_password = mysqli_query($conn, "Select * from admin where email = '$email' LIMIT 1");
                                            $count = mysqli_num_rows($sql_forgot_password);
                                            $row = mysqli_fetch_array($sql_forgot_password);
                                            if($count == 0){
                                                echo '<p style="color: red;">Email này không thuộc Admin nào</p>';
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
													echo '<h2>Message has been sent</h2>';
												} catch(Exception $e){
													echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
												}
                                            }
                                        }
                                    }
                                ?>
							<div class="row align-items-center">
								<div class="col-5">
									<div class="input-group mb-0">
										<input class="btn btn-primary btn-lg btn-block" name="forgotadminpass" type="submit" value="Gửi">
                                        <!--<a class="btn btn-primary btn-lg btn-block" href="index.html">Submit</a> -->
									</div>
								</div>
								<div class="col-2">
									<div class="font-16 weight-600 text-center" data-color="#707373">HOẶC</div>
								</div>
								<div class="col-5">
									<div class="input-group mb-0">
										<a class="btn btn-outline-primary btn-lg btn-block" href="login.php">Đăng nhập</a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>