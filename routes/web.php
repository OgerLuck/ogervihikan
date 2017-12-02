<?php

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
    return view('welcome');
});

Route::get('/app/peta_gempa_indonesia',  ['as' => 'ViewPetaGempaIndonesia', 'uses' => 'PetaGempaIndonesia@index']);
  
Route::get('/app/aksara_bali_ai', ['as' => 'ViewAksaraBaliNeuralNetwork', 'uses' => 'AksaraBaliNeuralNetwork@index']);

Route::get('/subject/artificial-neural-network', ['as' => 'ViewSubjectANN', 'uses' => 'SubjectANN@index']);

Route::get('/blog', ['as' => 'ViewBlogList', 'uses' => 'BlogCont@showList']);
Route::get('/blog/{link}', ['as' => 'ViewBlogContent', 'uses' => 'BlogCont@showContent']);

Route::post('/blog/insert', 'BlogCont@insert');
Route::post('/blog/update', 'BlogCont@update');
Route::post('/blog/delete', 'BlogCont@delete');


Route::get('/signin', ['as' => 'ViewSignin', 'uses' => 'Signin@index']);
Route::post('/signin/signin', 'Signin@signin');
Route::get('/signin/signout', 'Signin@signout');

Route::get('/admin', ['as' => 'ViewAdmin', 'uses' => 'Admin@index']);
