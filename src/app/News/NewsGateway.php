<?php

namespace App\News;

use Illuminate\Support\Facades\Http;

class NewsGateway 
{

    private $apiKey;
    

    public function __construct($apiKey) {
        $this->apiKey = $apiKey;
        $this->api = "https://api.currentsapi.services/v1/";
    }

    public function latest() {
        // get the latest news

        $response = Http::get($this->api."latest-news?apiKey=".$this->apiKey)["news"];
        $news = array_slice($response, 0, 5, true);

        return $news;
    }
}