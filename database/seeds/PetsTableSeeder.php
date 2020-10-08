<?php

use Illuminate\Database\Seeder;
use App\Pet;

class PetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pet::create([
            'name' => 'Rolls',
            'description' => 'The Thanksgiving pups are adorable.
            This is Rolls, male and adoption ready. These pups are friendly and, of course, active.',
            'image1_url' => 'rolls1.jpg',
            'image2_url' => 'rolls2.jpg',
            'image3_url' => 'rolls3.jpg',
            'species' => 'Dog',
            'breed' => 'Mixed',
            'gender' => 'Male',
            'age' => 'young',
            'size' => 'large',
            'status' => 'Available',
            'weight' => '10',
            'fur_level' => '1'
        ]);

        Pet::create([
            'name' => 'Baxter',
            'description' => 'I am very shy kids can be a bit scary to me (loud noises/fast movements are very scary to me)!
            I would do best in a home with no kids, older kids who understand my shyness & that I may not want to be picked up/carried around!',
            'image1_url' => 'baxter1.jpg',
            'image2_url' => 'baxter2.jpg',
            'image3_url' => 'baxter3.jpg',
            'species' => 'Cat',
            'breed' => 'Tabby Mix',
            'gender' => 'Female',
            'age' => 'young',
            'size' => 'small',
            'status' => 'Available',
            'weight' => '6',
            'fur_level' => '2'
        ]);

        Pet::create([
            'name' => 'Stuffing',
            'description' => 'The Thanksgiving pups are adorable.
            This is Stuffing, male and adoption ready. These pups are friendly and, of course, active.',
            'image1_url' => 'stuffing1.jpg',
            'image2_url' => 'stuffing2.jpg',
            'image3_url' => 'stuffing3.jpg',
            'species' => 'Dog',
            'breed' => 'Mixed',
            'gender' => 'Male',
            'age' => 'young',
            'size' => 'large',
            'status' => 'Available',
            'weight' => '10',
            'fur_level' => '1'
        ]);

        Pet::create([
            'name' => 'Mash Potatoe',
            'description' => 'The Thanksgiving pups are adorable.
            This is Mash Potatoe, male and adoption ready. These pups are friendly and, of course, active.',
            'image1_url' => 'mash1.jpg',
            'image2_url' => 'mash2.jpg',
            'species' => 'Dog',
            'breed' => 'Mixed',
            'gender' => 'Male',
            'age' => 'young',
            'size' => 'large',
            'status' => 'Available',
            'weight' => '10',
            'fur_level' => '1'
        ]);

        Pet::create([
            'name' => 'Gravy',
            'description' => 'The Thanksgiving pups are adorable.
            This is Gravy, male and adoption ready. These pups are friendly and, of course, active.',
            'image1_url' => 'gravy1.jpg',
            'image2_url' => 'gravy2.jpg',
            'image3_url' => 'gravy3.jpg',
            'species' => 'Dog',
            'breed' => 'Mixed',
            'gender' => 'Male',
            'age' => 'young',
            'size' => 'large',
            'status' => 'Available',
            'weight' => '10',
            'fur_level' => '3'
        ]);

        Pet::create([
            'name' => 'Turkey',
            'description' => 'The Thanksgiving pups are adorable.
            This is Turkey, male and adoption ready. These pups are friendly and, of course, active.',
            'image1_url' => 'turkey1.jpg',
            'image2_url' => 'turkey2.jpg',
            'image3_url' => 'turkey3.jpg',
            'species' => 'Dog',
            'breed' => 'Mixed',
            'gender' => 'Male',
            'age' => 'young',
            'size' => 'large',
            'status' => 'Available',
            'weight' => '10',
            'fur_level' => '3'
        ]);

        Pet::create([
            'name' => 'Chance',
            'description' => 'Chance is an incredible dog that would do well in a home with another
            dog to help ease his "home alone" anxieties. He is about 1 yr old and completed the Ridge Dog
            Training Program with flying colors. He prefers to be busy and would do well with an active person. ',
            'image1_url' => 'chance1.jpg',
            'image2_url' => 'chance2.jpg',
            'image3_url' => 'chance3.jpg',
            'species' => 'Dog',
            'breed' => 'Mixed',
            'gender' => 'Male',
            'age' => 'Adult',
            'size' => 'medium',
            'status' => 'Available',
            'weight' => '55',
            'fur_level' => '2'
        ]);

        Pet::create([
            'name' => 'Apollo',
            'description' => '
Apollo is a very handsome fellow with beautiful gray and black tabby markings. He is here at Greenhill with his housemate Cyra and
they are a closely bonded pair who need to be adopted together (for a reduced fee). Their former owner lost her housing so both kitties needed to
 find a new home. Apollo is friendly to family members but shy around strangers and he is active, affectionate and talkative. He likes to play
  and chase his sister (Cyra) and both cats are used to living indoors and have lived with a large dog who they mostly ignored.
  They would do best in a quiet adult home where they can grow old together and never be separated,
so if you\'re looking for a sweet pair of kitties then please come out soon and meet Cyra and Apollo!',
            'image1_url' => 'apollo1.jpg',
            'image2_url' => 'apollo2.jpg',
            'image3_url' => 'apollo3.jpg',
            'species' => 'Cat',
            'breed' => 'Domestic Shorthair',
            'gender' => 'Male',
            'age' => 'Adult',
            'size' => 'small',
            'status' => 'Holding',
            'weight' => '10',
            'fur_level' => '2'
        ]);

        Pet::create([
            'name' => 'Nawal',
            'description' => 'No one came for Nawal so he\'s available for adoption. He\'s a young guy under
            2 yrs and such a sweet guy.
            We don\'t know if he\'s into hunting but he\'s a typical good natured Lab and is enjoyable to be around.',
            'image1_url' => 'nawal1.jpg',
            'image2_url' => 'nawal2.jpg',
            'species' => 'Dog',
            'breed' => 'Lab',
            'gender' => 'Male',
            'age' => 'Adult',
            'size' => 'large',
            'status' => 'Available',
            'weight' => '26',
            'fur_level' => '2'
        ]);

        Pet::create([
            'name' => 'Damisi',
            'description' => 'Damisi is an approx. 3month old Border Collie type pup.
            She\'s a little on the timid size but in a few minutes she warms up and wants to cuddle.
            She was a stray and we are so happy she ended up with us. We think she\'s pretty special.
            She\'s trying to be house broke but it\'s hard in the shelter situation bring a puppy.
            Damisi is very smart and will make a great companion. ',
            'image1_url' => 'damisi.jpg',
            'species' => 'Dog',
            'breed' => 'Border Collie',
            'gender' => 'Female',
            'age' => 'young',
            'size' => 'medium',
            'status' => 'Available',
            'weight' => '45',
            'fur_level' => '3'
        ]);

        Pet::create([
            'name' => 'Suruchuri',
            'description' => 'Sururchi is a sweet, timid mixed breed dog. She roamed lose and actually wandered to the
             shelter but the first time we weren\'t successful in catching her but the second time we managed it.
             Sururchi worries that she\'s in trouble if there is a sudden movement or a loud noise.
             She usually just rolls over and goes limp. We cant wait to see her again confidence and blossom. ',
            'image1_url' => 'suruchuri1.jpg',
            'image2_url' => 'suruchuri2.jpg',
            'image3_url' => 'suruchuri3.jpg',
            'species' => 'Dog',
            'breed' => 'Mixed',
            'gender' => 'Female',
            'age' => 'Adult',
            'size' => 'medium',
            'status' => 'Holding',
            'weight' => '40',
            'fur_level' => '2'
        ]);

        Pet::create([
            'name' => 'Leyati',
            'description' => 'Leyati is Charlie and Lucy\'s son. He is 8 weeks old and his mama Lucy is a Pitbull. Dad is short and stumpy.
            They\'ve all been around kids in a large range of ages.',
            'image1_url' => 'leyati1.jpg',
            'image2_url' => 'leyati2.jpg',
            'image3_url' => 'leyati3.jpg',
            'species' => 'Dog',
            'breed' => 'Pitbull Mix',
            'gender' => 'Male',
            'age' => 'young',
            'size' => 'large',
            'status' => 'Available',
            'weight' => '40',
            'fur_level' => '1'
        ]);

        Pet::create([
            'name' => 'Malaska',
            'description' => 'Malaska was a stray that decided to land at someone\'s home and he stayed there for a few weeks
             but they had too many dogs so he finally made it up to the top of our waiting list and was brought to us.
            He\'s young, playful and very affectionate. Malaska weighs at 74 lbs and he\'s young. ',
            'image1_url' => 'malaska1.jpg',
            'image2_url' => 'malaska2.jpg',
            'image3_url' => 'malaska3.jpg',
            'species' => 'Dog',
            'breed' => 'Husky Mix',
            'gender' => 'Female',
            'age' => 'young',
            'size' => 'large',
            'status' => 'Available',
            'weight' => '74',
            'fur_level' => '1'
        ]);


        Pet::create([
            'name' => 'Sam',
            'description' => 'I am very shy kids can be a bit scary to me (loud noises/fast movements are very scary to me)!
            I would do best in a home with no kids, older kids who understand my shyness & that I may not want to be picked up/carried around!',
            'image1_url' => 'sam1.jpg',
            'species' => 'Cat',
            'breed' => 'Siamese',
            'gender' => 'Male',
            'age' => 'Adult',
            'size' => 'small',
            'status' => 'Available',
            'weight' => '5',
            'fur_level' => '2'
        ]);

        Pet::create([
            'name' => 'Shelly',
            'description' => 'I was found as a stray, and have shown signs of being cat aggressive. I need to be the only cat in the home.',
            'image1_url' => 'shelly.jpg',
            'species' => 'Cat',
            'breed' => 'Domestic Shorthair',
            'gender' => 'Male',
            'age' => 'Adult',
            'size' => 'small',
            'status' => 'Available',
            'weight' => '7',
            'fur_level' => '2'
        ]);


    }
}
