<?php
$events = [
    [
        'id' => 1,
        'title' => 'Web Development Workshop',
        'date' => '2026-08-10',
        'time' => '10:00 AM',
        'location' => 'Computer Lab 1',
        'category' => 'Workshop',
        'seats' => 30,
        'description' => 'A practical workshop introducing students to HTML, CSS, responsive design, and basic PHP development.'
    ],
    [
        'id' => 2,
        'title' => 'Cybersecurity Awareness Seminar',
        'date' => '2026-08-15',
        'time' => '12:00 PM',
        'location' => 'Main Hall',
        'category' => 'Seminar',
        'seats' => 80,
        'description' => 'A seminar covering password security, phishing awareness, safe browsing, and protection of personal information.'
    ],
    [
        'id' => 3,
        'title' => 'Programming Competition',
        'date' => '2026-08-20',
        'time' => '09:00 AM',
        'location' => 'Innovation Center',
        'category' => 'Competition',
        'seats' => 50,
        'description' => 'A friendly programming competition where students solve logical and coding challenges in teams.'
    ],
    [
        'id' => 4,
        'title' => 'University Technology Trip',
        'date' => '2026-08-25',
        'time' => '08:00 AM',
        'location' => 'University Main Gate',
        'category' => 'Trip',
        'seats' => 40,
        'description' => 'An educational visit to a local technology company to learn about real-world IT operations and careers.'
    ],
    [
        'id' => 5,
        'title' => 'Artificial Intelligence Talk',
        'date' => '2026-09-01',
        'time' => '11:00 AM',
        'location' => 'Lecture Hall B',
        'category' => 'Seminar',
        'seats' => 100,
        'description' => 'An introductory talk about artificial intelligence, machine learning, and their impact on modern industries.'
    ],
    [
        'id' => 6,
        'title' => 'UI/UX Design Challenge',
        'date' => '2026-09-05',
        'time' => '01:00 PM',
        'location' => 'Design Studio',
        'category' => 'Competition',
        'seats' => 35,
        'description' => 'Students create and present a simple user interface prototype for a university service.'
    ]
];

function findEventById(array $events, int $id): ?array
{
    foreach ($events as $event) {
        if ((int)$event['id'] === $id) {
            return $event;
        }
    }
    return null;
}
