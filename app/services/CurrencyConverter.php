<?php

namespace App\services;

use Illuminate\Support\Facades\Http;

class Currency {

    private $apiKey;

    protected  $baseurl ='https://api.currconv.com/api/v7/convert';

    public function __construct(string $apiKey)
    {
        $this->apiKey=$apiKey;
    }


    public function convert( string $from , string $to ,float $amount = 1 ){


        $q ="{$from}_{$to}";

        $response = Http::baseUrl($this->baseurl)->get('/convert',[
            'q' =>  $q,
            'compact' => 'y',
            'apiKey' => $this->apiKey
        ]);

        $result= $response->json();
        return $result[$q] * $amount;
    }
}