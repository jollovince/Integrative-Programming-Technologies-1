<?php

// If statement
$temperature = 15;

if ($temperature > 20) {
    echo "It's a hot day! <br>";
}

$temperature = 25;
if ($temperature > 20) {
    echo "It's a hot day! <br>";
}

echo "<hr>";

// If Else statement
$age = 17;

if ($age >= 18) {
    echo "You are old enough to vote. <br>";
} else {
    echo "You are not old enough to vote yet. <br>";
}

echo "<hr>";

// If...elseif...else statement
$score = 85;

if ($score >= 90) {
    echo "Your grade is an A. <br>";
} elseif ($score >= 80) {
    echo "Your grade is a B. <br>";
} elseif ($score >= 70) {
    echo "Your grade is a C. <br>";
} else {
    echo "Your grade is an F. <br>";
}

echo "<hr>";

// Switch statement
$dayOfWeek = "Tuesday";

switch ($dayOfWeek) {
    case "Monday":
        echo "It's the start of the week. <br>";
        break;
    case "Tuesday":
        echo "Second day of the week. Let's get to work! <br>";
        break;
    case "Wednesday":
        echo "Hump day! We're halfway there. <br>";
        break;
    case "Thursday":
        echo "Almost the weekend! <br>";
        break;
    case "Friday":
        echo "TGIF! Time to relax. <br>";
        break;
    default:
        echo "It's the weekend! Time to rest. <br>";
}

?>

