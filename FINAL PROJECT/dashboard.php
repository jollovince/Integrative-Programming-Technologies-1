<?php
session_start();

// Protect dashboard
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$profile_img = (!empty($_SESSION["profile_img"]))
    ? "uploads/" . $_SESSION["profile_img"]
    : "https://cdn-icons-png.flaticon.com/512/847/847969.png";
?>
<!doctype html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Saving Goal Tracker</title>

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700;800&display=swap" rel="stylesheet">

<style>
body {
    background: linear-gradient(135deg, #d7f5e8, #b2e8cc, #8fd8b8);
    font-family: 'Poppins', sans-serif;
}
.glass {
    background: rgba(255,255,255,0.4);
    backdrop-filter: blur(18px);
    border-radius: 22px;
}
.goal-card {
    background: white;
    border-radius: 22px;
    padding: 24px;
    transition: .2s;
}
.goal-card:hover {
    transform: translateY(-3px);
}
.modal {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.5);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}
.modal.active {
    display: flex;
}
.modal-box {
    width: 380px;
    background: rgba(255,255,255,0.25);
    backdrop-filter: blur(28px);
    border-radius: 22px;
    padding: 24px;
}
</style>
</head>

<body class="min-h-screen flex flex-col">

<!-- HEADER -->
<div class="fixed top-5 right-5 flex items-center gap-3 z-50">
    <button onclick="location.href='logout.php'"
        class="bg-red-500 text-white px-4 py-2 rounded-xl">Logout</button>

    <a href="profile-section.php">
        <img src="<?= $profile_img ?>" class="w-11 h-11 rounded-full border-2 border-white shadow">
    </a>
</div>

<!-- MAIN CONTENT -->
<div class="container mx-auto p-6 flex-grow mt-16">

    <div class="text-center">
        <h2 class="text-3xl font-bold text-gray-800">
            Welcome, <?= htmlspecialchars($_SESSION["name"]) ?> 👋
        </h2>
        <p class="text-gray-700">We're glad to see you again.</p>
    </div>

    <h1 class="text-center text-5xl font-extrabold text-green-900 mt-4">Saving Goal Tracker</h1>
    <p class="text-center opacity-75">Track your savings and reach your dreams!</p>

    <!-- Stats -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 my-10 text-center">
        <div class="glass p-6">
            <div id="total-goals" class="text-3xl font-bold">0</div>
            <div>TOTAL GOALS</div>
        </div>
        <div class="glass p-6">
            <div id="total-saved" class="text-3xl font-bold">₱0</div>
            <div>TOTAL SAVED</div>
        </div>
        <div class="glass p-6">
            <div id="goals-completed" class="text-3xl font-bold">0</div>
            <div>COMPLETED</div>
        </div>
        <div class="glass p-6">
            <div id="avg-progress" class="text-3xl font-bold">0%</div>
            <div>AVERAGE</div>
        </div>
    </div>

    <!-- Buttons -->
    <div class="flex gap-4 mb-6">
        <button onclick="openGoalModal()"
            class="bg-emerald-600 text-white px-6 py-3 rounded-2xl shadow">➕ Add Goal</button>

        <button onclick="toggleAnalytics()"
            class="bg-emerald-600 text-white px-6 py-3 rounded-2xl shadow">📊 Analytics</button>
    </div>

    <!-- Goals -->
    <div id="goals-container" class="grid md:grid-cols-2 lg:grid-cols-3 gap-6"></div>

    <div id="empty-state" class="hidden text-center mt-10 text-gray-700">
        <h2 class="text-2xl font-bold">No Goals Yet</h2>
        <button onclick="openGoalModal()"
            class="mt-4 bg-emerald-600 text-white px-6 py-3 rounded-xl">Create Goal</button>
    </div>

    <!-- Analytics -->
    <div id="analytics-section" class="hidden rounded-3xl mt-10 p-8 glass">
        <h2 class="text-xl font-extrabold text-green-900 mb-4">📊 Savings Analytics</h2>

        <canvas id="progressChart" class="w-full max-h-[260px] mb-8"></canvas>
        <canvas id="pieChart" class="w-full max-h-[260px]"></canvas>
    </div>

</div>


<!-- =====================
     MODALS
===================== -->

<!-- Add Goal Modal -->
<div id="goal-modal" class="modal">
    <div class="modal-box">
        <h2 class="text-2xl font-bold text-green-900 text-center mb-4">Add Goal</h2>

        <form id="goal-form" class="space-y-4">
            <input id="goal-title" class="w-full p-3 rounded-xl" placeholder="Goal Title" required>
            <input id="target-amount" type="number" class="w-full p-3 rounded-xl" placeholder="Target Amount" required>
            <input id="target-date" type="date" class="w-full p-3 rounded-xl" required>

            <div class="flex gap-3">
                <button type="button" onclick="closeGoalModal()" class="w-1/2 bg-gray-200 py-2 rounded-xl">Cancel</button>
                <button type="submit" class="w-1/2 bg-emerald-600 text-white py-2 rounded-xl">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Add Money Modal -->
<div id="money-modal" class="modal">
    <div class="modal-box">
        <h2 class="text-xl font-bold mb-4">Add Money</h2>

        <form id="money-form">
            <input id="deposit-amount" type="number" class="w-full p-3 rounded-xl mb-3" placeholder="Amount" required>
            <input id="money-goal-id" type="hidden">

            <div class="flex gap-3">
                <button type="button" onclick="closeAddMoneyModal()" class="w-1/2 bg-gray-300 py-2 rounded-xl">Cancel</button>
                <button type="submit" class="w-1/2 bg-emerald-600 text-white py-2 rounded-xl">Add</button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Modal -->
<div id="delete-modal" class="modal">
    <div class="modal-box text-center">
        <h2 class="text-lg font-bold mb-3">Delete Goal?</h2>
        <p class="text-gray-700 mb-4">This action cannot be undone.</p>

        <input id="delete-goal-id" type="hidden">

        <div class="flex gap-3">
            <button onclick="closeDeleteModal()" class="w-1/2 bg-gray-300 py-2 rounded-xl">Cancel</button>
            <button onclick="confirmDeleteGoal()" class="w-1/2 bg-red-500 text-white py-2 rounded-xl">Delete</button>
        </div>
    </div>
</div>


<!-- =====================
     JAVASCRIPT
===================== -->

<script>
let goals = [];
let user_id = "<?= $user_id ?>";

const pastelColors = ["#6EE7B7", "#93C5FD", "#FBCFE8", "#FDE68A", "#C4B5FD", "#FCA5A5", "#A5F3FC", "#FDBA74", "#D9F99D"];

document.addEventListener("DOMContentLoaded", loadGoals);

// Load goals
function loadGoals() {
    fetch("./api/goals/get_goals.php?user_id=" + user_id)
        .then(r => r.json())
        .then(data => {
            goals = data || [];
            renderGoals();
            updateStats();
        });
}

// Render goals
function renderGoals() {
    const cont = document.getElementById("goals-container");
    const empty = document.getElementById("empty-state");

    if (goals.length === 0) {
        cont.innerHTML = "";
        empty.classList.remove("hidden");
        return;
    }

    empty.classList.add("hidden");

    cont.innerHTML = goals.map(g => {
        let pct = (g.current_amount / g.target_amount) * 100;
        pct = Math.min(pct, 100);

        return `
        <div class="goal-card">
            <div class="flex justify-between">
                <h3 class="text-xl font-bold">${g.title}</h3>
                <div class="flex gap-2">
                    <span onclick="openAddMoneyModal('${g.id}')" class="cursor-pointer text-green-700">💰</span>
                    <span onclick="openDeleteModal('${g.id}')" class="cursor-pointer text-red-700">🗑️</span>
                </div>
            </div>

            <div class="flex justify-between text-gray-600 mt-2">
                <span>₱${Number(g.current_amount).toLocaleString()}</span>
                <span>₱${Number(g.target_amount).toLocaleString()}</span>
            </div>

            <div class="w-full bg-gray-300 h-3 rounded-full mt-2">
                <div class="h-full rounded-full" style="width:${pct}%; background:#10B981;"></div>
            </div>

            <p class="text-center font-bold mt-1">${pct.toFixed(1)}%</p>
        </div>`;
    }).join("");
}

// Update stats
function updateStats() {
    const tg = goals.length;
    const ts = goals.reduce((a, g) => a + Number(g.current_amount), 0);
    const comp = goals.filter(g => g.current_amount >= g.target_amount).length;
    const avg = tg === 0 ? 0 :
        goals.reduce((a, g) => a + (g.current_amount / g.target_amount * 100), 0) / tg;

    document.getElementById("total-goals").innerText = tg;
    document.getElementById("total-saved").innerText = "₱" + ts.toLocaleString();
    document.getElementById("goals-completed").innerText = comp;
    document.getElementById("avg-progress").innerText = Math.floor(avg) + "%";
}

/* =====================
   MODALS
===================== */

function openGoalModal() {
    document.getElementById("goal-modal").classList.add("active");
}
function closeGoalModal() {
    document.getElementById("goal-modal").classList.remove("active");
}

function openAddMoneyModal(id) {
    document.getElementById("money-goal-id").value = id;
    document.getElementById("money-modal").classList.add("active");
}
function closeAddMoneyModal() {
    document.getElementById("money-modal").classList.remove("active");
}

function openDeleteModal(id) {
    document.getElementById("delete-goal-id").value = id;
    document.getElementById("delete-modal").classList.add("active");
}
function closeDeleteModal() {
    document.getElementById("delete-modal").classList.remove("active");
}

/* =====================
   ADD GOAL
===================== */

document.getElementById("goal-form").addEventListener("submit", e => {
    e.preventDefault();

    fetch("./api/goals/add_goal.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            user_id,
            title: document.getElementById("goal-title").value,
            target_amount: document.getElementById("target-amount").value,
            target_date: document.getElementById("target-date").value
        })
    })
        .then(r => r.json())
        .then(d => {
            if (d.success) {
                closeGoalModal();
                loadGoals();
            }
        });
});

/* =====================
   ADD MONEY
===================== */

document.getElementById("money-form").addEventListener("submit", e => {
    e.preventDefault();

    const id = document.getElementById("money-goal-id").value;
    const amount = Number(document.getElementById("deposit-amount").value);

    fetch("./api/goals/update_goal.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ goal_id: id, amount })
    })
        .then(r => r.json())
        .then(d => {
            if (d.success) {
                closeAddMoneyModal();
                loadGoals();
            }
        });
});

/* =====================
   DELETE GOAL
===================== */

function confirmDeleteGoal() {
    const id = document.getElementById("delete-goal-id").value;

    fetch("./api/goals/delete_goal.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ goal_id: id })
    })
        .then(r => r.json())
        .then(d => {
            if (d.success) {
                closeDeleteModal();
                loadGoals();
            }
        });
}


/* =====================
   ANALYTICS
===================== */

let progressChart, pieChart;

function toggleAnalytics() {
    const el = document.getElementById("analytics-section");
    el.classList.toggle("hidden");

    if (!el.classList.contains("hidden")) {
        renderAnalytics();
    }
}

function renderAnalytics() {
    const ctx = document.getElementById("progressChart");
    const ctx2 = document.getElementById("pieChart");

    if (progressChart) progressChart.destroy();
    if (pieChart) pieChart.destroy();

    const colors = goals.map((g, i) => pastelColors[i % pastelColors.length]);

    progressChart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: goals.map(g => g.title),
            datasets: [{
                label: "Progress (%)",
                data: goals.map(g => Math.min(100, Math.floor((g.current_amount / g.target_amount) * 100))),
                backgroundColor: colors
            }]
        }
    });

    pieChart = new Chart(ctx2, {
        type: "pie",
        data: {
            labels: goals.map(g => g.title),
            datasets: [{
                label: "Saved",
                data: goals.map(g => g.current_amount),
                backgroundColor: colors
            }]
        }
    });
}

</script>

<?php include 'includes/footer.php'; ?>
</body>
</html>
