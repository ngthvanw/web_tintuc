<?php 
namespace models;
/**
* 
*/
class Category extends BaseModel
{
	public $tableName = 'categories';

	public $columns = [	'id','category_name', 'category_url'];

	public function getPostsOfCate() {

		$post = new \models\Post();

		$mypost = $post->where(['category_id', $this->id])->orderBy(['post_time', 'desc'])->get();

		return $mypost;

	}
	public function countPost()
	{
		return count($this->getPostsOfCate());
	}
}

 ?>
