<?php
header("Content-Type: application/json");
require_once "../db.php";

$user_id = $_GET["user_id"];

$result = $conn->query("SELECT * FROM goals WHERE user_id=$user_id");

$goals = [];
while ($row = $result->fetch_assoc()) {
    $goals[] = $row;
}

echo json_encode([
    "success" => true,
    "goals" => $goals
]);
?>
