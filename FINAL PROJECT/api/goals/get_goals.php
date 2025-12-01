<?php
header("Content-Type: application/json");
require_once "../../db.php";

$user_id = $_GET["user_id"] ?? 0;

$stmt = $conn->prepare("SELECT * FROM goals WHERE user_id=? ORDER BY id DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$goals = [];
while ($row = $result->fetch_assoc()) {
    $goals[] = $row;
}

echo json_encode($goals);
?>
