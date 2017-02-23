<?php

namespace App\Http\Controllers;

use App\Helpers\StringGenerator;
use App\Http\Requests\CatRequest;
use App\Models\Cat;
use Validator;

class CatController extends Controller
{
    public function index()
    {
        $cats = Cat::all();
        $cat = $cats[0];
        return view('cat.index', ['cats' => $cats]);
    }

    public function create()
    {
        return view('cat.create', ['str' => StringGenerator::getStr('TESTOVICH')]);
    }


    public function save(CatRequest $request)
    {
        $validator = Validator::make($request->all(), $request->rules());
        if ($validator->fails()) {
            return redirect('cat/index')
                ->withErrors($validator)
                ->withInput();
        }
    }

//
//    public function save(Request $request)
//    {
//        $validator = Validator::make($request->all(), [
//            'title' => 'required|max:2',
//            'description' => 'string',
//        ], [
//            'title.required' => 'qweqweqweqwe q)))',
//            'title.max' => 'qweqweqweqwe q)))'
//
//        ]);
//
//        if ($validator->fails()) {
//            return redirect('cat/create')
//                ->withErrors($validator)
//                ->withInput();
//        }
//
//        dd('ok');
//    }

}
