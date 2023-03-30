<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::insert([
            ['title' => 'Pending'],
            ['title' => 'Porcessing'],
            ['title' => 'On the way'],
            ['title' => 'Cancelled'],
            ['title' => 'Completed'],
            ['title' => 'Refunded'],
            ['title' => 'Returned'],
        ]);
    }
}