<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Notifications\Notifiable;

class ScrapeAllCommand extends Command
{

    use Notifiable;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:both {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape both lost and found in all 50 states for given animal type';
    public $type;
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
    {    $type = $this->argument('type');

        $states_full_key = array(
            "Alabama" => "Alabama",
            "Alaska" => "Alaska",
            "Arizona" => "Arizona",
            "Arkansas" => "Arkansas",
            "California" => "California",
            "Colorado" => "Colorado",
            "Connecticut" => "Connecticut",
            "Delaware" => "Delaware",
            "District of Columbia" => "District of Columbia",
            "Florida" => "Florida",
            "Georgia" => "Georgia",
            "Hawaii" => "Hawaii",
            "Idaho" => "Idaho",
            "Illinois" => "Illinois",
            "Indiana" => "Indiana",
            "Iowa" => "Iowa",
            "Kansas" => "Kansas",
            "Kentucky" => "Kentucky",
            "Louisiana" => "Louisiana",
            "Maine" => "Maine",
            "Maryland" => "Maryland",
            "Massachusetts" => "Massachusetts",
            "Michigan" => "Michigan",
            "Minnesota" => "Minnesota",
            "Mississippi" => "Mississippi",
            "Missouri" => "Missouri",
            "Montana" => "Montana",
            "Nebraska" => "Nebraska",
            "Nevada" => "Nevada",
            "New Hampshire" => "New Hampshire",
            "New Jersey" => "New Jersey",
            "New Mexico" => "New Mexico",
            "New York" => "New York",
            "North Carolina" => "North Carolina",
            "North Dakota" => "North Dakota",
            "Ohio" => "Ohio",
            "Oklahoma" => "Oklahoma",
            "Oregon" => "Oregon",
            "Pennsylvania" => "Pennsylvania",
            "Rhode Island" => "Rhode Island",
            "South Carolina" => "South Carolina",
            "South Dakota" => "South Dakota",
            "Tennessee" => "Tennessee",
            "Texas" => "Texas",
            "Utah" => "Utah",
            "Vermont" => "Vermont",
            "Virginia" => "Virginia",
            "Washington" => "Washington",
            "West Virginia" => "West Virginia",
            "Wisconsin" => "Wisconsin",
            "Wyoming" => "Wyoming"
        );

        foreach ($states_full_key as $state) {
            $this->call('scrape:found', [
                'type' => $type, 'state' => $state
            ]);
            $this->call('scrape:lost', [
                'type' => $type, 'state' => $state
            ]);
        }

    }
}
