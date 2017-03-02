<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';
//    protected $primeryKey = 'company';
//    public $incrementing=TRUE;
    public function index()
    {
        $companies = Flight::all();

        return view('databaseShow', ['companies' => $companies]);
    }
    public function createModel($request)
    {
        $company=new Company;
        $company->name=$request->input('title');
        $company->description=$request->input('description');
        $company->img="c:";
        $company->save();
          
    }
}
