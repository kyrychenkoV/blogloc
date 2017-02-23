<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Index5Controller extends Controller
{
    public function index(){
        $header="Hello World 5555";
        $message=" Для начала давайте создадим наш первый маршрут (route). В Laravel самый простой маршрут — функция-замыкание (closure). Откройте файл app/routes.php и добавьте этот код в его конец:";
        return view('page')->with(['message'=>$message,'header'=>$header]);
    }
}
