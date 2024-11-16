<?php

function Label($for, $text)
{
  echo <<<HTML
  <label
    class="text-sm text-foreground font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
    required
    for={$for}
    >
    {$text}
  </label>
  HTML;
}
