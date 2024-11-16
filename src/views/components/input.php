<?php

function Input($id, $name, $type = "text", $placeholder = "")
{
  echo <<<HTML
  <input
    class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
    required
    id={$id}
    type={$type}
    name={$name}
    placeholder={$placeholder}
    >
  HTML;
}
