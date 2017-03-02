<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Company;

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
    public function index(){
       return view ('form');

    }

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

        dump($requests);
        print_r($request->all());

        if($request->isMethod('post')){
        $name=$request->input('title');
            print_r($name);
        $description=$request->input('description');
            print_r($description);

//            $companies=Company::where('id','=','3')->get();
//            dump($companies);
//            foreach($companies as $company){
//                echo $company->name.'<br />';
//            }
            $url = asset('images/one.jpg');




            $file = $request->file('image');

            //Display File Name
            echo 'File Name: '.$file->getClientOriginalName();
            echo '<br>';
            $fileName=$file->getClientOriginalName();
            echo 'FILENAME'.$fileName;
            //Display File Extension
            echo 'File Extension: '.$file->getClientOriginalExtension();
            echo '<br>';

            //Display File Real Path
            echo 'File Real Path: '.$file->getRealPath();
            echo '<br>';


            //Display File Size
            echo 'File Size: '.$file->getSize();
            echo '<br>';

            //Display File Mime Type
            echo 'File Mime Type: '.$file->getMimeType();

            //Move Uploaded File
            $destinationPath = 'uploads';
            $file->move($destinationPath,$file->getClientOriginalName());
            echo '<br>';
//            $path = $file->getRealPath();
            $path = $request->file('image')->path();
//            dd($path);
            echo 'NEW PATCH'.$path;

            echo 'File Real Path: '.$file->getRealPath();
            echo '<br>';

//            $comp=new Company();
//            $comp->createModel($request);

            $companies=Company::all();
            dump($companies);

        }
        return view ('showCompany',['title'=>'Contacts','companies' =>$companies,'name'=>$name,'description'=>$description,'requests'=>$requests,'url'=>$url]);
//        return view ('form');
   }
}
