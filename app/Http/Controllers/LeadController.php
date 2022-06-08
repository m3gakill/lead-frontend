<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Question;
use App\Models\Lead;


class LeadController extends Controller
{
    protected $apiCategory;
    protected $apiQuestions;
    protected $apiLead;

    public function __construct()    
    {
        $this->apiCategory = new Category();
        $this->apiQuestion = new Question();
        $this->apiLead = new Lead();
    }    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {   
        
        $customer_id = 1;

        $categories = $this->apiCategory->getAllCategoriesByCustomer($customer_id);
        
        if (count($categories->data) > 1) {
            //apresenta as opções de categoria
            return view('lead.index', compact('categories'));            
        } else if (count($categories->data) == 1)  {
            //vai direto para o próximo            
            return $this->getCategory($categories->data[0]->id);
        } else {
            return view('welcome');
        }
        
    }    

    public function getCategory($category_id)
    {   
        
        $category =  $this->apiCategory->getCategory($category_id);            

        try {
            $sub_categories = $category->data[0]->sub_categories;

            if (count($sub_categories) > 1) {
                //apresenta as opções de categoria
                return view('lead.category', compact('category'));
            } else if (count($sub_categories) == 1)  {
                //vai direto para o próximo            
                return $this->getQuestionsBySubCategory($sub_categories[0]->id);
            } else {
                return view('welcome');
            }
        } catch (Exception $e) {

            return view('welcome');            
            
        }        
        
    }    

    public function getQuestionsBySubCategory($subcategory_id)
    {   
        
        $questions =  $this->apiQuestion->getQuestionsBySubCategory($subcategory_id);            
        return view('lead.question', compact('questions'));
        
    }        

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $arrLead = $request->get("lead");
        $response =  $this->apiLead->create($arrLead);
        return view('lead.conclusion');

    }

}
