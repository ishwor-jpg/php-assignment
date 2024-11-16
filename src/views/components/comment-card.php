<?php
include_once 'core/Helpers.php';

function CommentCard($post)
{
?>
  <div id="comment-slot" class="space-y-4 mt-4 hidden">
    <hr class="border-border" />
    <h2 class="text-xl text-foreground font-semibold mb-4">Comments</h2>
    <ul class="space-y-4">
      <?php foreach ($post->comments as $comment): ?>
        <li class="bg-muted rounded-lg p-4">
          <div class="flex items-center text-sm text-gray-500">
            <a href="#" class="text-primary font-semibold hover:underline underline-offset-2">
              @<?php echo htmlspecialchars($comment->author); ?>
            </a>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12.1" cy="12.1" r="1" />
            </svg>
            <?php echo timeSince($comment->created_at); ?>
          </div>
          <p class="text-muted-foreground">
            <?php echo htmlspecialchars($comment->content); ?>
          </p>
        </li>
      <?php endforeach; ?>
    </ul>
    <form action="/comment/create" method="post" class="flex gap-2">
      <input type="hidden" name="post_id" value="<?php echo $post->post_id; ?>" />
      <?php
      Input("content", "content", "textarea", "Write a comment...");
      Button("submit", "Comment");
      ?>
    </form>
  </div>
<?php
}
