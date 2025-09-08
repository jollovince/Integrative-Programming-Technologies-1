<?php include 'members.php';
// Your $members array (same as before)

$selectedMember = null;

// Check if `member` is in the URL and valid
if (isset($_GET['member']) && isset($members[$_GET['member']])) {
    $selectedMember = $members[$_GET['member']];
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<title>Exercise 2</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<div id="mainContent">
<h1 class="title">
  <img src="images/logo.png" alt="AnteMaloi Logo">
</h1>
<button id="darkModeToggle" class="dark-mode-toggle"></button>

<div class="team-grid">
  <?php if ($selectedMember): ?>
    <!-- Show only the selected member -->
    <div class="flip-card">
      <div class="flip-card-inner">
        <div class="flip-card-front profile-card">
          <p class="quote">"<?php echo $selectedMember['quote']; ?>"</p>
          <img src="<?php echo $selectedMember['image']; ?>" 
               alt="Picture of <?php echo $selectedMember['name']; ?>" 
               class="profile-img <?php echo $selectedMember['imgClass']; ?>">
          <h2><?php echo $selectedMember['name']; ?></h2>
          <p><strong>Age:</strong> <?php echo $selectedMember['age']; ?></p>
          <p><strong>Birthday:</strong> <?php echo $selectedMember['birthday']; ?></p>
          <p><strong>School:</strong> <?php echo $selectedMember['school']; ?></p>
          <p><strong>Course:</strong> <?php echo $selectedMember['course']; ?></p>
          <p><strong>Hobbies:</strong> <?php echo $selectedMember['hobbies']; ?></p>
        </div>
        <div class="flip-card-back profile-card">
          <div class="qr-container">
            <h3>Connect with <?php echo explode(" ", $selectedMember['name'])[0]; ?></h3>
            <h4>Scan This</h4>
            <img src="<?php echo $selectedMember['qr']; ?>" alt="QR Code for <?php echo $selectedMember['name']; ?>" class="qr-code">
            <a href="<?php echo $selectedMember['github']; ?>" class="qr-link" target="_blank">
              <i class="fab fa-github"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  <?php else: ?>
    <!-- Show all members -->
    <?php foreach ($members as $index => $m): ?>
      <div class="flip-card">
        <div class="flip-card-inner">
          <div class="flip-card-front profile-card">
            <p class="quote">"<?php echo $m['quote']; ?>"</p>
            <img src="<?php echo $m['image']; ?>" 
                 alt="Picture of <?php echo $m['name']; ?>" 
                 class="profile-img <?php echo $m['imgClass']; ?>">
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
  <?php endif; ?>
</div>
</div>
</body>
</html>
