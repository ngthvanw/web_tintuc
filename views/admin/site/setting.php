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
<script>
	window.onload = function(){
	var favicon_input = document.getElementById('favicon_input');
	var favicon = document.getElementById('favicon');
		favicon_input.addEventListener('change', function(e){
			favicon.src = URL.createObjectURL(e.target.files[0]);
		});
	}
</script>
<div class="col-sm-10">
	<div class="col-sm-8 col-xs-offset-2">
		<div class="box profile__form">
			<form method="post" action="<?=getUrl('admin/site/saveSetting') ?>" enctype="multipart/form-data">
				<?php 
					echo isset($_GET['msg'])==true?'<div class="alert alert-danger">'.$_GET['msg'].'</div>':null;
				 ?>
				<div class="form-group">
				    <label for="title">Title</label>
					<input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?php echo $title ?>">
				</div>
				<div class="form-group">
					<label for="description">Description</label>
					<textarea name="description" id="description" class="form-control" placeholder="Description" rows="5"><?php echo $description ?></textarea>
				</div>
				<div class="form-group">
					<label for="description">Favicon: </label>
					<img src="<?=getUrl('public/images/'.$favicon) ?>" alt="" width="25px" id="favicon">
					<input type="file" class="form-control" id="favicon_input" name="favicon">
				</div>
				<button type="submit" class="btn btn-default" name="submit">Submit</button>
			</form>
		</div>
	</div>
</div>