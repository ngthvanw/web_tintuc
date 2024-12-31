<script>
	window.onload = function(){
	var thumbnail = document.getElementsByName('avatar')[0];
	var thumbnail_img = document.getElementById('avatar_img');
		thumbnail.addEventListener('change', function(e){
			thumbnail_img.src = URL.createObjectURL(e.target.files[0]);
		});
	}
</script>
<div class="breadcumb">
				<div class="col-sm-10 col-sm-offset-2">
					<div class="col-sm-12">
						<h3>Profile</h3>
						<a href="#">Dashboard</a>
						>
						Profile
					</div>
				</div>
			</div>
			<div class="col-sm-2"></div>
			<div class="col-sm-10">
				<?php include_once $information; ?>
				<div class="col-sm-8">
					<div class="box profile__form">
						<?php 
								echo isset($_GET['msg'])==true?'<div class="alert alert-danger">'.$_GET['msg'].'</div>':null;
							 ?>
						<form action="<?php echo getUrl('admin/profile/saveEdit'); ?>" method="post" enctype="multipart/form-data">
							<div class="form-group">
							    <label for="fullname">Your Name:</label>
								<input type="text" class="form-control" id="fullname" name="fullname" placeholder="Your name" value="<?=$user->fullname ?>">
							</div>
							<div class="form-group">
								<img src="<?=getUrl('public/images/uploaded/'.$user->avatar) ?>" alt="" class="thumbnail" width="150px" id="avatar_img"><br>
							    <label for="avatar">Avatar:</label>
								<input type="file" class="form-control" id="avatar" name="avatar" >
							</div>
							<div class="form-group">
							    <label for="about">About</label>
								<textarea class="form-control" id="about" rows="5" placeholder="Something about yourself" name="about"><?=$user->about ?></textarea> 
							</div>
							<button type="submit" class="btn btn-default" name="submit">Submit</button>
						</form>
					</div>
				</div>
			</div>