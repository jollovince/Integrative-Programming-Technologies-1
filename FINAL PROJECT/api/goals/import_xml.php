<?php
header("Content-Type: application/json");
require_once "../db.php";

$xmlData = file_get_contents("php://input");
$xml = simplexml_load_string($xmlData);

foreach ($xml->goal as $g) {

    $stmt = $conn->prepare("
        INSERT INTO goals (user_id, title, target_amount, current_amount, target_date, category)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "isddss",
        $g->user_id,
        $g->title,
        $g->target_amount,
        $g->current_amount,
        $g->target_date,
        $g->category
    );

    $stmt->execute();
}

echo json_encode(["success" => true]);
?>
