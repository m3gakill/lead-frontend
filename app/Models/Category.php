<?php

namespace App\Models;

use App\Models\BaseModel;

class Category extends BaseModel
{
    protected $resourse = 'categories';
  
    public function getCategory($id)
    {                
        $uri =  $this->urlBase . $this->resourse . '/'. $id;
            
        $res = $this->client->request('GET', $uri , [
            'headers' => $this->headers
        ]);
        return json_decode($res->getBody());  

    }

    public function getAllCategoriesByCustomer($customer_id)
    {                
        $uri =  $this->urlBase . $this->resourse . '/getAllCategoriesByCustomer/' . $customer_id;
        $res = $this->client->request('GET', $uri , [
            'headers' => $this->headers
        ]);
        //echo $res->getStatusCode();
        // "200"
        //echo $res->getHeader('content-type')[0];
        // 'application/json; charset=utf8'
        //echo $res->getBody();        
        // {"type":"User"...'
        //exit;
        return json_decode($res->getBody());        
        
    }   
	
}
