<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;




class IndexController extends Controller
{
   public function index(){
	   return 'Hello w controller';
   }
}

