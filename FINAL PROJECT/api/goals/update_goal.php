<?php
header("Content-Type: application/json");
require_once "../../db.php";

$data = json_decode(file_get_contents("php://input"), true);

$goal_id = $data["goal_id"] ?? 0;
$amount = $data["amount"] ?? 0;

if ($goal_id == 0 || $amount <= 0) {
    echo json_encode(["success" => false, "message" => "Invalid input"]);
    exit;
}

// add money to current_amount
$stmt = $conn->prepare("
    UPDATE goals 
    SET current_amount = current_amount + ? 
    WHERE id = ?
");
$stmt->bind_param("di", $amount, $goal_id);


if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode([
        "success" => false,
        "message" => $stmt->error
    ]);
}
?>
