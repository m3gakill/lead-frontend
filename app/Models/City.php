<?php

namespace App\Models;

use App\Models\BaseModel;

class City extends BaseModel
{
    protected $resourse = 'cities';
  
    public function getCitiesByName($name)
    {                
        $uri =  $this->urlBase . $this->resourse . '/getCitiesByName/'. $name;
        $res = $this->client->request('GET', $uri , [
            'headers' => $this->headers
        ]);

        return json_decode($res->getBody());        
         
    }
	
}
