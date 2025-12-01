<?php
header("Content-Type: application/xml");
require_once "../db.php";

$user_id = $_GET["user_id"];

$result = $conn->query("SELECT * FROM goals WHERE user_id=$user_id");

$xml = new SimpleXMLElement("<goals/>");

while ($row = $result->fetch_assoc()) {
    $goal = $xml->addChild("goal");

    foreach ($row as $key => $value) {
        $goal->addChild($key, htmlspecialchars($value));
    }
}

echo $xml->asXML();
?>
