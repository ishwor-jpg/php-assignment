<?php
include_once 'core/Helpers.php';

function PostCard($post)
{
?>
  <h1 class="text-xl text-foreground font-semibold hover:underline">
    <?php echo htmlspecialchars($post->title); ?>
  </h1>
  <p class="text-muted-foreground line-clamp-2">
    <?php echo htmlspecialchars($post->content); ?>
  </p>
  <div class="flex justify-between mt-4">
    <button type="button" id="comment-count" class="flex gap-1 items-center text-sm text-muted-foreground hover:text-primary">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z" />
      </svg>
      <span>
        <?php echo count($post->comments); ?>
        replies
      </span>
    </button>
    <div class="flex items-center text-sm text-gray-500">
      Posted by&nbsp;
      <a href="#" class="text-primary hover:underline underline-offset-2">
        @<?php echo htmlspecialchars($post->author); ?>
      </a>
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12.1" cy="12.1" r="1" />
      </svg>
      <?php echo timeSince($post->created_at); ?>
    </div>
  </div>
<?php
}
