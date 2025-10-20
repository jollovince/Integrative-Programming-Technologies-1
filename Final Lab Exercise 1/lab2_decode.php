<?php
// lab2_decode.php

$json = '{"name": "Juliana", "age": 20, "email": "guanzonjulianalorraine@gmail.com"}';

$data = json_decode($json);
$dataArray = json_decode($json, true);

echo "Object: " . $data->name . "<br>";
echo "Array: " . $dataArray['email'];
?>