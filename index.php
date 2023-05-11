<?php
require_once  'php/autoload.php';

use App\Article;

$Articles = Article::make();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="favicon.png" />
	<title>RTECH For Tech Materials</title>

	<link rel="stylesheet" href="css/general.css" />
	<link rel="stylesheet" href="css/aside.css">
	<link rel="stylesheet" href="css/footer.css">
	<link rel="stylesheet" href="css/index.css" />

	<script src="js/index.js"></script>
	<script defer src="js/big_slideshow.js"></script>
</head>

<body>
	<!-- Header -->
	<?php include('common/header.php') ?>

	<main>
		<!-- slide show -->
		<div class="big-slideshow-container">
			<div class="big-slideshow-slides-container" data-current-slide="0">
				<!-- Slide 1 -->
				<div class="big-slideshow-slide bs-reverse">
					<div class="bs-content-left">
						<h2>MacBook Pro Thế Hệ Mới</h2>
						<p>Nhanh hơn, Bền Bỉ Hơn</p>
						<a href="article?article_id=55" class="styled-btn">Đặt hàng</a>
					</div>
					<div class="bs-content-right">
						<img src="img/slideshow/1/image.png">
					</div>
					<img class="big-slideshow-bg-img img-blur" src="img/slideshow/1/bg.jpg" loading="lazy">
				</div>
				<!-- Slide 2 -->
				<div class="big-slideshow-slide">
					<div class="bs-content-left" style="color: #fff">
						<h2>Razer Kraken Gaming</h2>
						<p>Tai nghe dành cho chuyên gia thể thao điện tử</p>
						<a href="article?article_id=56" class="styled-btn">Đặt hàng</a>
					</div>
					<div class="bs-content-right">
						<img src="img/slideshow/2/image.png">
					</div>
					<img class="big-slideshow-bg-img img-blur" src="img/slideshow/2/bg.jpg" loading="lazy">
				</div>
				<!-- Slide 3 -->
				<div class="big-slideshow-slide">
					<div class="bs-content-left">
						<h2>Nintendo Switch</h2>
						<p>Các trò chơi bạn muốn, mọi lúc mọi nơi</p>
						<a href="article?article_id=57" class="styled-btn">Đặt hàng</a>
					</div>
					<div class="bs-content-right">
						<img src="img/slideshow/3/image.png">
					</div>
					<img class="big-slideshow-bg-img img-blur" src="img/slideshow/3/bg.jpg" loading="lazy">
				</div>
				<!-- Slide 4 -->
				<div class="big-slideshow-slide" style="justify-content: start;">
					<div class="bs-content-left" style="color: #fff">
						<h2>Razer BlackWidow</h2>
						<p>bàn phím chơi game cơ mang tính biểu tượng</p>
						<a href="article?article_id=58" class="styled-btn">Đặt hàng</a>
					</div>
					<img class="big-slideshow-bg-img" src="img/slideshow/4/image.jpg" loading="lazy">
				</div>
			</div>
			<div class="big-slideshow-buttons-container">
				<button data-slide="1" style="background-color: var(--color-2)"></button>
				<button data-slide="2"></button>
				<button data-slide="3"></button>
				<button data-slide="4"></button>
			</div>
			<button class="big-slideshow-previous-slide" onclick="swipeSlideBS(event,-1)">❮</button>
			<button class="big-slideshow-next-slide" onclick="swipeSlideBS(event,1)">❯</button>
		</div>

		<div id="main-container">
			<aside>
				<?php include 'common/aside.php' ?>
			</aside>
			<div id="main-content">
				<!-- trending/discount/new -->
				<section class="main">
					<div class="section-header">
						<button class="change-btn" id="change-btn-active" data="trending" onclick="changeFrom(event)" disabled>
							Xu Hướng
						</button>
						<button class="change-btn" data="on-discount" onclick="changeFrom(event)">
							Khuyến Mãi
						</button>
						<button class="change-btn" data="new" onclick="changeFrom(event)">
							Sản Phẩm Mới
						</button>
					</div>

					<div id="trending" class="fadein-article-container" style="display: block;">
						<?php
						$articles = $Articles->getArticles();

						foreach ($articles as $article) { ?>
							<div class="article">
								<a href="article?article_id=<?= $article['article_id'] ?>">

									<?php if ($article['discount']) { ?>
										<span class="discount-span">-<?= $article['discount'] ?>%</span>
									<?php } elseif ($article['new']) { ?>
										<span class="new-span">NEW</span>
									<?php } ?>

									<img src="<?= $article['thumbnail_src'] ?>" />

									<div class="article-brand">
										<img src="<?= $article['brand_src'] ?>" loading="lazy" />
										<span><?= $article['brand'] ?></span>
									</div>

									<span class="article-title">
										<?= $article['article_name'] ?>
									</span>

									<?php if (!$article['discount']) { ?>
										<span class="article-price"><?= $article['price'] ?> VND</span>
									<?php } else { ?>
										<span class="article-price"><?= $article['new_price'] ?> VND
											<span class="article-old-price"><?= $article['price'] ?> VND</span>
										</span>
									<?php } ?>

									<div class="rating-container">
										<span class="back-stars">☆☆☆☆☆</span>
										<span class="front-stars" <?= 'style="width:' . $article['rating_percentage'] . '%"' ?>>★★★★★</span>
									</div>
								</a>
								<?php if ($article['stock']) { ?>
									<button article_id="<?= $article['article_id'] ?>" class="article-add-to-cart-btn">
										<span>Add to cart</span>
										<img src="img/shopping-cart.png" />
									</button>
								<?php } ?>
							</div>
						<?php } ?>
					</div>

					<div id="on-discount" class="fadein-article-container">
						<?php
						$articles = $Articles->getArticles('articlesOnDiscount');

						foreach ($articles as $article) { ?>
							<div class="article">
								<a href="article?article_id=<?= $article['article_id'] ?>">

									<?php if ($article['discount']) { ?>
										<span class="discount-span">-<?= $article['discount'] ?>%</span>
									<?php } elseif ($article['new']) { ?>
										<span class="new-span">NEW</span>
									<?php } ?>

									<img src="<?= $article['thumbnail_src'] ?>" />

									<div class="article-brand">
										<img src="<?= $article['brand_src'] ?>" loading="lazy" />
										<span><?= $article['brand'] ?></span>
									</div>

									<span class="article-title">
										<?= $article['article_name'] ?>
									</span>

									<?php if (!$article['discount']) { ?>
										<span class="article-price"><?= $article['price'] ?> VND</span>
									<?php } else { ?>
										<span class="article-price"><?= $article['new_price'] ?> VND
											<span class="article-old-price"><?= $article['price'] ?> VND</span>
										</span>
									<?php } ?>

									<div class="rating-container">
										<span class="back-stars">☆☆☆☆☆</span>
										<span class="front-stars" <?= 'style="width:' . $article['rating_percentage'] . '%"' ?>>★★★★★</span>
									</div>
								</a>
								<?php if ($article['stock']) { ?>
									<button article_id="<?= $article['article_id'] ?>" class="article-add-to-cart-btn">
										<span>Add to cart</span>
										<img src="img/shopping-cart.png" />
									</button>
								<?php } ?>
							</div>
						<?php } ?>
					</div>

					<div id="new" class="fadein-article-container">
						<?php
						$articles = $Articles->getArticles('articlesNew');

						foreach ($articles as $article) { ?>
							<div class="article">
								<a href="article?article_id=<?= $article['article_id'] ?>">

									<?php if ($article['discount']) { ?>
										<span class="discount-span">-<?= $article['discount'] ?>%</span>
									<?php } elseif ($article['new']) { ?>
										<span class="new-span">NEW</span>
									<?php } ?>

									<img src="<?= $article['thumbnail_src'] ?>" loading="lazy" />

									<div class="article-brand">
										<img src="<?= $article['brand_src'] ?>" />
										<span><?= $article['brand'] ?></span>
									</div>

									<span class="article-title">
										<?= $article['article_name'] ?>
									</span>

									<?php if (!$article['discount']) { ?>
										<span class="article-price"><?= $article['price'] ?> VND</span>
									<?php } else { ?>
										<span class="article-price"><?= $article['new_price'] ?> VND
											<span class="article-old-price"><?= $article['price'] ?> VND</span>
										</span>
									<?php } ?>

									<div class="rating-container">
										<span class="back-stars">☆☆☆☆☆</span>
										<span class="front-stars" <?= 'style="width:' . $article['rating_percentage'] . '%"' ?>>★★★★★</span>
									</div>
								</a>
								<?php if ($article['stock']) { ?>
									<button article_id="<?= $article['article_id'] ?>" class="article-add-to-cart-btn">
										<span>Add to cart</span>
										<img src="img/shopping-cart.png" />
									</button>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				</section>
				<!-- airpods special offer -->
				<section id="airpods-special-offer" class="special-offer">
					<div class="special-offer-text">
						<h2>Dell Inspiron</h2>
						<p>
						Mượt mà trong mọi thao tác
						</p>
						<a href="article?article_id=1" class="styled-btn">
							Đặt hàng Ngay
						</a>
					</div>
					<div class="special-offer-img">
						<img src="img/special_offers/dell-best-laptop-2018-hd-png.png" loading="lazy" alt="">
					</div>
				</section>
				<!-- intel possessors -->
				<section>
					<div class="section-header">
						<h1 class="specific-section-header">
						Bộ xử lý intel tốt nhất trong năm
						</h1>
					</div>
					<div>
						<?php
						$articles = $Articles->getArticles('articlesByBrandName', ['brand' => 'intel'], 4);

						foreach ($articles as $article) { ?>
							<div class="article">
								<a href="article?article_id=<?= $article['article_id'] ?>">

									<?php if ($article['discount']) { ?>
										<span class="discount-span">-<?= $article['discount'] ?>%</span>
									<?php } elseif ($article['new']) { ?>
										<span class="new-span">NEW</span>
									<?php } ?>

									<img src="<?= $article['thumbnail_src'] ?>" loading="lazy" />

									<div class="article-brand">
										<img src="<?= $article['brand_src'] ?>" />
										<span><?= $article['brand'] ?></span>
									</div>

									<span class="article-title">
										<?= $article['article_name'] ?>
									</span>

									<?php if (!$article['discount']) { ?>
										<span class="article-price"><?= $article['price'] ?> VND</span>
									<?php } else { ?>
										<span class="article-price"><?= $article['new_price'] ?> VND
											<span class="article-old-price"><?= $article['price'] ?> VND</span>
										</span>
									<?php } ?>

									<div class="rating-container">
										<span class="back-stars">☆☆☆☆☆</span>
										<span class="front-stars" <?= 'style="width:' . $article['rating_percentage'] . '%"' ?>>★★★★★</span>
									</div>
								</a>
								<?php if ($article['stock']) { ?>
									<button article_id="<?= $article['article_id'] ?>" class="article-add-to-cart-btn">
										<span>Add to cart</span>
										<img src="img/shopping-cart.png" />
									</button>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				</section>
				<!-- top rated -->
				<section>
					<div class="section-header">
						<h1 class="specific-section-header">
						Xếp hạng hàng đầu
						</h1>
					</div>
					<div>
						<?php
						$articles = $Articles->getArticles('articles', [], 4, 'rating_percentage');

						foreach ($articles as $article) { ?>
							<div class="article">
								<a href="article?article_id=<?= $article['article_id'] ?>">

									<?php if ($article['discount']) { ?>
										<span class="discount-span">-<?= $article['discount'] ?>%</span>
									<?php } elseif ($article['new']) { ?>
										<span class="new-span">NEW</span>
									<?php } ?>

									<img src="<?= $article['thumbnail_src'] ?>" />

									<div class="article-brand">
										<img src="<?= $article['brand_src'] ?>" loading="lazy" />
										<span><?= $article['brand'] ?></span>
									</div>

									<span class="article-title">
										<?= $article['article_name'] ?>
									</span>

									<?php if (!$article['discount']) { ?>
										<span class="article-price"><?= $article['price'] ?> VND</span>
									<?php } else { ?>
										<span class="article-price"><?= $article['new_price'] ?> VND
											<span class="article-old-price"><?= $article['price'] ?> VND</span>
										</span>
									<?php } ?>

									<div class="rating-container">
										<span class="back-stars">☆☆☆☆☆</span>
										<span class="front-stars" <?= 'style="width:' . $article['rating_percentage'] . '%"' ?>>★★★★★</span>
									</div>
								</a>
								<?php if ($article['stock']) { ?>
									<button article_id="<?= $article['article_id'] ?>" class="article-add-to-cart-btn">
										<span>Add to cart</span>
										<img src="img/shopping-cart.png" />
									</button>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				</section>
				<!-- galaxy s9 special offer -->
				<section id="s9-special-offer" class="special-offer">
					<div class="special-offer-img">
						<img src="img/special_offers/s9_special_offer.png" loading="lazy" alt="">
					</div>
					<div class="special-offer-text">
						<h2>Galaxy S9</h2>
						<p>
							With a camera that works like your eye.
						</p>
						<a href="article?article_id=51" class="styled-btn">
						Đặt hàng Ngay
						</a>
					</div>
				</section>
			</div>
		</div>
	</main>

	<!-- Footer -->
	<?php include('common/footer.php') ?>
</body>

</html>
