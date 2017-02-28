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
//Route::get('/','IndexController1@index');
Route::get('/','IndexController1@index');



//Route::get('page5',['as'=>'home','Index5Controller@index']);
Route::get('article/{id}','IndexController1@show')->name('articleShow'); //создаем алиас на маршрут для того чтобы вставить его в ссылку

//
//Route::post('register', array('before' => 'csrf', function()
//{//    dump('$_POST');
////     print_r($_POST);// не попал файл имдж в суперглобальный масив
////     dump($_POST);
////    return view('store');
//}));
Route::post('register','IndexController1@register');
Route::match(['get','post'],'/contact',['uses'=>'Test\FormController@show','as'=>'contact']);



//Route::get ('/test/{id}',function ($id){
//    echo '<pre>';
//        echo $id;
//    echo '</pre>';
//}
//);
//Route::get ('/test/{id?}',function ($id=null){
//    echo '<pre>';
//    echo $id;
//    echo '</pre>';
//}
//);

//Route::get ('/test/{id}',function ($id=null){
//    echo '<pre>';
//    echo $id;
//    echo '</pre>';
//})->where('id','[0-9+]'); //рег на ай ди попадут только числа 0-9 / '[0-9]+ попадут любые'

//Route::get ('/test/{city}/{id}',function ($id,$city){
//    echo '<pre>';
//    echo $id;
//    echo $city;
//    echo '</pre>';
//})->where(['city'=>'[A-Za-z+]','id'=>'[0-9+]']);//не сработало

//Route::get ('/test/{city}/{id}',function ($id,$city){
//    echo '<pre>';
//    echo $id;
//    echo $city;
//    echo '</pre>';
//});
//Route::group([],function () {
//    Route::get ('/test/1',function (){
//            echo '/test/1';
//    });
//    Route::get ('/test/2',function (){
//        echo '/test/2';
//    });
//
//});

//TestControlers

//
Route::get('/control',['uses'=>'Test\TestController@getControllers','as'=>'controls']);
Route::get('/control/{id}',['uses'=>'Test\TestController@getController','as'=>'control','middleware'=>'middle']);//->name('control');
// Restful controllers контроллер типа ресурс
Route::get('/pages/add','Test\CoreResource@add'); // пеерд Route::resource('/pages','Test\CoreResource'); для добавления своего метода в Route::resource и ручками прописываем его;
Route::resource('/pages','Test\CoreResource');
//Route::resource('/pages','Test\CoreResource',['only'=>['index','show']]);//создадутся маршруты только для ['index','show']
//Route::resource('/pages','Test\CoreResource',['exept'=>['index','show']]);// кроме ['index','show']

//Route::controller('/pagess','PagesController');// не пошло