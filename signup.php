<?php
require_once 'php/autoload.php';
session_start();
if (isset($_SESSION['user']->id)) header('location: ./');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="favicon.png" />
	<title>Sign Up</title>
	<link rel="stylesheet" href="css/general.css" />
	<link rel="stylesheet" href="css/form.css" />

	<script src="js/validate_password.js"></script>
</head>

<body style="background-image: url('img/signup-form-background.jpg');">
	<!-- Header -->
	<?php include('common/header.php') ?>

	<div id="main-container">
		<div class="form-container signup-form-container">
			<div class="form-header">
				<img src="img/new-account.png" alt="image error" />
				<h2>Đăng Ký</h2>
			</div>

			<form name="signup" method="POST" action="php/actions/signup.php">
				<div id="sections-container">
					<div class="section">
						<h3>Bắt Buộc:</h3>
						<input name="first_name" type="text" minlength="2" maxlength="155" placeholder="Tên" required />
						<input name="last_name" type="text" minlength="2" maxlength="155" placeholder="Họ" required />
						<input name="email" type="email" maxlength="155" placeholder="Email" required />
						<input name="password" type="password" minlength="4" maxlength="155" placeholder="Mật Khẩu" required />
						<input name="password_conf" type="password" placeholder="Xác Nhận Mật Khẩu" required />
					</div>
					<div class="splitter"></div>
					<div class="section">
						<h3>Không Bắt Buộc:</h3>
						<input name="address" type="text" maxlength="155" placeholder="Địa Chỉ" />
						<input name="phone_number" type="text" maxlength="155" placeholder="Số Điện Thoại" />
						<br /><span>Ngày Sinh</span>
						<input name="birth_date" type="date" min="1930-01-01" max="2023-01-01" />
					</div>
				</div>
				<button type="submit" onclick="validatePassword();">
					<img src="img/create.png" alt="image error" />
					<span>Đăng Ký</span>
				</button>
			</form>
			<span id="switch_span">Bạn đã có tài khoản? <a href="login.php">Đăng nhập tại đây</a></span>
		</div>
	</div>

	<!-- feedback notification -->
	<?php if (isset($_GET['fn'])) : ?>
		<div id="feedback_notification" class="fn-<?= $_GET['fn'] ?>">
			<span><?= $_GET['fn_message'] ?></span>
			<button id="fn-close">X</button>
		</div>
		<script>
			document
				.getElementById('fn-close')
				.addEventListener('click', () => document
					.getElementById('feedback_notification').remove()
				)
		</script>
	<?php endif ?>
</body>

</html>
