<?php

$jsonData = file_get_contents("php://input");

$data = json_decode($jsonData, true);

if ($data) {
    echo "Username: " . $data['username'] . "<br>";
    echo "Password: " . $data['password'];
} else {
    echo "No JSON input received.";
}
?>