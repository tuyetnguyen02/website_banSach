<?php
$mainTitle = "";
// Số lượng sách hiển thị trên mỗi trang
define('BOOKS_PER_PAGE', 8);
if(isset($_GET['category_id'])){
	$category_id = $_GET['category_id'];
	$category_name = $_GET['category_name'];
	$title = $category_name;
	$mainTitle = $category_name;
	require_once('layouts/header.php');

	$sql = "select Books.*, Category.category_name as category_name from Books left join Category on Books.category_id = Category.category_id where Books.category_id = $category_id and Books.deleted = 0";
	$bookItems = executeResult($sql);

	// Lấy số trang từ tham số truyền vào
	$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

	// Tính toán chỉ số của sách để hiển thị trên trang hiện tại
	$startIndex = ($page - 1) * BOOKS_PER_PAGE;
	$endIndex = $startIndex + BOOKS_PER_PAGE - 1;
	$totalBooks = count($bookItems);
	$totalPages = ceil($totalBooks / BOOKS_PER_PAGE);

	// Kiểm tra và giới hạn chỉ số cuối cùng
	if ($endIndex >= $totalBooks) {
		$endIndex = $totalBooks - 1;
	}
}else{
	$title = 'Sách Hay';
	require_once('layouts/header.php');

	$sql = "select Books.*, Category.category_name as category_name from Books left join Category on Books.category_id = Category.category_id where Books.deleted = 0";
	$bookItems = executeResult($sql);

	// Lấy số trang từ tham số truyền vào
	$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

	// Tính toán chỉ số của sách để hiển thị trên trang hiện tại
	$startIndex = ($page - 1) * BOOKS_PER_PAGE;
	$endIndex = $startIndex + BOOKS_PER_PAGE - 1;
	$totalBooks = count($bookItems);
	$totalPages = ceil($totalBooks / BOOKS_PER_PAGE);

	// Kiểm tra và giới hạn chỉ số cuối cùng
	if ($endIndex >= $totalBooks) {
		$endIndex = $totalBooks - 1;
	}
}

// Xử lý sắp xếp theo giá
$sortType = '';
if (isset($_GET['sort'])) {
	$sortType = $_GET['sort'];
	if ($sortType === 'asc') {
		usort($bookItems, function ($a, $b) {
			return $a['price'] - $b['price'];
		});
	} elseif ($sortType === 'desc') {
		usort($bookItems, function ($a, $b) {
			return $b['price'] - $a['price'];
		});
	}
}

$sql = "SELECT Category.*, COUNT(Books.book_id) AS book_count
FROM Category
LEFT JOIN Books ON Category.category_id = Books.category_id
GROUP BY Category.category_id";

$categoryItems = executeResult($sql);
?>
		<!--************************************
				Main Start
				*************************************-->
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
											<div class="tg-products">
												<!-- <div class="tg-sectionhead">
													<h2><span>People’s Choice</span>Bestselling Books</h2>
												</div> -->
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
												<div class="tg-productgrid">
													<div class="tg-refinesearch">
														<span><?= $mainTitle?></span>
														<form class="tg-formtheme tg-formsortshoitems">
															<fieldset>
																<div class="form-group">
																	<span class="tg-select">
																		<select onchange="changeSort(this)">
																			<?php
																			$sortValue = isset($_GET['sort']) ? $_GET['sort'] : '';
																			?>
																			<option value="" <?php echo ($sortValue === '') ? 'selected' : ''; ?>>Sắp xếp theo</option>
																			<option value="desc" <?php echo ($sortValue === 'desc') ? 'selected' : ''; ?>>Giá giảm dần</option>
																			<option value="asc" <?php echo ($sortValue === 'asc') ? 'selected' : ''; ?>>Giá tăng dần</option>
																		</select>
																	</span>
																</div>
																<script>
																	function changeSort(select) {
																		var selectedValue = select.value;
																		var currentURL = window.location.pathname;

        																// Kiểm tra xem biến $category_id có tồn tại không
																		<?php if (isset($category_id)) : ?>
           															    // Nếu tồn tại, thêm biến $category_id vào URL
																			currentURL += '?category_id=<?php echo $category_id; ?>&category_name=<?php echo $category_name; ?>&sort=' + selectedValue;
																		<?php else : ?>
            															// Nếu không tồn tại, chỉ thêm biến sort vào URL
																			currentURL += '?sort=' + selectedValue;
																		<?php endif; ?>

																		window.location.href = currentURL;
																	}
																</script>
																<!-- <div class="form-group">
																	<label>show:</label>
																	<span class="tg-select">
																		<select>
																			<option>8</option>
																			<option>16</option>
																			<option>20</option>
																		</select>
																	</span>
																</div> -->
															</fieldset>
														</form>
													</div>
													<!-- <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3">
														<div class="tg-postbook">
															<figure class="tg-featureimg">
																<div class="tg-bookimg">
																	<div class="tg-frontcover"><img src="assets/images/books/img-01.jpg" alt="image description"></div>
																	<div class="tg-backcover"><img src="assets/images/books/img-01.jpg" alt="image description"></div>
																</div>
															</figure>
															<div class="tg-postbookcontent">
																<ul class="tg-bookscategories">
																	<li><a href="javascript:void(0);">Art &amp; Photography</a></li>
																</ul>
																<div class="tg-themetagbox"><span class="tg-themetag">sale</span></div>
																<div class="tg-booktitle">
																	<h3><a href="javascript:void(0);">Help Me Find My Stomach</a></h3>
																</div>
																<span class="tg-bookwriter">By: <a href="javascript:void(0);">Angela Gunning</a></span>
																<span class="tg-stars"><span></span></span>
																<span class="tg-bookprice">
																	<ins>$25.18</ins>
																	<del>$27.20</del>
																</span>
																<a class="tg-btn tg-btnstyletwo" href="javascript:void(0);">
																	<i class="fa fa-shopping-basket"></i>
																	<em>Thêm Giỏ hàng</em>
																</a>
															</div>
														</div>
													</div> -->
													<?php
													$index = 0;
													for ($i = $startIndex; $i <= $endIndex; $i++) {
														echo '<div class="col-xs-6 col-sm-6 col-md-4 col-lg-3">
														<div class="tg-postbook">
														<figure class="tg-featureimg">
														<a href="detail.php?book_id='.$bookItems[$i]['book_id'].'&book_name='.$bookItems[$i]['book_name'].'"><div class="tg-bookimg">
														<div class="tg-frontcover"><img src="admin/assets/images/'.$bookItems[$i]['img'].'" alt="image description"></div>
														<div class="tg-backcover"><img src="admin/assets/images/'.$bookItems[$i]['img'].'" alt="image description"></div>
														</div></a>
														</figure>
														<div class="tg-postbookcontent">
														<ul class="tg-bookscategories">
														<li><a href="books.php?category_id='.$bookItems[$i]['category_id'].'&category_name='.$bookItems[$i]['category_name'].'">'.$bookItems[$i]['category_name'].'</a></li>
														</ul>
														<div class="tg-booktitle">
														<h3 class = "product-name-no-ellipsis"><a href="detail.php?book_id='.$bookItems[$i]['book_id'].'&book_name='.$bookItems[$i]['book_name'].'" style = "padding-top: 0px !important;
														line-height: 1.4em;
														word-break: break-word;
														white-space: normal;
														overflow: hidden;
														text-overflow: ellipsis;
														display: -webkit-box;
														-webkit-line-clamp: 2;
														-webkit-box-orient: vertical;
														min-height: 2.8em;
														max-height: 2.8em;
														font-size: 1em;">'.$bookItems[$i]['book_name'].'</a></h3>
														</div>
														<span class="tg-bookwriter">Tác giả: <a href="javascript:void(0);" style="padding-top: 0px !important;
														line-height: 1.4em;
														word-break: break-word;
														white-space: normal;
														overflow: hidden;
														text-overflow: ellipsis;
														display: -webkit-box;
														-webkit-line-clamp: 2;
														-webkit-box-orient: vertical;
														min-height: 2.8em;
														max-height: 2.8em;
														font-size: 1em;">'.$bookItems[$i]['author'].'</a></span>
														<span class="tg-bookprice">
														<ins>'.number_format($bookItems[$i]['price'], 0, ',', '.').' đ</ins>
														</span>														</div>
														</div>
														</div>';
													}
													?>
												</div>
												<?php
													// Hiển thị sách trên trang hiện tại
												echo '<div class="tg-productgrid">';
												for ($i = $startIndex; $i <= $endIndex; $i++) {
    												// Hiển thị thông tin sách tại đây
    												// ...
												}
												echo '</div>';

													// Hiển thị phân trang
												echo '<div class="tg-pagenavigation">';
												if ($page > 1) {
													echo '<a href="?page=' . ($page - 1) . '&sort=' . $sortType . '">&laquo; Trang trước</a>';
												}
												 // Số trang hiển thị xung quanh trang hiện tại
												$range = 3;
												$ellipsis = false;
												for ($i = 1; $i <= $totalPages; $i++) {
													if ($i == $page) {
														$activeClass = 'class="active"';
														echo '<a href="?page=' . $i . '&sort=' . $sortType . '" ' . $activeClass . '><strong>' . $i . '</strong></a>';
														$ellipsis = true;
													} elseif (($i >= $page - $range && $i < $page) || ($i > $page && $i <= $page + $range)) {
														echo '<a href="?page=' . $i . '&sort=' . $sortType . '">' . $i . '</a>';
														$ellipsis = true; 
													}
												}

												// Hiển thị dấu "..." và số trang lớn nhất nếu có
												if ($ellipsis && $totalPages > ($page + $range)) {
													echo '<span>...</span>';
													echo '<a href="?page=' . $totalPages . '&sort=' . $sortType . '">' . $totalPages . '</a>';
												}

												if ($page < $totalPages) {
													echo '<a href="?page=' . ($page + 1) . '&sort=' . $sortType . '">Trang sau &raquo;</a>';
												}

												echo '</div>';
												?>
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