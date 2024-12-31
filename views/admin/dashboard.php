<div class="breadcumb">
				<div class="col-sm-10 col-sm-offset-2">
					<div class="col-sm-12">
						<h3>Dashboard</h3>
						<a href="#">Dashboard</a>
						
					</div>
				</div>
			</div>
			<div class="col-sm-2"></div>
			<style>
				.countpost{
					height: 100px;
					background: #398bf7;
					color: #FFF;
				}
				.countcate{
					height: 100px;
					background: #06d79c;
					color: #FFF;
				}
				.countuser{
					height: 100px;
					background: #745af2;
					color: #FFF;
				}
				.countcomment{
					height: 100px;
					background: #ef5350;
					color: #FFF;
				}
				i{
					font-size: 80px !important;
				}
				.col-xs-5{
					padding-top: 10px;
				}
				h1{
					padding: 0;
					margin: 0
				}
				h2{
					padding-bottom: 0;
					margin-bottom: 0;
					font-size: 20px;
				}
			</style>
			<div class="col-sm-10">

					<div class="col-xs-3">
						<div class="col-xs-12 countpost">
						<div class="col-xs-5">
							<i class="fa fa-newspaper-o" aria-hidden="true"></i>
						</div>
						<div class="col-xs-7">
							<h2> Post</h2>
							<h1><?php echo $totalpost ?></h1>
						</div>
						</div>
						<div style="clear: both;"></div>
					</div>
					<div class="col-xs-3">
						<div class="col-xs-12 countcate">
						<div class="col-xs-5">
							<i class="fa fa-tasks" aria-hidden="true"></i>
						</div>
						<div class="col-xs-7">
							<h2> Category</h2>
							<h1><?php echo $totalcate ?></h1>
						</div>
						</div>
						<div style="clear: both;"></div>
					</div>
					<div class="col-xs-3">
						<div class="col-xs-12 countuser">
						<div class="col-xs-5">
							<i class="fa fa-users" aria-hidden="true"></i>
						</div>
						<div class="col-xs-7">
							<h2> User</h2>
							<h1><?php echo $totaluser ?></h1>
						</div>
						</div>
						<div style="clear: both;"></div>
					</div>
					<div class="col-xs-3">
						<div class="col-xs-12 countcomment">
						<div class="col-xs-5">
							<i class="fa fa-comments" aria-hidden="true"></i>
						</div>
						<div class="col-xs-7">
							<h2> Comment</h2>
							<h1><?php echo $totalcomment ?></h1>
						</div>
						</div>
						<div style="clear: both;"></div>
					</div>
			</div>