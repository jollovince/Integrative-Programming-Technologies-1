<?php
session_start();
require_once "../../db.php";

header("Content-Type: application/json");

if (!isset($_POST["user_id"])) {
    echo json_encode(["success" => false, "message" => "Missing user_id"]);
    exit();
}

$user_id = $_POST["user_id"];

// Check if file exists
if (!isset($_FILES["image"])) {
    echo json_encode(["success" => false, "message" => "No file uploaded"]);
    exit();
}

$file = $_FILES["image"];
$ext = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
$allowed = ["jpg", "jpeg", "png"];

// Validate file type
if (!in_array($ext, $allowed)) {
    echo json_encode(["success" => false, "message" => "Invalid image format"]);
    exit();
}

// Create unique filename
$filename = "profile_" . $user_id . "_" . time() . "." . $ext;
$uploadPath = "../../uploads/" . $filename;

// Move uploaded file
if (!move_uploaded_file($file["tmp_name"], $uploadPath)) {
    echo json_encode(["success" => false, "message" => "Upload failed"]);
    exit();
}

// Save to database
$stmt = $conn->prepare("UPDATE users SET profile_img=? WHERE id=?");
$stmt->bind_param("si", $filename, $user_id);
$stmt->execute();

// Update session para real-time mag change
$_SESSION["profile_img"] = $filename;

echo json_encode([
    "success" => true,
    "filename" => $filename
]);

exit();
