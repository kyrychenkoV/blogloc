<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FormController extends Controller
{
//    protected $request;
//
//    public function __construct(Request $request){
//      $this->request=$request;
//    }
//
//   public function show(){
//    $name = $this->request->input('name');
//       print_r($name);
//       print_r($this->request->all());
//       dump ($this->request);
//       return view ('form');
//   }
    public function show(Request $request){
//    $name = $request->input('login');
//
//    if($request->has('login')){
//        print_r($name);
//    }
//    else{
//        echo 'Input login';
//    }
//     $name = $request->input('login');
//       print_r($name);
//       print_r($request->all());
//       dump ($request);
//
//        $request->flash();// сохраняет данныев сесии
        $requests=$request->all();
        dump($request);


        if($request->isMethod('post')){
        $name=$request->input('title');
            print_r($name);
        $description=$request->input('description');
            print_r($description);




        }
        return view ('form',['name'=>$name,'description'=>$description,'requests'=>$requests]);
   }
}
