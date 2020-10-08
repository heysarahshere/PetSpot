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
         $this->call(AlertsTableSeeder::class);
         $this->call(PetsTableSeeder::class);
         $this->call(AttributesTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(PostsTableSeeder::class);
    }
}
