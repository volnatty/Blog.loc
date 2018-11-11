<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Tag::class, 50)->create();
        factory(\App\Models\Category::class, 10)->create();
        factory(\App\Models\User::class)->create(['role_id' => 1, 'email' => 'admin@app.com']);
        factory(\App\Models\User::class, 10)->create();
//         $this->call([
//             UsersTableSeeder::class,
//             TagsCategoriesSeeder::class,
//         ]);
    }
}
