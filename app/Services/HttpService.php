<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class HttpService{

    public function __construct(){

    }

    public function get($url){

        $response = Http::acceptJson()
                        ->withoutVerifying()
                        ->timeout(30)
                        ->retry(3, 100)
                        ->get($url);

        if($response->successful()):
            return json_decode($response->getBody());
        else:
            return null;
        endif;
    }

    public function post($url){
        
    }

}