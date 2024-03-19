<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChatGptSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'OPENAI_API_KEY',
                'value' => '',
                'group' => 'ChatGpt',
            ],
            [
                'key' => 'CHAT_GPT_PROMPT',
                'value' => '', // Replace with your actual API key
                'group' => 'ChatGpt',
            ],
            [
                'key' => 'CHAT_GPT_MODEL',
                'value' => 'text-davinci-003', // Replace with your actual API key
                'group' => 'ChatGpt',
            ],
            [
                'key' => 'CHAT_GPT_MAX_TOKENS',
                'value' => '150', // Replace with your actual API key
                'group' => 'ChatGpt',
            ], [
                'key' => 'CHAT_GPT_TEMPRERATURE',
                'value' => '0.7', // Replace with your actual API key
                'group' => 'ChatGpt',
            ],
            // Add more settings entries here
        ];

        // Insert only if record doesn't exist (using `firstOrCreate`)
        foreach ($settings as $setting) {
            Setting::firstOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
