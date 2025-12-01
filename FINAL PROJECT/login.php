<?php
session_start();
require "db.php";

/* ------------- 
   AUTO REDIRECT IF LOGGED IN
------------- */
if (isset($_SESSION["user_id"])) {
    header("Location: dashboard.php"); 
    exit();
}

$error = "";

/* LOGIN */
if (isset($_POST["login"])) {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row["password"])) {

            $_SESSION["user_id"] = $row["id"];
            $_SESSION["name"] = $row["name"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["profile_img"] = $row["profile_img"];

            header("Location: dashboard.php");
            exit();
        }
    }

    $error = "Invalid email or password!";
}

/* SIGNUP */
if (isset($_POST["signup"])) {
    $name  = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $pass  = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $q = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $q->bind_param("s", $email);
    $q->execute();
    $exists = $q->get_result()->num_rows;

    if ($exists > 0) {
        $error = "Email already exists!";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $pass);
        $stmt->execute();

        header("Location: login.php");
        exit();
    }
}
?>
<!doctype html>
<html lang="en">

<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
* { font-family: 'Poppins', sans-serif; }

body {
    background:
        linear-gradient(rgba(255,255,255,0.45), rgba(255,255,255,0.45)),
        url('./assets/images/saving_goal.jpg') center/cover no-repeat fixed;
    color: #111;
}

.wrapper {
    width: 900px;
    max-width: 100%;
    overflow: hidden;
    border-radius: 32px;
    background: rgba(255,255,255,0.6);
    backdrop-filter: blur(18px);
    border: 1px solid rgba(255,255,255,0.35);
    box-shadow: 0 10px 40px rgba(0,0,0,0.15);
}

/* -------- SLIDER -------- */
.form-slider {
    width: 300%; /* dahil 3 pages */
    display: flex;
    transition: transform .6s ease;
}

.form-slider.slide-signup {
    transform: translateX(-33.33%);
}
.form-slider.slide-forgot {
    transform: translateX(-66.66%);
}

.form-page {
    width: 33.33%;
    padding: 55px 50px;
}

input {
    background: rgba(255,255,255,0.85);
    border: 1px solid rgba(0,0,0,0.15);
    border-radius: 16px;
    padding: 18px;
    height: 52px;
    transition: .25s;
    width: 100%;
}

input:focus {
    background: white;
    border-color: #34d399;
    box-shadow: 0 0 14px rgba(52,211,153,0.35);
}

button {
    border-radius: 14px;
    font-weight: 600;
    transition: .25s;
    color: white;
}
button:hover {
    transform: translateY(-2px);
    opacity: .95;
}

.title {
    font-size: 2.4rem;
    font-weight: 700;
    color: #0f3926;
}
.subtitle {
    font-size: .95rem;
    color: #4b4b4b;
    margin-bottom: 28px;
}
</style>
</head>

<body class="min-h-screen flex flex-col">

<div class="flex-grow flex justify-center items-center p-4">

    <div class="wrapper grid grid-cols-1 md:grid-cols-2">

        <div class="relative overflow-hidden bg-white/60 backdrop-blur-xl">

            <?php if (!empty($error)): ?>
            <div class="bg-red-200 text-red-800 p-3 text-center rounded-b-lg"><?= $error ?></div>
            <?php endif; ?>

            <div id="formSlider" class="form-slider">

<!-- ========== LOGIN PAGE ========== -->
<div class="form-page">
    <h1 class="title">Welcome! 👋</h1>
    <p class="subtitle">Log in to continue</p>

    <form method="POST" class="space-y-4">
        <input name="email" type="email" placeholder="Email" required>
        <input name="password" type="password" placeholder="Password" required>
        <button name="login" class="w-full bg-green-700 py-3">Sign In</button>
    </form>

    <p class="mt-3 text-center">
        <button id="goForgot" class="text-green-700 font-semibold hover:underline">Forgot password?</button>
    </p>

    <p class="mt-6 text-center">
        Don't have an account?
        <button id="goSignup" class="text-green-800 font-semibold">Create one</button>
    </p>
</div>


<!-- ========== SIGNUP PAGE ========== -->
<div class="form-page">
    <h1 class="title">Create Account ✨</h1>
    <p class="subtitle">Start your journey with us</p>

    <form method="POST" class="space-y-4">
        <input name="name" type="text" placeholder="Full Name" required>
        <input name="email" type="email" placeholder="Email" required>
        <input name="password" type="password" placeholder="Password" required>
        <button name="signup" class="w-full bg-green-700 py-3">Sign Up</button>
    </form>

    <p class="mt-6 text-center">
        Already have an account?
        <button id="goLogin" class="text-green-800 font-semibold">Login</button>
    </p>
</div>


<!-- ========== FORGOT PASSWORD PAGE (SLIDE 3) ========== -->
<div class="form-page">
    <h1 class="title">Reset Password 🔐</h1>
    <p class="subtitle">Enter your email to receive a reset code</p>

    <form method="POST" action="forgot_password.php" class="space-y-4">
        <input name="email" type="email" placeholder="Email" required>
        <button class="w-full bg-green-700 py-3">Send Code</button>
    </form>

    <p class="mt-6 text-center">
        <button id="backLogin" class="text-green-800 font-semibold">Back to Login</button>
    </p>
</div>

            </div>
        </div>

        <div class="hidden md:flex flex-col items-center justify-center p-10 text-white"
             style="background: linear-gradient(135deg,#0f1f16,#0c2621,#0a1d17);">

            <img src="./assets/images/bg-1.jpg" class="w-64 rounded-xl shadow-xl mb-4">
            <h2 class="text-2xl font-bold text-green-200 mb-2">Track Your Finances</h2>
            <p class="text-green-100 max-w-xs text-sm text-center">Stay motivated and organized.</p>
        </div>

    </div>
</div>

<?php include 'includes/footer.php'; ?>

<!-- SLIDER SCRIPT -->
<script>
document.addEventListener("DOMContentLoaded", () => {
    const slider = document.getElementById("formSlider");
    const goSignup = document.getElementById("goSignup");
    const goLogin  = document.getElementById("goLogin");
    const goForgot = document.getElementById("goForgot");
    const backLogin = document.getElementById("backLogin");

    goSignup.onclick = () => {
        slider.classList.remove("slide-forgot");
        slider.classList.add("slide-signup");
    };

    goLogin.onclick = () => {
        slider.classList.remove("slide-signup", "slide-forgot");
    };

    goForgot.onclick = () => {
        slider.classList.remove("slide-signup");
        slider.classList.add("slide-forgot");
    };

    backLogin.onclick = () => {
        slider.classList.remove("slide-signup", "slide-forgot");
    };
});
</script>

</body>
</html>
