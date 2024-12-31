	<section class="article container category">
		<section class="row">
			<section class="category__box col-lg-8">
				<section class="col-lg-12">
					<h2 class="article__title">
						<span><?php echo $category->category_name ?></span>
					</h2>
				</section>
				<?php foreach ($post as  $value): ?>
					
				
				<section class="category__news col-lg-12">
					<section class="category__news__thumb">
						<img src="<?=getUrl('public/images/uploaded/'.$value->thumbnail) ?>" alt="">
						<section class="category__news__title">
						<h4>
							<a href="<?=getUrl('post?id='.$value->id) ?>"><?=$value->title ?></a>
						</h4>
					</section>
					</section>
					
					<section class="category__news__info">
						<span class="catename">
							<?php echo $category->category_name ?>
						</span>
						<span class="posttime">
							<i class="fa fa-clock-o"></i> <?php
								echo convertTime($value->post_time);
							?>
						</span>
					</section>
					<section class="category__news__desc">
						<?php description($value->detail, 800); ?>
					</section>
					<span class="readmore"><a href="<?=getUrl('post?id='.$value->id) ?>">READMORE</a></span>
				</section>
				<?php endforeach ?>
			</section>
			<?php include_once $sidebar; ?>
		</section>
		<style>
					ul.pagination li.active a{
						background-color: #d13030;
    					border-color: #d13030;
    					color: #FFF;
					}
					ul.pagination li a{
						
    					border-color: #d13030;
    					color: #d13030;
					}
					ul.pagination li a:hover{
    					color: #d13030;
					}
				</style>
		<div class="col-xs-6 col-xs-offset-3">
				    <ul class="pagination pagination-lg">
				    	<?php for ($i=0; $i < $allpages; $i++) { 
				    	?>
				    	<li <?php if ($currentpage == $i) {
				    		echo 'class="active"';
				    	} ?>><a href="<?=getUrl('category?id='.$id.'&page='.$i) ?>"><?=$i ?></a></li>
				    <?php
				    	} ?>
				    </ul>
				</div>

	</section>
	<section class="clear"></section>