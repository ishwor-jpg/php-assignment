<?php
class Database
{
  private $host = '127.0.0.1';
  private $dbname = 'disboard';
  private $username = 'root';
  private $password = 'root';
  private $conn;

  public function __construct()
  {
    $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }

  public function query($sql)
  {
    return $this->conn->query($sql);
  }

  public function prepare($sql)
  {
    return $this->conn->prepare($sql);
  }

  public function close()
  {
    $this->conn->close();
  }
}
