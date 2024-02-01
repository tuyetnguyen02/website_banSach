<?php
$title = $_GET['book_name'];
require_once('layouts/header.php');

$book_id = getGet('book_id');
$sql = "
SELECT 
Books.*,
Category.category_name AS category_name,
Publisher.publisher_name AS publisher_name
FROM 
Books
LEFT JOIN 
Category ON Books.category_id = Category.category_id
LEFT JOIN
Publisher ON Books.publisher_id = Publisher.publisher_id
WHERE 
Books.book_id = $book_id
";
$book = executeResult($sql, true);


$category_id = $book['category_id'];
$sql = "select Books.*, Category.category_name as category_name from Books left join Category on Books.category_id = Category.category_id where Books.category_id = $category_id";

$lastestItems = executeResult($sql);

$sql = "SELECT Category.*, COUNT(Books.book_id) AS book_count
FROM Category
LEFT JOIN Books ON Category.category_id = Books.category_id
GROUP BY Category.category_id";

$categoryItems = executeResult($sql);
?>
<!-- <--Main Start *************************************--> 
<main id="tg-main" class="tg-main tg-haslayout">
			<!--************************************
					News Grid Start
					*************************************-->
					<div class="tg-sectionspace tg-haslayout">
						<div class="container">
							<div class="row">
								<div id="tg-twocolumns" class="tg-twocolumns">
									<div class="col-xs-12 col-sm-8 col-md-8 col-lg-9 pull-right">
										<div id="tg-content" class="tg-content">
											<!-- <div class="tg-featurebook alert" role="alert">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
												<div class="tg-featureditm">
													<div class="row">
														<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 hidden-sm hidden-xs">
															<figure><img src="assets/images/img-04.png" alt="image description"></figure>
														</div>
														<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
															<div class="tg-featureditmcontent">
																<div class="tg-themetagbox"><span class="tg-themetag">featured</span></div>
																<div class="tg-booktitle">
																	<h3><a href="javascript:void(0);">Things To Know About Green Flat Design</a></h3>
																</div>
																<span class="tg-bookwriter">By: <a href="javascript:void(0);">Farrah Whisenhunt</a></span>
																<span class="tg-stars"><span></span></span>
																<div class="tg-priceandbtn">
																	<span class="tg-bookprice">
																		<ins>$23.18</ins>
																		<del>$30.20</del>
																	</span>
																	<a class="tg-btn tg-btnstyletwo tg-active" href="javascript:void(0);">
																		<i class="fa fa-shopping-basket"></i>
																		<em>Add To Basket</em>
																	</a>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div> -->
											<div class="tg-productdetail">
												<div class="row">
													<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
														<div class="tg-postbook">
															<figure class="tg-featureimg"><img src="admin/assets/images/<?=$book['img']?>" alt="image description"></figure>
															<div class="tg-postbookcontent">
																<span class="tg-bookprice">
																	<ins><?= number_format($book['price'], 0, ',', '.') ?> đ</ins>
																</span>
																<!-- <span class="tg-bookwriter">You save $4.02</span> -->
																<ul class="tg-delevrystock">
																	<li><i class="icon-rocket"></i><span>Miễn phí vận chuyển toàn quốc</span></li>
																	<li><i class="icon-store"></i><span>Tình trạng: <em>Còn hàng</em></span></li>
																</ul>
																<div class="tg-quantityholder">
																	<em class="minus">-</em>
																	<input type="text" class="result quantity" value="1" id="quantity1" name="quantity">
																	<em class="plus">+</em>
																</div>
																<a class="tg-btn tg-active tg-btn-lg add-cart" href="javascript:void(0);">Thêm vào giỏ hàng</a>
																<!-- <a class="tg-btnaddtowishlist" href="javascript:void(0);">
																	<span>Thêm vào danh sách ưa thích</span>
																</a> -->
															</div>
														</div>
													</div>
													<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
														<div class="tg-productcontent">
															<ul class="tg-bookscategories">
																<li><a href="javascript:void(0);"><?=$book['category_name']?></a></li>
															</ul>
															<!-- <div class="tg-themetagbox"><span class="tg-themetag">sale</span></div> -->
															<div class="tg-booktitle">
																<h3><?=$book['book_name']?></h3>
															</div>
															<span class="tg-bookwriter">Tác giả: <a href="javascript:void(0);"><?=$book['author']?></a></span>
															<span class="tg-stars"><span></span></span>
															<span class="tg-addreviews"><a href="javascript:void(0);">Thêm đánh giá</a></span>
															<div class="tg-share">
																<span>Chia sẻ:</span>
																<ul class="tg-socialicons">
																	<li class="tg-facebook"><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
																	<li class="tg-twitter"><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
																	<li class="tg-linkedin"><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
																	<li class="tg-googleplus"><a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a></li>
																	<li class="tg-rss"><a href="javascript:void(0);"><i class="fa fa-rss"></i></a></li>
																</ul>
															</div>
															<div class="tg-description">
																<div id="shortDescription"></div>
																<div id="fullDescription" style="display:none;"></div>
																<button id="showMoreButton" onclick="showMore()">Hiện thêm...</button>
																<button id="showLessButton" style="display:none;" onclick="showLess()">Rút gọn</button>
															</div>

															<script>
																$(document).ready(function() {
																	var fullDescription = `<?php echo addslashes($book['detail']); ?>`;
																	var shortDescription = truncateText(fullDescription, 300);

																	$("#shortDescription").html(shortDescription);
																	$("#fullDescription").html(fullDescription);
																});

																function truncateText(text, maxLength) {
																	return text.length > maxLength ? text.substr(0, maxLength) + "..." : text;
																}

																function showMore() {
																	$("#shortDescription").hide();
																	$("#fullDescription").show();
																	$("#showMoreButton").hide();
																	$("#showLessButton").show();
																}

																function showLess() {
																	$("#shortDescription").show();
																	$("#fullDescription").hide();
																	$("#showMoreButton").show();
																	$("#showLessButton").hide();
																}
															</script>

															<div class="tg-sectionhead">
																<h2>Chi tiết sách</h2>
															</div>
															<ul class="tg-productinfo">
																<li><span>Mã hàng:</span><span><?=$book['ISBN']?></span></li>
																<li><span>Tác giả:</span><span><?=$book['author']?></span></li>
																<li><span>Nhà xuất bản:</span><span><?=$book['publisher_name']?></span></li>
																<li><span>Năm xuất bản:</span><span><?=$book['year']?></span></li>
																<li><span>Số trang:</span><span><?=$book['num_pages']?></span></li>
															</ul>
															<!-- <div class="tg-alsoavailable">
																<figure>
																	<img src="assets/images/img-02.jpg" alt="image description">
																	<figcaption>
																		<h3>Also Available in:</h3>
																		<ul>
																			<li><span>CD-Audio $18.30</span></li>
																			<li><span>Paperback $20.10</span></li>
																			<li><span>E-Book $11.30</span></li>
																		</ul>
																	</figcaption>
																</figure>
															</div> -->
														</div>
													</div>
													<div class="tg-productdescription">
														<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
															<!-- <div class="tg-sectionhead">
																<h2>Đánh giá sản phẩm</h2>
															</div> -->
															<!-- **************Viết và Hiển thị đánh giá************** -->
															<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
														
															
															<?php
																
																include_once 'model/feedback.php';
																
																$feedback_list = feedback_list($book_id);
																if(isset($_POST['feedback_submit'])){
																	review_add($_POST['feedback_input'],$_SESSION['user_id'], $book_id);
																	// header('location: detail.php?book_id=.$book_id='.$book_id.'&book_name='.$title);
																	 echo "<script>location.href = 'detail.php?book_id=".$book_id."&book_name=".$title.";</script>";
																	// <script>location.reload();</script>";
																}
																
																include_once 'layouts/template_feedback.php';
															?>

														</div>
													</div>
													
												</div>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 pull-left">
										<aside id="tg-sidebar" class="tg-sidebar">
											<div class="tg-widget tg-widgetsearch">
												<form class="tg-formtheme tg-formsearch" action="search.php" method="GET">
													<div class="form-group">
														<button type="submit"><i class="icon-magnifier"></i></button>
														<input type="search" name="search" class="form-group" placeholder="Tìm kiếm theo Tiêu đề, Tác giả, ISBN,..." required>
													</div>
												</form>
											</div>
											<div class="tg-widget tg-catagories">
												<div class="tg-widgettitle">
													<h3>Danh mục</h3>
												</div>
												<div class="tg-widgetcontent">
													<ul>
														<li><a href="books.php">Tất cả</a></li>
														<?php
														$index = 0;
														foreach($categoryItems as $item) {
															echo '<li><a href="books.php?category_id='.$item['category_id'].'&category_name='.$item['category_name'].'"><span>'.$item['category_name'].'</span><em>'.$item['book_count'].'</em></a></li>';
														}
														?>
													</ul>
												</div>
											</div>
											<!-- <div class="tg-widget tg-widgettrending">
												<div class="tg-widgettitle">
													<h3>Trending Products</h3>
												</div>
												<div class="tg-widgetcontent">
													<ul>
														<li>
															<article class="tg-post">
																<figure><a href="javascript:void(0);"><img src="assets/images/products/img-04.jpg" alt="image description"></a></figure>
																<div class="tg-postcontent">
																	<div class="tg-posttitle">
																		<h3><a href="javascript:void(0);">Where The Wild Things Are</a></h3>
																	</div>
																	<span class="tg-bookwriter">By: <a href="javascript:void(0);">Kathrine Culbertson</a></span>
																</div>
															</article>
														</li>
														<li>
															<article class="tg-post">
																<figure><a href="javascript:void(0);"><img src="assets/images/products/img-05.jpg" alt="image description"></a></figure>
																<div class="tg-postcontent">
																	<div class="tg-posttitle">
																		<h3><a href="javascript:void(0);">Where The Wild Things Are</a></h3>
																	</div>
																	<span class="tg-bookwriter">By: <a href="javascript:void(0);">Kathrine Culbertson</a></span>
																</div>
															</article>
														</li>
														<li>
															<article class="tg-post">
																<figure><a href="javascript:void(0);"><img src="assets/images/products/img-06.jpg" alt="image description"></a></figure>
																<div class="tg-postcontent">
																	<div class="tg-posttitle">
																		<h3><a href="javascript:void(0);">Where The Wild Things Are</a></h3>
																	</div>
																	<span class="tg-bookwriter">By: <a href="javascript:void(0);">Kathrine Culbertson</a></span>
																</div>
															</article>
														</li>
														<li>
															<article class="tg-post">
																<figure><a href="javascript:void(0);"><img src="assets/images/products/img-07.jpg" alt="image description"></a></figure>
																<div class="tg-postcontent">
																	<div class="tg-posttitle">
																		<h3><a href="javascript:void(0);">Where The Wild Things Are</a></h3>
																	</div>
																	<span class="tg-bookwriter">By: <a href="javascript:void(0);">Kathrine Culbertson</a></span>
																</div>
															</article>
														</li>
													</ul>
												</div>
											</div> -->
											<div class="tg-widget tg-widgetinstagram">
												<div class="tg-widgettitle">
													<h3>Instagram</h3>
												</div>
												<div class="tg-widgetcontent">
													<ul>
														<li>
															<figure>
																<img src="assets/images/instagram/img-01.jpg" alt="image description">
																<figcaption><a href="javascript:void(0);"><i class="icon-heart"></i><em>50,134</em></a></figcaption>
															</figure>
														</li>
														<li>
															<figure>
																<img src="assets/images/instagram/img-02.jpg" alt="image description">
																<figcaption><a href="javascript:void(0);"><i class="icon-heart"></i><em>50,134</em></a></figcaption>
															</figure>
														</li>
														<li>
															<figure>
																<img src="assets/images/instagram/img-03.jpg" alt="image description">
																<figcaption><a href="javascript:void(0);"><i class="icon-heart"></i><em>50,134</em></a></figcaption>
															</figure>
														</li>
														<li>
															<figure>
																<img src="assets/images/instagram/img-04.jpg" alt="image description">
																<figcaption><a href="javascript:void(0);"><i class="icon-heart"></i><em>50,134</em></a></figcaption>
															</figure>
														</li>
														<li>
															<figure>
																<img src="assets/images/instagram/img-05.jpg" alt="image description">
																<figcaption><a href="javascript:void(0);"><i class="icon-heart"></i><em>50,134</em></a></figcaption>
															</figure>
														</li>
														<li>
															<figure>
																<img src="assets/images/instagram/img-06.jpg" alt="image description">
																<figcaption><a href="javascript:void(0);"><i class="icon-heart"></i><em>50,134</em></a></figcaption>
															</figure>
														</li>
														<li>
															<figure>
																<img src="assets/images/instagram/img-07.jpg" alt="image description">
																<figcaption><a href="javascript:void(0);"><i class="icon-heart"></i><em>50,134</em></a></figcaption>
															</figure>
														</li>
														<li>
															<figure>
																<img src="assets/images/instagram/img-08.jpg" alt="image description">
																<figcaption><a href="javascript:void(0);"><i class="icon-heart"></i><em>50,134</em></a></figcaption>
															</figure>
														</li>
														<li>
															<figure>
																<img src="assets/images/instagram/img-09.jpg" alt="image description">
																<figcaption><a href="javascript:void(0);"><i class="icon-heart"></i><em>50,134</em></a></figcaption>
															</figure>
														</li>
													</ul>
												</div>
											</div>
											<!-- <div class="tg-widget tg-widgetblogers">
												<div class="tg-widgettitle">
													<h3>Top Bloogers</h3>
												</div>
												<div class="tg-widgetcontent">
													<ul>
														<li>
															<div class="tg-author">
																<figure><a href="javascript:void(0);"><img src="assets/images/author/imag-03.jpg" alt="image description"></a></figure>
																<div class="tg-authorcontent">
																	<h2><a href="javascript:void(0);">Jude Morphew</a></h2>
																	<span>21,658 Published Books</span>
																</div>
															</div>
														</li>
														<li>
															<div class="tg-author">
																<figure><a href="javascript:void(0);"><img src="assets/images/author/imag-04.jpg" alt="image description"></a></figure>
																<div class="tg-authorcontent">
																	<h2><a href="javascript:void(0);">Jude Morphew</a></h2>
																	<span>21,658 Published Books</span>
																</div>
															</div>
														</li>
														<li>
															<div class="tg-author">
																<figure><a href="javascript:void(0);"><img src="assets/images/author/imag-05.jpg" alt="image description"></a></figure>
																<div class="tg-authorcontent">
																	<h2><a href="javascript:void(0);">Jude Morphew</a></h2>
																	<span>21,658 Published Books</span>
																</div>
															</div>
														</li>
														<li>
															<div class="tg-author">
																<figure><a href="javascript:void(0);"><img src="assets/images/author/imag-06.jpg" alt="image description"></a></figure>
																<div class="tg-authorcontent">
																	<h2><a href="javascript:void(0);">Jude Morphew</a></h2>
																	<span>21,658 Published Books</span>
																</div>
															</div>
														</li>
													</ul>
												</div>
											</div> -->
										</aside>
									</div>
								</div>
							</div>
						</div>
					</div>
			<!--************************************
					News Grid End
					*************************************-->
				</main>
		<!--************************************
				Main End
				*************************************-->
				<?php
				require_once('layouts/footer.php');
			?>