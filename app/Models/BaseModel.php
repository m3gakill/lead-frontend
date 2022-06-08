<?php

namespace App\Models;

use GuzzleHttp\Client;

class BaseModel
{
    protected $urlBase;
    protected $client;     
    protected $header; 
    protected $token;   

    public function  __construct(){
        
        $this->urlBase = 'http://localhost:8000/api/';
        $this->client = new \GuzzleHttp\Client();
        $this->token = '9|p5LX7e5RWdHlmS2gT7ujlLQ8iRzPOp2efbQXXP9a';

        $this->headers = [
            'Authorization' => 'Bearer ' . $this->token,        
            'Accept'        => 'application/json',
        ];

    }


}
