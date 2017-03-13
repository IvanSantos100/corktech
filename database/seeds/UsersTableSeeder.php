<?php

use CorkTeck\Models\User;
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
        factory(User::class, 1)->create([
            'name' => 'Admin',
            'email' => 'admin@corktech.com'
        ]);
    }
}
