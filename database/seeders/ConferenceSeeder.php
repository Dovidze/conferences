<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Conference;
use Carbon\Carbon;

class ConferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Conference::create([
            'title' => 'Pirmoji konferencija',
            'description' => 'Ši konferencija kalbės apie programavimą.',
            'start_time' => Carbon::now()->addDays(1),
            'end_time' => Carbon::now()->addDays(1)->addHours(2),
            'date' => now()->format('Y-m-d'),
            'user_id' => 1
        ]);

        Conference::create([
            'title' => 'Antroji konferencija',
            'description' => 'Ši konferencija kalbės apie naujausias technologijas.',
            'start_time' => Carbon::now()->addDays(3),
            'end_time' => Carbon::now()->addDays(3)->addHours(2),
            'date' => now()->format('Y-m-d'),
            'user_id' => 1
        ]);
    }
}
