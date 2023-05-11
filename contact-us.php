<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="favicon.png" />
	<title>Contact Us</title>
	<link rel="stylesheet" href="css/general.css" />
	<link rel="stylesheet" href="css/form.css" />
</head>

<body style="background-image: url('img/contact-us-form-background.jpg');">
	<!-- Header -->
	<?php include('common/header.php') ?>

	<div id="main-container">
		<div class="form-container contact-us-form-container">
			<div class="form-header">
				<img src="img/contact-us.png" alt="image error" />
				<h2>Liên Hệ Với Chúng Tôi</h2>
			</div>

			<form action="index.php">
				<div id="sections-container">
					<div class="section">

						<?php
						if (isset($_SESSION['user']->id)) {
							require 'php/dataBase.php';
							$result = $sql->query("SELECT `first_name`, `last_name`, `email`, `phone_number` FROM `user` WHERE `user_id` =" . $_SESSION['user']->id) or die($sql->error);

							$data = mysqli_fetch_row($result);
							echo
								'
                <input name="nom_complet" value="' . $data[0] . ' ' . $data[1] . '" type="text" placeholder="Họ và Tên" disabled />
                <input name="email" value="' . $data[2] . '" type="email" placeholder="Email" disabled />
                ';
							if ($data[3] != '')
								echo '<input name="phone_number" value="' . $data[3] . '" type="text" placeholder="Số Điện Thoại" disabled />';
							else
								echo '<input name="phone_number" type="text" placeholder="Số Điện Thoại" />';
						} else echo
							'
              <input name="nom_complet" type="text" placeholder="Complete Name" required />
              <input name="email" type="email" placeholder="Email" required />
              <input name="phone_number" type="text" placeholder="Số Điện Thoại" />
              ';
						?>

						<input type="text" placeholder="Chủ đề (ví dụ: Vận chuyển)" required />
					</div>
					<div class="splitter"></div>
					<div class="section">
						<p>
						Trường bên dưới là phương tiện để bạn thông báo cho chúng tôi về mối quan tâm. <br /><br />
						Về vấn đề này, chúng tôi sẽ cố gắng cung cấp cho bạn câu trả lời trong vòng tối đa 48 giờ.<br /><br />
						Chúng tôi cũng sẽ mời bạn truy cập phần trợ giúp của chúng tôi để bạn không bỏ lỡ bất kỳ mối quan tâm nào.
						</p>
					</div>
				</div>
				<textarea name="message" rows="8" cols="80" form="contactform" placeholder="Vấn đề ..." required></textarea>
				<button type="submit">
					<img src="img/send.png" alt="image error" />
					<span>Gửi</span>
				</button>
			</form>
		</div>
	</div>

	<footer></footer>
</body>

</html>
