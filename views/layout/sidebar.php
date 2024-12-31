<aside class="col-lg-4 ">
			<?php 

		$sidebarpost = new \models\Post();

		$allpostsidebar = $sidebarpost->all();
		$random = true;
		if (count($allpostsidebar)<4) {
			$random = false;
		}


		if ($random == true) {
		$rand_key = array_rand($allpostsidebar, 4);
		$randompost = [];
		for ($i=0; $i < count($rand_key); $i++) {
			$randompost[] = $allpostsidebar[$rand_key[$i]];
		}

		 ?>

				<section class="fahsion hidden-xs">
					<h2>
						Tin Tức Tiêu Biểu
					</h2>
					<?php 
					foreach ($randompost as $value):
					 ?>
					<section class="fahsion__news col-lg-6">
						<img src="<?=getUrl('public/images/uploaded/'.$value->thumbnail); ?>" alt="">
						<h4>
							<a href="<?=getUrl('post?id='.$value->id) ?>"><?=$value->title ?></a>
						</h4><section class="clear"></section>
					</section>
					
					<?php endforeach; ?>

				</section>
				<section class="clear"></section>
				<?php } ?>
				<section class="newnews">
					<h2>
						New Articles
					</h2>
					<section class="newnews__boxlist">
						<?php 

							$newarticle = $sidebarpost->where()->orderBy(['post_time', 'desc'])->limit(5)->get();
							foreach ($newarticle as $value):
						?>
						<section class="newnews__listnews">
							<section class="col-xs-8">
								<span class="catename">
									<?=$value->category() ?>
								</span>
								<h4>
									<a href="<?=getUrl('post?id='.$value->id) ?>"><?=$value->title ?></a>
								</h4>
							</section>
							<section class="col-xs-4">
								<img src="<?=getUrl('public/images/uploaded/'.$value->thumbnail); ?>" alt="">
							</section>
							<section class="clear"></section>
						</section>
					<?php endforeach; ?>
						
					</section>
				</section>
			</aside>