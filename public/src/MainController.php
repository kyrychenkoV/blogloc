<?php namespace App\Http\Controllers;

use Orchestra\Parser\Xml\Facade;
use Laravie\Parser\Xml\Document;

class MainController extends Controller
{
    public function showVacancies()
    {
        $path = 'image/uploads/news/';

        $rss = "https://3dnews.ru/news/rss/";
        $xmlstr = @file_get_contents($rss);
        $xmls = \XmlParser::extract($xmlstr);
        $sxmlDocument=$xmls->getContent();
        $count=0;
        dd($sxmlDocument->channel->item[52]->description->__toString());
        foreach ($sxmlDocument->channel->item as $it) {
            $count++;
            $url=$it->enclosure['url'];
            $timestamp = time();
            $pictureName = $timestamp  .$count.".jpg";
            if($url!==null) {
                copy($url, $path . $pictureName);
                $news=new News();
                $string=$it->description;
                $news->name=$it->title;
                $news->description=$string;
                $news->img=$pictureName;
                $news->save();
            }
        }
    }
}