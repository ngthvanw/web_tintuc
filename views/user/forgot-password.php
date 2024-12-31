<?php 
if (!isset($_SESSION['user']) || !isset($_COOKIE['remember_token'])) {
	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Lấy lại mật khẩu</title>
		<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
		<div style="width: 500px;margin: auto">
			<h1>Nhập email để lấy lại mật khẩu</h1>
	<form action="<?php echo getUrl('forgot-submit') ?>" method="post">
		<div class="form-group">
		<input type="text" name="email" value="" placeholder="Your email" class="form-control"></div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
		</div>
</body>
</html>
<?php

}
else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="<?=getUrl('public/css/bootstrap/css/bootstrap.min.css') ?>">
	<title>You don't have permission to access</title>
</head>
<body>
	<div class="alert alert-danger">You must logout to forgot your password.</div>

</body>
</html>
	<?php 
}
	 ?>
