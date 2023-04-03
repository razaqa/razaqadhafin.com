<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 25; $i++) {
            DB::table('post_tag')->insert([
                'post_id' => fake()->randomDigitNotNull(),
                'tag_id' => fake()->randomDigitNotNull(),
                'created_at' => fake()->dateTime(),
                'updated_at' => fake()->dateTime(),
            ]);
        }
    }
}
