<?php
	$title = 'Trang chủ';
	$baseUrl = '';
	require_once('layouts/header.php');
	require_once('db/database.php');

	//Making dash board
	$sql_order = mysqli_query($conn, "select * from orders");
	$sql_order_count = mysqli_num_rows($sql_order);
	$sql_book = mysqli_query($conn, "Select * from books");
	$sql_book_count = mysqli_num_rows($sql_book);
	$sql_user = mysqli_query($conn, "Select * from login");
	$sql_user_count = mysqli_num_rows($sql_user);

	//Making chart
	$sql_for_chart = mysqli_query($conn, "select sum(total_price) as total, MONTH(date_of_purchase) as month from orders where YEAR(date_of_purchase) = YEAR(CURRENT_DATE) and status = 'Thành công';");
	$data = array();
	while ($row = mysqli_fetch_assoc($sql_for_chart)) {
    	$data[] = $row;
	}

	//Best selling product
	$sql_for_top_product = mysqli_query($conn, "select a.book_name, a.img, a.author, a.episode, a.num_pages, a.price, c.category_name, sum(b.quantity) as total_quantity
		from books a join orders b on a.book_id = b.book_id 
		JOIN category c on a.category_id = c.category_id 
		WHERE b.status = 'Thành công'
		group by a.book_id
		order by total_quantity DESC 
		limit 5;");

	$sql_target = mysqli_query($conn, "select sum(total_price) from orders where status = 'Thành công'");
?>



<div class="main-container">
		<div class="pd-ltr-20">
			<div class="card-box pd-20 height-100-p mb-30">
				<div class="row align-items-center">
					<div class="col-md-4">
						<img src="assets/vendors/images/banner-img.png" alt="">
					</div>
					<div class="col-md-8">
						<h4 class="font-20 weight-500 mb-10 text-capitalize">
							Chào mừng <div class="weight-600 font-30 text-blue"><?php echo $_SESSION['adminname'] ?></div>
						</h4>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-4 mb-30">
					<div class="card-box height-100-p widget-style1" style="align-items: center; display: flex; justify-content: center;">
						<span class="fas fa-book fa-3x" style="margin: 20px;"></span></i>
						<?php echo '<h3>' . $sql_book_count . ' Sách </h3>'?>
					</div>
				</div>
				<div class="col-xl-4 mb-30">
					<div class="card-box height-100-p widget-style1" style="align-items: center; display: flex; justify-content: center;">
						<i class="fas fa-user fa-3x" style="margin: 20px; "></i>
						<?php echo '<h3>' . $sql_user_count . ' Người dùng </h3>'?>
					</div>
				</div>
				<div class="col-xl-4 mb-30">
					<div class="card-box height-100-p widget-style1" style="align-items: center; display: flex; justify-content: center;">
						<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16" style="margin: 20px; ">
						<path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z"/>
						</svg>
						<?php echo '<h3>' . $sql_order_count . ' Đơn hàng </h3>'?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-8 mb-30">
					<div class="card-box height-100-p pd-20">
						<h2 class="h4 mb-20">Tổng giá trị mỗi tháng năm nay</h2>
						<canvas id="myChart" width="400" height="200"></canvas>
					</div>
				</div>
				<div class="col-xl-4 mb-30">
					<div class="card-box height-100-p pd-20">
						<h2 class="h4 mb-20">Mục tiêu 10 triệu VND</h2>
						<canvas id="myChart2" width="300" height="300"></canvas>
					</div>
				</div>
			</div>
			<div class="card-box mb-30">
				<h2 class="h4 pd-20">Sản phẩm bán chạy</h2>
				<table class="data-table table nowrap">
					<thead>
						<tr>
							<th>Sản phẩm</th>
							<th>Tên</th>
							<th>Danh mục</th>
							<th>Tập</th>
							<th>Số trang</th>
							<th>Giá</th>
							<th>Số lượng</th>
						</tr>
					</thead>
					<tbody>
						<?php
							while ($row = mysqli_fetch_assoc($sql_for_top_product)) {
								echo '<tr>';
								echo '<td><img src="assets/images/' . $row['img'] . '" width="70" height="70" alt=""></td>';
								echo '<td>';
								echo '<h5 class="font-16">' . $row['book_name'] . '</h5>';
								echo 'by ' . $row['author'];
								echo '</td>';
								echo '<td>' . $row['category_name'] . '</td>';
								echo '<td>' . $row['episode'] . '</td>';
								echo '<td>' . $row['num_pages'] . '</td>';
								echo '<td>$' . $row['price'] . '</td>';
								echo '<td>' . $row['total_quantity'] . '</td>';
								echo '</tr>';
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script>
		var ctx = document.getElementById('myChart').getContext('2d');
		var chartData = <?php echo json_encode($data); ?>;
		var months = [];
		var totalPrices = [];

		chartData.forEach(function(item) {
			months.push(item['month']);
			totalPrices.push(item['total']);
		});

		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: months,
				datasets: [{
					label: 'Total Price',
					data: totalPrices,
					backgroundColor: 'rgba(75, 192, 192, 0.2)',
					borderColor: 'rgba(75, 192, 192, 1)',
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					y: {
						beginAtZero: true
					}
				}
			}
		});
	</script>


	<script>
		var canvas = document.getElementById('myChart2');
		var ctx = canvas.getContext('2d');

		var radius = 100;
		var centerX = canvas.width / 2;
		var centerY = canvas.height / 2;
		var backgroundColor = '#f0f0f0';
		var progressColor = '#4caf50';

		var targetValue = 10000000;
		var completedValue = <?php $row = mysqli_fetch_row($sql_target);
			$completedValue = $row[0];
			echo $completedValue;
			?>;

		var percentage = ((completedValue / targetValue) * 100).toFixed(2);

		ctx.beginPath();
		ctx.arc(centerX, centerY, radius, 0, 2 * Math.PI);
		ctx.fillStyle = backgroundColor;
		ctx.fill();
		ctx.closePath();

		var startAngle = -0.5 * Math.PI;
		var endAngle = (percentage / 100) * 2 * Math.PI - 0.5 * Math.PI;
		ctx.beginPath();
		ctx.arc(centerX, centerY, radius, startAngle, endAngle);
		ctx.lineTo(centerX, centerY);
		ctx.fillStyle = progressColor;
		ctx.fill();
		ctx.closePath();

		ctx.font = '14px Arial'; // Đặt phông chữ và kích thước
		ctx.fillStyle = 'black'; // Đặt màu chữ
		ctx.textAlign = 'center'; // Canh giữa văn bản
		ctx.fillText(percentage + '%', centerX, centerY + 10); // Vẽ phần trăm
	</script>
<?php
	require_once('layouts/footer.php');
?>