<?php
$lines = file('storage/logs/laravel.log');
$lastLines = array_slice($lines, -100);
file_put_contents('test_log.txt', implode("", $lastLines));
//Edit Bayu 3/31/2026 Perbaikan Log Login