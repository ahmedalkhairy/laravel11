<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'outerwear',
                'spi_id' => 'outerwear',
            ],
            [
                'name' => 'sweatshirt',
                'spi_id' => 'sweatshirt',
            ],
            [
                'name' => 'dresses',
                'spi_id' => 'dresses',
            ],
            [
                'name' => 'pants',
                'spi_id' => 'pants',
            ],
            [
                'name' => 'sweater',
                'spi_id' => 'sweater',
            ]
        ];

        foreach ($data as $item) {
            Category::updateOrCreate(['name' => $item['name']], $item);
        }
    }
}
