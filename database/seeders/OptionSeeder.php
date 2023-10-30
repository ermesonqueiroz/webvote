<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    public function run(): void
    {
        Option::query()
            ->create([
                'description' => 'Opção 1',
                'votes_amount' => 0
            ])
            ->save();

        Option::query()
            ->create([
                'description' => 'Opção 2',
                'votes_amount' => 0
            ])
            ->save();
    }
}
