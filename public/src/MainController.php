<?php namespace App\Http\Controllers;

use Orchestra\Parser\Xml\Facade;
use Laravie\Parser\Xml\Document;

class MainController extends Controller
{
    public function showVacancies()
    {
        $rss = "https://3dnews.ru/news/rss/";
        $xmlstr = @file_get_contents($rss);
        $xmls = \XmlParser::extract($xmlstr);
        $abstracrtClass = new Document();//?
        $sxmlDocument = $xmls->getContent();
        foreach ($sxmlDocument->channel->item as $it) {
            $dataArray[] =
                ['title' => $it->title,
                    'description' => (string)$it->description,
                    'url' => $it->enclosure['url'],
                ];
        }
    }
}