<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "saving_goal_tracker";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die(json_encode([
        "success" => false,
        "message" => "Database Connection Error"
    ]));
}
?>
