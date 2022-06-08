<?php

namespace App\Models;

use App\Models\BaseModel;

class Lead extends BaseModel
{
    protected $resourse = 'leads';
  
    public function create($arrLead)
    {                
        $uri =  $this->urlBase . $this->resourse;
        $res = $this->client->request('POST', $uri . "" , [
            'headers' => $this->headers,
            'form_params' => $arrLead
        ]);

        return json_decode($res->getBody());        
         
    }
	
}
