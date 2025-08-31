<?php
$username = isset($_GET['username']) ? $_GET['username'] : '';

if ($username === '') {
    echo "Username parameter is missing.";
    exit;
}

$file_content = file_get_contents("http://eb2.ct8.pl/Avatars/".$username.".txt");

if ($file_content === false) {
    echo "Failed to fetch data from the server.";
    exit;
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
    $file = fopen("../Catalog/catalog.txt", "r");
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
    <li style="margin: 2px!important;" class="list-item item-card">
        <div onclick="window.location = '/Catalog/<?php echo $item['id']; ?>/<?php echo $item['name']; ?>'" class="item-card-container">
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
    <?php
}
?>
