<?php

namespace App\Helpers\Contracts;
use Illuminate\Http\Request;
interface Image{

    public function saveImage(Request $request);
    public function getImage();

}