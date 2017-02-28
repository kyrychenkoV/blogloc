<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function getControllers(){
        echo "12345678";    }
    public function getController($id){
        echo "$id";
    }
}

