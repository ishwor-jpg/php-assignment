<?php

class Comment
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getCommentsByPostId($postId)
  {
    $sql = "SELECT comments.*, users.username FROM comments 
            JOIN users ON comments.user_id = users.id 
            WHERE comments.post_id = ? 
            ORDER BY comments.created_at ASC";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    $result = $stmt->get_result();

    $comments = [];
    if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_object()) {
        $comments[] = $row;
      }
    }

    return $comments;
  }

  public function addComment($postId, $userId, $content)
  {
    $sql = ('INSERT INTO comments (post_id, user_id, content) VALUES (?, ?, ?)');
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("iis", $postId, $userId, $content);
    return $stmt->execute();
  }
}
