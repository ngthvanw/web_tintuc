<section class="article container detail">
	<section class="row">
		<section class="col-lg-8">
			<section class="detail__post">
				<h1>
					<?=$post->title ?>
				</h1>
				<section class="detail__desc">
					<span class="catename">
						<?=$post->category() ?>
					</span>
					- By <?=$post->author() ?> -
					<span class="posttime">
						<i class="fa fa-clock-o"></i> 
						<?php
								echo convertTime($post->post_time);
						?>
					</span>

					<i class="fa fa-eye" aria-hidden="true"></i> <?=$post->views ?>
					
				</section>
				<p class="paragraph__content">
					<?=$post->detail ?>
				</p>
				<?php echo $comment ?>
			</section>
		</section>
		<?php include_once $sidebar; ?>
	</section>
</section>
<section class="clear"></section>
