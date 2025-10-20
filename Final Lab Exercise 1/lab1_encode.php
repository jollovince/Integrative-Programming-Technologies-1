<?php

//associative array
$array = array(
    'name' => 'Mikee Dorol',
    'age' => 20,
    'course' => 'IT' 
);

$jsonString = json_encode($array);

echo $jsonString . "<br>";
?>