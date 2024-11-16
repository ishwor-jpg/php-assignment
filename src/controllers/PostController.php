<?php
class PostController extends Controller
{
  public function index()
  {
    $post = $this->model('Post');
    $posts = $post->getPosts();
    $this->view('posts/index', ['posts' => $posts]);
  }


  public function create()
  {
    session_start();
    if (!isset($_SESSION['user_id'])) {
      header("Location: /user/login");
      exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $title = $_POST['title'];
      $content = $_POST['content'];
      $user_id = $_SESSION['user_id'];

      $post = $this->model('Post');
      if ($post->createPost($title, $content, $user_id)) {
        header("Location: /post/index");
        exit;
      }
    }
  }

  public function delete($id)
  {
    session_start();
    if (!isset($_SESSION['user_id'])) {
      header("Location: /user/login");
      exit;
    }

    $post = $this->model('Post');
    $post->deletePost($id);
    header("Location: /post/index");
    exit;
  }
}
