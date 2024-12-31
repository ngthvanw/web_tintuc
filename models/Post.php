<?php 
namespace models;
/**
* 
*/
class Post extends BaseModel
{
	public $tableName = 'posts';

	public $columns = [	'title', 'detail', 'thumbnail', 
						'post_time', 'post_url', 'category_id', 'user_id', 'id', 'views'];
	
	public function author(){
		$owner = \models\User::findOne($this->user_id)->fullname;
		return $owner;
	}
	public function owner(){
		$owner = \models\User::findOne($this->user_id)->fullname;
		return $owner;
	}
	public function category(){
		$category = \models\Category::findOne($this->category_id)->category_name;
		return $category;
	}
	public function comment(){
		$comment = \models\Comment::where(['post_id', $this->id])->get();
		return $comment;
	}
}

 ?>
