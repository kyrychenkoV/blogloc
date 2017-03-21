<?php

namespace App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{   public $patch='uploads/';
    protected $table = 'company';
//    protected $primeryKey = 'company';
//    public $incrementing=TRUE;
    public function index()
    {
        $companies = Flight::all();

        return view('databaseShow', ['companies' => $companies]);
    }
    public function createModel($request,$pictureName)
    {
        $patch='uploads/';
        $company=new Company;
        $company->name=$request->input('title');
        $company->description=$request->input('description');
        $company->img=$patch.$pictureName;
        $company->save();
          
    }
    public function foto(){
        $files = Storage::files($this->patch);
        dd($files);
        $s= count($files);
        $randomArray=$this->unic_rnd(0,$s-1,3);
        dd(count($files));
        $arr=[];
//        dd($randomArray);

        for($i=0;$i<4;$i++){


            array_push($arr,$files[$randomArray[$i]]);
        }
//        dd($arr);
        return view('newDesign.news.one',['arr'=>$arr]);
    }
    public function unic_rnd($start, $end, $count){
        $array_r=array();
        $i=-1;
        while($i++<$count){
            $rnd = rand($start, $end);
            if(!in_array($rnd, $array_r)){
                $array_r[] = $rnd;
            }
            else{
                $count=$count+1;
            }
        }
        return $array_r;
    }
}
