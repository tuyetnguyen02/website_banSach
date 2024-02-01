<?php
$title = 'Giỏ hàng';
require_once('layouts/header.php');

?>
<!-- Cart Page Start -->
<main class="cart-page-main-block inner-page-sec-padding-bottom">

	<div class="cart_area cart-area-padding">
		<div class="container">
			<div class="page-section-title">
				<h1>Giỏ Hàng</h1>
			</div>
			<div class="row">
				<div class="col-12">
					<form action="#" class="">
						<!-- Cart Table -->
						<div class="cart-table table-responsive mb--40" >
							<table class="table">
								<!-- Head Row -->
								<thead>
									<tr>
										<th class="pro-remove"></th>
										<th class="pro-thumbnail">Ảnh</th>
										<th class="pro-title">Sản phẩm</th>
										<th class="pro-price">Giá</th>
										<th class="pro-quantity">Số lượng</th>
										<th class="pro-subtotal">Tổng tiền</th>
									</tr>
								</thead>
								<tbody>

								</tbody>
							</table>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="cart-section-2">
		<div class="container">
			<div class="row">
				<!-- Cart Summary -->
				<div class="col-lg-6 col-12 d-flex">
					<div class="cart-summary">
						<div class="cart-summary-wrap">
							<h4><span>Đơn Hàng</span></h4>
							<p>Số sản phẩm: <span class="text-primary soluongsanpham">0</span></p>
							<p>Phí ship: <span class="text-primary">0đ</span></p>
							<h2>Tổng tiền: <span class="text-primary tongtien">0đ</span></h2>
						</div>
						<div class="cart-summary-button">
							<a href="checkout.php" class="checkout-btn c-btn btn--primary">Thanh Toán</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</main>

<!-- Cart Page End -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>

	$(document).ready(function() {
		var cart = localStorage.getItem('cart')
		var id = 0;

		if(cart == null){
			window.location.href = 'index.php';
		}else{
			var cart = JSON.parse(localStorage.getItem('cart'))
			var tien = 0
			for (var i = 0; i < cart.length; i++) {
				var gia = parseInt(cart[i].giaban) * parseInt(cart[i].soluong) * 1000
				$('tbody').append('<tr> <td class="pro-remove"><a href="#" class="xoa" value="'+cart[i].masanpham+'">Xóa</a> </td> <td class="pro-thumbnail" style="width: 150px;"><a href="#"><img src="admin/assets/images/'+cart[i].anhchinh+'" alt="Product"></a></td> <td class="pro-title"><a href="detail.php/book_id='+cart[i].masanpham+'">'+cart[i].tensanpham+'</a></td> <td class="pro-price"><span>'+cart[i].giaban+' đ</span></td> <td class="pro-quantity"> <div class="pro-qty"> <div class="count-input-block"> <input type="number" class="form-control text-center number" data="'+cart[i].masanpham+'" value="'+cart[i].soluong+'"> </div> </div> </td> <td class="pro-subtotal"><span>'+gia.toLocaleString('vi', {style : 'currency', currency : 'VND'})+'</span></td> </tr>')
				tien += gia
			}

			$('.soluongsanpham').html(cart.length + ' sản phẩm')

			$('.tongtien').html(tien.toLocaleString('vi', {style : 'currency', currency : 'VND'}))

			$('.xoa').click(function(argument) {
				var masanpham = $(this).attr('value')

				var newcart = cart.filter(function(item) {
					return item.masanpham != masanpham;
				});

				localStorage.setItem("cart", JSON.stringify(newcart))

				location.reload();

			})
		}



		$(".number").on("input", function() {
			var sl = $(this).val(); 

			var msp = $(this).attr('data');

			for (var i = 0; i < cart.length; i++) {
				if(cart[i].masanpham == msp){
					id = i
				}
			}


			if(sl <= 0){
				
			}else{
				cart[id].soluong = sl
				localStorage.setItem('cart',JSON.stringify(cart))
				location.reload();
			}
			
		});



	});
</script>
<?php
require_once('layouts/footer.php');
?>