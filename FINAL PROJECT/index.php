<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saving Goal Tracker</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #d1f4e3, #b3ebcd, #9de2c1);
            overflow-x: hidden;
        }

        /* BOUNCE ANIMATION */
        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-18px);
            }
        }

        .bounce {
            animation: bounce 1.8s ease-in-out infinite;
        }

        /* FALLING COINS */
        .money-container {
            position: fixed;
            inset: 0;
            pointer-events: none;
            overflow: hidden;
            z-index: 0;
        }

        .money {
            position: absolute;
            top: -50px;
            width: 40px;
            opacity: 0.9;
            animation: fall linear infinite;
        }

        @keyframes fall {
            0% {
                transform: translateY(-50px) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }
    </style>
</head>

<body class="min-h-screen flex flex-col">

<!-- FALLING COIN BACKGROUND -->
<div class="money-container">
    <img src="assets/images/coin.png" class="money" style="left: 5%; animation-duration: 5s;">
    <img src="assets/images/coin.png" class="money" style="left: 20%; animation-duration: 6s;">
    <img src="assets/images/coin.png" class="money" style="left: 35%; animation-duration: 4.5s;">
    <img src="assets/images/coin.png" class="money" style="left: 50%; animation-duration: 7s;">
    <img src="assets/images/coin.png" class="money" style="left: 65%; animation-duration: 5.5s;">
    <img src="assets/images/coin.png" class="money" style="left: 80%; animation-duration: 6.5s;">
    <img src="assets/images/coin.png" class="money" style="left: 92%; animation-duration: 4.8s;">
</div>

<!-- NAVIGATION -->
<nav class="p-6 flex justify-between items-center relative z-10">
    <h1 class="text-3xl font-extrabold text-green-900">💰 Saving Goal Tracker</h1>
</nav>

<!-- HERO SECTION -->
<div class="container mx-auto flex flex-col-reverse md:flex-row items-center px-8 py-10 flex-grow relative z-10">

    <!-- LEFT SIDE -->
    <div class="w-full md:w-1/2 text-center md:text-left mt-10 md:mt-0">
        <h2 class="text-5xl md:text-6xl font-extrabold text-green-900 leading-tight">
            Save Smart. <br>
            Reach Your Goals.
        </h2>

        <p class="mt-4 text-lg text-gray-700 max-w-md">
            Track your money, visualize your progress, and stay motivated to achieve your dreams.
        </p>

        <div class="mt-8 flex flex-col md:flex-row gap-4 justify-center md:justify-start">
          <a href="login.php?signup=1"

               class="bg-green-700 text-white px-8 py-3 rounded-2xl text-lg shadow hover:scale-105 transition">
               Get Started
            </a>

            <a href="login.php"
               class="bg-white text-green-700 px-8 py-3 rounded-2xl text-lg border border-green-700 hover:bg-green-50 transition">
               Login
            </a>
        </div>
    </div>

    <!-- RIGHT IMAGE — 3D PIGGY BANK -->
    <div class="w-full md:w-1/2 flex justify-center">
        <img src="assets/images/piggy.png"
             class="w-80 md:w-[420px] drop-shadow-2xl bounce" alt="Piggy Bank">
    </div>

</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
