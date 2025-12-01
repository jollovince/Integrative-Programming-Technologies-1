<?php
header("Content-Type: application/json");
require_once "../../db.php";

$data = json_decode(file_get_contents("php://input"), true);

$goal_id = $data["goal_id"] ?? 0;
$title = $data["title"] ?? "";
$target_amount = $data["target_amount"] ?? 0;
$target_date = $data["target_date"] ?? "";
$category = $data["category"] ?? "";

if ($goal_id == 0 || $title == "" || $target_amount <= 0 || $target_date == "") {
    echo json_encode(["success" => false, "message" => "Invalid input"]);
    exit;
}

$stmt = $conn->prepare("
    UPDATE goals
    SET title = ?, target_amount = ?, target_date = ?, category = ?
    WHERE id = ?
");
$stmt->bind_param("sdssi", $title, $target_amount, $target_date, $category, $goal_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => $stmt->error]);
}
?>
