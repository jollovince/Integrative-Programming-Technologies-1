<?php
session_start();

$data = json_decode(file_get_contents("php://input"), true);

$_SESSION["user_id"] = $data["user_id"];
$_SESSION["name"] = $data["name"];
$_SESSION["email"] = $data["email"];
$_SESSION["profile_img"] = $data["profile_img"];

echo json_encode([ "success" => true ]);
