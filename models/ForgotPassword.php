<?php 
namespace models;
/**
* 
*/
class ForgotPassword extends BaseModel
{
	public $tableName = 'forgot_password';

	public $columns = [	'email', 'token', 'created_date'];
	
}

 ?>
