<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Input;
use\App\Lara;

class IndexController1 extends Controller
{
    public function register(){
        exit("fdfgdfg");

        return view('store');
    }

    protected $message;
    public function construct(){
        $this->message='Message add';
    }

   public function index(Request $request){
       $message='Message add';
        //$testLara=Lara::select(['id','title'])->get();
        $testLara=Lara::all();
       $result = $request->session()->all();//получаем данные из сессии
       dump($result);
        dump($testLara);

	   return view('index')->with(['message'=>$this->message,'testLara'=>$testLara]);
   }

    public function show($id){
        //1 variant
       $testLara=Lara::find($id);
        dump($testLara);

  //2 variant konstructir zapriosow
       /* $testLara=Lara::select(['id','title','contetnt','description'])->where ('id',$id)->first(); //where id=$id  first возвращает 1 модкль гет коллекию моделей
        //dump($testLara);*/
        return view('articleContent')->with(['message'=>$this->message,'testLara'=>$testLara]);
   }

}