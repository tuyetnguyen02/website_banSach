<?php
// if(!isset($_SESSION['cart'])) {
// 	$_SESSION['cart'] = [];
// }
// $count = 0;
// // var_dump($_SESSION['cart']);
// foreach($_SESSION['cart'] as $item) {
// 	$count += $item['num'];
// }
?>
<!-- <script type="text/javascript">
	function addCart(productId, num) {
		$.post('api/ajax_request.php', {
			'action': 'cart',
			'id': productId,
			'num': num
		}, function(data) {
			location.reload()
		})
	}
</script> -->
<!-- Cart start -->
<!-- <span class="cart_icon">
	<span class="cart_count"><?=$count?></span>
	<a href="cart.php"><img src="https://gokisoft.com/img/cart.png"></a>
</span> -->
<!-- Cart stop -->
<!--*************************************
Footer Start
*************************************-->
<footer id="tg-footer" class="tg-footer tg-haslayout">
	<div class="tg-footerarea">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<!-- <ul class="tg-clientservices">
						<li class="tg-devlivery">
							<span class="tg-clientserviceicon"><i class="icon-rocket"></i></span>
							<div class="tg-titlesubtitle">
								<h3>Vận chuyển nhanh</h3>
								<p>Vận chuyển toàn quốc</p>
							</div>
						</li>
						<li class="tg-discount">
							<span class="tg-clientserviceicon"><i class="icon-tag"></i></span>
							<div class="tg-titlesubtitle">
								<h3>Mở giảm giá</h3>
								<p>Chiết khấu</p>
							</div>
						</li>
						<li class="tg-quality">
							<span class="tg-clientserviceicon"><i class="icon-leaf"></i></span>
							<div class="tg-titlesubtitle">
								<h3>Quan tâm chất lượng</h3>
								<p>Xuất bản tác phẩm chất lượng</p>
							</div>
						</li>
						<li class="tg-support">
							<span class="tg-clientserviceicon"><i class="icon-heart"></i></span>
							<div class="tg-titlesubtitle">
								<h3>Hỗ trợ 24/7</h3>
								<p>Phục vụ mọi khoảnh khắc</p>
							</div>
						</li>
					</ul> -->
				</div>
				<div class="tg-threecolumns">
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
						<div class="tg-footercol">
							<strong class="tg-logo"><a href="javascript:void(0);"><img src="assets/images/flogo.png" alt="image description"></a></strong>
							<ul class="tg-contactinfo">
								<li>
									<i class="icon-apartment"></i>
									<address>GTVT, 3 Cầu Giấy, Hà Nội</address>
								</li>
								<li>
									<i class="icon-phone-handset"></i>
									<span>
										<em>113</em>
									</span>
								</li>
								<li>
									<i class="icon-clock"></i>
									<span>Phục vụ 7 ngày/tuần Từ 8:00 - 17:00</span>
								</li>
								<li>
									<i class="icon-envelope"></i>
									<span>
										<em><a href="mailto:support@domain.com">support@domain.com</a></em>
										<em><a href="mailto:info@domain.com">info@domain.com</a></em>
									</span>
								</li>
							</ul>
							<ul class="tg-socialicons">
								<li class="tg-facebook"><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
								<li class="tg-twitter"><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
								<li class="tg-linkedin"><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
								<li class="tg-googleplus"><a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a></li>
								<li class="tg-rss"><a href="javascript:void(0);"><i class="fa fa-rss"></i></a></li>
							</ul>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
						<div class="tg-footercol tg-widget tg-widgetnavigation">
							<div class="tg-widgettitle">
								<h3>Thông tin vận chuyển và Trợ giúp</h3>
							</div>
							<div class="tg-widgetcontent">
								<ul>
									<li><a href="javascript:void(0);">Điều khoản sử dụng</a></li>
									<li><a href="javascript:void(0);">Điều khoản bán hàng</a></li>
									<li><a href="javascript:void(0);">Đổi trả</a></li>
									<li><a href="javascript:void(0);">Privacy</a></li>
									<li><a href="javascript:void(0);">Cookies</a></li>
									<li><a href="javascript:void(0);">Liên hệ chúng tôi</a></li>
									<li><a href="javascript:void(0);">Các chi nhánh của chúng tôi</a></li>
									<li><a href="javascript:void(0);">Tầm nhìn &amp; Mục tiêu</a></li>
								</ul>
								<ul>
									<li><a href="javascript:void(0);">Câu chuyện của chúng tôi</a></li>
									<li><a href="javascript:void(0);">Gặp đội ngũ của chúng tôi</a></li>
									<li><a href="javascript:void(0);">Câu hỏi thường gặp</a></li>
									<li><a href="javascript:void(0);">Chứng thực</a></li>
									<li><a href="javascript:void(0);">Tham gia với chúng tôi</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						<div class="tg-footercol tg-widget tg-widgettopsellingauthors">
							<div class="tg-widgettitle">
								<h3>Tác giả bán chạy nhất</h3>
							</div>
							<div class="tg-widgetcontent">
								<ul>
									<li>
										<figure><a href="javascript:void(0);"><img src="assets/images/author/imag-09.jpg" alt="image description"></a></figure>
										<div class="tg-authornamebooks">
											<h4><a href="javascript:void(0);">Jude Morphew</a></h4>
											<p>21,658 đầu sách</p>
										</div>
									</li>
									<li>
										<figure><a href="javascript:void(0);"><img src="assets/images/author/imag-10.jpg" alt="image description"></a></figure>
										<div class="tg-authornamebooks">
											<h4><a href="javascript:void(0);">Shaun Humes</a></h4>
											<p>20,257 đầu sách</p>
										</div>
									</li>
									<li>
										<figure><a href="javascript:void(0);"><img src="assets/images/author/imag-11.jpg" alt="image description"></a></figure>
										<div class="tg-authornamebooks">
											<h4><a href="javascript:void(0);">Kathrine Culbertson</a></h4>
											<p>15,686 đầu sách</p>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="tg-newsletter">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<h4>Đăng ký nhận tin tức</h4>
					<!-- <h5>Consectetur adipisicing elit sed do eiusmod tempor incididunt.</h5> -->
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<form class="tg-formtheme tg-formnewsletter">
						<fieldset>
							<input type="email" name="email" class="form-control" placeholder="Enter Your Email ID">
							<button type="button"><i class="icon-envelope"></i></button>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="tg-footerbar">
		<a id="tg-btnbacktotop" class="tg-btnbacktotop" href="javascript:void(0);"><i class="icon-chevron-up"></i></a>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<span class="tg-paymenttype"><img src="assets/images/paymenticon.png" alt="image description"></span>
					<span class="tg-copyright">2017 All Rights Reserved By &copy; Book Library</span>
				</div>
			</div>
		</div>
	</div>
</footer>
		<!--************************************
				Footer End
				*************************************-->
			</div>
	<!--************************************
			Wrapper End
			*************************************-->
			<script>
				$(document).ready(function() {
					$('.add-cart').click(function(event) {
						event.preventDefault()
						var cart = localStorage.getItem("cart")

						var quantity = $('.quantity').val()
						if(quantity == null){
							quantity = 1;
						}
						if(cart == null){
							var item = [
							{
								masanpham: '<?php echo $book['book_id'];?>',
								tensanpham: '<?php echo $book['book_name'];?>',
								giaban: '<?php echo number_format($book['price']);?>',
								anhchinh: '<?php echo $book['img'];?>',
								soluong: quantity
							}
							]

							localStorage.setItem("cart", JSON.stringify(item))

							alert("Đã thêm sách vào giỏ hàng")
							location.reload();

						}else{
							var cart = JSON.parse(localStorage.getItem("cart"))

							var check = 0;
							var masanpham = '<?php echo $book['book_id'];?>'
							for (var i = 0; i < cart.length; i++) {
								if (cart[i].masanpham == masanpham){
									check = check + 1
								}
							}

							if(check != 0){
								alert("Sách đã có trong giỏ hàng!")
							}else{
								var book = {
									masanpham: '<?php echo $book['book_id'];?>',
									tensanpham: '<?php echo $book['book_name'];?>',
									giaban: '<?php echo number_format($book['price']);?>',
									anhchinh: '<?php echo $book['img'];?>',
									soluong: quantity
								}

								cart.push(book)


								localStorage.setItem("cart", JSON.stringify(cart))

								alert('Thêm sách vào giỏ hàng thành công!')
								location.reload();

							}


						}


					});
				});
			</script>
			<script>
				$(document).ready(function() {
					var cart = localStorage.getItem('cart')

					if(cart == null){
						$('.product-cart').append('<div class="tg-minicarproduct"> Không có sản phẩm </div>')
					}else{
						var cart = JSON.parse(localStorage.getItem('cart'))
						var tien = 0
						for (var i = 0; i < cart.length; i++) {
							var gia = parseInt(cart[i].giaban) * parseInt(cart[i].soluong) * 1000;
							$('.product-cart').append('<div class="tg-minicarproduct"><figure><img src="admin/assets/images/'+cart[i].anhchinh+'" alt="image description" width="50" height="50"></figure><div class="tg-minicarproductdata"><h5><a href="javascript:void(0);">'+cart[i].tensanpham+'</a></h5><h6><a href="javascript:void(0);"><span style="font: 10px;">'+cart[i].soluong+' X </span>'+cart[i].giaban+' đ</a></h6></div></div>');
							tien += gia;
						}

						$('.quantity-cart').html(cart.length)

						$('.money-cart').html(tien.toLocaleString('vi', {style : 'currency', currency : 'VND'}))

						// $('.dh').append('<div class="btn-block"> <a href="gio-hang.php" class="btn">Xem Giỏ Hàng <i class="fas fa-chevron-right"></i></a> <a href="thanh-toan.php" class="btn btn--primary">Thanh Toán <i class="fas fa-chevron-right"></i></a> </div>')

					}
				});
			</script>

			<script src="assets/js/vendor/jquery-library.js"></script>
			<script src="assets/js/vendor/bootstrap.min.js"></script>
			<script src="https://maps.google.com/maps/api/js?key=AIzaSyCR-KEWAVCn52mSdeVeTqZjtqbmVJyfSus&amp;language=en"></script>
			<script src="assets/js/owl.carousel.min.js"></script>
			<script src="assets/js/jquery.vide.min.js"></script>
			<script src="assets/js/countdown.js"></script>
			<script src="assets/js/jquery-ui.js"></script>
			<script src="assets/js/parallax.js"></script>
			<script src="assets/js/countTo.js"></script>
			<script src="assets/js/appear.js"></script>
			<script src="assets/js/gmap3.js"></script>
			<script src="assets/js/main.js"></script>
		</body>
		</html>