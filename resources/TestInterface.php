<?php

namespace App\Helpers\Contracts;
use Illuminate\Http\Request;



interface TestInterface{
//
//    public function deletePicture();
//    public function deleteNews();
    public function save( Request $request);
//    public function push();
//    public function finishSave(array $options);
//    public function update(array $attributes = []);
    public function touchOwners(Request $request);
}