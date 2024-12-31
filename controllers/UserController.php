<?php 
namespace controllers;

/**
* Class dùng để quản lý trang quản trị
*/
class UserController extends BaseController
{

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
				return $this->redirect('admin/login?msg=Your username or password do not correct');
				die;
			}
			if (hash_equals(md5($password), $user->password)) {
				$_SESSION['user'] = json_encode($user);
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
	public function registerProcess()
	{
		if (isset($_POST['register-submit'])) {

			$username = isset($_POST['username'])==true?$_POST['username']:null;
			$email = isset($_POST['email'])==true?$_POST['email']:null;
			$fullname = isset($_POST['fullname'])==true?$_POST['fullname']:null;
			$about = isset($_POST['about'])==true?$_POST['about']:null;
			$avatar =isset($_FILES['avatar'])==true?$_FILES['avatar']:null;
			$password = isset($_POST['password'])==true?$_POST['password']:null;
			$cf_password = isset($_POST['cf_password'])==true?$_POST['cf_password']:null;
			if ($username == null || $email == null || $fullname == null || $password == null || $cf_password == null || $avatar['name'] == "") {
				return $this->redirect('admin/login?msg=Please enter all of information&action=1');
				die;
			}
			if ($password !== $cf_password) {
				return $this->redirect('admin/login?msg=Your password is not the same&action=1');
				die;
			}
			$ext = pathinfo($avatar['name'], PATHINFO_EXTENSION);
			$allowedExt = ['jpg', 'png', 'jpeg', 'gif'];
			if (!in_array($ext, $allowedExt)) {
				return $this->redirect('admin/login?msg=Invaild images format&action=1');
				die;
			}
			$avatar['name'] = 'IMG_'.md5(uniqid().$avatar['name'].rand(1,1000)).'.'.$ext;
			move_uploaded_file($avatar['tmp_name'], 'public/images/uploaded/'.$avatar['name']);
			$user = new \models\User();
			$checkUsername = \models\User::where(['username', $username])->get();
			if (count($checkUsername)>1) {
				return $this->redirect('admin/login?msg=Your username is already used. Please register again.&action=1');
				die;
			}
			$user->username = $username;
			$user->email = $email;
			$user->fullname = $fullname;
			$user->about = $about;
			$user->avatar = $avatar['name'];
			$user->password = md5($password);
			$user->insert();
			return $this->redirect('admin/login?msg=Your account is already registered. Please login. ');
		}
	}
	public function logout()
	{
		$_SESSION['user'] = null;
		setcookie("remember_token", "", time() - 3600*24*10, "/");
		$_COOKIE['remember_token'] = null;
		return $this->redirect('admin/login?msg=You have been logged out.');
	}
}

 ?>