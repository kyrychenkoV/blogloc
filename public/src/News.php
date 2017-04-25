<?php

namespace App\Models;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class News extends Model
{
    const NOT_PICTURE = 'Not picture';
    const NEWS_ON_MAIN_PAGE=10;
    private $path = 'image/uploads/news/';
    private $errorsMessages;

    private $rules = array(
        'name' => 'required|max:1',
        'description' => 'required',
        'image' => 'sometimes|image|max:10240',
    );
    protected $fillable = [
        'id',
        'name',
        'description',
        'img',
        'created_at',
        'updated_at',
    ];
    public function saveImage(Request $request)
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

    private function deletePicture()
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
            $this->errorsMessages = $validatorCity->getMessageBag();
            dd($this->errorsMessages);
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
        return $this->errorsMessages;
    }

    private function getImage()
    {
        return $this->getPath() . $this->img;
    }
    public function getNewsForMainPage()
    {
        $news = $this->latest('id')->limit(self::NEWS_ON_MAIN_PAGE)->get();
        return $news;
    }
    public function getNewsFromRssLine($rss){

        $xml=$this->parseRssToXml($rss);
        $count = 0;
        foreach ($xml->channel->item as $it) {
            $news = new News();
            $news->name = $it->title;
            $countNews = 0;
            $countNews = News::where('name', $it->title)->count();
            if ($countNews == 0) {
                $count++;
                try {
                    $url = $it->enclosure['url'];
                    $pictureName=$this->getPictureName($count);
                    copy($url, 'public/'.$this->getPath() . $pictureName);
                    $string = $it->description;
                    $news->description = $string;
                    $news->img = $pictureName;
                    $news->published=1;
                    $news->save();
                } catch (\Exception $e) {
                    $e->getMessage();
                }
            }
        }
    }

    public function parseRssToXml($rss){
        $xmlstr = @file_get_contents($rss);
        $xmls = \XmlParser::extract($xmlstr);
        return $xmls->getContent();
    }
    public function getPictureName($count){

       return time().$count.".jpg";
    }

}
