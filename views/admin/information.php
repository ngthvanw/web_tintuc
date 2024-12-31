<div class="col-sm-4">
	<div class="box profile__info">
		<img src="<?=getUrl('public/images/uploaded/'.$user->avatar) ?>" alt="" class="profile__avatar"><br>
		<b>Username: <?=$user->username ?></b><br>
		<b>Fullname: <?=$user->fullname ?></b><br>
		Email: <?=$user->email ?><br>
		<div class="quote">
			<?=$user->about ?>
			
		</div><br>
	</div>
</div>