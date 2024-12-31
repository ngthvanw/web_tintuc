
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title ?></title>
	<link rel="icon" href="<?=getUrl('public/images/'.$favicon) ?>" type="image/x-icon">
	<link rel="stylesheet" href="<?=getUrl('public/css/bootstrap/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?=getUrl('public/css/css.css') ?>">
	<link rel="stylesheet" href="<?=getUrl('public/fonts/font-awesome-4.7.0/css/font-awesome.min.css') ?>">
	<script src="<?=getUrl('public/js/jquery.js') ?>"></script>
	<link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
	<script src="<?=getUrl('public/css/bootstrap/js/bootstrap.min.js') ?>"></script>
	<script src="<?=getUrl('public/js/menu.js') ?>"></script>
	<meta name="description" content="<?php echo $description ?>">
</head>
<body>
<script>
	$(function(){

		$('#search').click(function() {
			$('#searchbox').slideToggle();
		});

	$('#searchinput').keyup(function() {
			$('#loadimg').show();
			setTimeout(function(){
				$('#loadimg').hide();
			}, 2000);
			$.get('<?php echo getUrl('search') ?>', {keyword: $(this).val()} ,
	      		function (data) {
	      			setTimeout(function(){
	         	$('.result').html(data);
	         	}, 1000);
	   		});
			
			

	});

	});
</script>
<?php $categorymenu = \models\Category::all(); ?>
	<header>
		<section class="top-header hidden-xs">
			<section class="container">
				<section class="row">
					<?php 
					if (!isset($_SESSION['user']) && isset($_COOKIE['remember_token']) != null)
					{
					
						$usermodel = new \models\User();
						$remember_token = isset($_COOKIE['remember_token'])==true?$_COOKIE['remember_token']:null;
						$user = $usermodel->where(['remember_token', $remember_token])->first();
						$_SESSION['user'] = json_encode($user);
					}
					if (!isset($_SESSION['user']) && !isset($_COOKIE['remember_token'])) {
					 ?>
					<section class="col-lg-9">
						<ul class="top-menu">
							<li>
								<a href="<?=getUrl('') ?>">Homepage</a>
							</li>
						<?php 
							
							foreach ($categorymenu as $value):
						?>
						<li>
							<a href="<?=getUrl('category?id='.$value->id) ?>"><?=$value->category_name ?></a>

						</li>
						<?php
							endforeach;
						 ?>
						</ul>
					</section>
					<section class="col-lg-3">
						<a href=""><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
						<a href=""><i class="fa fa-google-plus-square" aria-hidden="true"></i></a>
						<a href=""><i class="fa fa-youtube-square" aria-hidden="true"></i></a>
						<a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a>
					</section>
					<?php 
					} 
					else{

						
					?>
						<section class="col-lg-9" style="color: #FFF">
							Hello, <?php echo json_decode($_SESSION['user'])->fullname ?>
						</section>
						<section class="col-lg-3">
							<a href="<?php echo getUrl('admin'); ?>" style="margin-right: 15px; font-weight: bold; font-size: 20px">Admin Panel</a>
							<a href="<?php echo getUrl('admin/logout'); ?>">Logout</a>
						</section>
					<?php
					}

					?>

				</section>
			</section>
		</section>
		<section class="header">
		<section class="container">
			<section class="row">
				<section class="col-lg-3">
					<a href="<?=getUrl() ?>"><img src="<?=getUrl('public/images/abc.png') ?>" alt="Logo"></a>
				</section>
				<section class="col-lg-9">
					<ul class="menu">
						<li>
							<a href="<?=getUrl('/') ?>">Homepage</a>

						</li>
						<?php 
							
							foreach ($categorymenu as $value):
						?>
						<li>
							<a href="<?=getUrl('category?id='.$value->id) ?>"><?=$value->category_name ?></a>

						</li>
						<?php
							endforeach;
						 ?>
						<li class="search" id="search" style="font-size: 25px">
							<a href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
						</li>

					</ul>
				</section>
			</section>
		</section>
		<style>
			.searchbox{
				position: absolute;
				right: 120px;
				width: 400px;
				display: none;
				background: #FFF;
				box-shadow: 0 0 5px #b3b3b3;
				z-index: 999;
				padding: 20px;
				
			}
			.searchbox input{
				width: 100%;
				height: 40px;
			}
			.searchbox .searchbox__result{
				padding: 10px 10px;
				line-height: 20px;
				border-bottom: 1px solid #eee;
				max-width: 100%;
				overflow: hidden;

			}
			.result{
				max-height: 250px;
				overflow-y: scroll;
			}
			.loading{
				text-align: center !important;
			}
			
			#loadimg {
				display: none;
			}
		</style>
		<section class="searchbox" id="searchbox">
			<form>
				<input type="text" placeholder="Search..." id="searchinput" class="form-control">
			</form>
			<div class="result">
				<div class="loading">
					<img src="<?php echo getUrl('public/images/load.gif') ?>" alt="" id="loadimg">
				</div>
				
				
			</div>
		</section>
		</section>

		<section class="clear"></section>
	</header>