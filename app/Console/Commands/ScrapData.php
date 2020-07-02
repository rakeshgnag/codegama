<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;

use App\Data;

class ScrapData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getdata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scraps Data';

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
     * @return int
     */
    public function handle()
    {  

       $client = new Client();
       $url = 'https://stackoverflow.com/questions/tagged/c%23?tab=';
       $tags = ['Newest','Active','Bounties','Unanswered'];

       foreach ($tags as $tag) {
           $crawler = $client->request('GET', $url.$tag);
           $ext_data[$tag] = $crawler->filter('.fs-body3')->each(function ($node) {
                $data = explode(" ",$node->text());
                return $data[0];
           });
       }

       $data = new Data;
       $data->no_of_aquestions_bountied = str_replace(',', '', $ext_data['Bounties'][0]);
       $data->no_of_aquestions_active = str_replace(',', '',  $ext_data['Active'][0]);
       $data->no_of_questions_unanswered = str_replace(',', '', $ext_data['Unanswered'][0]);
       $data->no_of_questions = str_replace(',', '', $ext_data['Newest'][0]);
       $data->tag = 'c#';
       $data->save();
       
       var_dump($data);exit();
    }
}
