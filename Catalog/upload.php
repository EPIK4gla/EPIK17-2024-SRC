<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: /');
    exit();
}

function sendWebhook($data) {
  $file = fopen("catalog.txt", "r");
    $count = count(file("catalog.txt")) + 1;
    fclose($file);
    $webhookUrl = "https://discord.com/api/webhooks/1206038206588518460/BpXmdz8XmI8iR8ZRuI1dZphqUvgG30SJdmPaq03_fjH8iQJXYDcU1C0_sJoVHuCFQJ29";

    $payload = json_encode(array(
    'embeds' => array(
        array(
            'title' => (isset($data['Name']) ? $data['Name'] : 'Unknown') . ' | By: ' . (isset($data['username']) ? $data['username'] : 'Unknown'),
            'description' => isset($data['Description']) ? $data['Description'] : 'No description available',
            'thumbnail' => array('url' => isset($data['Thumbnail']) ? $data['Thumbnail'] : ''),
            'fields' => array(
                array('name' => 'Price', 'value' => (isset($data['Price']) ? $data['Price'] : 'Unknown') . ' E$', 'inline' => true)
            )
        )
    )
));



    $curl = curl_init($webhookUrl);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($payload))
    );

    $response = curl_exec($curl);

    if ($response === false) {
        echo 'Error: ' . curl_error($curl);
    } else {
        echo $response;
    }
    curl_close($curl);
}

if (!isset($_SESSION['username'])) {
    if ($rank !== 'admin') {
        header('Location: /');
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function fetchRobloxData($assetId) {
        $url = "https://economy.roblox.com/v2/assets/{$assetId}/details/";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }

    function fetchThumbnailUrl($assetId) {
        $url = "https://thumbnails.roblox.com/v1/assets?assetIds={$assetId}&returnPolicy=PlaceHolder&size=250x250&format=Png&isCircular=false";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response, true);
        return isset($data['data'][0]['imageUrl']) ? $data['data'][0]['imageUrl'] : '';
    }

    function getUserEpikBux($userId) {
    $usersFile = "../doc/users.txt";
    $lines = file($usersFile);

    foreach ($lines as $line) {
        $user = explode(' | ', $line);
        if ($user[0] == $userId) {
            return (int) $user[3];
        }
    }

    return 0;
}

function updateUserEpikBux($userId, $newEpikBux) {
    $usersFile = "../doc/users.txt";
    $lines = file($usersFile);
    $output = '';

    foreach ($lines as $line) {
        $user = explode(' | ', $line);
        if ($user[0] == $userId) {
            $user[3] = $newEpikBux;
        }
        $output .= implode(' | ', $user);
    }

    file_put_contents($usersFile, $output);
}

function writeToFile($data) {
    $rank = $_SESSION['rank'];
    $userId = $_SESSION['id'];
      
    if ($rank !== 'admin') {
        $epikBuxRequired = 10;
        $userEpikBux = getUserEpikBux($userId);

        if ($userEpikBux >= $epikBuxRequired) {
            $newEpikBux = $userEpikBux - $epikBuxRequired;
            updateUserEpikBux($userId, $newEpikBux);
        } else {
            echo('<center class="text-danger">You need at least 10 EpikBux to upload the item.</center>');
            exit();
        }
    }

    if ($rank === 'admin') {

    } else {
        if ($data['AssetTypeId'] !== 11 && $data['AssetTypeId'] !== 12 && $data['AssetTypeId'] !== 2) {
            echo('<center class="text-danger">Only shirts, pants and t-shirts can be created.</center>');
            exit();
            return;
        }
    
}

      
    $existingItems = file_get_contents("catalog.txt");
    $existingItemsArray = explode("\n", $existingItems);
    foreach ($existingItemsArray as $existingItem) {
        $existingItemData = json_decode($existingItem, true);
        if ($existingItemData['robloxassetid'] == $data['AssetId']) {
            echo('<center class="text-danger">This item already exists.</center>');
            exit();
        }
    }

    $creator = $_SESSION['username'];
    $price = isset($_POST['price']) && $_POST['price'] !== '' ? $_POST['price'] : ($robloxData['PriceInRobux'] === null ? -1 : $robloxData['PriceInRobux']);

    $file = fopen("catalog.txt", "r");
    $count = count(file("catalog.txt")) + 1;
    fclose($file);

    $currentTime = date("d/m/Y");
    
    $formattedData = array(
        'id' => $count,
        'robloxassetid' => $data['AssetId'],
        'name' => $data['Name'],
        'description' => $data['Description'],
        'creator' => $creator,
        'thumbnail' => fetchThumbnailUrl($data['AssetId']),
        'price' => $price,
        'is_limited' => $data['IsLimited'],
        'is_public_domain' => $data['IsPublicDomain'],
        'created' => $currentTime,
        'last_updated' => $currentTime
    );
  
    $logEntry = "[" . date("m/d/Y | H:i:s") . "] " .$_SESSION['username'] . " Uploaded item: " .$data['Name']." (ID: $count)";
    file_put_contents('../Admin/logs.txt', $logEntry . PHP_EOL, FILE_APPEND);
    

    $file = fopen("catalog.txt", "a");
    fwrite($file, json_encode($formattedData) . "\n");
    fclose($file);

    if ($creator === 'lvtkr' || $creator === 'omar' || $creator === 'bob' || $creator === 'some') {
        $inventoryData = 'lvtkr' . '|' . $count . '|' . $data['AssetId'] . "\n";
        file_put_contents('../doc/inventory.txt', $inventoryData, FILE_APPEND);
    
        $inventoryData = 'omar' . '|' . $count . '|' . $data['AssetId'] . "\n";
        file_put_contents('../doc/inventory.txt', $inventoryData, FILE_APPEND);
    } else if ($creator === $_SESSION['username'] && $creator !== 'lvtkr' && $creator !== 'omar') {
        $inventoryData = $_SESSION['username'] . '|' . $count . '|' . $data['AssetId'] . "\n";
        file_put_contents('../doc/inventory.txt', $inventoryData, FILE_APPEND);
    }
}

  if(isset($_POST['roblox_id'])) {
    $robloxUrl = $_POST['roblox_id'];
    $pattern = '/(\d+)/';
    preg_match($pattern, $robloxUrl, $matches);
    $assetId = isset($matches[0]) ? $matches[0] : $robloxUrl;
    
    $robloxData = fetchRobloxData($assetId);
    writeToFile($robloxData);
    
    
    $thumbnailUrl = fetchThumbnailUrl($assetId);
    $price = isset($_POST['price']) && $_POST['price'] !== '' ? $_POST['price'] : ($robloxData['PriceInRobux'] === null ? -1 : $robloxData['PriceInRobux']);

    $webhookData = array(
        'username' => isset($_SESSION['username']) ? $_SESSION['username'] : 'Unknown',
        'Name' => isset($robloxData['Name']) ? $robloxData['Name'] : 'Unknown',
        'Description' => isset($robloxData['Description']) ? $robloxData['Description'] : 'No description available',
        'Thumbnail' => $thumbnailUrl,
        'AssetId' => $assetId,
        'Price' => $price
    );

    sendWebhook($webhookData);
} else {
    echo "Error: 'roblox_id' not found in POST data.";
}


    $count = count(file("catalog.txt"));
    header('Location: /Catalog/' . $count . '/' . $robloxData['Name']);
  
}

include('../doc/header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPIK17</title>
    <script>
        function validatePrice() {
            var priceInput = document.getElementById("price").value;
            var regex = /^\d+$/;
            if (!regex.test(priceInput)) {
                alert("Please enter only numbers for the price.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
<div class="container-main">
    <div class="content">
        <div class="col-xs-12 col-sm-6">
            <div class="section-content">
                <div class="card-body">
                    <h3 class="text-center mb-4">Upload</h3>
                    <hr>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validatePrice()">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter Roblox URL or ID" id="roblox_id" name="roblox_id" title="Enter a valid Roblox URL or ID" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Price" id="price" name="price" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-buy-lg btn-full-width">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('../doc/footer.php'); ?>
</body>
</html>
