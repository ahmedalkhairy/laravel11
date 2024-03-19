<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            PromptsSeeder::class,
            PromptPropertiesSeeder::class,
            SettingsSeeder::class,
            CategorySeeder::class,
            CategoryAttributeSeeder::class,
            ChatGptSettingsSeeder::class,
        ]);

    }
}
