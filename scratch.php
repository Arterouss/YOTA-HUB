<?php
$seminars = \App\Models\Seminar::where('type', 'E-Learning')->get();
foreach($seminars as $s) {
    \App\Models\ShortCourse::firstOrCreate(
        ['title' => $s->title],
        [
            'id' => \Illuminate\Support\Str::uuid(),
            'description' => $s->description,
            'course_type' => 'free',
            'organizer' => 'YOTA Hub',
            'duration_start' => now(),
            'duration_end' => now()->addMonths(3),
            'certificate_available' => true,
            'quota_total' => 100,
            'quota_remaining' => 100,
            'price' => 0,
            'status' => 'open'
        ]
    );
}
echo 'Migrasi mantap!';
