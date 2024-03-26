<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'PlayVerse',
            'email' => 'Playverseaafrica@gmail.com',
            'password' => bcrypt('PlayVerse'),
            'role_id' => '1',
        ]);
        $role = Role::create([
            'name' => 'admin',
            'description' => 'App Uploader',
            'role_id'=>'2'
        ]);
    }
}
