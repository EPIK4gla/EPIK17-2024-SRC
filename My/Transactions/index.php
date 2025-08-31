<?php

session_start();
if(!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$inventoryData = file_get_contents('../../doc/inventory.txt');
if(!empty($inventoryData)) {
    $inventoryLines = explode("\n", $inventoryData);
    $inventory = array();
    foreach($inventoryLines as $line) {
        $fields = explode("|", $line);
        if(count($fields) === 3) {
            $inventory[] = array(
                'username' => $fields[0],
                'itemid' => $fields[1],
                'robloxassetid' => $fields[2]
            );
        }
    }
} else {
    $inventory = array();
}

$catalogData = file_get_contents('../../Catalog/catalog.txt');
$catalog = json_decode($catalogData, true);

$currentUsername = $_SESSION['username'];

if(is_array($inventory) && is_array($catalog)) {
    foreach($inventory as $item) {
        if($item['username'] === $currentUsername) {
            foreach($catalog as $catalogItem) {
                if($catalogItem['creator'] === $currentUsername && $catalogItem['id'] === $item['itemid']) {
                    echo "Username: " . $item['username'] . ", Item ID: " . $item['itemid'] . ", Asset ID: " . $item['robloxassetid'] . "<br>";
                }
            }
        }
    }
} else {
    echo "Inventory data or catalog data is not available or not in the expected format.";
}

?>
