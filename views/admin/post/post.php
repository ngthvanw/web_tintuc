<style>
  img.thumbnail{
    max-width: 200px;
  }
  td.detail{
    max-width: 300px;
    overflow-wrap: break-word;
  }
</style>
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
<table class="table table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Thumbnail</th>
        <th>Title</th>
        <th>Detail</th>
        <th>Category</th>
        <th>By</th>
        <th>Posted Time</th>
        <th><a href="<?=getUrl('admin/posts/add') ?>" class="btn btn-success btn-lg"><i class="fa fa-plus-circle" aria-hidden="true"></i>
</a></th>
      </tr>
    </thead>
    <tbody>
      <?php echo isset($_GET['msg'])==true?'<div class="alert alert-danger">'.$_GET['msg'].'</div>':null; ?>
      <?php
        if (count($post)==0) {
          echo '<div class="alert alert-warning">Không có bài viết nào.</div>';
        }
        foreach ($post as $key => $value):
       ?>
      <tr>
        <td><?=$value->id ?></td>
        <td><img class="thumbnail" src="<?=getUrl('public/images/uploaded/'.$value->thumbnail) ?>" alt=""></td>
        <td><?=$value->title ?></td>
        <td class="detail"><?php 
        $value->detail = strip_tags ($value->detail) ;
        if (strlen($value->detail)>150) {
          $value->detail = substr($value->detail, 0, 150);
        }
        echo $value->detail;
         ?></td>
        <td><?=$value->category() ?></td>
        <td><?=$value->owner() ?></td>
        <td><?=$value->post_time ?></td>
        <td>
          <a href="<?=getUrl('admin/posts/update?id='.$value->id) ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
          <a href="<?=getUrl('admin/posts/delete?id='.$value->id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
</table>
        <div class="col-xs-6 col-xs-offset-4">
            <ul class="pagination pagination-lg">
              <?php for ($i=0; $i < $allpages; $i++) { 
              ?>
              <li <?php if ($currentpage == $i) {
                echo 'class="active"';
              } ?>><a href="<?=getUrl('admin/posts?page='.$i) ?>"><?=$i ?></a></li>
            <?php
              } ?>
            </ul>
        </div>
            <div style="clear: both"></div>
    </div>
  </div>
</div>