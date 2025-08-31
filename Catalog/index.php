<?php
  session_start();
  
  if(!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header('Location: /');
    exit; // Add an exit after redirecting
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EPIK17</title>
   <link rel="canonical" href=
  "https://web.archive.org/web/20180223202128/https://www.roblox.com/catalog/?Direction=2">
  <link rel="stylesheet" href=
  "https://web.archive.org/web/20180223202128cs_/https://static.rbxcdn.com/css/page___178b163f0acd5df7054642d743431fdb_m.css/fetch">

  </head>
<body>
<?php include('../doc/header.php'); ?>
<div class="container-main">
  <div class="content">
    <div class="col mt-3">
      <div class="row align-items-center">
        <h2 style="position: absolute; left: 35px;">Catalog</h2>
        <div style="display: flex; justify-content: center;">
          <form class="col-md-4" method="GET" style="width: 100%; max-width: 400px;">
            <div class="input-group">
              <input id="navbar-search-input" name="search" class="form-control input-field" type="text" placeholder="Search" maxlength="120">
              <div class="input-group-btn">
                <button id="navbar-search-btn" class="input-addon-btn" type="submit">
                  <span class="icon-nav-search"></span>
                </button>
              </div>
            </div>
          </form>
        </div>
        <button onclick="window.location = 'upload.php'" style="position: absolute; right:35px;" class="btn btn-success btn-sm mt-2">Upload</button>
      </div>
      <br>
      </div>
      <ul class="hlist item-cards-stackable">
               
  
         
        <?php
        
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

  
        function fetchCatalogData()
{
    $catalog = [];
    $file = fopen("catalog.txt", "r");
    if ($file) {
        while (($line = fgets($file)) !== false) {
            $item = json_decode($line, true);
            $creator = $item['creator'] ?? '';
            $price = $item['price'] ?? '';

            if ((in_array($creator, ['lvtkr', 'omar', 'bob'])) && $price != -1) {
                $catalog[] = $item;
            }
        }
        fclose($file);
    }
    return array_reverse($catalog);
}


        $catalogData = fetchCatalogData();

        if(isset($_GET['search']) && !empty($_GET['search'])){
          $search = strtolower($_GET['search']);
          $catalogData = array_filter($catalogData, function($item) use ($search){
            return strpos(strtolower($item['name']), $search) !== false;
          });
        }
        

        $totalItems = count($catalogData);
        $itemsPerPage = 24;
        $totalPages = ceil($totalItems / $itemsPerPage);
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $startIndex = ($page - 1) * $itemsPerPage;
        $endIndex = min($startIndex + $itemsPerPage, $totalItems);

        function displayItems($catalogData, $startIndex, $endIndex)
        {
            $itemsToDisplay = array_slice($catalogData, $startIndex, $endIndex - $startIndex);
            foreach ($itemsToDisplay as $item) {
                $creator = isset($item['creator']) ? $item['creator'] : '';
                if ($creator === 'lvtkr' || $creator === 'omar' || $creator === 'bob' || $creator === 'some') {
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
      if (count($ownedItemData) >= 3 && $ownedItemData[0] == $_SESSION['username'] && $ownedItemData[1] == $item['id'] && $ownedItemData[2] == $item['robloxassetid']) {
          $itemOwned = true;
          break;
      }
  }
      
      $soldCount = 0;
$usersWithItem = [];

foreach ($ownedItems as $ownedItem) {
    $ownedItemData = explode("|", $ownedItem);
    if (count($ownedItemData) >= 3 && $ownedItemData[1] == $item['id'] && $ownedItemData[2] == $item['robloxassetid']) {
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
                    $userId = getUserIdByUsername($item['creator']); ?>
                    <li style="" class="list-item item-card">
    <div class="item-card-container">
      <?php if($itemOwned === true) { ?>
      <div class="item-card-equipped">
          <div class="item-card-equipped-label"></div>
        </div>
      <?php } ?>
        <a href="/Catalog/<?php echo $item['id']; ?>/<?php echo $item['name']; ?>" class="item-card-link">
            <div class="item-card-thumb-container">
                <img class="item-card-thumb" src="<?php echo ($item['thumbnail'] === '' ? '/content/images/non-loaded.png' : $item['thumbnail']); ?>" alt="<?php echo $item['name']; ?>">
                <?php if($item['is_limited'] === true) { ?> <span class="icon-limited-label"></span><?php } ?>
            </div>
        </a>
        <div class="item-card-caption">
            <a href="/Catalog/<?php echo $item['id']; ?>/<?php echo $item['name']; ?>" class="item-card-name-link">
                <div class="text-overflow item-card-name"><?php echo $item['name']; ?></div>
            </a>
      <div class="text-overflow item-card-creator">
        <span class="xsmall text-label">By</span>
        <a class="xsmall text-overflow text-link" href="/users/<?php echo $userId; ?>/profile"> <?php echo $item['creator']; ?> </a>
      </div>
            <div class="item-card-price margin-top-none">
                <?php if ($item['price'] == -1): ?>
                    <span class="text-secondary">Offsale</span>
                <?php elseif ($item['price'] == 0): ?>
                    <span class="text-robux">Free</span>
                <?php elseif ($item['price'] >= 0): ?>
                    <span class="text-robux">E$ <?php echo number_format($item['price']); ?></span>
                <?php endif; ?>
            </div>
        </div>
      
    </div>
</li>

               <?php }
            }
        }

        if(count($catalogData) == 0) {
          echo '<div style="position: absolute; left: 600px;" class="center"><a>No items were found.</a></div>';
        } else {
          displayItems($catalogData, $startIndex, $endIndex);
        }
        ?>
      <br>
         </div>
      <center>
        <div class="d-flex justify-content-center">
          <a <?php if ($page > 1) { ?> href="?page=<?php echo $page - 1; ?>" <?php } ?> class="ms-auto text-decoration-none text-secondary">Previous</a>
          <b style="margin-left: 10px; margin-right: 10px;" class="ms-2 me-2 text-white">Page <?php echo $page; ?> of <?php echo $totalPages; ?></b>
          <a <?php if ($page < $totalPages) { ?> href="?page=<?php echo $page + 1; ?>" <?php } ?> class="me-auto text-decoration-none text-primary">Next</a>
        </div>
      </center>
    </div>
  </div>
</div>

<?php include('../doc/footer.php'); ?>

</body>
</html>
