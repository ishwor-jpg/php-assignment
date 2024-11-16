<?php
class UserController extends Controller
{
  public function register()
  {
    $error = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      $user = $this->model('User');
      try {
        if ($user->register($username, $email, $password)) {
          header("Location: /user/login");
          exit;
        }
      } catch (Exception $e) {
        $error = $e->getMessage();
      }
    }

    $this->view('users/register', ['error' => $error]);
  }

  public function login()
  {
    $error = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email = $_POST['email'];
      $password = $_POST['password'];

      $user = $this->model('User');
      $authenticatedUser = $user->login($email, $password);

      if ($authenticatedUser) {
        session_start();
        $_SESSION['user_id'] = $authenticatedUser->user_id;
        $_SESSION['username'] = $authenticatedUser->username;
        header("Location: /post/index");
        exit;
      } else {
        $error = 'Invalid email or password';
      }
    }

    $this->view('users/login', ['error' => $error]);
  }

  public function logout()
  {
    session_start();
    session_destroy();
    header("Location: /post/index");
    // header("Location: /user/login");
    exit;
  }
}
