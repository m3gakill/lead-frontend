<?php

namespace App\Models;

use App\Models\BaseModel;

class Question extends BaseModel
{
    protected $resourse = 'questions';
  
    public function getQuestionsBySubCategory($subcategory_id)
    {                
        $uri =  $this->urlBase . $this->resourse . '/getQuestionsBySubCategory/'. $subcategory_id;
        $res = $this->client->request('GET', $uri , [
            'headers' => $this->headers
        ]);

        return json_decode($res->getBody());        
         
    }
	
}
