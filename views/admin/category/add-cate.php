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
	<div class="col-sm-12">
		<div class="box profile__form">
			
				<?php echo isset($_GET['msg'])==true?'<div class="alert alert-danger">'.$_GET['msg'].'</div>':null; ?>
			
			<form action="<?=getUrl('admin/category/save') ?>" method="post">
				<div class="form-group">
				    <label for="category_name"><b>Category Name</b></label>
					<input type="text" class="form-control" id="category_name" name="category_name" placeholder="Category Name">
				</div>
<!-- 				<div class="form-group">
				    <label for="category_url">Category Url</label>
					<input type="category_url" class="form-control" id="category_url" name="category_url" placeholder="Category Url">
				</div> -->
				<button type="submit" class="btn btn-default" name="submit">Submit</button>
			</form>
		</div>
	</div>
</div>