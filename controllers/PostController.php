<?php 
namespace controllers;
/**
* Controller cho bài viết cho webiste
*/
class PostController extends BaseController
{
	
	function viewPost()
	{	
		$id = isset($_GET['id'])==true?$_GET['id']:null;
		if ($id) {
			$post = \models\Post::findOne($id);
			if (!$post) {
				return $this->render("views/404.php");
			}
			else{
				if (!isset($_SESSION['views'][$id])) {
					$_SESSION['views'][$id] = 'ok';
					$post->views = $post->views+1;
					$post->update();
				}
				$commentModel = $post->comment();
				$comment = $this->render("views/post/comment.php", compact('commentModel', 'id'));
				$sidebar = 'views/layout/sidebar.php';
				$title = $post->title;
				return $this->render("views/post/post.php", compact("post", "sidebar", "comment", "commentModel", "title"), "views/layout/layout.php");
			}

		}else{
			return $this->render("views/404.php");
		}
		
	}
	public function comment()
	{
		$id = isset($_GET['id'])==true?$_GET['id']:null;
		if (!$id) {
			return $this->redirect('post?id='.$id);
		}
		$message = isset($_POST['message'])==true?$_POST['message']:null;
		$name = isset($_POST['name'])==true?$_POST['name']:null;
		$email = isset($_POST['email'])==true?$_POST['email']:null;
		if ($message == null || $name == null || $email == null) {
			return $this->redirect('post?id='.$id.'&msg=Vui lòng nhập đủ thông tin.');
		}
		$quest = ['name' => $name, 'email' => $email];
		if (!isset($_SESSION['comment'])) {
			$_SESSION['comment'] = json_encode($quest);
		}
		$comment = new \models\Comment();
		$comment->quest = json_encode($quest);
		$comment->message = $message;
		$comment->post_id = $id;
		$comment->comment_time = date('Y:m:d H:i:s');
		$comment->insert();
		return $this->redirect('post?id='.$id);
	}
	public function search()
	{
		$keyword = isset($_GET['keyword'])==true?$_GET['keyword']:null;
		if ($keyword) {
			$postSearch = \models\Post::where(['title', 'like', '%'.$keyword.'%'])->get();
			return $this->render('views/post/search.php', compact('postSearch'));
		}
	}

}

 ?>