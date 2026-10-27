<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['title' => 'Physician', 'slug' => 'physician'],
            ['title' => 'Dental', 'slug' => 'dental'],
        ];

        foreach ($categories as $category) {
            ServiceCategory::updateOrCreate(
                ['slug' => $category['slug']],
                [
                    'title' => $category['title'],
                    'is_active' => true,
                ],
            );
        }
    }
}
