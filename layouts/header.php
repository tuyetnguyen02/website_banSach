<?php
require_once('utils/utility.php');
require_once('database/dbhelper.php');

$sql = "SELECT Category.*, COUNT(Books.category_id) AS book_count
FROM Category
LEFT JOIN Books ON Category.category_id = Books.category_id
GROUP BY Category.category_id";
$menuItems = executeResult($sql);
?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?=$title?></title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon" href="apple-touch-icon.png">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/normalize.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/icomoon.css">
	<link rel="stylesheet" href="assets/css/jquery-ui.css">
	<link rel="stylesheet" href="assets/css/owl.carousel.css">
	<link rel="stylesheet" href="assets/css/transitions.css">
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/css/color.css">
	<link rel="stylesheet" href="assets/css/responsive.css">

	<link rel="stylesheet" href="assets/tuyet/css/maps/main.css.map">
	<link rel="stylesheet" href="assets/tuyet/css/maps/plugins.min.css.map">
	<link rel="stylesheet" href="assets/tuyet/css/pages/_faq.css">
	<link rel="stylesheet" href="assets/tuyet/css/pages/_order-complete.css">
	<link rel="stylesheet" href="assets/tuyet/css/main.css">
	<link rel="stylesheet" href="assets/tuyet/css/plugins.css">
	<link rel="stylesheet" href="assets/tuyet/css/rrrrrrrr.css">


	<script src="assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

	<div id="tg-wrapper" class="tg-wrapper tg-haslayout">
		<!--************************************
				Header Start
				*************************************-->
				<header id="tg-header" class="tg-header tg-haslayout">
					<div class="tg-topbar">
						<!-- <div class="container">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<ul class="tg-addnav">
										<li>
											<a href="javascript:void(0);">
												<i class="icon-envelope"></i>
												<em>Contact</em>
											</a>
										</li>
										<li>
											<a href="javascript:void(0);">
												<i class="icon-question-circle"></i>
												<em>Help</em>
											</a>
										</li>
									</ul>
									<div class="dropdown tg-themedropdown tg-currencydropdown">
										<a href="javascript:void(0);" id="tg-currenty" class="tg-btnthemedropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="icon-earth"></i>
											<span>Currency</span>
										</a>
										<ul class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-currenty">
											<li>
												<a href="javascript:void(0);">
													<i>£</i>
													<span>British Pound</span>
												</a>
											</li>
											<li>
												<a href="javascript:void(0);">
													<i>$</i>
													<span>Us Dollar</span>
												</a>
											</li>
											<li>
												<a href="javascript:void(0);">
													<i>€</i>
													<span>Euro</span>
												</a>
											</li>
										</ul>
									</div>
									<div class="tg-userlogin">
										<figure><a href="javascript:void(0);"><img src="assets/images/users/img-01.jpg" alt="image description"></a></figure>
										<span>Hi, John</span>
									</div>
								</div>
							</div>
						</div> -->
					</div>
					<div class="tg-middlecontainer">
						<div class="container">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<strong class="tg-logo"><a href="index.php"><img src="assets/images/logo.png" alt="company name here"></a></strong>
									<div class="tg-userlogin" style="margin-left: 20px; z-index: 9998; position: relative;">
										<?php
										session_start();
										$img_str = "";
										if(isset($_SESSION['user_name'])) {
										// Nếu có session user_name, hiển thị thông tin người dùng và dropdown menu
											$img_str = $_SESSION['user_img'];
											echo '<figure><a href="javascript:void(0);"><img src="admin/authen/userimg/user1.jpg" alt="image description"></a></figure>
											<span>Xin chào, ' . $_SESSION['user_name'] . '</span>

											<div class="dropdown">
											<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Menu
											</button>
											<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											<div class="dropdown-item"><a href="admin/authen/user_info.php">Thông tin cá nhân</a></div>
											<div class="dropdown-item"><a href="order.php">Đơn đặt hàng</a></div>
											<div class="dropdown-item"><a href="?login=logout" >Đăng xuất</a></div>
											</div>
											</div>';
										} else {
										// Nếu không có session user_name, hiển thị nút "Login"
											echo '<button class="btn btn-info" onclick="window.location.href=\'admin/authen/user_login.php\'">Đăng nhập</button>';
										}
										if(isset($_GET['login'])) {
											$logout = $_GET['login'];
										}
										else{
											$logout = '';
										}
										if($logout == 'logout'){
											session_destroy();

											echo "<script>location.href = 'index.php';</script>";
										}


										?>
								<!-- <figure><a href="javascript:void(0);"><img src="images/users/img-01.jpg" alt="image description"></a></figure>
									<span>Hi, John</span> -->

								<!-- <div class="dropdown">
									<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Menu
									</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<div class="dropdown-item"><a href="#">Profile</a></div>
										<div class="dropdown-item"><a href="?login=logout">Logout</a></div>
									</div>
								</div> -->
							</div>
							<div class="tg-wishlistandcart" style="z-index: 9999;">
										<!-- <div class="dropdown tg-themedropdown tg-wishlistdropdown">
											<a href="javascript:void(0);" id="tg-wishlisst" class="tg-btnthemedropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<span class="tg-themebadge">3</span>
												<i class="icon-heart"></i>
												<span>Wishlist</span>
											</a>
											<div class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-wishlisst">
												<div class="tg-description"><p>No products were added to the wishlist!</p></div>
											</div>
										</div> -->
										<div class="dropdown tg-themedropdown tg-minicartdropdown">
											<a href="javascript:void(0);" id="tg-minicart" class="tg-btnthemedropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<span class="tg-themebadge quantity-cart">0</span>
												<i class="icon-cart"></i>
												<!-- <span>$123.00</span> -->
											</a>
											<div class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-minicart">
												<div class="tg-minicartbody product-cart">
													<!-- <div class="tg-minicarproduct">
														<figure>
															<img src="assets/images/products/img-01.jpg" alt="image description">
															
														</figure>
														<div class="tg-minicarproductdata">
															<h5><a href="javascript:void(0);">Our State Fair Is A Great Function</a></h5>
															<h6><a href="javascript:void(0);">$ 12.15</a></h6>
														</div>
													</div> -->
												</div>
												<div class="tg-minicartfoot">
													<!-- <a class="tg-btnemptycart" href="javascript:void(0);">
														<i class="fa fa-trash-o"></i>
														<span>Xóa tất cả</span>
													</a> -->
													<!-- <span class="tg-subtotal money-cart">0</span> -->
													<div class="tg-btns">
														<a class="tg-btn tg-active" href="cart.php">Xem giỏ hàng</a>
														<a class="tg-btn" href="checkout.php">Thanh toán</a>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tg-searchbox">
										<form class="tg-formtheme tg-formsearch" action="search.php" method="GET">
											<fieldset>
												<input type="text" name="search" class="typeahead form-control" placeholder="Tìm kiếm theo Tiêu đề, Tác giả, ISBN,..." required>
												<button type="submit"><i class="icon-magnifier"></i></button>
											</fieldset>
											<!-- <a href="javascript:void(0);">+  Advanced Search</a> -->
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tg-navigationarea">
						<div class="container">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<nav id="tg-nav" class="tg-nav">
										<div class="navbar-header">
											<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#tg-navigation" aria-expanded="false">
												<span class="sr-only">Toggle navigation</span>
												<span class="icon-bar"></span>
												<span class="icon-bar"></span>
												<span class="icon-bar"></span>
											</button>
										</div>
										<div id="tg-navigation" class="collapse navbar-collapse tg-navigation">
											<ul>
												<li>
													<a href="index.php">Trang chủ</a>
												</li>
												<li class="menu-item-has-children">
													<a href="javascript:void(0);">Danh mục</a>
													<ul class="sub-menu">
														<li><a href="books.php">Tất cả</a></li>
														<?php
														foreach ($menuItems as $category) {
															echo '<li><a href="books.php?category_id='.$category['category_id'].'&category_name='.$category['category_name'].'">'.$category['category_name'].'</a></li>';
														}
														?>
													</ul>
												</li>
												<!-- <li class="menu-item-has-children">
													<a href="javascript:void(0);">Authors</a>
													<ul class="sub-menu">
														<li><a href="authors.html">Authors</a></li>
														<li><a href="authordetail.html">Author Detail</a></li>
													</ul>
												</li>
												<li><a href="products.html">Best Selling</a></li>
												<li><a href="products.html">Weekly Sale</a></li>
												<li class="menu-item-has-children">
													<a href="javascript:void(0);">Latest News</a>
													<ul class="sub-menu">
														<li><a href="newslist.html">News List</a></li>
														<li><a href="newsgrid.html">News Grid</a></li>
														<li><a href="newsdetail.html">News Detail</a></li>
													</ul>
												</li>
												<li><a href="contactus.html">Contact</a></li>
												<li class="menu-item-has-children current-menu-item">
													<a href="javascript:void(0);"><i class="icon-menu"></i></a>
													<ul class="sub-menu">
														<li class="menu-item-has-children current-menu-item">
															<a href="aboutus.html">Products</a>
															<ul class="sub-menu">
																<li><a href="products.html">Products</a></li>
																<li class="current-menu-item"><a href="productdetail.html">Product Detail</a></li>
															</ul>
														</li>
														<li><a href="aboutus.html">About Us</a></li>
														<li><a href="404error.html">404 Error</a></li>
														<li><a href="comingsoon.html">Coming Soon</a></li>
													</ul>
												</li> -->
											</ul>
										</div>
									</nav>
								</div>
							</div>
						</div>
					</div>
				</header>
		<!--************************************
				Header End
				*************************************-->
		<!--************************************
				Inner Banner Start
				*************************************-->
				<!-- <div class="tg-innerbanner tg-haslayout tg-parallax tg-bginnerbanner" data-z-index="-100" data-appear-top-offset="600" data-parallax="scroll" data-image-src="assets/images/parallax/bgparallax-07.jpg">
					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="tg-innerbannercontent">
									<h1>All Products</h1>
									<ol class="tg-breadcrumb">
										<li><a href="javascript:void(0);">home</a></li>
										<li><a href="javascript:void(0);">Products</a></li>
										<li class="tg-active">Product Title Here</li>
									</ol>
								</div>
							</div>
						</div>
					</div>
				</div> -->
		<!--************************************
				Inner Banner End
				*************************************-->
		<!--************************************