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
            'fname' => 'Admin',
            'lname' => 'Almeida',
        	'email' => 'admin@admin.com',
            'password' => bcrypt('secret'),
            'type' => true
        ]);

        $user = User::create([
        	'fname' => 'User',
            'lname' => 'Almeida',
        	'email' => 'user@user.com',
            'password' => bcrypt('secret')
        ]);

        factory(App\User::class, 10)->create();
    }
}
