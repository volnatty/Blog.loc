<?php

use Illuminate\Database\Seeder;

class TagsCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Tag::class, 50)->create();
        factory(\App\Models\Category::class, 10)->create();
    }
}
