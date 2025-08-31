<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: /');
    exit;
}
  
function getUserInfo($id)
{
    $filePath = "../doc/users.txt";
    if (file_exists($filePath)) {
        $file = fopen($filePath, "r");
        while (!feof($file)) {
            $line = fgets($file);
            $user = explode(" | ", $line);
            if ($user[0] == $id) {
                fclose($file);
                $userData = array(
                    'id' => $user[0],
                    'username' => $user[1],
                    'password' => $user[2],
                    'Epikbux' => $user[3],
                    'rank' => $user[4]
                );
                return $userData;
            }
        }
        fclose($file);
    } else {
        header('Location: /');
        exit();
    }
    return "File not found.";
}

function fetchInventoryData($username)
{
    $inventory = [];
    $file = fopen("../doc/inventory.txt", "r");
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
    $catalogData = file_get_contents("../Catalog/catalog.txt");
    $items = explode("\n", $catalogData);
    foreach ($items as $item) {
        $itemData = json_decode($item, true);
        if ($itemData['id'] == $itemId) {
            return $itemData;
        }
    }
    return null;
}
  
if(isset($_GET['id']) && empty($_GET['id'])) {
    header('Location: /');
    exit;
}
?>

<html>
<head>
    <title>Inventory</title>
    <link rel="canonical" href="https://web.archive.org/web/20180223202128/https://www.roblox.com/catalog/?Direction=2">
    <link rel="stylesheet" href="https://web.archive.org/web/20180223202128cs_/https://static.rbxcdn.com/css/page___178b163f0acd5df7054642d743431fdb_m.css/fetch">
</head>
<body>
<?php include('../doc/header.php'); ?>
<div class="container-main">
    <div class="content">
        <h1><?php if (!isset($_GET['id'])) {
                echo $_SESSION['username'];
            } else {
                $id = $_GET['id'];
                $user = getUserInfo($id);
                if (is_array($user)) {
                    echo $user['username'];
                }
            } ?>'s Inventory</h1>
        <div class="rbx-tabs-vertical">
            <ul id="vertical-tabs" class="nav nav-tabs nav-stacked rbx-tabs-vertical" role="tablist">
                <li class="rbx-tab active">
                    <a class="rbx-tab-heading" href="#all">
                        <span class="text-lead">All Items</span>
                        <span class="rbx-tab-subtitle"></span>
                    </a>
                </li>
                <li class="rbx-tab">
                    <a class="rbx-tab-heading" href="#heads">
                        <span class="text-lead">Heads</span>
                        <span class="rbx-tab-subtitle"></span>
                    </a>
                </li>
                <li class="rbx-tab">
                    <a class="rbx-tab-heading" href="#faces">
                        <span class="text-lead">Faces</span>
                        <span class="rbx-tab-subtitle"></span>
                    </a>
                </li>
                <li class="rbx-tab">
                    <a class="rbx-tab-heading" href="#gear">
                        <span class="text-lead">Gear</span>
                        <span class="rbx-tab-subtitle"></span>
                    </a>
                </li>
                <li class="rbx-tab">
                    <a class="rbx-tab-heading" href="#hats">
                        <span class="text-lead">Hats</span>
                        <span class="rbx-tab-subtitle"></span>
                    </a>
                </li>
                <li class="rbx-tab">
                    <a class="rbx-tab-heading" href="#tShirts">
                        <span class="text-lead">T-Shirts</span>
                        <span class="rbx-tab-subtitle"></span>
                    </a>
                </li>
                <li class="rbx-tab">
                    <a class="rbx-tab-heading" href="#shirts">
                        <span class="text-lead">Shirts</span>
                        <span class="rbx-tab-subtitle"></span>
                    </a>
                </li>
                <li class="rbx-tab">
                    <a class="rbx-tab-heading" href="#pants">
                        <span class="text-lead">Pants</span>
                        <span class="rbx-tab-subtitle"></span>
                    </a>
                </li>
            </ul>
            <div class="tab-content rbx-tab-content">
                <div ng-if="$ctrl.staticData.canViewInventory" ng-show="$ctrl.assets.length < 1"
                     class="item-cards ng-scope ng-hide">
                    <div class="section-content-off">
                        <span ng-bind="$ctrl.getInventoryEmptyMessage($ctrl.staticData.isOwnPage, $ctrl.pageType)"
                              class="ng-binding">Tu n'as aucun objet dans cette catégorie.</span>
                        <span ng-show="$ctrl.showMessageToFindNewItems($ctrl.pageType, $ctrl.currentData.category, $ctrl.currentData.subcategory)">
                            <span ng-bind-html="$ctrl.getInventoryNewItemsMessage($ctrl.staticData.isLibraryLinkEnabled, $ctrl.currentData.itemSection, '<a class=&quot;text-link&quot;' +  'href=&quot;' + $ctrl.currentData.assetTypeUrl + '&quot;>', '</a>')"
                                  class="ng-binding">Essaie de rechercher d'autres items dans le <a class="text-link"
                                                                                                     href="https://www.roblox.com/catalog/?Category=4&amp;Subcategory=15">marketplace</a>.</span>
                        </span>
                    </div>
                </div>
                <ul class="hlist item-cards item-cards-embed ng-scope tab-pane active" id="all">
                    <?php if (!isset($_GET['id'])) {
                        $inventoryData = fetchInventoryData($_SESSION['username']);
                        foreach ($inventoryData as $item) : ?>
                            <?php $itemDetails = fetchItemDetails($item[1]); ?>
                            <?php if ($itemDetails) : ?>

                                <li style="margin: 2px!important;" class="list-item item-card ng-scope">
                                    <div onclick="window.location = '/Catalog/<?php echo $itemDetails['id']; ?>/<?php echo $itemDetails['name']; ?>'"
                                         class="item-card-container">
                                        <a href="/Catalog/<?php echo $itemDetails['id']; ?>/<?php echo $itemDetails['name']; ?>"
                                           class="item-card-link">
                                            <div class="item-card-thumb-container">
                                                <img class="item-card-thumb"
                                                     src="<?php echo ($itemDetails['thumbnail'] === '' ? '/content/images/non-loaded.png' : $itemDetails['thumbnail']); ?>"
                                                     alt="<?php echo $itemDetails['name']; ?>">
                                                <?php if ($itemDetails['is_limited'] === true) { ?>
                                                    <span class="icon-limited-label"></span><?php } ?>
                                            </div>
                                        </a>
                                        <div class="item-card-caption">
                                            <a href="/Catalog/<?php echo $item['id']; ?>/<?php echo $item['name']; ?>"
                                               class="item-card-name-link">
                                                <div class="text-overflow item-card-name"><?php echo $itemDetails['name']; ?></div>
                                            </a>
                                            <div class="text-overflow item-card-creator">
                                                <span class="xsmall text-label">By</span>
                                                <a class="xsmall text-overflow text-link"
                                                   href="/users/<?php echo $userId; ?>/profile"> <?php echo $itemDetails['creator']; ?> </a>
                                            </div>
                                            <div class="item-card-price margin-top-none">
                                                <?php if ($itemDetails['price'] == -1): ?>
                                                    <span class="text-secondary">Offsale</span>
                                                <?php elseif ($itemDetails['price'] == 0): ?>
                                                    <span class="text-robux">Free</span>
                                                <?php elseif ($itemDetails['price'] >= 0): ?>
                                                    <span class="text-robux">E$
                                                        <?php echo number_format($itemDetails['price']); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php } else {
                        $id = $_GET['id'];
                        $user = getUserInfo($id);
                        if (is_array($user)) {
                            $inventoryData = fetchInventoryData($user['username']);
                            foreach ($inventoryData as $item) : ?>
                                <?php $itemDetails = fetchItemDetails($item[1]); ?>
                                <?php if ($itemDetails) : ?>

                                    <li style="margin: 2px!important;" class="list-item item-card ng-scope">
                                    <div onclick="window.location = '/Catalog/<?php echo $itemDetails['id']; ?>/<?php echo $itemDetails['name']; ?>'"
                                         class="item-card-container">
                                        <a href="/Catalog/<?php echo $itemDetails['id']; ?>/<?php echo $itemDetails['name']; ?>"
                                           class="item-card-link">
                                            <div class="item-card-thumb-container">
                                                <img class="item-card-thumb"
                                                     src="<?php echo ($itemDetails['thumbnail'] === '' ? '/content/images/non-loaded.png' : $itemDetails['thumbnail']); ?>"
                                                     alt="<?php echo $itemDetails['name']; ?>">
                                                <?php if ($itemDetails['is_limited'] === true) { ?>
                                                    <span class="icon-limited-label"></span><?php } ?>
                                            </div>
                                        </a>
                                        <div class="item-card-caption">
                                            <a href="/Catalog/<?php echo $item['id']; ?>/<?php echo $item['name']; ?>"
                                               class="item-card-name-link">
                                                <div class="text-overflow item-card-name"><?php echo $itemDetails['name']; ?></div>
                                            </a>
                                            <div class="text-overflow item-card-creator">
                                                <span class="xsmall text-label">By</span>
                                                <a class="xsmall text-overflow text-link"
                                                   href="/users/<?php echo $userId; ?>/profile"> <?php echo $itemDetails['creator']; ?> </a>
                                            </div>
                                            <div class="item-card-price margin-top-none">
                                                <?php if ($itemDetails['price'] == -1): ?>
                                                    <span class="text-secondary">Offsale</span>
                                                <?php elseif ($itemDetails['price'] == 0): ?>
                                                    <span class="text-robux">Free</span>
                                                <?php elseif ($itemDetails['price'] >= 0): ?>
                                                    <span class="text-robux">E$
                                                        <?php echo number_format($itemDetails['price']); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php }
                    } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include('../doc/footer.php'); ?>
</body>
</html>
