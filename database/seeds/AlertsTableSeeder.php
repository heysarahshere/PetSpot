<?php

use Illuminate\Database\Seeder;
use App\Alert;

class AlertsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Alert::create([
            'user_id' => 1,
            'email' => 'heysarahshere@gmail.com',
            'type' => 'dog',
            'state' => 'Alabama',
            'img' => 'dog-alert.png'
        ]);
        Alert::create([
            'user_id' => 1,
            'email' => 'heysarahshere@gmail.com',
            'type' => 'dog',
            'state' => 'Oklahoma',
            'img' => 'dog-alert.png'
        ]);
        Alert::create([
            'user_id' => 1,
            'email' => 'heysarahshere@gmail.com',
            'type' => 'dog',
            'state' => 'Florida',
            'img' => 'dog-alert.png'
        ]);
        Alert::create([
            'user_id' => 1,
            'email' => 'heysarahshere@gmail.com',
            'type' => 'dog',
            'state' => 'California',
            'img' => 'dog-alert.png'
        ]);
    }
}
