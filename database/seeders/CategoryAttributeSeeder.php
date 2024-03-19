<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CategoryAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Categories List
        $categories = Category::get();
        // Loop for categories
        foreach ($categories as $category) {
            $name = lcfirst($category->name);
            // Return properties file path
            $properties_file = public_path("properties_files/$name.json");
            // Check if the file is exists
            if(File::exists($properties_file)) {
                $attributes = json_decode(File::get($properties_file), true);
                $collection_attributes = collect($attributes)->transform(function ($item) {
                    $item['is_active'] = false;
                    return $item;
                });
                // Update the prompt attributes
                $category->update(['attributes' => $collection_attributes]);
            } else {
                dump( "The file $category->name not found");
            }
        }
    }
}
