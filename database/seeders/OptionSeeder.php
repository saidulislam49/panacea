<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Option::insert([
            ['title' => 'site_title', 'value' => 'Default'],
            ['title' => 'slogan', 'value' => 'Default'],
            ['title' => 'address', 'value' => 'Default'],
            ['title' => 'logo', 'value' => 'Default'],
            ['title' => 'favicon', 'value' => 'Default'],
            ['title' => 'phone_1', 'value' => 'Default'],
            ['title' => 'phone_2', 'value' => 'Default'],
            ['title' => 'email_1', 'value' => 'default@gmail.com'],
            ['title' => 'email_2', 'value' => 'default@gmail.com'],
            ['title' => 'fb', 'value' => 'Default'],
            ['title' => 'youtube', 'value' => 'Default'],
            ['title' => 'twitter', 'value' => 'Default'],
            ['title' => 'linkedin', 'value' => 'Default'],
            ['title' => 'telegram', 'value' => 'Default'],
            ['title' => 'whats_app', 'value' => 'Default'],
            ['title' => 'instagram', 'value' => 'Default'],
        ]);
    }
}