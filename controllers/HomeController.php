<?php 
namespace controllers;
/**
* Controller cho trang chủ cho webiste
*/
class HomeController extends BaseController
{
	
	function index()
	{	
		$postmodel = new \models\Post();
		$total = count($postmodel->all());
		$config = \models\Config::where(['config_name', 'numofpost'])->get();
		$numofpost = $config[0]->config_value;
		$allpages = ceil($total/$numofpost);
		$currentpage = isset($_GET['page'])==true?$_GET['page']:0;
		$post = $postmodel->where()->orderBy(['post_time', 'desc'])->limit([$currentpage*$numofpost, $numofpost])->get();
		$sidebar = 'views/layout/sidebar.php';
		$hotnews = $this->hotNews();
		$site = new \models\Config();
		$toppost = $postmodel->where()->orderBy(['views', 'desc'])->limit([5])->get();
		$title = $site->where(['config_name', 'title'])->first()->config_value;
		$description = $site->where(['config_name', 'description'])->first()->config_value;
		$favicon = $site->where(['config_name', 'favicon'])->first()->config_value;
		return $this->render("views/homepage.php", compact("post", "allpages", "currentpage", "sidebar", 'hotnews', 'title', 'description', 'favicon', 'toppost'), "views/layout/layout.php");
	}
	public function hotNews()
	{
		$post = new \models\Post();
		$toponepost = $post->where()->orderBy(['views', 'desc'])->first(); 
		$top4post = $post->where()->orderBy(['views', 'desc'])->limit([1, 3])->get();
		return $this->render("views/hotnews.php", compact('toponepost', 'top4post'));
	}

}

 ?>