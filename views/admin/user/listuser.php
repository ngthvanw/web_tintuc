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
        <th>Avatar</th>
        <th>Username</th>
        <th>Full name</th>
        <th>Email</th>
</a></th>
      </tr>
    </thead>
    <tbody>
      <?php echo isset($_GET['msg'])==true?'<div class="alert alert-danger">'.$_GET['msg'].'</div>':null; ?>
      <?php
        foreach ($users as $key => $value):
        	if ($value->id != 1):
       ?>
      <tr>
        <td><?=$value->id ?></td>
        <td><img class="thumbnail" src="<?=getUrl('public/images/uploaded/'.$value->avatar) ?>" alt=""></td>
        <td><?=$value->username ?></td>
        <td><?=$value->fullname ?></td>
        <td><?=$value->email ?></td>
        <td>
          <a href="<?=getUrl('admin/users/delete?id='.$value->id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
        </td>
      </tr>
    <?php 
	endif;
    endforeach; ?>
    </tbody>
</table>
            <div style="clear: both"></div>
    </div>
  </div>
</div>