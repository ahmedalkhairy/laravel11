<?php

namespace Database\Seeders;

use App\Models\Prompt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PromptPropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Prompts List
        $prompts = Prompt::get();
        // Loop for prompts
        foreach ($prompts as $prompt) {
            // Return properties file path
            $properties_file = public_path("properties_files/$prompt->key.json");
            // Check if the file is exists
            if(File::exists($properties_file)) {
                // Read json file
                $file = File::get($properties_file);
                $file = json_decode($file);
                // Update the prompt properties
                $prompt->update(['properties' => $file]);
            } else {
                dump( "The file $prompt->key not found");
            }
        }
    }
}
