<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<title>Đổi mật khẩu</title>
</head>
<body>
	<div style="width: 500px;margin: auto">
	Điền vào các trường sau để lấy lại mật khẩu.
	<br>
	<b><?php echo isset($_GET['msg'])==true?$_GET['msg']:null; ?></b>
	<form action="<?php echo getUrl('change-password') ?>" method="post">
		<input type="hidden" value="<?php echo $token ?>" name="token">
		<div class="form-group">
		<input type="password" name="password" placeholder="Your new password" class="form-control">
		</div>
		<div class="form-group">
		<input type="password" name="repassword" placeholder="Enter your new password again" class="form-control"></div>
		<button type="submit" class="btn btn-primary">Change password</button>
	</form>
	</div>
</body>
</html>