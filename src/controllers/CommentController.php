<?php
class CommentController extends Controller
{
  public function create()
  {
    session_start();
    if (!isset($_SESSION['user_id'])) {
      header("Location: /user/login");
      exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $postId = $_POST['post_id'];
      $userId = $_SESSION['user_id'];
      $content = $_POST['content'];

      $comment = $this->model('Comment');
      if ($comment->addComment($postId, $userId, $content)) {
        header("Location: /post/index");
        exit;
      }
    }
  }
}
