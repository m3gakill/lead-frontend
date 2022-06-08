<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\CityController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return view('lead.conclusion');
});


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/home', [App\Http\Controllers\CategoryController::class, 'show'])->name('show');
//Route::resource('category', CategoryController::class)->only(['show']);

/*
Route::controller(CategoryController::class)->group(function(){
    Route::get('/categories/show/{category_id}', 'show');
    Route::get('/categories/all', 'getAllCategoriesByClient');

});
*/
//Route::resource('lead', LeadController::class);
//Route::get('/lead', [LeadController::class, 'index']);

Route::controller(LeadController::class)->group(function(){    
    
    Route::get('/lead/category/{category_id}', 'getCategory')->name('lead.category');
    Route::get('/lead/questions/{subcategory_id}', 'getQuestionsBySubCategory')->name('lead.questions');
    Route::post('/lead/create', 'create')->name('lead.create');
    Route::get('/lead', 'index')->name('lead.index');
    
});

Route::controller(CityController::class)->group(function(){    
    
    Route::get('/cities', 'getCitiesByName')->name('city.autocomplete');
    
});