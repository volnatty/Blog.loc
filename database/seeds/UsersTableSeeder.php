<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\User::class)->create(['role_id' => 1, 'email' => 'admin@app.com']);
        factory(\App\Models\User::class, 10)->create();
    }
}
