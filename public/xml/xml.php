<?php

$rss = "https://3dnews.ru/news/rss/";
$xmlstr = @file_get_contents($rss);

if ($xmlstr === false) die('Error connect to RSS: ' . $rss);
$xmls = new SimpleXMLElement($xmlstr);
if ($xmls === false) die('Error parse RSS: ' . $rss);
$arr = [];

foreach ($xmls->channel->item as $it) {
    $dataArray[] =
        ['title'=>$it->title,
            'description' => (string)$it->description,
            'url'=> $it->enclosure['url'],
        ];
}
var_dump($dataArray);
$url = $dataArray[1]['url'];
// Загружаем содержимое удалённого изображения
$content = file_get_contents($url);
// Сохраняем файл на локальной машине
$fd = fopen("posentryprice_EUR_USD.png","w");
fwrite($fd, $content);
fclose($fd);
$bool=copy($dataArray[1]['url'],"image5.jpg");
for ($i = 0; $i < 10; $i++) {
    echo $dataArray['title'][$i] . "<br><br>";
    echo "<img src=\"" . $dataArray['url'][$i] . "\"width=\"255\" height=\"255\">" . "<br>";
    echo $dataArray['description'][$i] . "<br><br>";
}





//include 'exemple.php';
//$dom = new DomDocument('1.0');
//$books = $dom->appendChild($dom->createElement('books'));
//
//$book = $books->appendChild($dom->createElement('book'));
//$title = $book->appendChild($dom->createElement('title'));
//
//$domAttribute = $dom->createAttribute("name");
//$domAttribute->value = "YhisName";
//
//$title->appendChild(
//    $dom->createTextNode('Great American Novel'));
//$title->appendChild($domAttribute);
//
//$dom->formatOutput = true;
//$test1 = $dom->saveXML();
//$dom->save('test1.xml');
//
///*simple xml*/
//$simpleXML = simplexml_load_string('<books><book><title name="YhisName">Great American Novel</title></book></books>');
//
//if ($simpleXML === false) {
//    echo 'Error while parsing the document';
//    exit;
//}
//$dom_sxe = dom_import_simplexml($simpleXML);
//if (!$dom_sxe) {
//    echo 'Error while converting XML';
//    exit;
//}
//$dom1 = new DOMDocument('1.0');
//$dom_sxe = $dom1->importNode($dom_sxe, true);
//$dom_sxe = $dom1->appendChild($dom_sxe);
//
//echo $dom->save('test2.xml');
//
//
///*SimpleXML импортирует DOM*/
//$dom2 = new domDocument;
//$dom2->loadXML('<books><book><title name="YhisName">Great American Novel Import</title></book></books>');
//if (!$dom) {
//    echo 'Error while parsing the document';
//    exit;
//}
//$s=simplexml_import_dom($dom2);
////echo $s->book[0]->title;
//
//
///*ddd*/
//$content=file_get_contents('xmlfile.xml');
//$xml = new SimpleXMLElement($content);
//
//echo $xml->book[0]->title;


?>


