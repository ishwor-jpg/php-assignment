<?php

function Button($type, $text, $class = "")
{
  echo <<<HTML
  <button
    type={$type}
    class="h-10 px-4 py-2 inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-[2rem] text-sm font-medium bg-primary text-primary-foreground hover:bg-primary/90 ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 {$class}"
  >
    {$text}
  </button>
  HTML;
}
