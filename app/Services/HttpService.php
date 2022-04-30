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

     public function sendCurl($url,$payload=null){

      $ch = curl_init();

      curl_setopt($ch, CURLOPT_URL,$url);
      curl_setopt($ch, CURLOPT_POST,0) ;
      //curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($payload));
      // Receive server response ...
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      $server_output = curl_exec($ch);
      curl_close ($ch);

     return json_decode($server_output);

    }

}