<?php
$logFile = __DIR__ . '/storage/logs/laravel.log';
if (file_exists($logFile)) {
    $lines = file($logFile);
    $lastLines = array_slice($lines, -25);
    echo implode("", $lastLines);
} else {
    echo "No log file found.";
}
