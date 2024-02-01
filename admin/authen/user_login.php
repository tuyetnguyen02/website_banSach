
<!doctype html>
	<html class="no-js" lang="zxx">
    <!-- Head -->
    <?php
        include("../layout/head.php");
        include("../db/database.php");
        session_start();
        if(isset($_POST['userlogin'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
            if(empty($username) || empty($password)){
                echo '<p style="color: red;">Điền vào chỗ trống</p>';
            }
            else{
                $sql_user = mysqli_query($conn, "Select * from login where username ='$username' and password = '$password' LIMIT 1");
                $count = mysqli_num_rows($sql_user);
                $row = mysqli_fetch_array($sql_user);

                // $data = mysqli_query($conn, "Select * from login where username ='$username' and password = '$password');
                if($count == 0){
                    $_SESSION['login_error'] = "Tài khoản hoặc mật khẩu không đúng.";
                }
                else{
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['user_name'] = $row['username'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['user_email'] = $row['email'];
                    $_SESSION['user_number'] = $row['mobile'];
                    $_SESSION['user_img'] = $row['image'];
                    // echo "<script>localStorage.setItem('user_name', '" . $_SESSION['user_name'] . "');</script>";
                    // $session_id = session_id();
                    echo "<script>location.href = '../../';</script>";
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
                                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px; font-size: 20px;">Đăng nhập vào tài khoản</h5>
                                                    <div class="form-outline mb-4">
                                                        <input id="idUser" class="form-control form-control-lg" name="username"/>
                                                        <label class="form-label" for="idUser">Tài khoản</label>
                                                    </div>
                                                    <div class="form-outline mb-4">
                                                        <input type="password" id="idPass" class="form-control form-control-lg" name="password"/>
                                                        <label class="form-label" for="idPass">Mật khẩu</label>
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
                                                        <input class="btn btn-dark btn-lg btn-block" name="userlogin" type="submit" value="Đăng nhập">Đăng nhập</input>
                                                    </div>

                                                    <a class="small text-muted" href="user_forgotpassword.php" style="font-size: 18px;">Quên mật khẩu?</a>
                                                    <p class="mb-5 pb-lg-2" style="color: #393f81; font-size: 14px;">Không có tài khoản? <a href="user_register.php"
                                                        style="color: #393f81;">Đăng ký tại đây</a></p>
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