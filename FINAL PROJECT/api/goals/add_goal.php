<?php
header("Content-Type: application/json");
require_once "../../db.php";

$data = json_decode(file_get_contents("php://input"), true);

// SAFE GETTER (prevents warnings)
$user_id        = intval($data["user_id"] ?? 0);
$title          = $data["title"] ?? "";
$target_amount  = floatval($data["target_amount"] ?? 0);
$target_date    = $data["target_date"] ?? "";
$category       = $data["category"] ?? "none"; // DEFAULT VALUE

$current_amount = 0;

$sql = "INSERT INTO goals (user_id, title, target_amount, current_amount, target_date, category)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "isddss",
    $user_id,
    $title,
    $target_amount,
    $current_amount,
    $target_date,
    $category
);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $stmt->error]);
}
?>
