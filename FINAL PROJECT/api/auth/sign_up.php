<?php
// DATABASE CONNECTION
$host = "localhost";
$user = "root";
$pass = "";
$db   = "saving_goal_tracker"; // <--- palitan mo

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("DB Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    // CHECK EMPTY
    if (!$name || !$email || !$password) {
        echo "<script>alert('All fields are required!'); window.history.back();</script>";
        exit;
    }

    // CHECK IF EMAIL EXISTS
    $chk = mysqli_prepare($conn, "SELECT id FROM users WHERE email = ?");
    mysqli_stmt_bind_param($chk, "s", $email);
    mysqli_stmt_execute($chk);
    mysqli_stmt_store_result($chk);

    if (mysqli_stmt_num_rows($chk) > 0) {
        echo "<script>alert('Email already exists!'); window.history.back();</script>";
        exit;
    }

    // HASH PASSWORD
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    // INSERT USER
    $stmt = mysqli_prepare($conn, "INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashed);

    if (mysqli_stmt_execute($stmt)) {

        // ⭐ FIXED: PURE PHP REDIRECT (NO JAVASCRIPT NEEDED)
        header("Location: ../../index.php");
        exit;

    } else {
        echo "<script>alert('Error creating account.'); window.history.back();</script>";
        exit;
    }
}
?>
