<?php 
namespace models;
/**
* 
*/
class Comment extends BaseModel
{
	public $tableName = 'comments';

	public $columns = [	'id', 'user_id', 'post_id', 
						'message', 'comment_time', 'quest'];
	public function user(){
		$owner = \models\User::findOne($this->user_id)->fullname;
		return $owner;
	}
}

 ?>
