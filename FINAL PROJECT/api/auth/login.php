<?php
header("Content-Type: application/json");
require_once "../../db.php";

$data = json_decode(file_get_contents("php://input"), true);

$email = $data["email"] ?? "";
$password = $data["password"] ?? "";

$stmt = $conn->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(["success" => false, "message" => "Email not found"]);
    exit;
}

$user = $result->fetch_assoc();

if (!password_verify($password, $user["password"])) {
    echo json_encode(["success" => false, "message" => "Incorrect password"]);
    exit;
}

echo json_encode([
    "success" => true,
    "user_id" => $user["id"],
    "name" => $user["name"],
    "email" => $user["email"]
]);
?>
