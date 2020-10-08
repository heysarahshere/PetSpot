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
        User::create([
            'firstName' => "admin",
            'lastName' => "account",
            'userName' => "administrator",
            'email' => "admin@petspot.org",
            'password' => bcrypt('p@ss123'),
            'admin' => 1
        ]);
        User::create([
            'firstName' => "user",
            'lastName' => "account",
            'userName' => "guest123",
            'email' => "user@petspot.org",
            'password' => bcrypt('p@ss123')
        ]);
        User::create([
            'firstName' => "Sarah",
            'lastName' => "Covey",
            'userName' => "heysarahshere",
            'email' => "heysarahshere@gmail.com",
            'password' => bcrypt('oommoo'),
            'admin' => 1
        ]);
        User::create([
            'firstName' => "Austin",
            'lastName' => "Hegwald",
            'userName' => "mrpoopybutthole",
            'email' => "austinhegwald@hotmail.com",
            'password' => bcrypt('poopoo')
        ]);
        User::create([
            'firstName' => "Toby",
            'lastName' => "Covey",
            'userName' => "Tmiester806",
            'email' => "tobycovey@yahoo.com",
            'password' => bcrypt('nashville')
        ]);

    }
}
