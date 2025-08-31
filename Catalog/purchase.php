<?php
session_start();

if (!isset($_SESSION['username'])) {
    exit('User not logged in.');
}

$username = $_SESSION['username'];
$itemId = $_GET['id'];

function fetchUserData($username) {
    $userData = file_get_contents("../doc/users.txt");
    $userLines = explode("\n", $userData);

    foreach ($userLines as $userLine) {
        $user = explode(" | ", $userLine);
        if (isset($user[1]) && $user[1] == $username) {
            return $user;
        }
    }

    return null;
}

function updateUserData($username, $data) {
    $userData = file_get_contents("../doc/users.txt");
    $userLines = explode("\n", $userData);
    $updatedUserData = '';

    foreach ($userLines as &$userLine) {
        $user = explode(" | ", $userLine);
        if (isset($user[1]) && $user[1] == $username) {
            $user = $data;
            $userLine = implode(' | ', $user);
        }
        $updatedUserData .= $userLine . "\n";
    }

    while (count($userLines) > count(explode("\n", $updatedUserData))) {
        $updatedUserData .= "\n";
    }

    file_put_contents("../doc/users.txt", rtrim($updatedUserData));
}

function fetchItemData($itemId) {
    $catalogData = file_get_contents("catalog.txt");
    $catalogItems = explode("\n", $catalogData);

    foreach ($catalogItems as $item) {
        if (empty($item)) {
            continue;
        }

        $itemData = json_decode($item, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            continue;
        }

        if ($itemData['id'] == $itemId) {
            return $itemData;
        }
    }

    return null;
}

$userData = fetchUserData($_SESSION['username']);

if (!$userData) {
    exit('User data not found.');
}

$userEpikBux = isset($userData[3]) ? intval($userData[3]) : 0;
$itemId = isset($_GET['id']) ? $_GET['id'] : null;

if (!$itemId) {
    exit('Invalid item ID.');
}

$itemData = fetchItemData($itemId);

if (!$itemData) {
    exit('Item data not found.');
}

$itemPrice = $itemData['price'];

if ($itemPrice == -1) {
    header('Location: /Catalog/' . $itemId . '/' . $itemData['name']);
    exit;
}

if ($userEpikBux >= $itemPrice) {
    $userEpikBux -= $itemPrice;

    $creatorUsername = $itemData['creator'];
    $creatorData = fetchUserData($creatorUsername);
    if ($creatorData) {
        $creatorEpikBux = isset($creatorData[3]) ? intval($creatorData[3]) : 0;
        $creatorEpikBux += $itemPrice;
        $creatorData[3] = $creatorEpikBux;
        updateUserData($creatorUsername, $creatorData);
    } else {
        exit('Creator data not found.');
    }

    $userData[3] = $userEpikBux;
    updateUserData($_SESSION['username'], $userData);
  
    $logEntry = "[" . date("m/d/Y | H:i:s") . "] " .$_SESSION['username'] . " Bought item: " .$itemData['name']." (ID: $itemId) for $itemPrice EpikBux";
    file_put_contents('../Admin/logs.txt', $logEntry . PHP_EOL, FILE_APPEND);

    $inventoryData = $_SESSION['username'] . '|' . $itemId . '|' . $itemData['robloxassetid'] . "\n";
    file_put_contents('../doc/inventory.txt', $inventoryData, FILE_APPEND);

    header('Location: /Catalog/' . $itemId . '/' . $itemData['name']);
    exit;
} else {
    header('Location: /Catalog/' . $itemId . '/' . $itemData['name']);
    exit;
}
?>