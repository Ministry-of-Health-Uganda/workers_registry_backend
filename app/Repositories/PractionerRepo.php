<?php
namespace App\Repositories;

use App\Jobs\GenerateLinksJob;
use App\Models\DataSource;
use App\Services\HttpService;


class PractionerRepo implements IPractionerRepo{

    use \Illuminate\Foundation\Bus\DispatchesJobs;

    protected $http = null;
    
    public function __construct(HttpService $http){
        $this->http = $http;
    }

    public function fetchData()
    {
        $response = $this->http->get('');
        dd($response);
    }

    public function generateLinks(){

        $dataSource = DataSource::where('code','IHRIS_MANAGE_API_URL')->first();
        $url = $dataSource->base_url;
        $key = $dataSource->api_key;

        $response = $this->http->get($url.$key."/0");

        $count = $response->count;
        $per_page = $response->per_page;

        if($response):

        $linksJob = (new GenerateLinksJob($per_page,$count,$dataSource))
                    ->delay(5);
        $this->dispatch($linksJob);

        endif;

        dd($response);
       
    }

}