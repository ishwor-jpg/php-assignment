<?php
session_start();
include_once 'views/components/html-head.php';
include_once 'views/components/input.php';
include_once 'views/components/label.php';
include_once 'views/components/button.php';
?>

<!DOCTYPE html>
<html lang="en">

<?php
HtmlHead('Disboard | Login');
?>

<body class="container bg-background">
  <div class="grid place-items-center h-screen">
    <form action="/user/login" method="post" class="p-6 border border-border rounded-lg w-full max-w-[400px] space-y-4">
      <div class="space-y-2">
        <h1 class="font-bold text-foreground text-2xl">Login</h1>
        <p class="text-muted-foreground">
          Login to your account.
        </p>
      </div>
      <div class="space-y-2">
        <?php
        Label("email", "Email");
        Input("email", "email", "email", "example@mail.com");
        ?>
      </div>
      <div class="space-y-2">
        <?php
        Label("password", "Password");
        Input("password", "password", "password");
        ?>
      </div>
      <?php if (!empty($data['error'])): ?>
        <p style="color: red;"><?php echo $data['error']; ?></p>
      <?php endif; ?>
      <?php
      Button("submit", "Login", "w-full");
      ?>
      <div class="mt-4 text-foreground text-center text-sm">
        Don&apos;t have an account?
        <a href="/user/register" class="underline">
          Register
        </a>
      </div>
    </form>
  </div>
</body>

</html>