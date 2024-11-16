<?php
session_start();
include_once 'views/components/html-head.php';
include_once 'views/components/nav-bar.php';
include_once 'views/components/input.php';
include_once 'views/components/label.php';
include_once 'views/components/button.php';
include_once 'views/components/post-card.php';
include_once 'views/components/comment-card.php';
include_once 'core/Helpers.php';
?>

<!DOCTYPE html>
<html lang="en">

<?php
HtmlHead('Disboard | Posts');
?>

<body class="bg-background">
  <?php NavBar(); ?>
  <div class="container py-6 space-y-4">
    <div id="page-header-slot" class="flex justify-between items-center">
      <h1 class="text-foreground text-2xl font-semibold">All Posts</h1>
      <button
        id="new-post-button"
        class="h-10 px-4 py-2 inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-full text-sm font-medium bg-primary text-primary-foreground hover:bg-primary/90 ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z" />
        </svg>
        <span class="font-semibold">
          New Post
        </span>
      </button>
    </div>

    <form id="new-post-form" action="/post/create" method="post" class="hidden border border-border space-y-4 rounded-lg p-6">
      <div class="space-y-2">
        <?php
        Label("title", "Title");
        Input("title", "title", "text", "Enter a title");
        ?>
      </div>
      <div class="space-y-2">
        <?php
        Label("content", "Content");
        Input("content", "content", "textarea", "Enter your post content");
        ?>
      </div>
      <div class="flex gap-2 justify-end">
        <button id="cancel-button" type="reset" class="h-10 px-4 py-2 text-primary">
          Cancel
        </button>
        <?php
        Button("submit", "Create Post");
        ?>
      </div>
    </form>

    <ul class="space-y-4">
      <?php foreach ($data['posts'] as $post): ?>
        <li class="border border-border p-4 rounded-lg">
          <?php PostCard($post); ?>
          <?php CommentCard($post); ?>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>

  <script>
    const slot = document.getElementById('page-header-slot');
    const newPostForm = document.getElementById('new-post-form');
    const newPostButton = document.getElementById('new-post-button');
    const cancelButton = document.getElementById('cancel-button');

    newPostButton.addEventListener('click', () => {
      newPostForm.classList.remove('hidden');
      slot.classList.add('hidden');
    });

    cancelButton.addEventListener('click', () => {
      newPostForm.classList.add('hidden');
      slot.classList.remove('hidden');
    });

    document.querySelectorAll('#comment-count').forEach((commentCount) => {
      commentCount.addEventListener('click', () => {
        const commentSlot = commentCount.closest('li').querySelector('#comment-slot');
        commentSlot.classList.toggle('hidden');
      });
    });
  </script>
</body>

</html>