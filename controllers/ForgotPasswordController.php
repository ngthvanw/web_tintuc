<?php
namespace controllers;

/**
* 
*/
use models\ForgotPassword;
use models\User;
require 'lib/PHPMailer/src/Exception.php';
require 'lib/PHPMailer/src/PHPMailer.php';
require 'lib/PHPMailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class ForgotPasswordController extends BaseController
{
	public function form()
	{
		return $this->render('views/user/forgot-password.php');
	}
	function sendForgotEmail(){
		$email = $_POST['email'];
		$user = User::where(['email', '=', $email])->first();
		if(!$user){
			echo "Da gui email, ban vui long kiem tra de lay lai mat khau!";
			die;
		}

		$forgotModel = ForgotPassword::where(['email', '=', $email])->first();
		if($forgotModel){
			$forgotModel->delete();
		}
		$forgotModel = new ForgotPassword();
		$forgotModel->email = $email;
		$token = md5($email.microtime());
		$forgotModel->token = $token;
		$forgotModel->created_date = date('Y-m-d H:i:s'); 
		$forgotModel->insert();

		$mail = new PHPMailer(true);
		$email = $email; // email nhan 
		$name = $user->username; // ten ng nhan

		$email_from = 'tiennvph05036@fpt.edu.vn'; // email gui va nhan reply
		$name_from = 'Admin';
		//Send mail using gmail
		// if($send_using_gmail){
		    $mail->IsSMTP(); // telling the class to use SMTP
		   	$mail->IsHTML(true);
		    $mail->SMTPAuth = true; // enable SMTP authentication
		    $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
		    $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
		    $mail->Port = 465; // set the SMTP port for the GMAIL server
		    $mail->Username = "tiennvph05036@fpt.edu.vn"; // GMAIL username
		    $mail->Password = "0509940231998TT"; // GMAIL password
		// }
		 
		//Typical mail data
		$mail->AddAddress($email, $name);
		$mail->SetFrom($email_from, $name_from);
		$mail->Subject = "Lay lai mat khau";
		$mail->Body = '<!DOCTYPE html>
		<html>
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<title></title>
			<link rel="stylesheet" href="">
		</head>
		<body>
			<h1>Xin chao '.$user->username.',</h1>
			<strong>Vui long click vao duong dan duoi day de khoi tao lai mat khau cua ban:</strong>
			<a href="'.getUrl('reset-password?token='.$token).'">Click here</a>
			<p>Duong dan nay chi ton tai trong 24 gio.</p>
		</body>
		</html>';
		 
		try{
		    $mail->Send();
		} catch(Exception $e){
		    //Something went bad
		    echo "Fail :(";
		}


		echo "Da gui email, ban vui long kiem tra de lay lai mat khau!";
		die;

	}
	
	function resetForm(){
		$token = isset($_GET['token'])==true?$_GET['token']:null;
		if (!$token) {
			echo '<a href="'.getUrl('forgot-password').'">Vui lòng bấm vào đây để lấy lại mật khẩu</a>';
			die;
		}
		$forgotModel = ForgotPassword::where(['token', '=', $token])->first();
		if (!$forgotModel) {
			echo "Link của bạn không hợp lệ hoặc đã hết hạn. Vui lòng tạo lệnh mới để lấy lại mật khẩu";
			die;
		}
		// kiểm tra thời gian hiện tại và thời gian created_date có nhiều hơn 24h hay không?
		// nếu lớn hơn thì đưa ra thông báo link này đã hết hạn
		$timenow = date("Y:m:d H:i:s");
		$created_date = strtotime($forgotModel->created_date);
		$expired_date = date("Y-m-d H:i:s", $created_date + 60*60*24);
		if (strtotime($expired_date) < strtotime($timenow)) {
			echo "Link của bạn đã hết hạn. Vui lòng tạo lệnh mới để lấy lại mật khẩu";
			die;
		}
		// nếu nhỏ hơn 24h thì tiến hành hiển thị form để người dùng tạo mật khẩu mới đi kèm với hidden field chứa token
		return $this->render('views/user/change-password.php', compact('token'));

		// submit form để đổi mật khẩu của người dùng. Nhớ cần mã hóa md5
	}
	public function changePass()
	{
		$token = isset($_POST['token'])==true?$_POST['token']:null;
		if (!$token) {
			echo '<a href="'.getUrl('forgot-password').'">Vui lòng bấm vào đây để lấy lại mật khẩu</a>';
			die;
		}
		$forgotModel = ForgotPassword::where(['token', '=', $token])->first();
		if (!$forgotModel) {
			echo "Link của bạn không hợp lệ hoặc đã hết hạn. Vui lòng tạo lệnh mới để lấy lại mật khẩu";
			die;
		}
		$password = isset($_POST['password'])==true?$_POST['password']:null;
		$repassword = isset($_POST['repassword'])==true?$_POST['repassword']:null;
		if ($password  !== $repassword) {
			return $this->redirect('reset-password?token='.$token.'&msg=Mật khẩu phải giống nhau');
		}
		$email = $forgotModel->email;
		$user = User::where(['email', '=', $email])->first();
		$user->password = md5($password);
		$user->update();
		$forgotModel->created_date =  date("Y-m-d H:i:s", $forgotModel->created_date - 60*60*24);
		$forgotModel->update();
		return $this->redirect('admin/login?msg=Đổi mật khẩu thành công. Vui lòng đăng nhập');
	}


}


  ?>

