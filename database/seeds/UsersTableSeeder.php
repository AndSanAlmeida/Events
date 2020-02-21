<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Almeida',
        	'email' => 'admin@admin.com',
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
            'type' => true
        ]);

        $user = User::create([
        	'first_name' => 'User',
            'last_name' => 'Almeida',
        	'email' => 'user@user.com',
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
            'type' => false
        ]);

        factory(App\User::class, 10)->create();
    }
}
