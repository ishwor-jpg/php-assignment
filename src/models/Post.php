<?php
class Post
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getPosts()
  {
    $sql = "SELECT 
              posts.post_id AS post_id,
              posts.title AS post_title,
              posts.content AS post_content,
              posts.created_at AS post_created_at,
              users.username AS post_author,
              comments.comment_id AS comment_id,
              comments.content AS comment_content,
              comments.created_at AS comment_created_at,
              commenters.username AS comment_author
            FROM posts
            LEFT JOIN users ON posts.user_id = users.user_id
            LEFT JOIN comments ON comments.post_id = posts.post_id
            LEFT JOIN users AS commenters ON comments.user_id = commenters.user_id
            ORDER BY posts.created_at DESC, comments.created_at ASC";

    $result = $this->db->query($sql);

    $posts = [];
    if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_object()) {
        if (!isset($posts[$row->post_id])) {
          $post = new stdClass();
          $post->post_id = $row->post_id;
          $post->title = $row->post_title;
          $post->content = $row->post_content;
          $post->created_at = $row->post_created_at;
          $post->author = $row->post_author;
          $post->comments = [];
          $posts[$row->post_id] = $post;
        }

        if ($row->comment_id) {
          $comment = new stdClass();
          $comment->id = $row->comment_id;
          $comment->content = $row->comment_content;
          $comment->created_at = $row->comment_created_at;
          $comment->author = $row->comment_author;

          $posts[$row->post_id]->comments[] = $comment;
        }
      }
    }

    return array_values($posts);
  }

  public function getPostById($id)
  {
    $sql = "SELECT posts.*, users.username AS author FROM posts
            LEFT JOIN users ON posts.user_id = users.user_id
            WHERE posts.post_id = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_object();
  }

  public function createPost($title, $content, $user_id)
  {
    $sql = "INSERT INTO posts (title, content, user_id) VALUES (?, ?, ?)";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("ssi", $title, $content, $user_id);
    return $stmt->execute();
  }

  public function deletePost($post_id)
  {
    $sql = "DELETE FROM posts WHERE post_id = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("i", $post_id);
    return $stmt->execute();
  }
}
