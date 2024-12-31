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
						<form method="post" action="<?=getUrl('admin/profile/editpasswordProcess') ?>">
							<?php 
								echo isset($_GET['msg'])==true?'<div class="alert alert-danger">'.$_GET['msg'].'</div>':null;
							 ?>
							<div class="form-group">
							    <label for="c_password">Your current password:</label>
								<input type="password" class="form-control" id="c_password" name="c_password" placeholder="Your current password">
							</div>
							<div class="form-group">
								<label for="password">Enter your new password:</label>
								<input type="password" name="password" id="password" class="form-control" placeholder="Password">
							</div>
							<div class="form-group">
								<label for="password">Re-enter your new password</label>
								<input type="password" name="cf_password" id="cf_password" class="form-control" placeholder="Confirm Password">
							</div>

							<button type="submit" class="btn btn-default" name="submit">Submit</button>
						</form>
					</div>
				</div>
			</div>