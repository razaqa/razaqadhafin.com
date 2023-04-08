<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::updateOrCreate([
            'name'    => 'Works'
        ],[
            'name'    => 'Works',
            'desc'    => 'Special Category for Works',
            'is_special' => true
        ]);
        Category::factory(20)->create();
    }
}
