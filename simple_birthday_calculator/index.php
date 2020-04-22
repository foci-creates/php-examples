<?php 

$targetDays = mktime(10, 25, 0, 05, 10, 2020);

$today = time();

$differenceDays = ($targetDays - $today);

$days = (int)($differenceDays / 86400);

echo "Days till next birthady: " . $days . " days!";