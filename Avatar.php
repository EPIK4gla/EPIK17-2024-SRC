<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: /');
    exit();
}

function fetchInventoryData($username)
{
    $inventory = [];
    $file = fopen("doc/inventory.txt", "r");
    if ($file) {
        while (($line = fgets($file)) !== false) {
            $data = explode("|", $line);
            if ($data[0] === $username) {
                $inventory[] = $data;
            }
        }
        fclose($file);
    }
    return array_reverse($inventory);
}

function fetchItemDetails($itemId)
{
    $catalogData = file_get_contents("Catalog/catalog.txt");
    $items = explode("\n", $catalogData);
    foreach ($items as $item) {
        $itemData = json_decode($item, true);
        if ($itemData['id'] == $itemId) {
            return $itemData;
        }
    }
    return null;
}

$inventoryData = fetchInventoryData($_SESSION['username']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel='stylesheet' href='/content/css/CSS10.css' />
  <title>Inventory</title>
</head>
<body>
<?php include('doc/header.php'); ?>
<div class="container-main">
            <div class="content">
          <div class="container-header">
                <h2>Avatar Customization</h2>
                <button style="position: absolute; right: 35px;" class="btn btn-success btn-sm mt-2" onclick="saveCharacter()">Save Character</button>
            </div>
          
          
          <hr>
          
          <div class="container-list profile-avatar">

    <div class="col-sm-4 profile-avatar-left">
<div id="UserAvatar" class="thumbnail-holder" data-reset-enabled-every-page data-3d-thumbs-enabled data-url="https://www.roblox.com/thumbnail/user-avatar?userId=1848960&amp;thumbnailFormatId=124&amp;width=300&amp;height=300" style="width:300px; height:300px;">
    <span class="thumbnail-span" data-3d-url="http://web.archive.org/web/20160807153806im_/https://t5.rbxcdn.com/b082c01b099e8a0e8bd6a50c2b06e135" data-js-files="https://js.rbxcdn.com/95518cef4aea4b89a95e61452d70c3bb.js">
 <?php
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    require_once "render/Assemblies/Roblox/Grid/Rcc/RCCServiceSoap.php";
    $RCCServiceSoap = new RCCServiceSoap();
    $charAppUrl = 'http://eb2.ct8.pl/Avatars/' . $username . '.txt';

    $avatarUrl = "http://eb2.ct8.pl/Avatars/{$username}.txt";
$defaultUrl = "http://eb2.ct8.pl/charapp.txt";

if (@file_get_contents($avatarUrl)) {
    $file = "plr.CharacterAppearance = '{$avatarUrl}';";
} else {
    $file = "plr.CharacterAppearance = '{$defaultUrl}';";
}

  
    $headshot = '
        local baseHatZoom = 30
        local maxHatZoom = 100

        game:GetService("ContentProvider"):SetBaseUrl("http://eb2.ct8.pl/")
        game:GetService("ScriptContext").ScriptsDisabled = true

        local plr = game.Players:CreateLocalPlayer(1)
        ' . $file . '
        plr:LoadCharacter(false)

        local maxDimension = 0

        if plr.Character then
            for _, child in pairs(plr.Character:GetChildren()) do
                if child:IsA("Tool") then
                    child:Destroy()
                elseif child:IsA("Accoutrement") then
                    local size = child.Handle.Size / 2 + child.Handle.Position - plr.Character.Head.Position
                    local xy = Vector2.new(size.x, size.y)
                    if xy.magnitude > maxDimension then
                        maxDimension = xy.magnitude
                    end
                end
            end

            local maxHatOffset = 0.5
            maxDimension = math.min(1, maxDimension / 3)

            local viewOffset     = plr.Character.Head.CFrame * CFrame.new(0, 0 + maxHatOffset * maxDimension, 0.1)
            local positionOffset = plr.Character.Head.CFrame + (CFrame.Angles(0, -math.pi / 14, 0).lookVector.unit * 3.2)

            local camera = Instance.new("Camera", plr.Character)
            camera.Name = "ThumbnailCamera"
            camera.CameraType = Enum.CameraType.Scriptable
            camera.CoordinateFrame = CFrame.new(positionOffset.p, viewOffset.p)
            camera.FieldOfView = baseHatZoom + (maxHatZoom - baseHatZoom) * maxDimension
            workspace.CurrentCamera = camera
        end

        return game:GetService("ThumbnailGenerator"):Click("PNG", 1420, 1420, true)';


    $thumbnail = '
game:GetService("ContentProvider"):SetBaseUrl("http://eb2.ct8.pl/")
game:GetService("ScriptContext").ScriptsDisabled = true

local plr = game.Players:CreateLocalPlayer(1)
' . $file . '
plr:LoadCharacter(false)
      
      if plr.Character then
    for _, child in pairs(plr.Character:GetChildren()) do
        if child:IsA("Tool") then
            plr.Character.Torso["Right Shoulder"].CurrentAngle = math.rad(90)
            break
        end
    end
end


return game:GetService("ThumbnailGenerator"):Click("PNG", 1420, 1420, true)';

    $render = $RCCServiceSoap->execScript($thumbnail, rand(1, getrandmax()), 120);
    $render2 = $RCCServiceSoap->execScript($headshot, rand(1, getrandmax()), 120);
    
    $avatarFilePath = 'Thumbs/Headshots/' . $username . '.png';
    file_put_contents($avatarFilePath, base64_decode($render2));
    
    $avatarFilePath2 = 'Thumbs/Avatars/' . $username . '.png';
    file_put_contents($avatarFilePath2, base64_decode($render));
  
    $logEntry = "[" . date("m/d/Y | H:i:s") . "] " .$_SESSION['username'] . " rendered themselves.";
    file_put_contents('Admin/logs.txt', $logEntry . PHP_EOL, FILE_APPEND);
  

    echo '<img src="/Thumbs/Avatars/' . $_SESSION['username'] . '.png?c=' . rand('0', '10000000') . '"><span class="enable-three-dee btn-control btn-control-small">';
} else {
    echo "Username is required.";
}
?>
<img src="/Thumbs/Avatars/<?php echo $_SESSION['username']; ?>.png?c=<?php echo rand('0', '10000000'); ?>"></span><img class="user-avatar-overlay-image thumbnail-overlay" src="/Thumbs/Avatars/<?php echo $_SESSION['username']; ?>.png?c=<?php echo rand('0', '10000000'); ?>" alt=""/><span class="enable-three-dee btn-control btn-control-small"></span>
</div>
    </div>


          <div class="col-sm-8 profile-avatar-right">
            <div class="profile-avatar-mask">
<div class="profile-accoutrements-container" ng-controller="profileAccoutrementsController">
<div data-numberofaccoutrements="8" data-accoutrementsperpage="15" data-intouchscreen="true" profile-accoutrements-data profile-accoutrements-layout="profileAccoutrementsLayout">
                      </div>
    <div id="accoutrements-slider" class="profile-accoutrements-slider" profile-accoutrements-slider profile-accoutrements-layout="profileAccoutrementsLayout">
                    <ul class="accoutrement-items-container">
                      <?php

$file_content = @file_get_contents("http://eb2.ct8.pl/Avatars/".$_SESSION['username'].".txt");

if ($file_content === false) {
    
}

$links = explode(";", $file_content);

$avatar_asset_ids = [];

foreach ($links as $link) {
    $id_start = strpos($link, "id=");
    if ($id_start !== false) {
        $id_end = strpos($link, "&", $id_start);
        if ($id_end !== false) {
            $id = substr($link, $id_start + 3, $id_end - $id_start - 3);
            $avatar_asset_ids[] = $id;
        }
    }
}

function fetchCatalogData()
{
    $catalog = [];
    $file = fopen("Catalog/catalog.txt", "r");
    if ($file) {
        while (($line = fgets($file)) !== false) {
            $item = json_decode($line, true);
            $robloxassetid = isset($item['robloxassetid']) ? $item['robloxassetid'] : '';

            if (in_array($robloxassetid, $GLOBALS['avatar_asset_ids'])) {
                $catalog[] = $item;
            }
        }
        fclose($file);
    }
    return array_reverse($catalog);
}

$catalogData = fetchCatalogData();

foreach ($catalogData as $item) {
    ?>
    <li class="accoutrement-item" ng-non-bindable="">
  <a href="/Catalog/<?php echo $item['id']; ?>/<?php echo $item['name']; ?>">
    <img title="<?php echo $item['name']; ?>" alt="<?php echo $item['name']; ?>" style="width: 85px;height:85px;" class="accoutrement-image" src="<?php echo $item['thumbnail']; ?>">
    <div class="asset-restriction-icon">
      <span class="icon-label icon--label"></span>
    </div>
  </a>
</li>      <?php
}
?>
                      </ul>
    </div>

  <!--profile-accoutrement-slider-->
    <div id="accoutrements-page" class="profile-accoutrements-page-container" profile-accoutrements-page profile-accoutrements-layout="profileAccoutrementsLayout">
        <span class="profile-accoutrements-page hidden" ng-class="{'page-active': profileAccoutrementsLayout.currentPageNumber == 0}" ng-click="getAccoutrementsPage(0)"></span>
        <span class="profile-accoutrements-page hidden" ng-class="{'page-active': profileAccoutrementsLayout.currentPageNumber == 1}" ng-click="getAccoutrementsPage(1)"></span>
    </div>
</div>
            </div>
        </div>
</div>

<!--profile-accoutrement-slider-->
    <div id="accoutrements-page" class="profile-accoutrements-page-container" profile-accoutrements-page profile-accoutrements-layout="profileAccoutrementsLayout">
        <span class="profile-accoutrements-page hidden" ng-class="{'page-active': profileAccoutrementsLayout.currentPageNumber == 0}" ng-click="getAccoutrementsPage(0)"></span>
        <span class="profile-accoutrements-page hidden" ng-class="{'page-active': profileAccoutrementsLayout.currentPageNumber == 1}" ng-click="getAccoutrementsPage(1)"></span>
    </div>

      <?php foreach ($inventoryData as $item) : ?>
        <?php $itemDetails = fetchItemDetails($item[1]); ?>
        <?php if ($itemDetails) : ?>
                    
          <div class="col-xs-5 col-sm-2" style="margin-right: 5px;">
            <div class="section-content">
              <div class="border border-secondary rounded overflow-hidden position-relative">
                <a href="/Catalog/<?php echo $itemDetails['id']; ?>/<?php echo $itemDetails['name']; ?>">
                  <img src="<?php if($itemDetails['thumbnail'] === '') { echo '/content/images/non-loaded.png'; } else { echo $itemDetails['thumbnail']; } ?>" width="100%" style="border: 1px solid gray; border-radius: 3px; aspect-ratio: 1/1;" alt="<?php echo $itemDetails['name']; ?>">
                </a>
              </div>
              <p class="text-secondary m-0" style="font-size:12px;">
                <?php if (strlen($itemDetails['name']) > 24) {
        $itemDetails['name']= substr($itemDetails['name'], 0, 24) . "...";
    }
  echo $itemDetails['name']; ?></p>
              <p class="text-robux m-0"><?php if($itemDetails['price'] == -1) { echo 'Offsale'; } else if($itemDetails['price'] == 0) { echo 'Free'; } else if($itemDetails['price'] >= 0) { echo 'E$ ' . number_format($itemDetails['price']); }  ?></p>
              <button class="btn btn-primary btn-xs mt-5" style="width: auto!important;" onclick="equipItem('<?php echo $itemDetails['robloxassetid']; ?>')">Equip</button>
              <button class="btn btn-danger btn-xs mt-5" style="width: auto; float:right" onclick="removeItem('<?php echo $itemDetails['robloxassetid']; ?>')">Remove</button>
            </div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
    </div>
   

  <?php include('doc/footer.php'); ?>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    var selectedAssets = [];

    function equipItem(assetId) {
        if (selectedAssets.length >= 10) {
            alert("You can only select up to 10 assets.");
            return;
        }
        selectedAssets.push(assetId);
    }

     function saveCharacter() {
        if (selectedAssets.length === 0) {
            alert("Please select at least one asset.");
            return;
        }
        var username = "<?php echo $_SESSION['username']; ?>";
        var url = `http://eb2.ct8.pl/upload.php?username=${username}`;
        selectedAssets.forEach(assetId => {
            url += `&assets[]=${assetId}`;
        });

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'assets.php?assets=' + JSON.stringify(selectedAssets), true);
        xhr.onload = function () {
            if (xhr.status !== 200) {
                window.location.href = url;
            } else {
                alert('Error validating assets.');
            }
        };
        xhr.send();
    }
    </script>
  </body>
</html>
