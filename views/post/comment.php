


	



<br><br>
<section class="comments">

<br>
<h3>User Comment Example</h3>
<?php foreach ($commentModel as $value): ?>
<div class="col-sm-12">
<div class="col-sm-2">
<div class="thumbnail">
<img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
</div><!-- /thumbnail -->
</div><!-- /col-sm-1 -->
<div class="col-sm-5">
<div class="panel panel-default">
<div class="panel-heading">
<strong>
<?php

 $name = json_decode($value->quest)->name;
 echo $name; 
 ?>
 </strong> <span class="text-muted"><?php
								echo convertTime($value->comment_time);
						?></span>
</div>
<div class="panel-body">
<?php echo $value->message ?>
</div><!-- /panel-body -->
</div><!-- /panel panel-default -->
</div><!-- /col-sm-5 -->
</div>
<?php endforeach ?>
<div style="clear: both;"></div>

	<h2>
		Leave a comment
	</h2>
	<form action="<?php echo getUrl('post/comment?id='.$id) ?>" method="post">
		<div class="form-group">
			<label for="comment">Comment:</label>
			<textarea class="form-control" rows="10" name="message" id="comment" placeholder="Message"></textarea>
		</div>
		<?php 

		if (!isset($_SESSION['comment'])) {
		?>
		<div class="form-group">
			<label for="name">Name:</label>
			<input type="text" class="form-control" id="name" placeholder="Name" name="name">
		</div>
		<div class="form-group">
			<label for="email">Email:</label>
			<input type="text" class="form-control" id="email" name="email" placeholder="Email">
		</div>
		<?php
		}else{
			$questInfo = json_decode($_SESSION['comment']);
		?>
		<input type="hidden" class="form-control" id="name" placeholder="Name" name="name" value="<?php echo $questInfo->name ?>">
		<input type="hidden" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $questInfo->email ?>">
		<?php


		}

		 ?>
		<button type="submit" class="btn btn-default">Send your comment</button>
	</form>
</section>