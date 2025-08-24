<?php

// If statement (Weather Example)
$isRaining = true;

if ($isRaining) {
    echo "Don't forget your umbrella! <br>";
}

$isRaining = false;
if ($isRaining) {
    echo "It's raining again! <br>";
}

echo "<hr>";

// If Else statement (Time of Day Example)
$hour = 14; // 24-hour format (14 = 2 PM)

if ($hour < 12) {
    echo "Good morning! <br>";
} else {
    echo "Good afternoon or evening! <br>";
}

echo "<hr>";

// If...elseif...else statement (Speed Example)
$speed = 65;

if ($speed > 100) {
    echo "You are overspeeding! <br>";
} elseif ($speed >= 60) {
    echo "You are driving at a normal speed. <br>";
} elseif ($speed >= 30) {
    echo "You are driving slowly. <br>";
} else {
    echo "Your vehicle is almost at a stop. <br>";
}

echo "<hr>";

// Switch statement (Meals of the Day Example)
$meal = "Dinner";

switch ($meal) {
    case "Breakfast":
        echo "Time for some coffee and eggs! <br>";
        break;
    case "Lunch":
        echo "How about rice and adobo? <br>";
        break;
    case "Snack":
        echo "Grab some merienda! <br>";
        break;
    case "Dinner":
        echo "Enjoy your evening meal with family. <br>";
        break;
    default:
        echo "Anytime is food time! <br>";
}

?>
