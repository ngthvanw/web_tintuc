<?php 
namespace controllers;

/**
* Class dùng để quản lý trang quản trị
*/
class AdminController extends BaseController
{
	
	public function index()
{
    $totalpost = count(\models\Post::all());
    $totaluser = count(\models\User::all());
    $totalcate = count(\models\Category::all());
    $totalcomment = count(\models\Comment::all());
    return $this->render("views/admin/dashboard.php", compact('totalpost', 'totaluser', 'totalcomment', 'totalcate'), "views/admin/admin.layout.php");
}

	public function listCategory()
	{	
		$category = \models\Category::all();
		return $this->render("views/admin/category/category.php", compact("category"), "views/admin/admin.layout.php");
	}
	public function userList()
	{
		$users = \models\User::all();
		return $this->render("views/admin/user/listuser.php", compact("users"), "views/admin/admin.layout.php");
	}
	public function deleteUser()
	{
		$id = isset($_GET['id'])==true?$_GET['id']:null;
		if (!$id) {
			die;
		}
		$user = \models\User::findOne($id);
		$username = $user->username;
		if ($username == json_decode($_SESSION['user'])->username) {
			return $this->redirect('admin/users?msg=Không thể xóa chính mình');
			die;
		}
		$user->delete();
		return $this->redirect('admin/users?msg=Đã xóa người dùng: '.$username);
		

	}
	public function addNewCategory()
	{	
		$category = null; // Hoặc gán giá trị phù hợp nếu cần
		return $this->render("views/admin/category/add-cate.php", compact("category"), "views/admin/admin.layout.php");
	}
	
	public function saveCategory()
	{	
		
		if (isset($_POST['submit'])) {
			$id = isset($_GET['id'])==true?$_GET['id']:null;
			$category_name = isset($_POST['category_name'])==true?$_POST['category_name']:null;
			if ($category_name == null) {
				header("location: ".getUrl('admin/category/add?msg=Tên danh mục không được trống!'));
			}
			else{
				if ($id) {
					$category = \models\Category::findOne($id);
				}
				else{
					$category = new \models\Category();
				}
				$category->category_name = $category_name;
				if ($id) {
					$category->update();
				}
				else{
					$category->insert();
				}
				
				header("location: ".getUrl('admin/category'));
			}
		}
		
	}
	public function removeCategory()
	{	
		$id = isset($_GET['id'])==true?$_GET['id']:null;
		if ($id) {
			$category = \models\Category::findOne($id);
			$category_name = $category->category_name;
			$category->delete();
			header("location: ".getUrl('admin/category?msg=Đã xóa danh mục '.$category_name));
		}
	}
	public function updateCategory()
	{	
		$id = isset($_GET['id'])==true?$_GET['id']:null;
		if ($id) {
			$category = \models\Category::findOne($id);
			return $this->render("views/admin/category/update-cate.php", compact("category"), "views/admin/admin.layout.php");
		}
		
	}

	public function listPost()
	{
		$category_id = isset($_GET['category_id'])==true?$_GET['category_id']:null;
		if ($category_id) {
			$post = \models\Category::findOne($category_id);
			$post = $post->getPostsOfCate();
		}
		else{
			$postmodel = new \models\Post();
			$total = count($postmodel->all());
			$config = \models\Config::where(['config_name', 'numofpost'])->get();
			$numofpost = $config[0]->config_value;
			$allpages = ceil($total/$numofpost);
			$currentpage = isset($_GET['page'])==true?$_GET['page']:0;
			$post = \models\Post::where()->orderBy(['id', 'desc'])->limit([$currentpage*$numofpost, $numofpost])->get();

		}
		return $this->render("views/admin/post/post.php", compact("post", "allpages", "currentpage","post"), "views/admin/admin.layout.php");
	}

	public function addNewPost()
	{
		$category = \models\Category::all();
		return $this->render("views/admin/post/add-post.php", compact("category"), "views/admin/admin.layout.php");
	}
	public function updatePost()
	{	
		$id = isset($_GET['id'])==true?$_GET['id']:null;
		if ($id) {
			$category = \models\Category::all();
			$post = \models\Post::findOne($id);
			return $this->render("views/admin/post/update-post.php", compact("category", 'post'), "views/admin/admin.layout.php");

		}
		
	}

	public function savePost(){
		
		if (isset($_POST['submit'])) {
			$id = isset($_GET['id'])==true?$_GET['id']:null;
			$title = isset($_POST['title'])==true?$_POST['title']:null;
			// $post_url = isset($_POST['url'])==true?$_POST['url']:null;
			$detail = isset($_POST['detail'])==true?$_POST['detail']:null;
			$category_id = isset($_POST['category_id'])==true?$_POST['category_id']:null;
			$thumbnail = isset($_FILES['thumbnail'])==true?$_FILES['thumbnail']:null;
			if ($title == null || $detail == null || $category_id == null) {
				return $this->redirect('admin/posts/add?msg=Vui lòng nhập đầy đủ thông tin bài viết');
			}
			if ($id == null && $thumbnail['name'] == '' ) {
				return $this->redirect('admin/posts/add?msg=Vui lòng nhập đầy đủ thông tin bài viết');
			}

			if ($id) {
				$post = \models\Post::findOne($id);
			}
			else{
				$post = new \models\Post();
			}
			$post->title = $title;
			$post->detail = $detail;
			// $post->post_url = $post_url;
			$post->user_id = json_decode($_SESSION['user'])->id;
			$post->category_id = $category_id;
			if ($id != null && $thumbnail['name']=="") {
			}
			else{
				$ext = strtolower(pathinfo($thumbnail['name'], PATHINFO_EXTENSION));
				$allowedExt = ['jpg', 'png', 'jpeg', 'gif'];
				if (!in_array($ext, $allowedExt)) {
					if ($id==null) {
						return $this->redirect('admin/posts/add?msg=Vui lòng upload đúng định dạng ảnh');
					}
					else{
						return $this->redirect('admin/posts/update?id='.$id.'&msg=Vui lòng upload đúng định dạng ảnh');
					}
				}
				$thumbnail['name'] = 'IMG_'.uniqid().md5(microtime()).'.'.$ext;
				move_uploaded_file($thumbnail['tmp_name'], 'public/images/uploaded/'.$thumbnail['name']);
				$post->thumbnail = $thumbnail['name'];
			}
			$post->post_time = \date("Y:m:d h:m:s");
			if ($id) {
				$post->update();
			}
			else{
				$post->insert();
			}
			return $this->redirect('admin/posts');
		}
	}
	public function removePost()
	{	
		$id = isset($_GET['id'])==true?$_GET['id']:null;
		if ($id) {
			$post = \models\Post::findOne($id);
			$title = $post->title;
			$post->delete();
			header("location: ".getUrl('admin/posts?msg=Đã xóa bài viết '.$title));
		}
	}
	public function loginForm()
	{
		return $this->render("views/admin/login.php");
	}
	public function loginProcess()
	{
		if (isset($_POST['login-submit'])) {
			$usermodel = new \models\User();
			$username = isset($_POST['username'])==true?$_POST['username']:null;
			$password = isset($_POST['password'])==true?$_POST['password']:null;
			if ($username == null || $password == null) {
				return $this->redirect('admin/login?msg=Please enter all of information.');
				die;
			}
			$user = $usermodel->where(['username', $username])->first();
			if (!$user) {
				return $this->redirect('admin/login?msg=our username or password do not correct');
				die;
			}
			if (hash_equals(md5($password), $user->password)) {
				$_SESSION['user'] = $user;
				if (isset($_POST['remember'])) {
					$remember_token = "_token_".uniqid(rand(1,1000)).md5(microtime().rand(1,1000));
					$expired_time = date("Y:m:d H:m:s", time() + 3600*24*10);
					setcookie('remember_token', $remember_token, time() + 3600*24*10, '/');
					$user->remember_token = $remember_token;
					$user->expired_time = $expired_time;
					$user->update();

				}
				return $this->redirect('admin');

			}else{
				return $this->redirect('admin/login?msg=Your username or password do not correct');
				die;
			}
		}
	}
	public function changeEmail()
	{ 
		$decode = json_decode($_SESSION['user']);
		$user = \models\User::findOne($decode->id);
		$information = 'views/admin/information.php';
		return $this->render("views/admin/changeemail.php", compact('user', 'information'), 'views/admin/admin.layout.php');
	}
	public function changePassword()
	{ 
		$decode = json_decode($_SESSION['user']);
		$user = \models\User::findOne($decode->id);
		$information = 'views/admin/information.php';
		return $this->render("views/admin/changepassword.php", compact('user', 'information'), 'views/admin/admin.layout.php');
	}
	public function editpasswordProcess()
	{
		if (isset($_POST['submit'])) {
			$changeuser = json_decode($_SESSION['user']);
			$c_password = isset($_POST['c_password'])==true?$_POST['c_password']:null;
			$password = isset($_POST['password'])==true?$_POST['password']:null;
			$cf_password = isset($_POST['cf_password'])==true?$_POST['cf_password']:null;
			if ($password == null || $c_password == null || $cf_password == null) {
				return $this->redirect('admin/profile/editpassword?msg=Please enter all information');
				die;
			}
			if ($password !== $cf_password) {
				return $this->redirect('admin/profile/editpassword?msg=Your new password is not the same');
				die;
			}
			if ($changeuser->password != md5($c_password)) {
				return $this->redirect('admin/profile/editpassword?msg=Invaild current password.');
				die;
			}
			$changeuser = \models\User::findOne($changeuser->id);
			$changeuser->password = md5($password);
			$changeuser->update();
			$newinfo = \models\User::findOne($changeuser->id);
			$_SESSION['user'] = json_encode($newinfo);
			return $this->redirect('admin/logout');
		}
	}
	public function editemailProcess()
	{
		if (isset($_POST['submit'])) {
			$changeemailuser = json_decode($_SESSION['user']);
			$email = isset($_POST['email'])==true?$_POST['email']:null;
			$password = isset($_POST['password'])==true?$_POST['password']:null;
			if ($email==null || $password == null) {
				return $this->redirect('admin/profile/editemail?msg=Please enter all information');
				die;
			}
			if ($changeemailuser->password != md5($password)) {
				return $this->redirect('admin/profile/editemail?msg=Invaild password.');
				die;
			}
			$changeemailuser = \models\User::findOne($changeemailuser->id);
			$changeemailuser->email = $email;
			$changeemailuser->update();
			$newinfo = \models\User::findOne($changeemailuser->id);
			$_SESSION['user'] = json_encode($newinfo);
			return $this->redirect('admin/profile/editemail?msg=Your email have been changed');
		}
	}
	public function edit()
	{
		$stt = isset($_GET['status'])==true?$_GET['status']:null;
		$decode = json_decode($_SESSION['user']);
		if ($stt == "ok") {
			$user = \models\User::findOne($decode->id);
			$_SESSION['user'] = json_encode($user);
		}
		$decode = json_decode($_SESSION['user']);
		$information = 'views/admin/information.php';
		$user = \models\User::findOne($decode->id);
		return $this->render('views/admin/edit-profile.php', compact('information', 'user'), 'views/admin/admin.layout.php');
		
	}
	public function saveEdit()
	{
		if (isset($_POST['submit'])) {
			$fullname = isset($_POST['fullname'])==true?$_POST['fullname']:null;
			$about = isset($_POST['about'])==true?$_POST['about']:null;
			$avatar =isset($_FILES['avatar'])==true?$_FILES['avatar']:null;
			if ($fullname == null) {
				return $this->redirect('admin/profile/edit?msg=Please enter all of information');
				die;
			}
			$decode = json_decode($_SESSION['user']);
			$user = \models\User::findOne($decode->id);
			$user->fullname = $fullname;
			$user->about = $about;
			if ($avatar['name'] != "" && $avatar != false) {
				$ext = strtolower(pathinfo($avatar['name'], PATHINFO_EXTENSION));
				$allowedExt = ['jpg', 'png', 'jpeg', 'gif'];
				if (!in_array($ext, $allowedExt)) {
					return $this->redirect('admin/profile/edit?msg=Invaild images format&action=1');
					die;
				}
				$avatar['name'] = 'IMG_'.md5(uniqid().$avatar['name'].rand(1,1000)).'.'.$ext;
				move_uploaded_file($avatar['tmp_name'], 'public/images/uploaded/'.$avatar['name']);
				$user->avatar = $avatar['name'];
			}
			$user->update();

			return $this->redirect('admin/profile/edit?status=ok&msg=Đã thay đổi thông tin thành công.');
		}
	}
	public function siteSetting()
	{

		$site = new \models\Config();
		$title = $site->where(['config_name', 'title'])->first()->config_value;
		$description = $site->where(['config_name', 'description'])->first()->config_value;
		$favicon = $site->where(['config_name', 'favicon'])->first()->config_value;
		return $this->render('views/admin/site/setting.php', compact('title', 'description', 'favicon'), 'views/admin/admin.layout.php');
	}
	public function saveSetting()
	{

		if (isset($_POST['submit'])) {
			$site = new \models\Config();
			$title = isset($_POST['title'])==true?$_POST['title']:null;
			$description = isset($_POST['description'])==true?$_POST['description']:null;
			$favicon = isset($_FILES['favicon'])==true?$_FILES['favicon']:null;
			if ($favicon != null && $favicon['name'] !="") {
				$ext = strtolower(pathinfo($favicon['name'], PATHINFO_EXTENSION));
				$allowedExt = ['jpg', 'png', 'jpeg', 'gif', 'ico'];
				if (!in_array($ext, $allowedExt)) {
					return $this->redirect('admin/site/setting?msg=File favicon không hợp lệ.');
					die;
				}
				$favicon['name'] = "favicon.".$ext;
				move_uploaded_file($favicon['tmp_name'], 'public/images/'.$favicon['name']);
				$faviconModel = $site->where(['config_name', 'favicon'])->first();
				$faviconModel->config_value = $favicon['name'];
				$faviconModel->update();

			}
			

			$titleModel = $site->where(['config_name', 'title'])->first();
			$titleModel->config_value = $title;
			$titleModel->update();


			$titleModel = $site->where(['config_name', 'title'])->first();
			$titleModel->config_value = $title;
			$titleModel->update();

			$descriptionModel = $site->where(['config_name', 'description'])->first();
			$descriptionModel->config_value = $description;
			$descriptionModel->update();
			return $this->redirect('admin/site/setting?msg=Đã thay đổi thông tin website');

		}
	}
}

 ?>