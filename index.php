<?php
$title = 'Sách Hay';
require_once('layouts/header.php');

$sql = "SELECT Books.*, Category.category_name as category_name from Books left join Category on Books.category_id = Category.category_id WHERE Books.deleted = 0 ORDER BY Books.num_sell DESC LIMIT 6";
$bestSellingItems = executeResult($sql);

$sql = "SELECT Books.*, Category.category_name as category_name from Books left join Category on Books.category_id = Category.category_id WHERE book_id = 1";
$pickedAuthorItem1 = executeResult($sql);
$sql = "SELECT Books.*, Category.category_name as category_name from Books left join Category on Books.category_id = Category.category_id WHERE book_id = 2";
$pickedAuthorItem2 = executeResult($sql);
$sql = "SELECT Books.*, Category.category_name as category_name from Books left join Category on Books.category_id = Category.category_id WHERE book_id = 3";
$pickedAuthorItem3 = executeResult($sql);

?>
<!--************************************
					Best Selling Start
					*************************************-->
					<section class="tg-sectionspace tg-haslayout">
						<div class="container">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="tg-sectionhead">
										<h2><span>Lựa chọn của người dùng</span>Sách bán chạy</h2>
										<!-- <a class="tg-btn" href="books.php">View All</a> -->
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div id="tg-bestsellingbooksslider" class="tg-bestsellingbooksslider tg-bestsellingbooks owl-carousel">
										<!-- <div class="item">
											<div class="tg-postbook">
												<figure class="tg-featureimg">
													<div class="tg-bookimg">
														<div class="tg-frontcover"><img src="assets/images/books/img-01.jpg" alt="image description"></div>
														<div class="tg-backcover"><img src="assets/images/books/img-01.jpg" alt="image description"></div>
													</div>
												</figure>
												<div class="tg-postbookcontent">
													<ul class="tg-bookscategories">
														<li><a href="javascript:void(0);">Adventure</a></li>
														<li><a href="javascript:void(0);">Fun</a></li>
													</ul>
													<div class="tg-booktitle">
														<h3><a href="javascript:void(0);">Help Me Find My Stomach</a></h3>
													</div>
													<span class="tg-bookwriter">By: <a href="javascript:void(0);">Angela Gunning</a></span>
													<span class="tg-bookprice">
														<ins>$25.18</ins>
													</span>
													<a class="tg-btn tg-btnstyletwo" href="javascript:void(0);">
														<i class="fa fa-shopping-basket"></i>
														<em>Add To Basket</em>
													</a>
												</div>
											</div>
										</div> -->
										<?php
										$index = 0;
										foreach ($bestSellingItems as $item) {
											echo '
											<div class="item">
											<div class="tg-postbook">
											<figure class="tg-featureimg">
											<a href="detail.php?book_id='.$item['book_id'].'&book_name='.$item['book_name'].'"><div class="tg-bookimg">
											<div class="tg-frontcover"><img src="admin/assets/images/'.$item['img'].'" alt="image description"></div>
											<div class="tg-backcover"><img src="admin/assets/images/'.$item['img'].'" alt="image description"></div>
											</div></a>
											</figure>
											<div class="tg-postbookcontent">
											<ul class="tg-bookscategories">
											<li><a href="books.php?category_id='.$item['category_id'].'&category_name='.$item['category_name'].'">'.$item['category_name'].'</a></li>
											</ul>
											<div class="tg-booktitle">
											<h3><a href="detail.php?book_id='.$item['book_id'].'&book_name='.$item['book_name'].'" style = "padding-top: 0px !important;
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
											font-size: 1em;">'.$item['book_name'].'</a></h3>
											</div>
											<span class="tg-bookwriter">Tác giả: <a href="javascript:void(0);" style = "padding-top: 0px !important;
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
											font-size: 1em;">'.$item['author'].'</a></span>
											<span class="tg-bookprice">
											<ins>'.number_format($item['price'], 0, ',', '.').' đ</ins>
											</span>
											</div>
											</div>
											</div>
											';
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			<!--************************************
					Best Selling End
					*************************************-->

			<!--************************************
					Featured Item Start
					*************************************-->
					<!-- <section class="tg-bglight tg-haslayout">
						<div class="container">
							<div class="row">
								<div class="tg-featureditm">
									<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 hidden-sm hidden-xs">
										<figure><img src="assets/images/img-02.png" alt="image description"></figure>
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
						</div>
					</section> -->
			<!--************************************
					Featured Item End
					*************************************-->
			<!--************************************
					New Release Start
					*************************************-->
					<!-- <section class="tg-sectionspace tg-haslayout">
						<div class="container">
							<div class="row">
								<div class="tg-newrelease">
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
										<div class="tg-sectionhead">
											<h2><span>Taste The New Spice</span>New Release Books</h2>
										</div>
										<div class="tg-description">
											<p>Consectetur adipisicing elit sed do eiusmod tempor incididunt labore toloregna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamcoiars nisiuip commodo consequat aute irure dolor in aprehenderit aveli esseati cillum dolor fugiat nulla pariatur cepteur sint occaecat cupidatat.</p>
										</div>
										<div class="tg-btns">
											<a class="tg-btn tg-active" href="javascript:void(0);">View All</a>
											<a class="tg-btn" href="javascript:void(0);">Read More</a>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
										<div class="row">
											<div class="tg-newreleasebooks">
												<div class="col-xs-4 col-sm-4 col-md-6 col-lg-4">
													<div class="tg-postbook">
														<figure class="tg-featureimg">
															<div class="tg-bookimg">
																<div class="tg-frontcover"><img src="assets/images/books/img-07.jpg" alt="image description"></div>
																<div class="tg-backcover"><img src="assets/images/books/img-07.jpg" alt="image description"></div>
															</div>
															<a class="tg-btnaddtowishlist" href="javascript:void(0);">
																<i class="icon-heart"></i>
																<span>add to wishlist</span>
															</a>
														</figure>
														<div class="tg-postbookcontent">
															<ul class="tg-bookscategories">
																<li><a href="javascript:void(0);">Adventure</a></li>
																<li><a href="javascript:void(0);">Fun</a></li>
															</ul>
															<div class="tg-booktitle">
																<h3><a href="javascript:void(0);">Help Me Find My Stomach</a></h3>
															</div>
															<span class="tg-bookwriter">By: <a href="javascript:void(0);">Kathrine Culbertson</a></span>
															<span class="tg-stars"><span></span></span>
														</div>
													</div>
												</div>
												<div class="col-xs-4 col-sm-4 col-md-6 col-lg-4">
													<div class="tg-postbook">
														<figure class="tg-featureimg">
															<div class="tg-bookimg">
																<div class="tg-frontcover"><img src="assets/images/books/img-08.jpg" alt="image description"></div>
																<div class="tg-backcover"><img src="assets/images/books/img-08.jpg" alt="image description"></div>
															</div>
															<a class="tg-btnaddtowishlist" href="javascript:void(0);">
																<i class="icon-heart"></i>
																<span>add to wishlist</span>
															</a>
														</figure>
														<div class="tg-postbookcontent">
															<ul class="tg-bookscategories">
																<li><a href="javascript:void(0);">Adventure</a></li>
																<li><a href="javascript:void(0);">Fun</a></li>
															</ul>
															<div class="tg-booktitle">
																<h3><a href="javascript:void(0);">Drive Safely, No Bumping</a></h3>
															</div>
															<span class="tg-bookwriter">By: <a href="javascript:void(0);">Sunshine Orlando</a></span>
															<span class="tg-stars"><span></span></span>
														</div>
													</div>
												</div>
												<div class="col-xs-4 col-sm-4 col-md-3 col-lg-4 hidden-md">
													<div class="tg-postbook">
														<figure class="tg-featureimg">
															<div class="tg-bookimg">
																<div class="tg-frontcover"><img src="assets/images/books/img-09.jpg" alt="image description"></div>
																<div class="tg-backcover"><img src="assets/images/books/img-09.jpg" alt="image description"></div>
															</div>
															<a class="tg-btnaddtowishlist" href="javascript:void(0);">
																<i class="icon-heart"></i>
																<span>add to wishlist</span>
															</a>
														</figure>
														<div class="tg-postbookcontent">
															<ul class="tg-bookscategories">
																<li><a href="javascript:void(0);">Adventure</a></li>
																<li><a href="javascript:void(0);">Fun</a></li>
															</ul>
															<div class="tg-booktitle">
																<h3><a href="javascript:void(0);">Let The Good Times Roll Up</a></h3>
															</div>
															<span class="tg-bookwriter">By: <a href="javascript:void(0);">Elisabeth Ronning</a></span>
															<span class="tg-stars"><span></span></span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section> -->
			<!--************************************
					New Release End
					*************************************-->
			<!--************************************
					Collection Count Start
					*************************************-->
					<section class="tg-parallax tg-bgcollectioncount tg-haslayout" data-z-index="-100" data-appear-top-offset="600" data-parallax="scroll" data-image-src="assets/images/parallax/bgparallax-04.jpg">
						<div class="tg-sectionspace tg-collectioncount tg-haslayout">
							<div class="container">
								<div class="row">
									<div id="tg-collectioncounters" class="tg-collectioncounters">
										<div class="tg-collectioncounter tg-drama">
											<div class="tg-collectioncountericon">
												<i class="icon-bubble"></i>
											</div>
											<div class="tg-titlepluscounter">
												<h2>Drama</h2>
												<h3 data-from="0" data-to="6179213" data-speed="8000" data-refresh-interval="50">6,179,213</h3>
											</div>
										</div>
										<div class="tg-collectioncounter tg-horror">
											<div class="tg-collectioncountericon">
												<i class="icon-heart-pulse"></i>
											</div>
											<div class="tg-titlepluscounter">
												<h2>Horror</h2>
												<h3 data-from="0" data-to="3121242" data-speed="8000" data-refresh-interval="50">3,121,242</h3>
											</div>
										</div>
										<div class="tg-collectioncounter tg-romance">
											<div class="tg-collectioncountericon">
												<i class="icon-heart"></i>
											</div>
											<div class="tg-titlepluscounter">
												<h2>Romance</h2>
												<h3 data-from="0" data-to="2101012" data-speed="8000" data-refresh-interval="50">2,101,012</h3>
											</div>
										</div>
										<div class="tg-collectioncounter tg-fashion">
											<div class="tg-collectioncountericon">
												<i class="icon-star"></i>
											</div>
											<div class="tg-titlepluscounter">
												<h2>Fashion</h2>
												<h3 data-from="0" data-to="1158245" data-speed="8000" data-refresh-interval="50">1,158,245</h3>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
			<!--************************************
					Collection Count End
					*************************************-->
			<!--************************************
					Picked By Author Start
					*************************************-->
					<section class="tg-sectionspace tg-haslayout">
						<div class="container">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="tg-sectionhead">
										<h2><span>Một số Sách</span>Được Chọn Bởi Tác Giả</h2>
										<!-- <a class="tg-btn" href="javascript:void(0);">View All</a> -->
									</div>
								</div>
								<div id="tg-pickedbyauthorslider" class="tg-pickedbyauthor tg-pickedbyauthorslider owl-carousel">
									<div class="item">
										<div class="tg-postbook">
											<figure class="tg-featureimg">
												<div class="tg-bookimg">
													<div class="tg-frontcover"><img src="admin/assets/images/<?=$pickedAuthorItem1[0]['img']?>" alt="image description"></div>
												</div>
												<div class="tg-hovercontent">
													<div class="tg-description">
														<p><?= strlen($pickedAuthorItem1[0]['detail']) > 200 ? substr($pickedAuthorItem1[0]['detail'], 0, 200) . '...' : $pickedAuthorItem1[0]['detail'] ?></p>
													</div>
													<strong class="tg-bookpage">Số trang: <?=$pickedAuthorItem1[0]['num_pages']?></strong>
													<strong class="tg-bookcategory">Danh mục: <?=$pickedAuthorItem1[0]['category_name']?></strong>
													<strong class="tg-bookprice">Giá: <?= number_format($pickedAuthorItem1[0]['price'], 0, ',', '.') ?> đ</strong>
												</div>
											</figure>
											<div class="tg-postbookcontent">
												<div class="tg-booktitle">
													<h3><a href="detail.php?book_id=<?= $pickedAuthorItem1[0]['book_id']?>&book_name=<?= $pickedAuthorItem1[0]['book_name']?>"><?= $pickedAuthorItem1[0]['book_name']?></a></h3>
												</div>
												<span class="tg-bookwriter">Tác giả: <a href="javascript:void(0);"><?= $pickedAuthorItem1[0]['author']?></a></span>
												<a class="tg-btn tg-btnstyletwo add-cart" href="javascript:void(0);">
													<i class="fa fa-shopping-basket"></i>
													<em>Thêm Giỏ hàng</em>
												</a>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="tg-postbook">
											<figure class="tg-featureimg">
												<div class="tg-bookimg">
													<div class="tg-frontcover"><img src="admin/assets/images/<?=$pickedAuthorItem2[0]['img']?>" alt="image description"></div>
												</div>
												<div class="tg-hovercontent">
													<div class="tg-description">
														<p><?= strlen($pickedAuthorItem2[0]['detail']) > 200 ? substr($pickedAuthorItem2[0]['detail'], 0, 200) . '...' : $pickedAuthorItem2[0]['detail'] ?></p>
													</div>
													<strong class="tg-bookpage">Số trang: <?= $pickedAuthorItem2[0]['num_pages']?></strong>
													<strong class="tg-bookcategory">Danh mục: <?= $pickedAuthorItem2[0]['category_name']?></strong>
													<strong class="tg-bookprice">Giá: <?= number_format($pickedAuthorItem2[0]['price'], 0, ',', '.') ?> đ</strong>
												</div>
											</figure>
											<div class="tg-postbookcontent">
												<div class="tg-booktitle">
													<h3><a href="detail.php?book_id=<?= $pickedAuthorItem2[0]['book_id']?>&book_name=<?= $pickedAuthorItem2[0]['book_name']?>"><?= $pickedAuthorItem2[0]['book_name']?></a></h3>
												</div>
												<span class="tg-bookwriter">Tác giả: <a href="javascript:void(0);"><?= $pickedAuthorItem2[0]['author']?></a></span>
												<a class="tg-btn tg-btnstyletwo add-cart" href="javascript:void(0);">
													<i class="fa fa-shopping-basket"></i>
													<em>Thêm Giỏ hàng</em>
												</a>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="tg-postbook">
											<figure class="tg-featureimg">
												<div class="tg-bookimg">
													<div class="tg-frontcover"><img src="admin/assets/images/<?=$pickedAuthorItem3[0]['img']?>" alt="image description"></div>
												</div>
												<div class="tg-hovercontent">
													<div class="tg-description">
														<p><?= strlen($pickedAuthorItem3[0]['detail']) > 200 ? substr($pickedAuthorItem3[0]['detail'], 0, 200) . '...' : $pickedAuthorItem3[0]['detail'] ?></p>
													</div>
													<strong class="tg-bookpage">Số trang: <?= $pickedAuthorItem3[0]['num_pages']?></strong>
													<strong class="tg-bookcategory">Danh mục: <?= $pickedAuthorItem3[0]['category_name']?></strong>
													<strong class="tg-bookprice">Giá: <?= number_format($pickedAuthorItem3[0]['price'], 0, ',', '.') ?> đ</strong>
												</div>
											</figure>
											<div class="tg-postbookcontent">
												<div class="tg-booktitle">
													<h3><a href="detail.php?book_id=<?= $pickedAuthorItem3[0]['book_id']?>&book_name=<?= $pickedAuthorItem3[0]['book_name']?>"><?= $pickedAuthorItem3[0]['book_name']?></a></h3>
												</div>
												<span class="tg-bookwriter">Tác giả: <a href="javascript:void(0);"><?= $pickedAuthorItem3[0]['author']?></a></span>
												<a class="tg-btn tg-btnstyletwo add-cart" href="javascript:void(0);">
													<i class="fa fa-shopping-basket"></i>
													<em>Thêm Giỏ hàng</em>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
			<!--************************************
					Picked By Author End
					*************************************-->
			<!--************************************
					Testimonials Start
					*************************************-->
					<section class="tg-parallax tg-bgtestimonials tg-haslayout" data-z-index="-100" data-appear-top-offset="600" data-parallax="scroll" data-image-src="assets/images/parallax/bgparallax-05.jpg">
						<div class="tg-sectionspace tg-haslayout">
							<div class="container">
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-push-2">
										<div id="tg-testimonialsslider" class="tg-testimonialsslider tg-testimonials owl-carousel">
											<div class="item tg-testimonial">
												<figure><img src="assets/images/author/imag-02.jpg" alt="image description"></figure>
												<!-- <blockquote><q>Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore tolore magna aliqua enim ad minim veniam, quis nostrud exercitation ullamcoiars nisi ut aliquip commodo.</q></blockquote> -->
												<div class="tg-testimonialauthor">
													<h3>Holli Fenstermacher</h3>
													<span>Manager @ CIFP</span>
												</div>
											</div>
											<div class="item tg-testimonial">
												<figure><img src="assets/images/author/imag-02.jpg" alt="image description"></figure>
												<!-- <blockquote><q>Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore tolore magna aliqua enim ad minim veniam, quis nostrud exercitation ullamcoiars nisi ut aliquip commodo.</q></blockquote> -->
												<div class="tg-testimonialauthor">
													<h3>Holli Fenstermacher</h3>
													<span>Manager @ CIFP</span>
												</div>
											</div>
											<div class="item tg-testimonial">
												<figure><img src="assets/images/author/imag-02.jpg" alt="image description"></figure>
												<!-- <blockquote><q>Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore tolore magna aliqua enim ad minim veniam, quis nostrud exercitation ullamcoiars nisi ut aliquip commodo.</q></blockquote> -->
												<div class="tg-testimonialauthor">
													<h3>Holli Fenstermacher</h3>
													<span>Manager @ CIFP</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
			<!--************************************
					Testimonials End
					*************************************-->

			<!--************************************
					Call to Action Start
					*************************************-->
					<section class="tg-parallax tg-bgcalltoaction tg-haslayout" data-z-index="-100" data-appear-top-offset="600" data-parallax="scroll" data-image-src="assets/images/parallax/bgparallax-06.jpg">
						<div class="tg-sectionspace tg-haslayout">
							<div class="container">
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="tg-calltoaction">
											<h2>Mở giảm giá cho tất cả</h2>
											<!-- <h3>Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore.</h3> -->
											<a class="tg-btn tg-active" href="javascript:void(0);">Đọc thêm</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
			<!--************************************
					Call to Action End
					*************************************-->
			<!--************************************
					Latest News Start
					*************************************-->
					<!-- <section class="tg-sectionspace tg-haslayout">
						<div class="container">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="tg-sectionhead">
										<h2><span>Latest News &amp; Articles</span>What's Hot in The News</h2>
										<a class="tg-btn" href="javascript:void(0);">View All</a>
									</div>
								</div>
								<div id="tg-postslider" class="tg-postslider tg-blogpost owl-carousel">
									<article class="item tg-post">
										<figure><a href="javascript:void(0);"><img src="assets/images/blog/img-01.jpg" alt="image description"></a></figure>
										<div class="tg-postcontent">
											<ul class="tg-bookscategories">
												<li><a href="javascript:void(0);">Adventure</a></li>
												<li><a href="javascript:void(0);">Fun</a></li>
											</ul>
											<div class="tg-themetagbox"><span class="tg-themetag">featured</span></div>
											<div class="tg-posttitle">
												<h3><a href="javascript:void(0);">Where The Wild Things Are</a></h3>
											</div>
											<span class="tg-bookwriter">By: <a href="javascript:void(0);">Kathrine Culbertson</a></span>
											<ul class="tg-postmetadata">
												<li><a href="javascript:void(0);"><i class="fa fa-comment-o"></i><i>21,415 Comments</i></a></li>
												<li><a href="javascript:void(0);"><i class="fa fa-eye"></i><i>24,565 Views</i></a></li>
											</ul>
										</div>
									</article>
									<article class="item tg-post">
										<figure><a href="javascript:void(0);"><img src="assets/images/blog/img-02.jpg" alt="image description"></a></figure>
										<div class="tg-postcontent">
											<ul class="tg-bookscategories">
												<li><a href="javascript:void(0);">Adventure</a></li>
												<li><a href="javascript:void(0);">Fun</a></li>
											</ul>
											<div class="tg-themetagbox"><span class="tg-themetag">featured</span></div>
											<div class="tg-posttitle">
												<h3><a href="javascript:void(0);">All She Wants To Do Is Dance</a></h3>
											</div>
											<span class="tg-bookwriter">By: <a href="javascript:void(0);">Kathrine Culbertson</a></span>
											<ul class="tg-postmetadata">
												<li><a href="javascript:void(0);"><i class="fa fa-comment-o"></i><i>21,415 Comments</i></a></li>
												<li><a href="javascript:void(0);"><i class="fa fa-eye"></i><i>24,565 Views</i></a></li>
											</ul>
										</div>
									</article>
									<article class="item tg-post">
										<figure><a href="javascript:void(0);"><img src="assets/images/blog/img-03.jpg" alt="image description"></a></figure>
										<div class="tg-postcontent">
											<ul class="tg-bookscategories">
												<li><a href="javascript:void(0);">Adventure</a></li>
												<li><a href="javascript:void(0);">Fun</a></li>
											</ul>
											<div class="tg-themetagbox"><span class="tg-themetag">featured</span></div>
											<div class="tg-posttitle">
												<h3><a href="javascript:void(0);">Why Walk When You Can Climb?</a></h3>
											</div>
											<span class="tg-bookwriter">By: <a href="javascript:void(0);">Kathrine Culbertson</a></span>
											<ul class="tg-postmetadata">
												<li><a href="javascript:void(0);"><i class="fa fa-comment-o"></i><i>21,415 Comments</i></a></li>
												<li><a href="javascript:void(0);"><i class="fa fa-eye"></i><i>24,565 Views</i></a></li>
											</ul>
										</div>
									</article>
									<article class="item tg-post">
										<figure><a href="javascript:void(0);"><img src="assets/images/blog/img-04.jpg" alt="image description"></a></figure>
										<div class="tg-postcontent">
											<ul class="tg-bookscategories">
												<li><a href="javascript:void(0);">Adventure</a></li>
												<li><a href="javascript:void(0);">Fun</a></li>
											</ul>
											<div class="tg-themetagbox"><span class="tg-themetag">featured</span></div>
											<div class="tg-posttitle">
												<h3><a href="javascript:void(0);">Dance Like Nobody’s Watching</a></h3>
											</div>
											<span class="tg-bookwriter">By: <a href="javascript:void(0);">Kathrine Culbertson</a></span>
											<ul class="tg-postmetadata">
												<li><a href="javascript:void(0);"><i class="fa fa-comment-o"></i><i>21,415 Comments</i></a></li>
												<li><a href="javascript:void(0);"><i class="fa fa-eye"></i><i>24,565 Views</i></a></li>
											</ul>
										</div>
									</article>
									<article class="item tg-post">
										<figure><a href="javascript:void(0);"><img src="assets/images/blog/img-02.jpg" alt="image description"></a></figure>
										<div class="tg-postcontent">
											<ul class="tg-bookscategories">
												<li><a href="javascript:void(0);">Adventure</a></li>
												<li><a href="javascript:void(0);">Fun</a></li>
											</ul>
											<div class="tg-themetagbox"><span class="tg-themetag">featured</span></div>
											<div class="tg-posttitle">
												<h3><a href="javascript:void(0);">All She Wants To Do Is Dance</a></h3>
											</div>
											<span class="tg-bookwriter">By: <a href="javascript:void(0);">Kathrine Culbertson</a></span>
											<ul class="tg-postmetadata">
												<li><a href="javascript:void(0);"><i class="fa fa-comment-o"></i><i>21,415 Comments</i></a></li>
												<li><a href="javascript:void(0);"><i class="fa fa-eye"></i><i>24,565 Views</i></a></li>
											</ul>
										</div>
									</article>
									<article class="item tg-post">
										<figure><a href="javascript:void(0);"><img src="assets/images/blog/img-03.jpg" alt="image description"></a></figure>
										<div class="tg-postcontent">
											<ul class="tg-bookscategories">
												<li><a href="javascript:void(0);">Adventure</a></li>
												<li><a href="javascript:void(0);">Fun</a></li>
											</ul>
											<div class="tg-themetagbox"><span class="tg-themetag">featured</span></div>
											<div class="tg-posttitle">
												<h3><a href="javascript:void(0);">Why Walk When You Can Climb?</a></h3>
											</div>
											<span class="tg-bookwriter">By: <a href="javascript:void(0);">Kathrine Culbertson</a></span>
											<ul class="tg-postmetadata">
												<li><a href="javascript:void(0);"><i class="fa fa-comment-o"></i><i>21,415 Comments</i></a></li>
												<li><a href="javascript:void(0);"><i class="fa fa-eye"></i><i>24,565 Views</i></a></li>
											</ul>
										</div>
									</article>
								</div>
							</div>
						</div>
					</section> -->
			<!--************************************
					Latest News End
					*************************************-->
				</main>
		<!--************************************
				Main End
				*************************************-->
				<?php
				require_once('layouts/footer.php');
			?>