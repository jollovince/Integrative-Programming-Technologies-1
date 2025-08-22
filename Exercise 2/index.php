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
    "name" => "juliana Guanzon",
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
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<title>Exercise 1</title>
<link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"></a>
</head>
<body>

<!-- Main content wrapper -->
<div id="mainContent">

<!-- Logo -->
<h1 class="title">
  <img src="images/logo.png" alt="AnteMaloi Logo">
</h1>
<!-- Dark Mode Toggle -->
<button id="darkModeToggle" class="dark-mode-toggle"></button>

<!-- Team Section -->
  <div class="team-grid">
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
  </div>
</div> <!-- End of mainContent -->

<!-- Script -->
<script src="script.js"></script>
</body>
</html>
