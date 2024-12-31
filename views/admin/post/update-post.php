<script src="<?=getUrl('public/libs/ckeditor/ckeditor.js') ?>"></script>
<script>
	window.onload = function(){
	var thumbnail = document.getElementsByName('thumbnail')[0];
	var thumbnail_img = document.getElementById('thumbnail_img');
		thumbnail.addEventListener('change', function(e){
			thumbnail_img.src = URL.createObjectURL(e.target.files[0]);
		});
	};
	function ChangeToSlug()
	{
    var title, slug;
 
    //Lấy text từ thẻ input title 
    title = document.getElementById("title").value;
 
    //Đổi chữ hoa thành chữ thường
    slug = title.toLowerCase();
 
    //Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    //Xóa các ký tự đặt biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, "-");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    //In slug ra textbox có id “slug”
    document.getElementById('url').value = slug;
	}
</script>
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
			
			<form action="<?=getUrl('admin/posts/save?id='.$post->id) ?>" method="post" enctype="multipart/form-data">
				<div class="form-group">
				    <label for="title"><b>Title: </b></label>
					<input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?=$post->title ?>" onkeyup="ChangeToSlug()">
				</div>
				<!-- <div class="form-group">
				    <label for="url"><b>URL: </b></label>
					<input type="text" class="form-control" id="url" name="url" placeholder="URL" value="<?=$post->post_url ?>">
				</div> -->
				<div class="form-group">
					<img src="<?=getUrl('public/images/uploaded/'.$post->thumbnail) ?>" alt="" id="thumbnail_img" width="200px"><br>
				    <label for="thumbnail"><b>Thumbnail</b></label>
					<input type="file" class="form-control" id="thumbnail" name="thumbnail" placeholder="Thumbnail">
				</div>
				<div class="form-group">
				    <label for="detail"><b>Detail</b></label>
					<textarea id="editor1" name="detail" cols="80" rows="10" placeholder="Viết bài của bạn tại đây.">
						<?=$post->detail ?>
			       	</textarea>
			        <script>
			           CKEDITOR.replace( 'editor1' );
			        </script>    
				</div>
				<div class="form-group">
				    <label for="category_id"><b>Category</b></label>
					<select class="form-control" name="category_id" id="category_id">
						<?php 
						foreach ($category as $value):
						?>
							<option value="<?=$value->id ?>" 
							<?php 
								if ($value->id==$post->category_id) {
									echo "selected";
								}
							 ?>>
							<?=$value->category_name ?></option>
						<?php
						endforeach;
						 ?>
					</select>
				</div>
				<button type="submit" class="btn btn-default" name="submit">Submit</button>
			</form>
		</div>
	</div>
</div>