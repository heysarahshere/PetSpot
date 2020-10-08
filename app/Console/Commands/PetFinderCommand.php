<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PetFinderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'petfinder:pull';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull data from the PetFinder API';

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
        $client = new GuzzleHttp\Client();
        $res = $client->get('https://api.github.com/user', ['auth' =>  ['user', 'pass']]);
        echo $res->getStatusCode(); // 200
        echo $res->getBody();

    }
}
