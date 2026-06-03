<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$courses = \App\Models\ShortCourse::select('title', 'course_type', 'price')->get();
foreach ($courses as $course) {
    echo "Title: {$course->title} | Type: {$course->course_type} | Price: {$course->price}\n";
}
