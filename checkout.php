<?php
$title = 'Thanh toán';
require_once('layouts/header.php');

if (!isset($_SESSION['user_name'])) {
    echo "<script>window.location.href = 'admin/authen/user_login.php';</script>";
}
$taikhoan = $_SESSION['user_name'];
$sql_khachhang = "SELECT * FROM login WHERE username = '".$taikhoan."'";
$khachhang = executeResult($sql_khachhang, true);

// if (strpos($khachhang['name'], 'Null') !== false) {
//     echo "<script>window.location.href = 'admin/authen/user_login.php';</script>";
// }
?>

<!-- Checkout Form s-->
<main id="content" class="page-section inner-page-sec-padding-bottom space-db--20" style="background-color: #f9f9f9; padding: 60px 0;">

    <form method="POST">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Checkout Form s-->
                    <div class="checkout-form" style="background-color: #fff; padding: 20px; border: 1px solid #ddd;">
                        <div class="row row-40">
                            <div class="col-lg-7 mb--20">
                                <!-- Billing Address -->
                                <div id="billing-form" class="mb-40">
                                    <h4 class="checkout-title" style="font-size: 24px; margin-bottom: 20px;">Thông Tin Thanh Toán</h4>
                                    <div class="row">
                                        <div class="col-md-6 col-12 mb--20">
                                            <label>Họ tên</label>
                                            <input type="text" value="<?= $khachhang['name'] ?>" placeholder="Họ tên người nhận" required class="hoten" disabled style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd;">
                                        </div>
                                        <div class="col-md-6 col-12 mb--20">
                                            <label>Số điện thoại</label>
                                            <input type="text" placeholder="Số điện thoại" value="<?= $khachhang['mobile'] ?>" required class="sodienthoai" disabled style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd;">
                                        </div>
                                        <div class="col-12 mb--20">
                                            <label>Số nhà</label>
                                            <input type="text" placeholder="Số nhà" required class="sonha" style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd;">
                                        </div>
                                        <div class="col-12 mb--20">
                                            <label>Thôn/Xóm</label>
                                            <input type="text" placeholder="Thôn hoặc xóm" required class="thonxom" style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd;">
                                        </div>
                                        <div class="col-12 mb--20">
                                            <label>Phường/Xã</label>
                                            <input type="text" placeholder="Phường hoặc xã" required class="phuongxa" style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd;">
                                        </div>
                                        <div class="col-12 mb--20">
                                            <label>Huyện</label>
                                            <input type="text" placeholder="Huyện" required class="huyen" style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd;">
                                        </div>
                                        <div class="col-12 mb--20">
                                            <label>Thành phố</label>
                                            <input type="text" placeholder="Thành phố hoặc tỉnh" required class="tinhthanh" style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="row">
                                    <!-- Cart Total -->
                                    <div class="col-12">
                                        <div class="checkout-cart-total" style="background-color: #fff; border: 1px solid #ddd; padding: 20px; margin-top: 20px;">
                                            <h2 class="checkout-title" style="font-size: 24px; margin-bottom: 20px;">THÔNG TIN ĐƠN HÀNG</h2>
                                            <h4 style="font-size: 18px; margin-bottom: 10px;">Sản phẩm <span>Tổng tiền</span></h4>
                                            <ul class="thongtinsanpham" style="list-style-type: none; padding: 0; margin: 0;">

                                            </ul>
                                            <p style="font-size: 16px; margin-bottom: 10px;">Số lượng sản phẩm <span class="sl">0</span></p>
                                            <p style="font-size: 16px; margin-bottom: 10px;">Phí giao hàng <span>0</span></p>
                                            <h4 style="font-size: 18px;">Tổng tiền <span class="tt">0</span></h4>
                                            <br>
                                            <div class="term-block" style="margin-top: 20px;">
                                                <input type="checkbox" id="accept_terms2" style="margin-right: 10px;">
                                                <label for="accept_terms2">Tôi đồng ý điều khoản & dịch vụ</label>
                                            </div>
                                            <button class="place-order w-100 dathang" style="padding: 15px 20px; font-size: 16px; text-transform: uppercase; background-color: #ff6f61; color: #fff; border: none; cursor: pointer; transition: background-color 0.3s ease; display: inline-block; width: 100%;">ĐẶT HÀNG</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</main>

<script>
    $(document).ready(function () {
        $(document).ready(function() {
        var giohang = localStorage.getItem('cart')
        var tien = 0
        if(giohang == null){
            window.location.href = 'index.php'
        }else{
            var giohang = JSON.parse(localStorage.getItem('cart'))
            
            for (var i = 0; i < giohang.length; i++) {
                var gia = parseInt(giohang[i].giaban) * parseInt(giohang[i].soluong) * 1000
                $('.thongtinsanpham').append('<li><span class="left">'+giohang[i].tensanpham+' X '+giohang[i].soluong+'</span> <span class="right">'+gia.toLocaleString('vi', {style : 'currency', currency : 'VND'})+'</span></li>')
                tien += parseInt(gia)
            }
            $('.sl').html(giohang.length + ' sản phẩm')
            $('.tt').html(tien.toLocaleString('vi', {style : 'currency', currency : 'VND'}))
        }

        var soluong = [] 
        $('.dathang').click(function(event) {
            event.preventDefault()
            var diachi = $('.sonha').val() + ", " + $('.thonxom').val() + ", " + $('.phuongxa').val() + ", " + $('.huyen').val() + ", " + $('.tinhthanh').val()
            var makhachhang = '<?php echo $khachhang["user_id"] ?>'
            var sanpham = JSON.parse(localStorage.getItem('cart'))
            var sodienthoai = '<?php echo $khachhang["mobile"] ?>'

            soluong.length = 0;
            for (var i = 0; i < sanpham.length; i++) {
                soluong.push(sanpham[i].soluong)
            }

// looix ko chayj toi dat-hang-thanh-cong
            $.post('process-checkout.php', {makhachhang: makhachhang, diachi:diachi, sanpham:sanpham, tongtien: tien, soluong: soluong, sodienthoai: sodienthoai}, function(data) {
                var madonhang = data
                var thoigian = '<?php echo date("d/m/Y") ?>'
                var thongtindonhang = localStorage.getItem('cart')

                localStorage.clear()

                localStorage.setItem('madonhang',madonhang)
                localStorage.setItem('thoigian',thoigian)
                localStorage.setItem('thongtindonhang',thongtindonhang)
                localStorage.setItem('tt',tien.toLocaleString('vi', {style : 'currency', currency : 'VND'}))

                window.location.href = 'complete-checkout.php'
            });

        });

    });
    });
</script>
<?php
require_once('layouts/footer.php');
?>
