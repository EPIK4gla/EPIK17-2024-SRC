<?php
session_start();

if (!isset($_SESSION['rank']) || $_SESSION['rank'] !== 'admin') {
    header('Location: /home.php');
    exit;
}

$logFile = "logs.txt";

if (file_exists($logFile)) {
    $logs = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $logs = array_reverse($logs);
    $logs = implode("\n", $logs);
} else {
    $logs = "Log file not found.";
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

    <h1>View Logs</h1>
    <hr>
    
    <pre><?php echo $logs; ?></pre>
  </div></div>

    <?php include('../doc/footer.php'); ?>

</body>
</html>
