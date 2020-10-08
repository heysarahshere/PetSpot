<?php

namespace App\Console\Commands;

use App\CrawlerData;
use App\Post;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Goutte\Client;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\DomCrawler\Crawler;


class ScrapeLostCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:lost {type} {state}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape lost pets from lostfoundpets.us.';
    public $state;
    public $type;

    /**
     * Create a new command instance.
     *
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

        $buttonCrawler = $crawler->selectButton('lost');
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

//                print_r($img);
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
                $needle = "location where lost";
                if (strpos($data_string, $needle) !== false) {
                    $half_address = substr($data_string, strrpos($data_string, $needle) + 20);
                    $address = strstr($half_address, ":", TRUE);
                    // get lat/lng
                    $apiKey = env('GOOGLE_MAPS_API_KEY');
                    $prepAddr = str_replace(' ', '+', $address);
                    $geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $prepAddr . '&key=' . $apiKey);
                    $output = json_decode($geocode);
                    $latitude = $output->results[0]->geometry->location->lat;
                    $longitude = $output->results[0]->geometry->location->lng;
                    // set post info
                    $post->address_address = $address;
                    $post->address_latitude = $latitude;
                    $post->address_longitude = $longitude;
                    //TEST
                }
                // contact info
                $needle = ":name";
                if (strpos($data_string, $needle) !== false) {
                    $half_name = substr($data_string, strrpos($data_string, $needle) + 6);
                    $name = strstr($half_name, ":", TRUE);
                } else {
                    $name = "Not given.";
                }
                $needle = "home phone";
                if (strpos($data_string, $needle) !== false) {
                    $half_number = substr($data_string, strrpos($data_string, $needle) + 11);
                    $number = strstr($half_number, ":", TRUE);
                } else {
                    $number = "Not given.";
                }
                $needle = "work phone";
                if (strpos($data_string, $needle) !== false) {
                    $half_number = substr($data_string, strrpos($data_string, $needle) + 11);
                    $number2 = strstr($half_number, ":", TRUE);
                } else {
                    $number2 = "Not given.";
                }
                $needle = "e-mail";
                if (strpos($data_string, $needle) !== false) {
                    $half_email = substr($data_string, strrpos($data_string, $needle) + 6);
                    $email = strstr($half_email, ":", TRUE);
                } else {
                    $email = "Not given.";
                }
                // date lost
                $date_needle = "was lost on";
                if (strpos($data_string, $date_needle) !== false) {
                    $half_date = substr($data_string, strrpos($data_string, $date_needle) + 12);
                    $date_lost = strstr($half_date, ":", TRUE);
                } else {
                    $date_lost = "an unknown date";
                }

                // breed
                $needle = "breed";
                if (strpos($data_string, $needle) !== false) {

                    $state = $this->argument('state');
                    $type = $this->argument('type');
                    $titles = [
                        'Help! Can\'t find',
                        'Lost our',
                        'Missing',
                        'Please locate',
                        'Hoping someone has seen a'
                    ];

                    $half_breed = substr($data_string, strrpos($data_string, $needle) + 6);
                    $breed = strstr($half_breed, ":", TRUE);
                    if ($breed === '') {
                        $breed = "Pet";
                    }
                    // set post info
                    $post->title = $titles[rand(0, 4)] . ' ' . $breed . ' ' . $type;
                    $post->author = "WebCrawler";
                    $post->user_id = $id;
                    // get actual email?
                    $post->contact_email = "heysarahshere@gmail.com";
                    $post->category = "Lost Pets";
                    $post->content = "<h2 style=\"text-align: left;\">Missing: " . $breed . " - last seen near " . $address . " on " . $date_lost ."</h2><p style=\"text-align: left;\"><span style=\"color: #ff6600;\">" . $img . "</span></p>
                    <h3 style=\"text-align: left;\"><span style=\"color: #ff6600;\">Please contact " . $name . " or respond to this post.</span><br /><span style=\"color: #ff6600;\">Home Phone: " . $number . " | Work Phone: " . $number2 . "</span></h3>
                    <p>National Lost Pets Database ID:" . $id . "</p><h5 style=\"text-align: left;\"><span style=\"color: #808080;\"><hr><strong>This post was generated by a webcrawler.</strong> If the data in this listing is incorrect, please contact a moderator.</span></h5>";
                    $post->address_longitude = $longitude;
                    $post->type = $type;
                    $post->state = $state;
                    if(strtotime($date_lost) > 0){
                        $post->event_date = date('Y-m-d', strtotime($date_lost));
                    }
                    // make sure unique post
                    $input = array('user_id' => $id);
                    $rules = array(
                        'user_id' => 'unique:posts'
                    );
//  if post to send email
                    $validator = Validator::make($input, $rules);
                    if ($validator->passes()) {
                        $post->save();
                    }
                    //TEST
//                    print_r($breed . "\n");
                }
            });
        }
    }
}
