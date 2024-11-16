<?php
class User
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function register($username, $email, $password)
  {
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    $sql = "INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $passwordHash);
    return $stmt->execute();
  }

  public function login($email, $password)
  {
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_object();

    if ($user && password_verify($password, $user->password_hash)) {
      return $user;
    }

    return false;
  }
}
