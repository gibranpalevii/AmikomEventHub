<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\User::firstOrCreate(
            ['email' => 'admin@amikom.ac.id'],
            [
                'name' => 'Admin Amikom',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );

        $seminar = \App\Models\Category::firstOrCreate(
            ['slug' => 'seminar-it'],
            ['name' => 'Seminar IT']
        );

        $entertainment = \App\Models\Category::firstOrCreate(
            ['slug' => 'entertainment'],
            ['name' => 'Entertainment']
        );

        $workshop = \App\Models\Category::firstOrCreate(
            ['slug' => 'workshop'],
            ['name' => 'Workshop']
        );

        \App\Models\Event::insert([
            [
                'category_id' => $entertainment->id,
                'title' => 'Jazz Night 2026',
                'description' => 'Nikmati malam dengan alunan musik jazz yang santai.',
                'date' => '2026-05-10 19:00:00',
                'location' => 'Amikom Baru',
                'price' => 50000,
                'stock' => 100,
                'poster_path' => 'posters/event-1.png',
            ],
            [
                'category_id' => $seminar->id,
                'title' => 'Hackathon Developer Fest',
                'description' => 'Asah skill coding dan buat inovasi digital.',
                'date' => '2026-05-05 10:00:00',
                'location' => 'Inkubator Amikom',
                'price' => 50000,
                'stock' => 100,
                'poster_path' => 'posters/event-2.png',
            ],
            [
                'category_id' => $seminar->id,
                'title' => 'AI & Future Tech Summit',
                'description' => 'Bahas tren AI dan teknologi masa depan.',
                'date' => '2026-05-01 13:00:00',
                'location' => 'Cinema Unit 6',
                'price' => 50000,
                'stock' => 100,
                'poster_path' => 'posters/event-3.png',
            ],
            [
                'category_id' => $workshop->id,
                'title' => 'UI/UX Masterclass',
                'description' => 'Belajar desain UI/UX dari nol sampai mahir.',
                'date' => '2026-06-01 09:00:00',
                'location' => 'Lab Multimedia',
                'price' => 75000,
                'stock' => 50,
                'poster_path' => 'posters/event-4.png',
            ],
            [
                'category_id' => $entertainment->id,
                'title' => 'E-Sport U-Champ',
                'description' => 'Turnamen e-sport terbesar antar mahasiswa.',
                'date' => '2026-06-10 13:00:00',
                'location' => 'Hall Amikom',
                'price' => 25000,
                'stock' => 200,
                'poster_path' => 'posters/event-5.png',
            ],
            [
                'category_id' => $seminar->id,
                'title' => 'Cyber Security Talk',
                'description' => 'Belajar keamanan digital dari praktisi IT.',
                'date' => '2026-06-15 10:00:00',
                'location' => 'Auditorium',
                'price' => 40000,
                'stock' => 120,
                'poster_path' => 'posters/event-6.png',
            ],
        ]);
    }
}