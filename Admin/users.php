<?php
session_start();
if ($_SESSION['rank'] !== 'admin') {
    header('Location: /home.php');
    exit; // Terminate script execution after redirect
}

$usersFilePath = "../doc/users.txt";
$bannedFilePath = "../doc/banned.txt";

// Read the list of banned users into an array
$bannedUsers = [];
if (file_exists($bannedFilePath)) {
    $bannedUsers = file($bannedFilePath, FILE_IGNORE_NEW_LINES);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EPIK17 Admin Panel</title>
</head>
<body>
  <?php include('header.php'); ?>
  <h1>Manage Users</h1>
  <hr>

  <?php
  if (file_exists($usersFilePath)) {
      $fileContent = file_get_contents($usersFilePath);
      $lines = explode("\n", $fileContent);
      
      foreach ($lines as $line) {
          $userData = explode("|", $line);
          $username = $userData[1];
          $isBanned = in_array($username, $bannedUsers);
          ?>
          <li class="list-item avatar-card">
              <div class="avatar-card-container <?php echo $isBanned ? 'disabled' : ''; ?>">
                  <div class="avatar-card-content">
                      <div class="avatar-card-fullbody">
                          <a href="#" class="avatar-card-link">
                              <img src="http://ep7.ct8.pl/Thumbs/Headshots/<?php echo htmlspecialchars($username); ?>.png">
                          </a>
                      </div>
                      <div class="avatar-card-caption">
                          <div class="text-overflow avatar-name"><?php echo htmlspecialchars($username); ?></div>
                      </div>
                  </div>
                  <div class="avatar-card-btns">
                      <button class="btn-secondary-md"></button>
                      <?php if ($isBanned) : ?>
                          <button class="btn-control-md">Unban</button>
                      <?php else: ?>
                          <button class="btn-control-md">Ban</button>
                      <?php endif; ?>
                  </div>
              </div>
          </li>
          <?php
      }
  } else {
      echo "File not found.";
  }
  ?>

  </div>
  </div>

  <?php include('../doc/footer.php'); ?>

</body>
</html>
