<?php

use Illuminate\Database\Seeder;
use \App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Start point of our date range.
        $start = strtotime("10 September 2000");

        //End point of our date range.
        $end = strtotime("22 July 2010");

        //Custom range.
        $timestamp = mt_rand($start, $end);

        Post::create([
            'title' => 'Looking for Small Dog',
            'author' => 'Sam',
            'contact_email' => 'sam@sam.sam',
            'content' => 'I need a small companion for my father. He\'s
            lonely but has always wanted a chiweenie or similar small mixed breed dog.
            No cats please. No purebreds.',
            'category' => 'Seeking Pets',
            'address_address' => '1600 1st Ave, Seattle, WA 98101',
            'address_latitude' => '47.6782249',
            'address_longitude' => '-117.2318143',
            'state' => 'Washington',
            'type' => 'dog',
            'event_date' =>date('Y-m-d', strtotime($timestamp))
        ]);
        Post::create([
            'title' => 'Looking for an Older Cat',
            'author' => 'Grandma Anne',
            'contact_email' => 'gma_anne@hotmail.com',
            'content' => 'I need an old, worn out companion kitty. No dogs please.',
            'category' => 'Seeking Pets',
            'address_address' => '1600 1st Ave, Seattle, WA 98101',
            'address_latitude' => '47.8782249',
            'address_longitude' => '-117.1318143',
            'state' => 'Washington',
            'type' => 'cat',
            'event_date' =>date('Y-m-d', strtotime($timestamp))
//             date("Y-M-D", $timestamp)
        ]);
        Post::create([
            'title' => 'Looking for Small Dog',
            'author' => 'Sam',
            'contact_email' => 'sam@sam.sam',
            'content' => 'I need a small companion for my father. He\'s
            lonely but has always wanted a chiweenie or similar small mixed breed dog.
            No cats please. No purebreds.',
            'category' => 'Seeking Pets',
            'address_address' => '778 W Broad St, Boise, ID 83702',
            'address_latitude' => '47.6939208',
            'address_longitude' => '-117.1218143',
            'state' => 'Idaho',
            'type' => 'dog',
            'event_date' =>date('Y-m-d', strtotime($timestamp))
        ]);
        Post::create([
            'title' => 'Lost Dog',
            'author' => 'Steve Smith',
            'contact_email' => 'stevebs@gmail.com',
            'content' => 'lost a black lab mix puppy on the corner of sprague and division. not chipped.',
            'category' => 'Lost Pets',
            'address_address' => '778 W Broad St, Boise, ID 83702',
            'address_latitude' => '47.6937208',
            'address_longitude' => '-117.1214143',
            'state' => 'Idaho',
            'type' => 'dog',
            'event_date' =>date('Y-m-d', strtotime($timestamp))
        ]);
        Post::create([
            'title' => 'Found a really skinny striped cat',
            'author' => 'anon123',
            'contact_email' => 'anonmake@gmail.com',
            'content' => 'found a black cat, it is big anf fluffy. not sure if chipped.' ,
            'category' => 'Found Pets',
            'address_address' => '778 W Broad St, Boise, ID 83702',
            'address_latitude' => '47.6479393',
            'address_longitude' => '-117.1214423',
            'state' => 'Idaho',
            'type' => 'cat',
            'event_date' =>date('Y-m-d', strtotime($timestamp))
        ]);
        Post::create([
            'title' => 'Cute Pets thread',
            'author' => 'katiek',
            'contact_email' => 'katie_k@gmail.com',
            'content' => 'Share some photos of your cute little guys! Cats, Dogs, whatever!',
            'category' => 'General',
            'address_address' => '210 Sherman Ave #117, Coeur d\'Alene, ID 83814',
            'address_latitude' => '47.6129393',
            'address_longitude' => '-117.1764423',
            'state' => 'Idaho',
            'type' => 'other',
            'event_date' =>date('Y-m-d', strtotime($timestamp))
        ]);
        Post::create([
            'title' => 'Found a white mix doggo, male',
            'author' => 'jimmybeans',
            'contact_email' => 'jimbeans@gmail.com',
            'content' => 'small timid and white. seems scared but is clean and probably has a good home somewhere.
             checking for a chip when the vet opens tomorrow. anyone have any ideas who he might belong to?' ,
            'category' => 'Found Pets',
            'address_address' => '210 Sherman Ave #117, Coeur d\'Alene, ID 83814',
            'address_latitude' => '47.6479553',
            'address_longitude' => '-117.1214455',
            'state' => 'Idaho',
            'type' => 'dog',
            'event_date' =>date('Y-m-d', strtotime($timestamp))
        ]);
        Post::create([
            'title' => 'New Banner thread',
            'author' => 'katiek',
            'contact_email' => 'katie_k@gmail.com',
            'content' => 'Share some photos of your cute little guys!
            Landscape photos in higher definition preferred. Winner will get their picture as the new home page banner for a week!',
            'category' => 'General',
            'address_address' => '210 Sherman Ave #117, Coeur d\'Alene, ID 83814',
            'address_latitude' => '47.6473493',
            'address_longitude' => '-117.1243423',
            'state' => 'Idaho',
            'type' => 'other',
            'event_date' =>date('Y-m-d', strtotime($timestamp))
        ]);
        Post::create([
            'title' => 'Looking for Big Puppy',
            'author' => 'Samantha',
            'contact_email' => 'sammys@sam.sam',
            'content' => 'I need a big dog for walks. Old or young, even a grumpy one.
            No cats please. No purebreds.',
            'category' => 'Seeking Pets',
            'address_address' => '210 Sherman Ave #117, Coeur d\'Alene, ID 83814',
            'address_latitude' => '47.6479543',
            'address_longitude' => '-117.1214403',
            'state' => 'Idaho',
            'type' => 'dog',
            'event_date' =>date('Y-m-d', strtotime($timestamp))
        ]);
        Post::create([
            'title' => 'Looking for reptiles in Seattle',
            'author' => 'Alex',
            'contact_email' => 'allexma@hotmail.com',
            'content' => 'Not sure fi this is the place to post,
            but are there any good reptile breeders around? I don\'t want to go to one of those
            nasty exotic pet shops, just want a nice at-home breeder. Prefer large boas or dragons. Thx',
            'category' => 'Seeking Pets',
            'address_address' => '2502 S Tyler St, Tacoma, WA 98405',
            'address_latitude' => '47.6436393',
            'address_longitude' => '-117.1214423',
            'user_id' => '1',
            'state' => 'Washington',
            'type' => 'other',
            'event_date' =>date('Y-m-d', strtotime($timestamp))
        ]);
        Post::create([
            'title' => 'Looking for Small Dog',
            'author' => 'Betty',
            'contact_email' => 'bettysp@aol.com',
            'content' => 'I need a small companion that i can train to be a support animal.
            Looking for an intelligent breed like Aussies, retrievers, GSDs, etc.',
            'category' => 'Seeking Pets',
            'address_address' => '828 W Main Ave, Spokane, WA 99201',
            'address_latitude' => '47.6479313',
            'address_longitude' => '-117.1214423',
            'user_id' => '1',
            'state' => 'Washington',
            'type' => 'dog',
            'event_date' =>date('Y-m-d', strtotime($timestamp))
        ]);
        Post::create([
            'title' => 'STOLEN! White 6 month-old Husky puppy',
            'author' => 'Bob Smith',
            'contact_email' => 'bobob@gmail.com',
            'content' => 'Husky puppy stolen right from back yard while I was inside.
            Camera caught a thin male in a hoodie snatching her away and walking off down sidewalk.
            Reward of $500 offered for safe return of puppy.',
            'category' => 'Lost Pets',
            'address_address' => '1600 1st Ave, Seattle, WA 98101',
            'address_latitude' => '47.6479393',
            'address_longitude' => '-117.1214263',
            'user_id' => '1',
            'state' => 'Washington',
            'type' => 'dog',
            'event_date' =>date('Y-m-d', strtotime($timestamp))
        ]);
        Post::create([
            'title' => 'Found a Fluffy Gray cat',
            'author' => 'anonymous',
            'contact_email' => 'anonmake@gmail.com',
            'content' => 'found a black cat, it is big anf fluffy. not sure if chipped. contact at 555-555-5555.' ,
            'category' => 'Found Pets',
            'address_address' => '828 W Main Ave, Spokane, WA 99201',
            'address_latitude' => '47.6479393',
            'address_longitude' => '-117.1276423',
            'user_id' => '1',
            'state' => 'Washington',
            'type' => 'cat',
            'event_date' =>date('Y-m-d', strtotime($timestamp))
        ]);
        Post::create([
            'title' => 'Pet Teefs thread',
            'author' => 'katiek',
            'contact_email' => 'katie_k@gmail.com',
            'content' => 'Share some pics of those cheesy grins! Teefs especially welcome!',
            'category' => 'General',
            'address_address' => '828 W Main Ave, Spokane, WA 99201',
            'address_latitude' => '47.6479763',
            'address_longitude' => '-117.1214423',
            'user_id' => '1',
            'state' => 'Washington',
            'type' => 'other',
            'event_date' =>date('Y-m-d', strtotime($timestamp))
        ]);
        Post::create([
            'title' => 'Are regular squirrels allowed to be kept as pets?',
            'author' => 'jimmybeans',
            'contact_email' => 'jimbeans@gmail.com',
            'content' => "I made a cool sweater for this little squirrel who lives in the trees.
             Is it cool if I keep him or is that wrong. Thx.",
            'category' => 'General',
            'address_address' => '828 W Main Ave, Spokane, WA 99201',
            'address_latitude' => '47.6779693',
            'address_longitude' => '-117.1214423',
            'user_id' => '1',
            'state' => 'Washington',
            'type' => 'other',
            'event_date' =>date('Y-m-d', strtotime($timestamp))
        ]);
        Post::create([
            'title' => 'Stop dog barking and lunging on walks? Any help?',
            'author' => 'clueless_roo',
            'contact_email' => 'roob22@gmail.com',
            'content' => 'My dog has been struggling with walks. Every person or animals sets her off and she pulls and barks and even
            seems like she\'s trying to attack. I don\'t know what to do. Not a fan of choke chains or shocking, or anything painful.
            Any advice or help is appreciated. Thank you! Dog tax: pics of Daisy when she is NOT going crazy.',
            'category' => 'General',
            'address_address' => '828 W Main Ave, Spokane, WA 99201',
            'address_latitude' => '47.6479693',
            'address_longitude' => '-117.1714423',
            'user_id' => '1',
            'state' => 'Washington',
            'type' => 'dog',
            'event_date' =>date('Y-m-d', strtotime($timestamp))
        ]);
    }
}
