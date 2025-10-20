<?php
header('Content-Type: application/json');
$user = [
    "id" => 1,
    "name" => "Vince Jollo Grafel",
    "email" => "vincejollo@gmail.com",
    "status" => "active"
];
echo json_encode($user);
?>