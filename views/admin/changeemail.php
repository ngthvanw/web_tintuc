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
						<form method="post" action="<?=getUrl('admin/profile/editemailProcess') ?>">
							<?php 
								echo isset($_GET['msg'])==true?'<div class="alert alert-danger">'.$_GET['msg'].'</div>':null;
							 ?>
							<div class="form-group">
							    <label for="email">Email address:</label>
								<input type="email" class="form-control" id="email" name="email" placeholder="Email">
							</div>
							<div class="form-group">
								<label for="password">Enter your current password to change email:</label>
								<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
							</div>

							<button type="submit" class="btn btn-default" name="submit">Submit</button>
						</form>
					</div>
				</div>
			</div>