<?php
session_start();
  ob_start();
  

  
  
function fetchUserData($username) {
  $userData = file_get_contents("../doc/users.txt");
  $userLines = explode("\n", $userData);

  foreach ($userLines as $userLine) {
      $user = explode("|", $userLine);
      if (isset($user[1]) && $user[1] == $username) {
          return $user;
      }
  }

  return null;
}

function getUserIdByUsername($username) {
  $userDataFile = "../doc/users.txt";
  
  if (file_exists($userDataFile)) {
      $userData = file_get_contents($userDataFile);
      if ($userData === false) {
          echo "Error: Unable to read user data file.";
          return null;
      }

      $users = explode("\n", $userData);
      foreach ($users as $user) {
          $userDataArray = explode(" | ", $user);
          if (count($userDataArray) >= 2 && $userDataArray[1] == $username) {
              return $userDataArray[0];
          }
      }
  } else {
      echo "Error: User data file not found.";
      return null;
  }
  
  return null;
}

function generateCatalogItemHTML($item, $username, $isAdmin) {
  if (empty($item) || empty($username)) {
        header('Location: /Catalog');
        exit();
    }

  
    $itemData = json_decode($item, true);

    $itemId = isset($itemData['id']) ? $itemData['id'] : '';
    $assetId = isset($itemData['robloxassetid']) ? $itemData['robloxassetid'] : '';
    $itemName = isset($itemData['name']) ? $itemData['name'] : '';
    $creator = isset($itemData['creator']) ? $itemData['creator'] : '';
    $created = isset($itemData['created']) ? $itemData['created'] : '';
    $updated = isset($itemData['last_updated']) ? $itemData['last_updated'] : '';
    $thumbnail = isset($itemData['thumbnail']) ? $itemData['thumbnail'] : '';
    $description = isset($itemData['description']) ? $itemData['description'] : '';
    $price = isset($itemData['price']) ? floatval($itemData['price']) : -1;
    $isLimited = isset($itemData['is_limited']) ? $itemData['is_limited'] : false;
    
    $userId = getUserIdByUsername($creator);

    $userInventoryFile = "../doc/inventory.txt";
    $userDataFile = "../doc/users.txt";

    if (file_exists($userInventoryFile) && file_exists($userDataFile)) {
        $userInventory = file_get_contents($userInventoryFile);
        if ($userInventory === false) {
            echo "Error: Unable to read user inventory file.";
            exit;
        }

        $ownedItems = explode("\n", $userInventory);
        $itemOwned = false;
  foreach ($ownedItems as $ownedItem) {
      $ownedItemData = explode("|", $ownedItem);
      if (count($ownedItemData) >= 3 && $ownedItemData[0] == $username && $ownedItemData[1] == $_GET['id'] && $ownedItemData[2] == $assetId) {
          $itemOwned = true;
          break;
      }
  }
      
      $soldCount = 0;
$usersWithItem = [];

foreach ($ownedItems as $ownedItem) {
    $ownedItemData = explode("|", $ownedItem);
    if (count($ownedItemData) >= 3 && $ownedItemData[1] == $_GET['id'] && $ownedItemData[2] == $assetId) {
        $ownerUsername = $ownedItemData[0];
        if (!in_array($ownerUsername, $usersWithItem)) {
            $usersWithItem[] = $ownerUsername;
            $soldCount++;
        }
    }
}

        
    } else {
        echo "Error: Inventory or user data files not found.";
    }
  
    
    $html = '<div class="container-main">';
$html .= '<script type="text/javascript">';
$html .= 'if (top.location != self.location) {';
$html .= 'top.location = self.location.href;';
$html .= '}';
$html .= '</script>';
$html .= '<div class="alert-container">';
$html .= '<noscript><div><div class="alert-info" role="alert">Please enable Javascript to use all the features on this site.</div></div></noscript>';
$html .= '</div>';
$html .= '<div class="content">';
$html .= '<div id="item-container" class="page-content inline-social" ';
$html .= 'data-item-id="10468797" ';
$html .= 'data-item-type="Asset" ';
$html .= 'data-item-name="Ban Hammer" ';
$html .= 'data-asset-type="Gear" ';
$html .= 'data-asset-type-display-name="Gear" ';
$html .= 'data-userasset-id="" ';
$html .= 'data-is-purchase-enabled="true" ';
$html .= 'data-product-id="1791401" ';
$html .= 'data-bc-requirement="0" ';
$html .= 'data-expected-currency="1" ';
$html .= 'data-expected-price="0" ';
$html .= 'data-seller-name="ROBLOX" ';
$html .= 'data-expected-seller-id="1" ';
$html .= 'data-lowest-private-sale-userasset-id="" ';
$html .= 'data-is-limited-unique="false" ';
$html .= 'data-user-id="886284560" ';
$html .= 'data-asset-granted="False" ';
$html .= 'data-forward-url="" ';
$html .= 'data-avatar-wear-url="https://avatar.roblox.com/v1/avatar/assets/10468797/wear" ';
$html .= 'data-avatar-remove-url="https://avatar.roblox.com/v1/avatar/assets/10468797/remove" ';
$html .= 'data-current-time="7/27/2019 1:18:02 AM">';
$html .= '<div class="system-feedback">';
$html .= '<div class="alert-system-feedback">';
$html .= '<div class="alert alert-success">Purchase Completed</div>';
$html .= '</div>';
$html .= '<div class="alert-system-feedback">';
$html .= '<div class="alert alert-warning">Error occurred</div>';
$html .= '</div>';
$html .= '</div>';
$html .= '<div class="remove-panel section-content top-section">';
$html .= '<div class="border-bottom item-name-container">';
$html .= '<h2>' . htmlspecialchars($itemName) . '</h2>';
$html .= '<div>';
$html .= '<span class="text-label">By <a href="/users/'.$userId.'/profile/" class="text-name">'.$creator.'</a> | Sold '. $soldCount .' Times.</span>';
$html .= '</div>';
$html .= '</div>';
$html .= '<div class="item-thumbnail-container">';
$html .= '<div id="use-dynamic-thumbnail-lighting" class="hidden" data-use-dynamic-thumbnail-lighting="False"></div>';
$html .= '<div id="AssetThumbnail" class="asset-thumb-container thumbnail-holder three-dee-static"';
$html .= 'data-reset-enabled-every-page ';
$html .= 'data-3d-thumbs-enabled ';
$html .= 'data-3dtype="static" ';
$html .= 'data-url="/thumbnail/asset?assetId=10468797&amp;thumbnailFormatId=254&amp;width=420&amp;height=420">';
$html .= '<div id="current-animation-name"></div>';
$html .= '<span class="thumbnail-span" data-3d-url="/asset-thumbnail-3d/json?assetId=10468797">';
$html .= '<img class="" src="' . ($thumbnail === '' ? '/content/images/non-loaded.png' : $thumbnail) . '"/>';
$html .= '</span>';
$html .= '<span class="thumbnail-span-original hidden" data-3d-url="/asset-thumbnail-3d/json?assetId=10468797">';
$html .= '<img class="" src="' . ($thumbnail === '' ? '/content/images/non-loaded.png' : $thumbnail) . '"/>';
$html .= '</span>';
$html .= '<span class="thumbnail-span-try-it-on hidden" data-3d-url="/temp-outfit-thumbnail-3d/json?assetId=10468797"';
$html .= 'data-retry-url="/temp-outfit-thumbnail/json?assetId=10468797&amp;width=420&amp;height=420&amp;format=Png" ';
$html .= 'data-orig-retry-url="/temp-outfit-thumbnail/json?assetId=10468797&amp;width=420&amp;height=420&amp;format=Png">';
$html .= '<img alt="You, trying the asset on." class="" src=""/>';
$html .= '</span>';
$html .= '<div class="equipped-marker"></div>';
$html .= '<div class="thumbnail-buttons">';
$html .= '<span class="try-it-on btn-control-sm">Try On</span>';
$html .= '<button class="border enable-three-dee three-dee-static-icon thumb-interactive-btn btn-control-md"></button>';
$html .= '</div>';
$html .= '<div class="asset-status-icon"></div>';
$html .= '</div>';
$html .= '</div>';
$html .= '<script type="text/javascript">';
$html .= '(function () {';
$html .= 'if (Roblox && Roblox.Performance) {';
$html .= 'Roblox.Performance.setPerformanceMark("itemReskin_thumbnail_loaded");';
$html .= '}';
$html .= '})();';
$html .= '</script>';

$html .= '<div id="item-details" class="content-overflow-toggle content-height content-overflow-page-loading item-details">';

  if ($itemOwned) {
      $html .= '<div class="clearfix price-container">';
$html .= '<div class="price-container-text">';
$html .= '<div class="item-first-line">Item already owned.</div>';
$html .= '<div class="price-info"></div>';
$html .= '</div>';
$html .= '<div class="action-button">';
$html .= '<button type="button" class="btn-fixed-width-lg btn-growth-lg" disabled="">Buy</button>';
$html .= '</div>';
$html .= '</div>';   
  } else if ($price == -1) {
        $html .= '<div class="clearfix price-container">';
$html .= '<div class="price-container-text">';
$html .= '<div class="item-first-line">This item is not currently for sale.</div>';
$html .= '<div class="price-info"></div>';
$html .= '</div>';
$html .= '<div class="action-button">';
$html .= '<button type="button" class="btn-fixed-width-lg btn-growth-lg" disabled="">Buy</button>';
$html .= '</div>';
$html .= '</div>';
    } else if ($price == 0) {
        $html .= '<div class="clearfix price-container">';
$html .= '<div class="price-container-text">';
$html .= '<div class="text-robux">Free</div>';
$html .= '<div class="price-info"></div>';
$html .= '</div>';
$html .= '<div class="action-button">';
$html .= '<button type="button" id="buy-btn-robux" class="btn-fixed-width-lg btn-growth-lg">Buy</button>';
$html .= '</div>';
$html .= '</div>';
    } else {
        $html .= '<div class="clearfix price-container">';
$html .= '<div class="price-container-text">';
$html .= '<h2 class="text-robux"><span class="icon-robux"></span> ' . number_format($price) . '</h2>';
$html .= '<div class="price-info"></div>';
$html .= '</div>';
$html .= '<div class="action-button">';
$html .= '<button type="button" id="buy-btn-robux" class="btn-fixed-width-lg btn-growth-lg">Buy</button>';
$html .= '</div>';
$html .= '</div>';    
    }
$html .= '<div class="clearfix item-mobile-description item-field-container">';
$html .= '<a class="description-content font-body text wait-for-i18n-format-render">'.htmlspecialchars($description).'</a>';
$html .= '</div>';
$html .= '<div class="clearfix item-type-field-container">';
$html .= '<div class="font-header-1 text-subheader text-label text-overflow field-label">Type</div>';
$html .= '<span id="type-content" class="font-body text wait-for-i18n-format-render"></span>';
$html .= '</div>';
$html .= '<div class="clearfix item-field-container">';
$html .= '<div class="font-header-1 text-subheader text-label text-overflow field-label">Genres</div>';
$html .= '<div class="field-content">';
$html .= '<a class="text-name item-genre wait-for-i18n-format-render" href="https://www.roblox.com/all-catalog">';
$html .= 'All';
$html .= '</a>';
$html .= '<span class="wait-for-i18n-format-render"></span>';
$html .= '</div>';
$html .= '</div>';
$html .= '<div class="clearfix item-field-container">';
$html .= '<div class="font-header-1 text-subheader text-label text-overflow field-label">Attributes</div>';
$html .= '<div class="field-content">';
$html .= '<div class="attribute-container">';
$html .= '<span class="icon-Melee attribute-icon wait-for-i18n-format-render"></span>';
$html .= '<span class="wait-for-i18n-format-render">Melee</span>';
$html .= '</div>';
$html .= '<div class="attribute-container">';
$html .= '<span class="icon-Navigation attribute-icon wait-for-i18n-format-render"></span>';
$html .= '<span class="wait-for-i18n-format-render">Navigation</span>';
$html .= '</div>';
$html .= '</div>';
$html .= '</div>';
$html .= '<div class="clearfix toggle-target item-field-container">';
$html .= '<div class="font-header-1 text-subheader text-label text-overflow field-label">Description</div>';
$html .= '<a id="item-details-description" class="content-overflow-toggle content-height content-overflow-page-loading font-body text description-content wait-for-i18n-format-render">'.htmlspecialchars($description).'<span class="hidden toggle-content" data-container-id="item-details-description" data-show-label="Read More" data-hide-label="Show Less">Read More</span></a>';
$html .= '</div>';
$html .= '<div class="hide show-more-end" data-container-id="item-details"></div>';
$html .= '<button type="button" class="hidden btn-full-width btn-control-md toggle-content" data-container-id="item-details" data-show-label="Read More" data-hide-label="Show Less">Read More</button>';
$html .= '</div>';
$html .= '<ul class="item-social-container clearfix include-favorite include-social">';
$html .= '<script src="https://www.google.com/recaptcha/api.js?render=explicit" async defer></script>';
$html .= '<li class="favorite-button-container">';
$html .= '<div class="tooltip-container" data-toggle="tooltip" title="" data-original-title="Add to Favorites">';
$html .= '<a id="toggle-favorite" data-toggle-url="/v2/favorite/toggle" data-targetId="10468797" data-isguest="False" data-favoriteType="Asset"';
$html .= 'data-signin-url="https://www.roblox.com/newlogin?returnUrl=%2Fcatalog%2F10468797%2FBan-Hammer">';
$html .= '<span title="NaN" class="text-favorite favoriteCount NaN" id="result">?</span>';
$html .= '<div id="favorite-icon" class="icon-favorite "></div>';
$html .= '</a>';
$html .= '</div>';
$html .= '</li>';
$html .= '<li class="social-media-share">';
$html .= '<div class="social-share-container">';
$html .= '<a class="icon-share" id="rbx-share-btn"></a>';
$html .= '<div class="rbx-share-container">';
$html .= '<div class="share-container-inner">';
$html .= '<div id="gigya-target"></div>';
$html .= '</div>';
$html .= '</div>';
$html .= '</div>';
$html .= '</li>';
$html .= '</ul>';
$html .= '</div>';
$html .= '</div>';
$html .= '</div>';
$html .= '</div>';


    
    

    return $html;
}

function head($item) {
  $itemData = json_decode($item, true);

  $itemId = isset($itemData['id']) ? $itemData['id'] : '';
  $assetId = isset($itemData['robloxassetid']) ? $itemData['robloxassetid'] : '';
  $itemName = isset($itemData['name']) ? $itemData['name'] : '';
  $creator = isset($itemData['creator']) ? $itemData['creator'] : '';
  $created = isset($itemData['created']) ? $itemData['created'] : '';
  $updated = isset($itemData['last_updated']) ? $itemData['last_updated'] : '';
  $thumbnail = isset($itemData['thumbnail']) ? $itemData['thumbnail'] : '';
  $description = isset($itemData['description']) ? $itemData['description'] : '';
  $price = isset($itemData['price']) ? $itemData['price'] : '';
  $isLimited = isset($itemData['is_limited']) ? $itemData['is_limited'] : false;

  $head = '<meta property="og:title" content="' . $itemName . '">
  <meta property="og:type" content="product">
  <meta property="og:url" content="https://ep7.ct8.pl/Catalog/'.$itemId.'/'.$itemName.'">
  <meta property="og:description" content="Personalize your avatar with the ' . $itemName . ' element and millions of others. Match and mix the hat element with other objects to create an avatar that is unique to you!">
  <meta property="og:image" content="' . $thumbnail . '">';

  return  $head;
}

$isAdmin = isset($_SESSION['rank']) && $_SESSION['rank'] === 'admin';

if ($isAdmin && isset($_POST['delete_item'])) {
  $assetId = $_POST['delete_asset_id'];

  $catalogFile = 'catalog.txt';
  $catalogData = file_get_contents($catalogFile);
  $catalogItems = explode("\n", $catalogData);
  $updatedCatalogItems = [];

  foreach ($catalogItems as $item) {
      $itemData = json_decode($item, true);
      if ($itemData && isset($itemData['id']) && $itemData['id'] == $assetId) {
          continue;
      }
      $updatedCatalogItems[] = $item;
  }

  file_put_contents($catalogFile, implode("\n", $updatedCatalogItems));

  $inventoryFile = '../doc/inventory.txt';
  $inventoryData = file_get_contents($inventoryFile);
  $inventoryItems = explode("\n", $inventoryData);
  $newInventory = [];

  foreach ($inventoryItems as $inventoryItem) {
      $itemParts = explode('|', $inventoryItem);
      if (count($itemParts) >= 3 && $itemParts[2] == $assetId) {
          continue;
      }
      $newInventory[] = $inventoryItem;
  }
  file_put_contents($inventoryFile, implode("\n", $newInventory));

  echo '<script>alert("Item deleted successfully.");</script>';
}

$itemNumber = isset($_GET['id']) ? $_GET['id'] : null;

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EPIK17</title>
  <?php $head = head($_GET['id']);
    echo $head; ?>
  
<link onerror='Roblox.BundleDetector && Roblox.BundleDetector.reportBundleError(this)' rel='stylesheet' data-bundlename='StyleGuide' href='https://static.rbxcdn.com/css/4db56b05c02c8ab6a24e3aec5aca644b3a2ac54ae5c1157bc697e7d8918f9918.css/fetch' />
    
<link onerror='Roblox.BundleDetector && Roblox.BundleDetector.reportBundleError(this)' rel='stylesheet'  href='https://static.rbxcdn.com/css/page___2734452ad08702f8d10fd93190f266b8_m.css/fetch' />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
<?php include('../doc/header.php'); ?>
<br>
<?php
$catalogData = file_get_contents("catalog.txt");
$catalogItems = explode("\n", $catalogData);

if ($itemNumber && $itemNumber <= count($catalogItems)) {
    $itemHTML = generateCatalogItemHTML($catalogItems[$itemNumber - 1], $_SESSION['username'], $isAdmin);
    echo $itemHTML;
} else {
    echo "Item not found.";
}
?>
  <?php include('../doc/footer.php'); ob_flush();?>
<script>
document.addEventListener("DOMContentLoaded", function() {
  document.getElementById("buy-btn-robux").addEventListener("click", function() {
    var itemId = "<?php echo $_GET['id']; ?>";
    window.location.href = "/Catalog/purchase.php?id=" + itemId;
  });
});
</script>
  
  <div class="ConfirmationModal modalPopup unifiedModal smallModal" data-modal-handle="confirmation" style="display:none;">
    <a class="genericmodal-close ImageButton closeBtnCircle_20h"></a>
    <div class="Title"></div>
    <div class="GenericModalBody">
        <div class="TopBody">
            <div class="ImageContainer roblox-item-image" data-image-size="small" data-no-overlays data-no-click>
                <img class="GenericModalImage" alt="generic image" />
            </div>
            <div class="Message"></div>
        </div>
        <div class="ConfirmationModalButtonContainer GenericModalButtonContainer">
            <a href id="roblox-confirm-btn"><span></span></a>
            <a href id="roblox-decline-btn"><span></span></a>
        </div>
        <div class="ConfirmationModalFooter">
        
        </div>  
    </div>  
    <script type="text/javascript">
        Roblox = Roblox || {};
        Roblox.Resources = Roblox.Resources || {};
        
        //<sl:translate>
        Roblox.Resources.GenericConfirmation = {
            yes: "Yes",
            No: "No",
            Confirm: "Confirm",
            Cancel: "Cancel"
        };
        //</sl:translate>
    </script>
</div>

<div id="modal-confirmation" class="modal-confirmation" data-modal-type="confirmation">
    <div id="modal-dialog"  class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true"><span class="icon-close"></span></span><span class="sr-only">Close</span>
                </button>
                <h5 class="modal-title"></h5>
            </div>

            <div class="modal-body">
                <div class="modal-top-body">
                    <div class="modal-message"></div>
                    <div class="modal-image-container roblox-item-image" data-image-size="medium" data-no-overlays data-no-click>
                        <img class="modal-thumb" alt="generic image"/>
                    </div>
                    <div class="modal-checkbox checkbox">
                        <input id="modal-checkbox-input" type="checkbox"/>
                        <label for="modal-checkbox-input"></label>
                    </div>
                </div>
                <div class="modal-btns">
                    <a href id="confirm-btn"><span></span></a>
                    <a href id="decline-btn"><span></span></a>
                </div>
                <div class="loading modal-processing">
                    <img class="loading-default" src='https://images.rbxcdn.com/4bed93c91f909002b1f17f05c0ce13d1.gif' alt="Processing..." />
                </div>
            </div>
            <div class="modal-footer text-footer">

            </div>
        </div>
    </div>
</div>







<script type="text/javascript">
    var Roblox = Roblox || {};
    Roblox.jsConsoleEnabled = false;
</script>



    <script type="text/javascript">
        $(function () {
            Roblox.CookieUpgrader.domain = 'roblox.com';
            Roblox.CookieUpgrader.upgrade("GuestData", { expires: Roblox.CookieUpgrader.thirtyYearsFromNow });
            Roblox.CookieUpgrader.upgrade("RBXSource", { expires: function (cookie) { return Roblox.CookieUpgrader.getExpirationFromCookieValue("rbx_acquisition_time", cookie); } });
            Roblox.CookieUpgrader.upgrade("RBXViralAcquisition", { expires: function (cookie) { return Roblox.CookieUpgrader.getExpirationFromCookieValue("time", cookie); } });
                
                Roblox.CookieUpgrader.upgrade("RBXMarketing", { expires: Roblox.CookieUpgrader.thirtyYearsFromNow });
                
                            
                Roblox.CookieUpgrader.upgrade("RBXSessionTracker", { expires: Roblox.CookieUpgrader.fourHoursFromNow });
                
                            
                Roblox.CookieUpgrader.upgrade("RBXEventTrackerV2", {expires: Roblox.CookieUpgrader.thirtyYearsFromNow});
                
        });
    </script>



    
<script onerror='Roblox.BundleDetector && Roblox.BundleDetector.reportBundleError(this)' data-monitor='true' data-bundlename='intl-polyfill' type='text/javascript' src='https://js.rbxcdn.com/ee40f2a1a1a92c3ddcfbd6941428ebc0.js.gzip'></script>
<script onerror='Roblox.BundleDetector && Roblox.BundleDetector.reportBundleError(this)' data-monitor='true' data-bundlename='InternationalCore' type='text/javascript' src='https://js.rbxcdn.com/b7765265afdb7c76d94552b635c3d3b9003e39e810227f3d25432466a817b0f1.js'></script>

<script onerror='Roblox.BundleDetector && Roblox.BundleDetector.reportBundleError(this)' data-monitor='true' data-bundlename='TranslationResources' type='text/javascript' src='https://js.rbxcdn.com/73a89de8a6dbe8005fb3d6be12e361fddac57c13295171d3a8d5f397e761615d.js'></script>


    <script onerror='Roblox.BundleDetector && Roblox.BundleDetector.reportBundleError(this)' data-monitor='true' data-bundlename='leanbase' type='text/javascript' src='https://js.rbxcdn.com/f45665e7e5db98201fe7b2507178cf22.js.gzip'></script>


<script onerror='Roblox.BundleDetector && Roblox.BundleDetector.reportBundleError(this)' data-monitor='true' data-bundlename='CoreUtilities' type='text/javascript' src='https://js.rbxcdn.com/e39d717145fdd1164dc2880ed356b8e529fa8124c5dfbed43c20a5614fc3821f.js'></script>

<script onerror='Roblox.BundleDetector && Roblox.BundleDetector.reportBundleError(this)' data-monitor='true' data-bundlename='CoreRobloxUtilities' type='text/javascript' src='https://js.rbxcdn.com/ccc5b6b92eb7dba88eef70b0f6da0f5df2ed8da5168b590d67f69856068983af.js'></script>

    <script onerror='Roblox.BundleDetector && Roblox.BundleDetector.reportBundleError(this)' data-monitor='true' data-bundlename='React' type='text/javascript' src='https://js.rbxcdn.com/3485182d26ebdd16cc205fc1dc5d7de152529918cf897b07865339de5d5abfce.js'></script>

<script onerror='Roblox.BundleDetector && Roblox.BundleDetector.reportBundleError(this)' data-monitor='true' data-bundlename='ReactStyleGuide' type='text/javascript' src='https://js.rbxcdn.com/f686b3f78964914c1e500373348a30f7bab55ef4dd196044f191e2862be822c0.js'></script>

<script onerror='Roblox.BundleDetector && Roblox.BundleDetector.reportBundleError(this)' data-monitor='true' data-bundlename='ReactUtilities' type='text/javascript' src='https://js.rbxcdn.com/3bfcca1f8bb2298e510c1baa286b2033ae6209a08bdf8967dacd2de45229730e.js'></script>


    <script onerror='Roblox.BundleDetector && Roblox.BundleDetector.reportBundleError(this)' data-monitor='true' data-bundlename='angular' type='text/javascript' src='https://js.rbxcdn.com/ae5b5a047c32177e8d21426c506865aa.js.gzip'></script>

    <div ng-modules="baseTemplateApp">
        <script type="text/javascript" src="https://js.rbxcdn.com/cbd9a121217c4887264ffe32686ecd52.js.gzip"></script>
    </div>

    <div ng-modules="pageTemplateApp">
        <!-- Template bundle: page -->
<script type="text/javascript">
"use strict"; angular.module("pageTemplateApp", []).run(['$templateCache', function($templateCache) { 

 }]);
</script>

    </div>
</body>
</html>
