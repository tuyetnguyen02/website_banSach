
<!doctype html>
    <html class="no-js" lang="zxx">
    <!-- Head -->
    <?php
        include("../layout/head.php");
        include("../db/database.php");
        session_start();
        if(isset($_POST['userregister'])){
            $username = $_POST['username'];
            $sql_query = mysqli_query($conn,"select * from login where username ='$username'");
            $num_user = mysqli_num_rows($sql_query);
            $password = $_POST['password'];
            $email = $_POST['email'];
            $name = $_POST['name'];
            $contact = $_POST['contact'];
            $phoneNumber = preg_replace('/[^0-9]/', '', $contact);
            if(empty($username) || empty($password) || empty($name) || empty($email)){
                $_SESSION['register_message'] = "Không được để trống!";
            }
            else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $_SESSION['register_message'] = "Sử dụng Email hợp lệ!";
            }
            else if(!preg_match('/^0[0-9]{9}$/', $phoneNumber)){
                $_SESSION['register_message'] = "Sử dụng Số điện thoại hợp lệ!";
            }
            else if($num_user > 0){
                $_SESSION['register_message'] = "đã có tên user này!";
            }
            else{
                $sql = mysqli_query($conn,"select * from login");
                        $num_user = mysqli_num_rows($sql) + 1;
                        $sql_user = mysqli_query($conn, "insert into login (user_id, username, password, name, mobile, email)
                        VALUES ($num_user,'$username', '$password', '$name', '$phoneNumber','$email')");
                        if($sql_user){
                            $_SESSION['register_message'] = "Đã tạo tài khoản thành công";
                            echo "<script>location.href = 'user_login.php';</script>";
                        }
                        else{
                            $_SESSION['register_message'] = "Lỗi xảy ra khi đăng ký";
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
                                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px; font-size: 20px;">Đăng ký tài khoản</h5>
                                                    <div class="form-outline mb-4">
                                                        <input id="idUser" class="form-control form-control-lg" name="username"/>
                                                        <label class="form-label" for="idUser">Tài khoản</label>
                                                    </div>
                                                    <div class="form-outline mb-4">
                                                        <input id="idEmail" class="form-control form-control-lg" name="email"/>
                                                        <label class="form-label" for="idUser">Email</label>
                                                    </div>
                                                    <div class="form-outline mb-4">
                                                        <input id="idName" class="form-control form-control-lg" name="name"/>
                                                        <label class="form-label" for="idUser">Họ và Tên</label>
                                                    </div>
                                                    <div class="form-outline mb-4">
                                                        <input id="idContact" class="form-control form-control-lg" name="contact"/>
                                                        <label class="form-label" for="idContact">Số điện thoại</label>
                                                    </div>
                                                    <div class="form-outline mb-4">
                                                        <input type="password" id="idPass" class="form-control form-control-lg" name="password"/>
                                                        <label class="form-label" for="idPass">Mật khẩu</label>
                                                    </div>
                                                    <?php
                                                        // Kiểm tra nếu có thông báo lỗi, hiển thị trong div
                                                        if (isset($_SESSION['register_message'])) {
                                                            echo '<div class="alert alert-danger">' . $_SESSION['register_message'] . '</div>';
                                                            // Xóa thông báo lỗi sau khi đã hiển thị
                                                            unset($_SESSION['register_message']);
                                                        }
                                                    ?>
                                                    <div class="pt-1 mb-4">
                                                        <input class="btn btn-dark btn-lg btn-block" name="userregister" type="submit" value="Đăng ký"></input>
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