<?php 
namespace controllers;
/**
* Controller cho trang chủ cho webiste
*/
class CategoryController extends BaseController
{
	
	public function showPosts()
	{
		$id = isset($_GET['id'])==true?$_GET['id']:null;
		$category = \models\Category::findOne($id);
		$title = $category->category_name;
		$post = new \models\Post();
		$total = count($post->where(['category_id', $id])->get());
		$config = \models\Config::where(['config_name', 'numofpost'])->get();
		$numofpost = $config[0]->config_value;
		$allpages = ceil($total/$numofpost);
		$currentpage = isset($_GET['page'])==true?$_GET['page']:0;
		$post = $post->where(['category_id', $id])->limit([$currentpage*$numofpost, $numofpost])->get();
		$sidebar = 'views/layout/sidebar.php';
		return $this->render('views/category/showposts.php', compact('id', 'post', "allpages", "currentpage", 'category', 'sidebar', 'title'), "views/layout/layout.php");
	}

}

 ?>