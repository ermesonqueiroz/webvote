<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    public function run(): void
    {
        Option::create([
            'title' => 'Vasco',
            'description' => 'O Gigante da Colina',
            'votes_amount' => 0
        ]);

        Option::create([
            'title' => 'Flamengo',
            'description' => 'Mengão',
            'votes_amount' => 0
        ]);
    }
}
