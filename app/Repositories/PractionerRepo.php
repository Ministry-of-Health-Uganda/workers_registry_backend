<?php
namespace App\Repositories;

use App\Jobs\GenerateLinksJob;
use App\Jobs\SaveApiDataJob;
use App\Models\DataSource;
use App\Services\HttpService;


class PractionerRepo implements IPractionerRepo{

    use \Illuminate\Foundation\Bus\DispatchesJobs;

    protected $http = null;
    
    public function __construct(HttpService $http){
        ini_set('max_execution_time', '300');
        $this->http = $http;
    }

    public function fetchData()
    {
        $dataSource = $this->getDataSource();
        $links      = $dataSource->links;
        $all        = [];

        foreach($links as $link){

            $data = $this->http->sendCurl($link->url);

            $practioners_data = $data->data;
            $apiDataJob = (new SaveApiDataJob($practioners_data,$link->id))->delay(10);
            $this->dispatch($apiDataJob);

            $all[] = $practioners_data;
        }


         dd($data);


    }

    public function generateLinks(){

        $dataSource = $this->getDataSource();

        $url = $dataSource->base_url;
        $key = $dataSource->api_key;


        $response = $this->http->sendCurl($url.$key."/0");
        
        $count = $response->count;
        $per_page = $response->per_page;

        if($response):

        $linksJob = (new GenerateLinksJob($per_page,$count,$dataSource))
                    ->delay(5);
        $this->dispatch($linksJob);

        endif;

        dd($response);
       
    }

    private function getDataSource(){
        return  DataSource::where('code','IHRIS_MANAGE_API_URL')->first();
    }

}