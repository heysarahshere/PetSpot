<?php

namespace App\Console\Commands;

use App\Alert;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\CrawlerData;
use App\Notifications\FoundPetAlert;
use App\Notifications\UserPetAlert;
use App\Post;
use DateTime;
use Goutte\Client;
use Illuminate\Console\Command;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\DomCrawler\Crawler;

class ScrapeFoundCommand extends Command
{

    use Notifiable;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:found {type} {state}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape found pets from lostfoundpets.us.';
    public $state;
    public $type;
    public $count = 0;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $state = $this->argument('state');
        $type = $this->argument('type');
        $client = new Client();
        $crawler = $client->request('GET', 'https://www.lostfoundpets.us/dbsearch.php');

        $buttonCrawler = $crawler->selectButton('found');
        $form = $buttonCrawler->form();
        $form['pet']->select($type);
        $form['lfstate']->select($state);
        $crawler = $client->submit($form);

        $data = [];
        $nodeValues = $crawler->filter('font')->each(function (Crawler $node, $i) {
            $data = $node->text();
            $id_needle = "Pet ID";
            if (strpos($data, $id_needle) !== false) {
                $pet_id = substr($data, strrpos($data, ':') + 2);
                $input = array('value' => $pet_id);
                $rules = array(
                    'value' => 'unique:crawler_data'
                );
                $validator = Validator::make($input, $rules);
                if ($validator->passes()) {
                    $data = new CrawlerData(['value' => $pet_id]);
                    $data->save();
                }
            }
            return $data;
        });

        $pet_list = CrawlerData::all();
        CrawlerData::truncate();

        foreach ($pet_list as $pet) {

            $id = $pet->value;
            $crawler = $client->request('GET', 'https://www.lostfoundpets.us/dbsearch.php');


            $formNodeValues = $crawler->filter('div > table > tr ')->each(function (Crawler $node, $i) use ($crawler, $client, $id) {
                $form = $crawler->filter('form')->eq(2)->form();
                $form['petid'] = $id;
                $crawler = $client->submit($form);
                $img = $crawler->filter('img')->eq(4)->attr('src');

                $detailNodeValues = $crawler->filter('td')->each(function (Crawler $node, $i) {
                    return $node->text();
                });

                $post = new Post();
                $img_needle = "www.alapet";
                if (strpos($img, $img_needle) !== false) {
                    $img = '<img src="' . $img . '" alt=\"lost_pet\" width=\"350\" height=\"350\" />';
                } else {
                    $img = '<img src="/images/5f46da73e5382.gif" alt="National Lost & Found Pets Logo" width="250" height="250" />';
                }
                $post->img = $img;

                // raw data as string from national lost pets database
                $data_string = implode(':', $detailNodeValues);

                // location
                $needle = "found";
                if (strpos($data_string, $needle) !== false) {
                    $half_address = substr($data_string, strrpos($data_string, $needle) + 7);
                    $address = strstr($half_address, ":", TRUE);

                    // get lat/lng
                    $apiKey = env('GOOGLE_MAPS_API_KEY');
                    $prepAddr = str_replace(' ', '+', $address);
                    $geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $prepAddr . '&key=' . $apiKey);
                    $output = json_decode($geocode);
                    print_r($output);
                    $latitude = $output->results[0]->geometry->location->lat;
                    $longitude = $output->results[0]->geometry->location->lng;

                    // set post info
                    $post->address_address = $address;
                    $post->address_latitude = $latitude;
                    $post->address_longitude = $longitude;
                }
                // sex
                $needle = "sex";
                if (strpos($data_string, $needle) !== false) {
                    $half_sex = substr($data_string, strrpos($data_string, $needle) + 4);
                    $sex = strstr($half_sex, ":", TRUE);
                } else {
                    $sex = "Unknown";
                }
                // color
                $needle = "color";
                if (strpos($data_string, $needle) !== false) {
                    $half_color = substr($data_string, strrpos($data_string, $needle) + 6);
                    $color = strstr($half_color, ":", TRUE);
                } else {
                    $color = "Unknown";
                }
                // size
                $needle = "size";
                if (strpos($data_string, $needle) !== false) {
                    $half_size = substr($data_string, strrpos($data_string, $needle) + 5);
                    $size = strstr($half_size, ":", TRUE);
                } else {
                    $size = "Unknown";
                }
                if ($size === ' ') {
                    $size = "Unknown";
                }
                // date found
                $needle = "date found";
                if (strpos($data_string, $needle) !== false) {
                    $half_found = substr($data_string, strrpos($data_string, $needle) + 11);
                    $date_found = strstr($half_found, ":", TRUE);
                } else {
                    $date_found = "Unknown";
                }
                // date found
                $needle = "age";
                if (strpos($data_string, $needle) !== false) {
                    $half_age = substr($data_string, strrpos($data_string, $needle) + 4);
                    $age = strstr($half_age, ":", TRUE);
                } else {
                    $age = "Unknown";
                }
                // breed
                $needle = "breed";
                if (strpos($data_string, $needle) !== false) {
                    $type = $this->argument('type');
                    $state = $this->argument('state');
                    $titles = [
                        'Help! Found a',
                        'Ok, who is missing a',
                        'Someone lost a',
                        'Found this little',
                        'Hoping someone knows who owns this'
                    ];
                    $half_breed = substr($data_string, strrpos($data_string, $needle) + 6);
                    $breed = strstr($half_breed, ":", TRUE);
                    if ($breed === '') {
                        $breed = "Pet";
                    }
                    if (strpos($breed, ',') !== false) {
                        $breed_title = strstr($half_breed, ",", TRUE);
                    } else {
                        $breed_title = $breed;
                    }
                    // set post info
                    $post->title = $titles[rand(0, 4)] . ' ' . $breed_title . ' ' . $type;
                    $post->author = "WebCrawler";
                    $post->user_id = $id;
                    // get actual email?
                    $post->contact_email = "heysarahshere@gmail.com";
                    $post->category = "Found Pets";
                    $post->content = "<h2 style=\"text-align: left;\">FOUND: " . $breed . " - near " . $address . " on " . $date_found . "." . "</h2><p style=\"text-align: left;\"><span style=\"color: #ff6600;\">" . $img . "</span></p>
                    <h3 style=\"text-align: left;\"><span style=\"color: #ff6600;\">Please contact a moderator or respond to this post.</span><br /><span style=\"color: #ff6600;\">Size: " . $size . " | Age: " . $age . " | Sex: " . $sex . " | Color: " . $color . "</span></h3>
                    <p>National Lost Pets Database ID:" . $id . "</p><h5 style=\"text-align: left;\"><span style=\"color: #808080;\"><hr><strong>This post was generated by a webcrawler.</strong> If the data in this listing is incorrect, please contact a moderator.</span></h5>";
                    $post->address_longitude = $longitude;
                    $post->type = $type;
                    $post->state = $state;
                    $post->event_date = date('Y-m-d', strtotime($date_found));

                    // make sure unique post
                    $input = array('user_id' => $id);
                    $rules = array(
                        'user_id' => 'unique:posts'
                    );
                    $validator = Validator::make($input, $rules);
                    if ($validator->passes()) {
                        $this->count += 1;
                        $post->save();
                            $lwr_type = strtolower($type);
                            // get relevant alerts
                            $alerts = Alert::where('type', $lwr_type)->where('state', $state)->get();
                            print_r($alerts);

                            foreach ($alerts as $alert) {
                                // send alert to each user
                                $user = User::find($alert->user_id);
                                // if user hasn't set up preferences
                                $user->notify(new UserPetAlert($type, $state, $post->id));
                                $alert->notify(new FoundPetAlert($type, $state, $post->id));

                        }
                    }


                }
            });
        }
        print_r($this->count);
        // out of loop
//        if ($this->count > 0) {
//            $lwr_type = strtolower($type);
//            // get relevant alerts
//            $alerts = Alert::where('type', $lwr_type)->where('state', $state)->get();
//            print_r($alerts);
//
//            foreach ($alerts as $alert) {
//                // send alert to each user
//                $user = User::find($alert->User_id);
//                // if user hasn't set up preferences
//                $user->notify(new UserPetAlert($type, $state, $this->count));
//                $alert->notify(new FoundPetAlert($type, $state, $this->count));
////                Notification::route('mail', $alert->email)->notify(new FoundPetAlert($type, $state, $this->count));
//
//                // if user has preferences
//            }
//        }
    }
}
