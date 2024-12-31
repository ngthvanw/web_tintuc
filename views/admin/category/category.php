
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
        <th>Category Name</th>
        <th><a href="<?=getUrl('admin/category/add') ?>" class="btn btn-success btn-lg"><i class="fa fa-plus-circle" aria-hidden="true"></i>
</a></th>
      </tr>
    </thead>
    <tbody>
      <?php echo isset($_GET['msg'])==true?'<div class="alert alert-danger">'.$_GET['msg'].'</div>':null; ?>
      <?php
        foreach ($category as $key => $value):
       ?>
      <tr>
        <td><?=$value->id ?></td>
        <td><a href="<?=getUrl('admin/posts?category_id='.$value->id); ?>"><?=$value->category_name ?></a></td>
        <td>
          <a href="<?=getUrl('admin/category/update?id='.$value->id) ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
          <a href="<?=getUrl('admin/category/delete?id='.$value->id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
</table>
    </div>
  </div>
</div>