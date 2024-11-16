<?php
function timeSince($timestamp)
{
  $timeDifference = time() - strtotime($timestamp);

  if ($timeDifference < 1) {
    return 'just now';
  }

  $timeUnits = [
    31536000 => 'year',
    2592000  => 'month',
    604800   => 'week',
    86400    => 'day',
    3600     => 'hour',
    60       => 'minute',
    1        => 'second'
  ];

  foreach ($timeUnits as $seconds => $unit) {
    $count = floor($timeDifference / $seconds);
    if ($count >= 1) {
      return $count . ' ' . $unit . ($count > 1 ? 's' : '') . ' ago';
    }
  }
}
