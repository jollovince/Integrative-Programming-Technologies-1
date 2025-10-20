<?php
// Read JSON data sent from the frontend
$jsonData = file_get_contents("php://input");
$data = json_decode($jsonData, true);

if (isset($data['name']) && !empty($data['name'])) {
    $name = htmlspecialchars($data['name']);
    $response = [
        "status" => "success",
        "message" => "Welcome, $name!"
    ];
} else {
    $response = [
        "status" => "error",
        "message" => "Please enter your name."
    ];
}

// Return JSON response to frontend
header("Content-Type: application/json");
echo json_encode($response);
?>