<?php
session_start();

if (!isset($_SESSION['rank']) || $_SESSION['rank'] !== 'admin') {
    header('Location: /home.php');
    exit;
}

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$itemid = filter_input(INPUT_POST, 'itemid', FILTER_SANITIZE_NUMBER_INT);

if ($username !== null && $itemid !== null) {
    $catalog = file_get_contents('../Catalog/catalog.txt');
    $catalog_lines = explode("\n", $catalog); 

    $item_found = false;
    $robloxassetid = null;
    foreach ($catalog_lines as $line) {
        $entry = json_decode($line, true); 
        if ($entry && isset($entry['id']) && $entry['id'] == $itemid) {
            $item_found = true;
            $robloxassetid = $entry['robloxassetid'];
            break;
        }
    }

    if ($item_found) {
        $inventory_entry = "$username|$itemid|$robloxassetid";
        if (file_put_contents('../doc/inventory.txt', $inventory_entry . PHP_EOL, FILE_APPEND) !== false) {
            
            $logEntry = "[" . date("m/d/Y | H:i:s") . "] " .$_SESSION['username'] . " added ItemID: $itemid to $username";
            if (file_put_contents('logs.txt', $logEntry . PHP_EOL, FILE_APPEND) !== false) {
            
            } else {
                echo "Failed to log.<br>";
            }
        } else {
            echo "Failed to add to inventory.<br>";
        }
    } else {
        echo "Item not found in catalog.<br>";
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
    <div class="container-main content col-xs-12 section-content ">
    <h1>Item Giver</h1>
  
    <hr>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required><br>
        <input type="number" class="form-control" id="itemid" name="itemid" placeholder="Item ID" required><br>
        <input type="submit" class="btn-full-width btn-control-md" value="Give Item">
    </form>
</div>
    <?php include('../doc/footer.php'); ?>

</body>
</html>
