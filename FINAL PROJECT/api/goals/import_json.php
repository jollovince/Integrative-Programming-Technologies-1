<?php
header("Content-Type: application/json");
require_once "../db.php";

$data = json_decode(file_get_contents("php://input"), true);
$user_id = $data["user_id"];
$goals = $data["goals"];

foreach ($goals as $g) {
    $stmt = $conn->prepare("
        INSERT INTO goals (user_id, title, target_amount, current_amount, target_date, category)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param(
        "isddss",
        $user_id,
        $g["title"],
        $g["target_amount"],
        $g["current_amount"],
        $g["target_date"],
        $g["category"]
    );
    $stmt->execute();
}

echo json_encode(["success" => true]);
?>
