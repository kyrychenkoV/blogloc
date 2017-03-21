
<?php
//$array = array(
//    "foo" => "bar",
//    "bar" => "foo",
//);

// Начиная с PHP 5.4
$array = [
    8.1 => "bar ",
    "bar" => "foo ",
    true=>"1 ",
    false=>"0 ",
    null=>"null ",
    8.1=>"2bar "
];
//echo $array[8];
//echo $array["bar"];
//echo $array[1];
//echo $array[0];
//echo $array[""];
//echo $array[8];

//foreach ($array as $arr){
//    echo  "<br />$arr " ;
//}


"<br/>";
$array1 = array(
    1    => "a",
    "1"  => "b",
    1.5  => "c",
    true => "d",
);
$array2 = array(
    "foo " => "bar",
    "bar" => "foo",
    100   => -100,
    -100  => 100,
);
$array3 = array("foo   ", "bar", "hallo", "world");
//echo $array3[0];

$array4 = array(
    "a",
    "b",
    6 => "c",
    "d",
);
$array5=array(
    "foo"=>"bar ",
     42=>24,
    "multi"=>array(
        "dimensional"=>array(
            "array"=>"foo"
            )
        )
);
//echo $array5["foo"];
//echo $array5[42];
//echo $array5["multi"]["dimensional"]["array"];

function getArray1(){
    return array(1,2,3);
}
//echo $secondElement=getArray1()[1];

$arr = array(5 => 1, 12 => 2);
$arr[] = 56;
$arr["x"] = 42;
//echo $arr[5];
//echo $arr[13];
//echo $arr["x"];

//unset($arr[5]);
//unset($arr);


$array = array(1, 2, 3, 4, 5);
//print_r($array);

foreach ($array as $i => $value) {
    unset($array[$i]);
}
//print_r($array);

//$array[] = 68;//5 елемент

//print_r($array);





//var_dump($arr);


?>
