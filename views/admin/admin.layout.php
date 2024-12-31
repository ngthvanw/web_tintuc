<?php 
if (!isset($_SESSION['user']) && !isset($_COOKIE['remember_token'])) {
	?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="<?=getUrl('public/css/bootstrap/css/bootstrap.min.css') ?>">
	<title>You don't have permission to access</title>
</head>
<body>
	<div class="alert alert-danger">You don't have permission to access. Click to <a href="<?=getUrl('admin/login') ?>">LOGIN</a> or click to <a href="<?=getUrl('admin/login') ?>">REGISTER</a></div>
	<?php 

	 ?>
</body>
</html>
<?php
}else{

if (!isset($_SESSION['user'])) {
	$usermodel = new \models\User();
	$user = $usermodel->where(['remember_token', $_COOKIE['remember_token']])->first();
	$_SESSION['user'] = json_encode($user);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <title>Dashboard</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?=getUrl('public/css/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?=getUrl('public/fonts/font-awesome-4.7.0/css/font-awesome.css') ?>">
    <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
   	<script src="<?=getUrl('public/js/jquery.js') ?>"></script>
	<script src="<?=getUrl('public/css/bootstrap/js/bootstrap.min.js') ?>"></script>
</head>
<style>
	*{
		transition: all .2s;
	}
	a:hover{
		text-decoration: none;
	}
	body{
		font-size: 16px;
		font-family: 'Cabin', sans-serif;
		max-width: 100%;
		overflow-x: hidden;
	}
	.avatar{
		border-radius: 50%;
		width: 50px;
		height: 50px;
		margin-right: 15px;
	}
	header{
	    background: #1e88e5;
	    box-shadow: 5px 0px 10px rgba(0, 0, 0, 0.5);
	    height: 70px;
	    line-height: 70px;
	    color: #FFF;
	    font-weight: bold;
	    padding-right: 30px;
	    position: fixed;
	    z-index: 99;
	    width: 100%;
	}
	header a{
		color: #333
	}
	.header__logo{
		background: #1c81d9;
		text-align: center;
	}
	.header__logo a{
		color: #FFF;
	}
	.float-right{
		float: right;
	}
	.sidebar{
		height: 100%;
		box-shadow: 1px 0px 20px rgba(0, 0, 0, 0.08);
		padding: 0;
		position: fixed;
		z-index: 999;
		background: #FFF;
		margin-top: 70px
	}
	.breadcumb{
		height: 85px;
		box-shadow: 5px 0px 5px rgba(187, 180, 180, 0.5);
		background: #FFF;
		margin-bottom: 30px;
		margin-top: 70px;
	}
	.breadcumb h3{
		color: #009efb;
		margin-bottom: 0
	}
	.content{
		padding: 0;
		background: #eef5f9;
		min-height: 500px;
	}
	.content .box{
	     border: 1px solid rgba(0,0,0,.125); 
	    border-radius: .25rem;
	    background: #FFF;
	    padding: 30px 0;
	}
	ul.control{
		list-style-type: none;
		padding: 15px 15px 0 30px;
	}
	ul.control li a{
		
		margin: 5px 0;
		padding: 15px 0 15px 50px;
	}
	ul.control>li a:hover, li.active a, .hover{
		background: #26c6da;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
		border-radius: 5px;
		color: #FFF !important;
	}
	ul.control>li a{
		display: block;
		color: #607d8b;
	}
	.profile__avatar{
		border-radius: 50%;
		max-width: 150px;
		max-height: 150px;
	}
	.profile__info{
		text-align: center;
	}
	.profile__form{
		padding: 30px !important
	}

	.profile__form input[type="text"], .profile__form input[type="text"]:focus, .profile__form input[type="email"], .profile__form input[type="email"]:focus{
		border-top: none;
		border-right: none;
		border-left: none;
		border-radius: 0 !important;
		box-shadow: none;
		padding-left: 0px;
	}
	input{
		font-size: 16px !important;
	}
	.profile__form input:focus{
		border-bottom: 2px solid #1e88e5;
	}
	li ul.sub-menu{
		list-style-type: none;
		position: relative;
		width: 100%;
		display: none;

	}
	li ul.sub-menu>li a{
		padding: 10px 0 10px 5px;
		background: #058c9c;
		color: #FFF;
		
	}

</style>
<script>
	$(function(){
		var a = false;
		$(".control>li>a").click(function(){
			if (a == false) {
				a = true;
			}else{
				a = false
			}
			console.log(a);
			if (a == true) {
			$(this).addClass('hover');
			}else{
				$(this).removeClass('hover');
			}
		});
		$(".control>li").click(function(){
			$(this).children('ul').slideToggle();

		});
		

	});
</script>
<body>

	<header>
		<div class="row">
			<div class="col-sm-2 header__logo">
				<a href="<?=getUrl('') ?>"><img src="<?=getUrl('public/images/admin_logo.png') ?>" alt="">Assignment</a>
			</div>
			<div class="col-sm-10">
				<div class="float-right">
					<?php 
						$myuser = json_decode($_SESSION['user']);

					 ?>
					<img src="<?=getUrl('public/images/uploaded/'.$myuser->avatar) ?>" alt="" class="avatar">
					<?php 
					echo $myuser->fullname;
					?>
					<a href="<?=getUrl('admin/logout') ?>">LOGOUT</a>
				</div>
			</div>
		</div>
	</header>
	<div class="row">
		<div class="col-sm-2 sidebar">
			<ul class="control col-xs-12">
				<li class="active"><a href="http://localhost/webtintuc/admin">Dashboard</a></li>
				<li><a href="#">Category</a>
					<ul class="sub-menu">
						<li><a href="<?=getUrl('admin/category/add'); ?>">┗ Add new</a></li>
						<li><a href="<?=getUrl('admin/category'); ?>">┗ List category</a></li>
					</ul>
				</li>
				<li><a href="#">Post</a>
					<ul class="sub-menu">
						<li><a href="<?=getUrl('admin/posts/add'); ?>">┗ Add new</a></li>
						<li><a href="<?=getUrl('admin/posts'); ?>">┗ List post</a></li>
					</ul>
				</li>
				<!-- <li><a href="#">Setting</a></li> -->
				<li><a href="#">Profile</a>
					<ul class="sub-menu">
						<li><a href="<?=getUrl('admin/profile/edit'); ?>">┗ Edit Information</a></li>
						<li><a href="<?=getUrl('admin/profile/editemail'); ?>">┗ Edit Email</a></li>
						<li><a href="<?=getUrl('admin/profile/editpassword'); ?>">┗ Edit Password</a></li>
					</ul>
				</li>
				<li><a href="#">Setting</a>
					<ul class="sub-menu">
						<li><a href="<?=getUrl('admin/site/setting'); ?>">┗ SEO Setting</a></li>
						
					</ul>
				</li>
				<li><a href="<?=getUrl('admin/users'); ?>">Users</a>
				</li>
				<!-- <li><a href="#">User</a></li> -->
				
			</ul>
		</div>
		<div class="col-sm-12 content">
			<?php include_once $viewPath; ?>
		</div>
	</div>
</body>

</html>
<?php } ?>