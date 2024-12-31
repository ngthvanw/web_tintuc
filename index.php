<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
require_once "vendor/autoload.php";
use controllers\BaseController;
use controllers\HomeController;
use controllers\AdminController;
use controllers\CategoryController;
use controllers\PostController;
use controllers\UserController;
use controllers\ForgotPasswordController;
use models\BaseModel;
use models\Category;
use models\Post;
use models\Config;
use models\User;
use models\ForgotPassword;

$url = isset($_GET['url']) == true ? $_GET['url'] : "/";
switch ($url) {
	case "/":
		$ctl = new HomeController();
		echo $ctl->index();
		break;
		
	case 'forgot-password':
		$ctl = new ForgotPasswordController();
		echo $ctl->form();
		break;
	case 'forgot-submit':
		$ctl = new ForgotPasswordController();
		$ctl->sendForgotEmail();
		break;
	case 'reset-password':
		$ctl = new ForgotPasswordController();
		echo $ctl->resetForm();
		break;
	case 'change-password':
		$ctl = new ForgotPasswordController();
		echo $ctl->changePass();
		break;

	case "post":
		$ctl = new PostController();
		echo $ctl->viewPost();
		break;
	case "search":
		$ctl = new PostController();
		echo $ctl->search();
		break;
	case "post/comment":
		$ctl = new PostController();
		echo $ctl->comment();
		break;
	case "category":
		$ctl = new CategoryController();
		echo $ctl->showPosts();
		break;
	case "admin":
		$ctl = new AdminController();
		echo $ctl->index();
		break;
	case "admin/site/setting":
		$ctl = new AdminController();
		echo $ctl->siteSetting();
		break;
	case "admin/users":
		$ctl = new AdminController();
		echo $ctl->userList();
		break;
	case "admin/users/delete":
		$ctl = new AdminController();
		echo $ctl->deleteUser();
		break;
	case "admin/site/saveSetting":
		$ctl = new AdminController();
		echo $ctl->saveSetting();
		break;
	case "admin/login":
		$ctl = new UserController();
		echo $ctl->loginForm();
		break;
	case "admin/loginProcess":
		$ctl = new UserController();
		echo $ctl->loginProcess();
		break;
	case "admin/registerProcess":
		$ctl = new UserController();
		echo $ctl->registerProcess();
		break;
	case "admin/logout":
		$ctl = new UserController();
		echo $ctl->logout();
		break;
	case "admin/posts":
		$ctl = new AdminController();
		echo $ctl->listPost();
		break;

	case "admin/posts/delete":
		$ctl = new AdminController();
		echo $ctl->removePost();
		break;
	case "admin/profile/edit":
		$ctl = new AdminController();
		echo $ctl->edit();
		break;
	case "admin/profile/saveEdit":
		$ctl = new AdminController();
		echo $ctl->saveEdit();
		break;
	case "admin/profile/editemail":
		$ctl = new AdminController();
		echo $ctl->changeEmail();
		break;
	case "admin/profile/editemailProcess":
		$ctl = new AdminController();
		echo $ctl->editemailProcess();
		break;
	case "admin/profile/editpassword":
		$ctl = new AdminController();
		echo $ctl->changePassword();
		break;
	case "admin/profile/editpasswordProcess":
		$ctl = new AdminController();
		echo $ctl->editpasswordProcess();
		break;
	case "admin/posts/update":
		$ctl = new AdminController();
		echo $ctl->updatePost();
		break;
	case "admin/posts/add":
		$ctl = new AdminController();
		echo $ctl->addNewPost();
		break;
	case "admin/posts/save":
		$ctl = new AdminController();
		echo $ctl->savePost();
		break;
	case "admin/category/add":
		$ctl = new AdminController();
		echo $ctl->addNewCategory();
		break;
	case "admin/category/save":
		$ctl = new AdminController();
		echo $ctl->saveCategory();
		break;
	case "admin/category":
		$ctl = new AdminController();
		echo $ctl->listCategory();
		break;
	case "admin/category/delete":
		$ctl = new AdminController();
		echo $ctl->removeCategory();
		break;
	case "admin/category/update":
		$ctl = new AdminController();
		echo $ctl->updateCategory();
		break;
	default:
		$msg = "Trang bạn tìm kiếm không có thật. Vui lòng liên hệ với ban quản trị.";
		require_once 'views/404.php';
		break;
}


  ?>


