<section class="sport row" style="margin-bottom: 50px">
	<section class="col-lg-12">
		<h2 class="article__title">
			<span><i>Tin Tức</i> Nổi Bật Nhất</span>
		</h2>
		<section class="sport__video col-lg-7">
			<a href="<?=getUrl('post?id='.$toponepost->id) ?>">
				<img src="<?=getUrl('public/images/uploaded/'.$toponepost->thumbnail) ?>" alt="">
				<section class="sport__video__description">
					<span class="catename">
						<?php echo $toponepost->category() ?>
					</span>
					<span class="posttime">
						<i class="fa fa-clock-o"></i> <?php echo convertTime($toponepost->post_time); ?>
					</span>
					<h3>
						<?=$toponepost->title ?>
					</h3>
				</section>
			</a>
		</section>
		<section class="sport__boxlist col-lg-5">
			<?php foreach ($top4post as $value): ?>
				
			
			<section class="sport__listnews">
				<section class="col-xs-8">
					<span class="catename">
						<?php echo  $value->category(); ?>
					</span>
					<h4>
						<a href="<?=getUrl('post?id='.$value->id) ?>"><?=$value->title ?></a>
					</h4>
					<span class="posttime">
						<i class="fa fa-clock-o"></i> <?php echo  $value->post_time; ?>
					</span>
				</section>
				<section class="col-xs-4">
					<img src="<?=getUrl('public/images/uploaded/'.$value->thumbnail) ?>" alt="">
				</section>
				<section class="clear"></section>
			</section>

			<?php endforeach ?>
			
		</section>
	</section>
</section>