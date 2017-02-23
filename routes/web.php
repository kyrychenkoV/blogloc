<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/*Route::get('/', function () {
    return view('index');
});*/
Route::get('/','IndexController1@index');
Route::get('page', function () {
    return 'Hello World';
});

Route::get('page5','Index5Controller@index');
Route::get('article/{id}','IndexController1@show')->name('articleShow'); //создаем алиас на маршрут для того чтобы вставить его в ссылку


Route::post('register', array('before' => 'csrf', function()
{

//    dump('$_POST');
     print_r($_POST);// не попал файл имдж в суперглобальный масив
     dump($_POST);
//    return view('store');
}));
Route::post('register','IndexController1@register');


