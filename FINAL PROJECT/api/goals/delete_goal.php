<?php
header("Content-Type: application/json");
require_once "../../db.php";

$data = json_decode(file_get_contents("php://input"), true);

$goal_id = $data["goal_id"] ?? 0;

if ($goal_id == 0) {
    echo json_encode(["success" => false, "message" => "Invalid goal ID"]);
    exit;
}

$stmt = $conn->prepare("DELETE FROM goals WHERE id = ?");
$stmt->bind_param("i", $goal_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => $stmt->error]);
}
?>
