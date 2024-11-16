<?php

function NavBar()
{
?>
  <nav class="border-b border-border">
    <div class="container py-2 flex justify-between items-center">
      <a href="/post/index" class="flex gap-2 items-center text-foreground">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary">
          <path d="M14 9a2 2 0 0 1-2 2H6l-4 4V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2z" />
          <path d="M18 9h2a2 2 0 0 1 2 2v11l-4-4h-6a2 2 0 0 1-2-2v-1" />
        </svg>
        <span class="font-semibold text-xl">
          DisBoard
        </span>
      </a>
      <div class="space-x-2 text-foreground">
        <?php if (isset($_SESSION['user_id'])): ?>
          Welcome, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
          <a href="/user/logout" class="h-10 px-4 py-2 inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-full text-sm font-medium bg-background text-primary hover:bg-muted ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2">
            Logout
          </a>
        <?php else: ?>
          <a href="/user/register" class="h-10 px-4 py-2 inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-full text-sm font-medium bg-background text-primary hover:bg-muted ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2">
            Register
          </a>
          <a href="/user/login" class="h-10 px-4 py-2 inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-full text-sm font-medium bg-primary text-primary-foreground hover:bg-primary/90 ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2">
            Login
          </a>
        <?php endif; ?>
      </div>
    </div>
  </nav>
<?php
}
