<?php
session_start();

if ($_SESSION['rank'] !== 'admin') {
    header('Location: /home.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['userId']) && isset($_POST['epikBux']) && !empty($_POST['userId']) && !empty($_POST['epikBux'])) {
        $file = "../doc/users.txt";
        $logFile = "logs.txt";
        $userId = $_POST['userId'];
        $epikBux = intval($_POST['epikBux']);

        if (is_numeric($epikBux)) {
            $lines = file($file, FILE_IGNORE_NEW_LINES);
            $updated = false;

            foreach ($lines as &$line) {
                $userData = explode(" | ", $line);
                if ($userData[0] === $userId || $userData[1] === $userId) {
                    $balance = intval($userData[3]);
                    $balance += $epikBux;
                    $userData[3] = $balance;
                    $line = implode(" | ", $userData);
                    $updated = true;

                    $username = $userData[1]; 
                    $logEntry = "[" . date("m/d/Y | H:i:s") . "] " .$_SESSION['username'] . " gave $epikBux EpikBux to $username (ID: $userId)";
                    file_put_contents($logFile, $logEntry . PHP_EOL, FILE_APPEND);
                }
            }

            if ($updated) {
                if (file_put_contents($file, implode(PHP_EOL, $lines)) !== false) {
                    echo "EpikBux added successfully to user: $userId.";
                } else {
                    echo "Failed to update balance. Please try again later.";
                }
            } else {
                echo "User not found.";
            }
        } else {
            echo "Invalid input. Please provide a numeric EpikBux value.";
        }
    } else {
        echo "Invalid input. Please provide a valid user ID or username and a numeric EpikBux value.";
    }
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

    <h1>Epikbux Giver</h1>
  
    <hr>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="text" class="form-control" id="userId" name="userId" placeholder="User ID or Username." required><br>
        <input type="number" class="form-control" id="epikBux" name="epikBux" placeholder="Epikbux Number." required><br>
        <input type="submit" class="btn-full-width btn-control-md" value="Add EpikBux">
    </form>

    <?php include('../doc/footer.php'); ?>

</body>
</html>
