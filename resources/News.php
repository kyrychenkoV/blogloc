<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class News extends Model
{
    const NOT_PICTURE = 'Not picture';
    private $path = 'image/uploads/news/';
    private $errorsMessages;

    private $rules = array(
        'name' => 'required|max:150',
        'description' => 'required',
        'image' => 'sometimes|image|max:10240',
    );
    protected $fillable = [
        'id',
        'name',
        'description',
        'img',
    ];

    public function savePicture(Request $request)
    {
        if (!$this->img && $request->hasFile('image')) {
            $pictureName = $this->fileSave($request);
        } else if ($this->img && $request->hasFile('image')) {
            $pictureName = $this->fileSave($request);
            $this->deletePicture();
        } else if ($this->img && !$request->hasFile('image')) {
            $pictureName = self::NOT_PICTURE;
            $this->deletePicture();
        } else {
            $pictureName = self::NOT_PICTURE;
        }
        $this->img = $pictureName;
    }

    public function deletePicture()
    {
        $exists = Storage::disk('local')->has($this->getImage());
        if ($exists)
            Storage::delete($this->getImage());

    }

    public function deleteNews()
    {
        $this->deletePicture();
        $this->delete();
    }

    private function fileSave($request)
    {
        $file = $request->file('image');
        $pictureName = $file->getClientOriginalName();
        $timestamp = time();
        $pictureName = $timestamp . "_" . $pictureName;
        $file->move($this->path, $pictureName);
        return $pictureName;
    }


    public function validateForm($news)
    {
        $validatorCity = Validator::make($news, $this->rules);
        if ($validatorCity->fails()) {
            $this->errorsMessages = $validatorCity->getMessageBag()->all();
            return false;
        }
        return true;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getErrorsMessages()
    {
        return $this->errorsMessagess;
    }

    private function getImage()
    {
//        return  ($new->img?$new->getPatch().$new->img:self::DUMMY);
        return $this->getPath() . $this->img;
    }
//    public function scopeGetNews($query){
//        return $query->where('votes', '>', 100);
//    }
}