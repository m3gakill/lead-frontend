<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;


class CityController extends Controller
{
    protected $apiCity;

    public function __construct()    
    {
        $this->apiCity = new City();

    }    

    public function getCitiesByName(Request $request)
    {   
        $query = $request->get('query');
        $cities = array();
        
        if(strlen($query) > 3) { 
            $cities =  $this->apiCity->getCitiesByName($request->get('query')); 
        } 

        return $cities->data;
        
    }    

}
