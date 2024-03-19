<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            [
                'key' => 'vast api id',
                'value' => '',
                'group' => 'Vast Provider',
            ],
            [
                'key' => 'active provider',
                'value' => 'vast', // Replace with your actual API key
                'group' => 'General',
            ],
            // Add more settings entries here
        ];

        // Insert only if record doesn't exist (using `firstOrCreate`)
        foreach ($settings as $setting) {
            Setting::firstOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
