<?php
require_once 'php/autoload.php';
session_start();
if (!isset($_SESSION['user']->id)) header('location: ./');

?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="favicon.png" />
	<title>Checkout</title>
	<link rel="stylesheet" href="css/general.css" />
	<link rel="stylesheet" href="css/checkout.css">
	<link rel="stylesheet" href="css/header.css" />
	<link rel="stylesheet" href="css/form.css" />

	<script src="js/jquery/jquery-3.3.1.min.js"></script>
	<script src="js/cart.js"></script>
	<script>
		$(function() {
			var currentTab = 'cart-checkout';

			$('.nav-button').click(function() {
				nextTab = $(this).attr('val');

				if ($(this).attr('multiNav') == '1')
					nextTab += '-' + $('input[name="payment_cb"]:checked').attr('value');

				$('#' + currentTab).slideUp('medium', function() {
					$('#' + nextTab).slideDown('medium');
				});

				currentTab = nextTab;
			});
		});
	</script>
</head>

<body style="background-image: url('img/checkout-form-background.jpg');">

	<div id="main-container">
		<div class="form-container">
			<div class="form-header">
				<img src="img/payment.png" alt="image error" />
				<h2>Thanh Toán</h2>
			</div>
			<div id="cart-checkout">
				<h1>Danh Sách Sản Phẩm</h1>

				<div id="cart-items-container"></div>
				<div id="cart-pay-section"></div>
				<button val="payment-method" class="nav-button styled-btn sb-green">Tiếp Tục</button>
			</div>

			<div id="payment-method" style="display: none;">
				<h1>Phương Thức Thanh Toán</h1>

				<div class="payment-method-tab">
					<div class="payment-method-tab-check">
						<input type="radio" name="payment_cb" value="CC" checked>
						<img src="img/credit-card.png">
						<h2>Credit Cart</h2>
					</div>
					<p>Thanh toán bằng thẻ tín dụng của bạn như thẻ Visa hoặc thẻ Master</p>
				</div>
				<div class="payment-method-tab">
					<div class="payment-method-tab-check">
						<input type="radio" name="payment_cb" value="CCP">
						<img src="img/paypal-card.png">
						<h2>PayPal</h2>
					</div>
					<p>Thanh toán bằng tài khoản PayPal của bạn</p>
				</div>
				<div class="payment-method-tab" style="border: 0;">
					<div class="payment-method-tab-check">
						<input type="radio" name="payment_cb" value="LIV">
						<img src="img/shipping.png">
						<h2>Payment on delivery</h2>
					</div>
					<p>Thanh toán tận tay với đại lý của chúng tôi khi giao hàng</p>
				</div>

				<div class="double-button-container">
					<button val="cart-checkout" class="nav-button styled-btn sb-red">Quay Lại</button>
					<button val="payment-method" multiNav="1" class="nav-button styled-btn sb-green">Tiếp Tục</button>
				</div>
			</div>

			<!-- Payment methods -->
			<div id="payment-method-CC" style="display: none;">
				<form class="payment-method-form" action="php/actions/checkout.php" method="post">
					<span>Số thẻ</span>
					<input type="text" placeholder="XXXXXXXXX" minlength="5" maxlength="10">

					<span>Ngày hết hạn</span>
					<input type="text" placeholder="MM/YY" pattern="[0-9]{1,2}/[0-9]{1,2}">

					<span>CVC code</span>
					<input type="text" placeholder="XXXX" size="4" minlength="4" maxlength="4">

					<span>Địa chỉ giao hàng</span>
					<input name="shipping_address" value="<?= $_SESSION['user']->address ?>" type="text" minlength="5" required>

					<div class="double-button-container">
						<button type="button" val="payment-method" class="nav-button styled-btn sb-red">Back</button>
						<button type="submit" name="payment_method" value="credit_card" class="styled-btn sb-green">Continue</button>
					</div>
					<div class="notice-div">
					Thanh toán được xử lý ở đây.<br><br>
					Đây chỉ là một trang web demo, không nhập bất kỳ dữ liệu thực nào, thanh toán sẽ thành công bất kể đầu vào là gì<br><br>
					Trang web này được thực hiện bởi<br> <a href="https://docs.google.com/spreadsheets/d/1njA3pUGM0PVztu31k4G-tT8a6qvcYxes/edit#gid=1939067692" target="_blank">Nhóm 5</a>
					</div>
				</form>
			</div>
			<div id="payment-method-CCP" style="display: none;">
				<form class="payment-method-form" action="php/actions/checkout.php" method="post">
					<span>Thanh toán PayPal được xử lý tại đây ...</span><br>
					<span>Địa chỉ giao hàng</span>
					<input name="shipping_address" type="text" value="<?= $_SESSION['user']->address ?>" minlength="5" required>

					<div class="double-button-container">
						<button type="button" val="payment-method" class="nav-button styled-btn sb-red">Back</button>
						<button type="submit" name="payment_method" value="paypal" class="styled-btn sb-green">Continue</button>
					</div>

					<div class="notice-div">
					Thanh toán được xử lý ở đây.<br><br>
					Đây chỉ là một trang web demo, không nhập bất kỳ dữ liệu thực nào, thanh toán sẽ thành công bất kể đầu vào là gì<br><br>
					Trang web này được thực hiện bởi<br> <a href="https://docs.google.com/spreadsheets/d/1njA3pUGM0PVztu31k4G-tT8a6qvcYxes/edit#gid=1939067692" target="_blank">Nhóm 5</a>
					</div>
				</form>
			</div>
			<div id="payment-method-LIV" style="display: none;">
				<form class="payment-method-form" action="php/actions/checkout.php" method="post">
					<span>Địa chỉ giao hàng</span>
					<input name="shipping_address" type="text" value="<?= $_SESSION['user']->address ?>" minlength="5" required>

					<div class="double-button-container">
						<button type="button" val="payment-method" class="nav-button styled-btn sb-red">Back</button>
						<button type="submit" name="payment_method" value="on_delivery" class="styled-btn sb-green">Continue</button>
					</div>

					<div class="notice-div">
					Thanh toán được xử lý ở đây.<br><br>
					Đây chỉ là một trang web demo, không nhập bất kỳ dữ liệu thực nào, thanh toán sẽ thành công bất kể đầu vào là gì<br><br>
					Trang web này được thực hiện bởi<br> <a href="https://docs.google.com/spreadsheets/d/1njA3pUGM0PVztu31k4G-tT8a6qvcYxes/edit#gid=1939067692" target="_blank">Nhóm 5</a>
					</div>
				</form>
			</div>

			<div id="payment-end" style="display: none;">
				<h2>Thực hiện thanh toán Thành công! </h2>
				<br>
				<a href="index.php"><button style="width: 100%" class="nav-button styled-btn">Back au store</button></a>
			</div>
			<span id="switch_span"><a href="index.php">Quay Lại Trang Chủ</a></span>
		</div>
	</div>

	<footer></footer>
</body>

</html>
