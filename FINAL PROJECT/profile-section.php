<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id      = $_SESSION["user_id"];
$name         = $_SESSION["name"] ?? "Unknown User";
$email        = $_SESSION["email"] ?? "No Email";
$profile_img = isset($_SESSION["profile_img"]) && !empty($_SESSION["profile_img"])
    ? "uploads/" . $_SESSION["profile_img"]
    : "https://cdn-icons-png.flaticon.com/512/847/847969.png";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profile</title>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
:root{
  --bg-1:#dff8ec;
  --bg-2:#c6f1db;
  --bg-3:#aceacb;
  --accent:#1f8a5c;
  --accent-dark:#166c46;
  --text-dark:#0f3b28;
  --text-soft:#3c6f58;
  --glass-light:rgba(255,255,255,0.65);
  --glass-dark:rgba(22,50,40,0.28);
}

body {
  margin:0;
  background:linear-gradient(180deg,var(--bg-1),var(--bg-2),var(--bg-3));
  font-family:"Poppins";
  color:var(--text-dark);
}

/* Glass */
.glass{
  backdrop-filter:blur(18px);
  background:var(--glass-light);
  border-radius:22px;
  border:1px solid rgba(255,255,255,0.55);
  box-shadow:0 10px 30px rgba(0,0,0,0.08);
}

.glass-dark{
  backdrop-filter:blur(20px);
  background:var(--glass-dark);
  border-radius:22px;
  border:1px solid rgba(255,255,255,0.25);
  box-shadow:0 18px 40px rgba(0,0,0,0.18);
}

/* Header */
.header-bar {
  padding:14px 18px;
  background:rgba(255,255,255,0.45);
  backdrop-filter:blur(14px);
  border-bottom-left-radius:18px;
  border-bottom-right-radius:18px;
  display:flex;
  align-items:center;
  box-shadow:0 6px 18px rgba(0,0,0,0.10);
}

.header-title{
  flex:1;
  text-align:center;
  font-weight:700;
  margin-right:40px;
}

/* Back button */
.back-btn{
  background:rgba(255,255,255,0.65);
  border:1px solid rgba(255,255,255,0.45);
  padding:8px 16px;
  border-radius:14px;
  font-weight:600;
  color:var(--accent);
  transition:0.3s;
  display:flex;
  align-items:center;
  gap:6px;
}
.back-btn:hover{
  transform:translateX(-3px);
  background:white;
  color:var(--accent-dark);
}

/* Profile pic */
.profile-pic{
  width:110px;
  height:110px;
  border-radius:24px;
  object-fit:cover;
  border:4px solid rgba(255,255,255,0.85);
  box-shadow:0 12px 35px rgba(0,0,0,0.22);
}
</style>

</head>

<!-- FIXED: flex layout -->
<body class="min-h-screen flex flex-col">

<!-- HEADER -->
<div class="header-bar">
  <a href="index.php" class="back-btn"><span>←</span> Back</a>
  <span class="header-title text-xl text-green-900">Your Profile</span>
</div>

<!-- MAIN CONTENT (push footer down) -->
<div class="flex-grow">

  <div class="p-6 px-10 grid grid-cols-1 md:grid-cols-3 gap-6 w-full mt-6">

    <!-- LEFT PANEL -->
    <div class="glass-dark p-8 flex flex-col items-center">
      <img id="profilePic" src="<?= $profile_img ?>" class="profile-pic" />
      <h2 id="profileName" class="text-2xl font-bold text-white mt-5"><?= htmlspecialchars($name) ?></h2>
      <p id="profileEmail" class="text-white text-sm opacity-90"><?= htmlspecialchars($email) ?></p>

      <button id="openEdit"
        class="mt-6 w-full py-3 rounded-xl bg-white/80 font-semibold text-green-900 hover:bg-white transition shadow">
        Edit Profile
      </button>
    </div>

    <!-- RIGHT PANEL -->
    <div class="glass p-8 md:col-span-2">
      <h2 class="text-xl font-bold text-green-900 mb-4">Savings Summary</h2>

      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <div class="glass p-5 rounded-2xl shadow text-center">
          <p id="totalSaved" class="text-3xl font-bold text-green-900">₱0</p>
          <p class="text-green-700 text-sm">Total Saved</p>
        </div>

        <div class="glass p-5 rounded-2xl shadow text-center">
          <p id="activeGoals" class="text-3xl font-bold text-green-900">0</p>
          <p class="text-green-700 text-sm">Active Goals</p>
        </div>

        <div class="glass p-5 rounded-2xl shadow text-center">
          <p id="remainingAmount" class="text-3xl font-bold text-green-900">₱0</p>
          <p class="text-green-700 text-sm">Remaining</p>
        </div>
      </div>

      <h2 class="text-xl font-bold text-green-900 mb-3">Your Goals</h2>
      <div id="goalsList" class="space-y-3"></div>

      <h2 class="text-xl font-bold text-green-900 mt-8 mb-3">Recent Activity</h2>
      <div id="activityLog" class="glass p-4 rounded-2xl text-sm text-green-900 opacity-80">
        No activity yet.
      </div>

    </div>

  </div>
</div>

<!-- Modal + JS (unchanged) -->
<script>
/* your original JavaScript stays the same — no changes */
</script>

<?php include 'includes/footer.php'; ?>

</body>
</html>
