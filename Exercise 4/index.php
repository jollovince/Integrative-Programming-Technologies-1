<?php
$members = [  
[  
  "name" => "Vince Jollo Grafel",  
  "age" => 23,  
  "birthday" => "April 4, 2002",  
  "school" => "Pamantasan Ng Lungsod Ng Muntinlupa",  
  "course" => "Bachelor of Science in Information Technology",  
  "hobbies" => "Basketball, Gaming, Watching Anime, Reading Manga",  
  "image" => "images/jollo.jpg",  
  "quote" => "Your future self is already thanking you for studying today.",  
  "qr" => "images/qr-code-jollo.png",  
  "github" => "https://github.com/jollovince/Integrative-Programming-Technologies-1",  
  "imgClass" => "profile-img-jollo"  
],  
[  
  "name" => "Akimi Mariel Magpantay",  
  "age" => 20,  
  "birthday" => "September 12, 2004",  
  "school" => "Pamantasan Ng Lungsod Ng Muntinlupa",  
  "course" => "Bachelor of Science in Information Technology",  
  "hobbies" => "Watchng K-drama",  
  "image" => "images/akimi.jpg",  
  "quote" => "Be the brightest star even on the darkest night",  
  "qr" => "images/qr-code-akimi.png",  
  "github" => "https://github.com/akimimarielmagpantay/Integrative-Programming",  
  "imgClass" => "profile-img-magpantay"  
],  
[  
  "name" => "Mikee Dorol",  
  "age" => 20,  
  "birthday" => "November 02, 2004",  
  "school" => "Pamantasan Ng Lungsod Ng Muntinlupa",  
  "course" => "Bachelor of Science in Information Technology",  
  "hobbies" => "Watching Kdrama, Codm",  
  "image" => "images/mikee.jpg",  
  "quote" => "Que sera, sera",  
  "qr" => "images/qr-code-mikee.png",  
  "github" => "https://github.com/dorolmikeebsit-gif/Integrative-Programming-Technologies-1",  
  "imgClass" => "profile-img-dorol"  
],  
[  
  "name" => "Juliana Guanzon",  
  "age" => 20,  
  "birthday" => "June 25, 2005",  
  "school" => "Pamantasan Ng Lungsod Ng Muntinlupa",  
  "course" => "Bachelor of Science in Information Technology",  
  "hobbies" => "Watching Kdrama series, Playing with my dogs, Billiard",  
  "image" => "images/Juliana.jpg",  
  "quote" => "Walang mainit na kape, sa matigas mong tinapay",  
  "qr" => "images/qr-code-juliana.png",  
  "github" => "https://github.com/Julianaguanzon/INTPROG-TECHNOLOGIES-1",  
  "imgClass" => "profile-img-guanzon"  
]  
];  

// Search (GET)
$search = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';
if ($search) {
  $members = array_filter($members, function($m) use ($search) {
    return stripos($m['name'], $search) !== false;
  });
}

// POST Add Member
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $newName = trim($_POST['name']);

  // Check duplicate name (case-insensitive)
  $duplicate = false;
  foreach ($members as $m) {
    if (strcasecmp($m['name'], $newName) === 0) {
      $duplicate = true;
      break;
    }
  }

  if ($duplicate) {
    echo "<script>alert(' Duplicate name detected! \"$newName\" already exists.');</script>";
  } else {
    // Handle Profile Image Upload
    $imgName = time() . "_" . basename($_FILES['image']['name']);
    $imgTmp = $_FILES['image']['tmp_name'];
    $imgPath = "images/" . $imgName;
    move_uploaded_file($imgTmp, $imgPath);

    // Handle QR Code Upload
    $qrName = time() . "_" . basename($_FILES['qr']['name']);
    $qrTmp = $_FILES['qr']['tmp_name'];
    $qrPath = "images/" . $qrName;
    move_uploaded_file($qrTmp, $qrPath);

    $newMember = [
      "name" => $newName,
      "age" => $_POST['age'],
      "birthday" => $_POST['birthday'],
      "school" => $_POST['school'],
      "course" => $_POST['course'],
      "hobbies" => $_POST['hobbies'],
      "image" => $imgPath,
      "quote" => $_POST['quote'],
      "qr" => $qrPath,
      "github" => $_POST['github'],
      "imgClass" => "profile-img-default"
    ];
    $members[] = $newMember;
    echo "<script>alert(' Successfully added $newName!');</script>";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<title>Exercise 1</title>
<link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
/* ===== Modal Styling ===== */
.modal {
  display: none;
  position: fixed;
  z-index: 999;
  left: 0; top: 0;
  width: 100%; height: 100%;
  background: rgba(0,0,0,0.6);
  justify-content: center;
  align-items: center;
}
.modal-content {
  background: #fff;
  padding: 20px;
  border-radius: 12px;
  width: 90%;
  max-width: 400px;
  text-align: center;
  position: relative;
}
.modal-content h3 {
  margin-top: 0;
  font-size: 1.4rem;
}
.modal-content input {
  width: 100%;
  padding: 8px;
  margin: 6px 0;
  border: 1px solid #ccc;
  border-radius: 6px;
}
.modal-content button {
  margin-top: 10px;
  padding: 8px 15px;
  border: none;
  border-radius: 6px;
  background: #007bff;
  color: #fff;
  cursor: pointer;
}
.modal-content button:hover {
  background: #0056b3;
}
.close-btn {
  position: absolute;
  top: 10px; right: 15px;
  font-size: 20px;
  cursor: pointer;
}
</style>
</head>
<body>

<div id="mainContent">
  <!-- Logo -->
  <h1 class="title">
    <img src="images/logo.png" alt="AnteMaloi Logo">
  </h1>
  <button id="darkModeToggle" class="dark-mode-toggle"></button>

  <!-- Search -->
  <form method="get" style="text-align:center; margin:20px;">
    <input type="text" name="search" placeholder="Search name..." value="<?php echo htmlspecialchars($_GET['search'] ?? '', ENT_QUOTES); ?>">
    <button type="submit">Search</button>
  </form>

  <!-- Add Member (trigger modal) -->
  <div style="text-align:center; margin:20px;">
    <button id="openModal" class="btn-add">➕ Add Member</button>
  </div>

  <!-- Modal Form -->
  <div id="addMemberModal" class="modal">
    <div class="modal-content">
      <span class="close-btn" id="closeModal">&times;</span>
      <h3>Add Member</h3>
      <form method="post" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="number" name="age" placeholder="Age" required>
        <input type="text" name="birthday" placeholder="Birthday" required>
        <input type="text" name="school" placeholder="School" required>
        <input type="text" name="course" placeholder="Course" required>
        <input type="text" name="hobbies" placeholder="Hobbies" required>
        <input type="text" name="quote" placeholder="Favorite Quote" required>
        <input type="url" name="github" placeholder="GitHub Link" required>
        
        <label>Profile Picture:</label>
        <input type="file" name="image" accept="image/*" required>
        
        <label>QR Code:</label>
        <input type="file" name="qr" accept="image/*" required>
        
        <button type="submit">Add</button>
      </form>
    </div>
  </div>

  <!-- Team Section -->
  <div class="team-grid">
    <?php if (!empty($members)): ?>
      <?php foreach ($members as $m): ?>
        <div class="flip-card">
          <div class="flip-card-inner">
            <div class="flip-card-front profile-card">
              <p class="quote">"<?php echo $m['quote']; ?>"</p>
              <img src="<?php echo $m['image']; ?>" alt="Picture of <?php echo $m['name']; ?>" class="profile-img <?php echo $m['imgClass']; ?>">
              <h2><?php echo $m['name']; ?></h2>
              <p><strong>Age:</strong> <?php echo $m['age']; ?></p>
              <p><strong>Birthday:</strong> <?php echo $m['birthday']; ?></p>
              <p><strong>School:</strong> <?php echo $m['school']; ?></p>
              <p><strong>Course:</strong> <?php echo $m['course']; ?></p>
              <p><strong>Hobbies:</strong> <?php echo $m['hobbies']; ?></p>
            </div>
            <div class="flip-card-back profile-card">
              <div class="qr-container">
                <h3>Connect with <?php echo explode(" ", $m['name'])[0]; ?></h3>
                <h4>Scan This</h4>
                <img src="<?php echo $m['qr']; ?>" alt="QR Code for <?php echo $m['name']; ?>" class="qr-code">
                <a href="<?php echo $m['github']; ?>" class="qr-link" target="_blank">
                  <i class="fab fa-github"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p style="text-align:center;">No results found.</p>
    <?php endif; ?>
  </div>
</div>

<script>
// Modal JS
const modal = document.getElementById("addMemberModal");
const openBtn = document.getElementById("openModal");
const closeBtn = document.getElementById("closeModal");

openBtn.onclick = () => modal.style.display = "flex";
closeBtn.onclick = () => modal.style.display = "none";
window.onclick = (e) => { if (e.target == modal) modal.style.display = "none"; }
</script>

<script src="script.js"></script>
</body>
</html>
