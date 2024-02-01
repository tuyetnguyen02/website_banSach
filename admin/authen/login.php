<?php 
    session_start();
    include("../db/database.php");
	include("header/headerforlogin.php");
?>


<!DOCTYPE html>
<html>
<body class="login-page">
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="#">
					<img src="../assets/vendors/images/deskapp-logo.svg" alt="">
				</a>
			</div>
			<!-- <div class="login-menu">
				<ul>
					<li><a href="register.html">Register</a></li>
				</ul>
			</div> -->
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="../assets/vendors/images/login-page-img.png" alt="">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="login-box bg-white box-shadow border-radius-10 form-group">
						<div class="login-title">
							<h2 class="text-center text-primary">Quản trị viên</h2>
						</div>
						<form method="POST">
							<div class="select-role">
								<div class="btn-group btn-group-toggle" data-toggle="buttons">
								</div>
							</div>
							<div class="input-group custom">
								<input type="text" class="form-control form-control-lg" placeholder="Tên đăng nhập" name="username">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input type="password" class="form-control form-control-lg" placeholder="**********" name="password">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
								</div>
							</div>
							<div class="row pb-30">
								<div class="col-6">
                                <?php
                                    if(isset($_POST['adminlogin'])){
                                        $username = $_POST['username'];
                                        $password = $_POST['password'];
                                        if(empty($username) || empty($password)){
                                            echo '<p style="color: red;">Please fill the blank</p>';
                                        }
                                        else{
                                            $sql_admin = mysqli_query($conn, "Select * from admin where username ='$username' and password = '$password' LIMIT 1");
                                            $count = mysqli_num_rows($sql_admin);
                                            $row = mysqli_fetch_array($sql_admin);
                                            if($count == 0){
                                                echo "<p> Username or Password incorrect";
                                            }
                                            else{
                                                $_SESSION['adminname'] = $row['username'];
                                                header("Location: ../index.php");
                                            }
                                        }
                                    }
                                ?>

								</div>
								<div class="col-6">
									<div class="forgot-password"><a href="forgot-password.php">Quên mật khẩu</a></div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
										<input class="btn btn-primary btn-lg btn-block" name="adminlogin" type="submit" value="Đăng nhập">
										<!-- <a class="btn btn-primary btn-lg btn-block" href="">Sign In</a> -->
									</div>
									<!-- <div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">OR</div>
									<div class="input-group mb-0">
										<a class="btn btn-outline-primary btn-lg btn-block" href="register.html">Register To Create Account</a>
									</div> -->
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