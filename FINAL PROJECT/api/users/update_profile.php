<?php
session_start();
require_once "../../db.php";

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$user_id = $data["user_id"];
$name    = $data["name"];
$email   = $data["email"];

$stmt = $conn->prepare("UPDATE users SET name=?, email=? WHERE id=?");
$stmt->bind_param("ssi", $name, $email, $user_id);
$stmt->execute();

// Update session
$_SESSION["name"]  = $name;
$_SESSION["email"] = $email;

echo json_encode(["success" => true]);
