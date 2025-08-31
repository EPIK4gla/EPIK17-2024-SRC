<?php
/*if($_SERVER['REMOTE_ADDR'] !== 'put yr ip here') {
  die('Things is getting upgraded, stay active !');

} else {*/

  
  $docPath = __DIR__ . '/banned.txt';

if (is_readable($docPath)) {
    $bannedUsernames = file($docPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if ($bannedUsernames !== false) {
        $username = $_SESSION['username'];

        if (in_array($username, $bannedUsernames)) {
            header("Location: /banned.php");
            exit();
        }
    } else {
        echo "Failed to read the banned user list.";
    }
} else {
    echo "The banned user list file is not accessible.";
}

function getUserById($id) {
    if (!is_numeric($id) || $id <= 0) {
        return null;
    }

    $id = basename($id);
    $_ROOT_ = $_SERVER['DOCUMENT_ROOT'];

    $userRecords = file($_ROOT_ . "/doc/users.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  
    foreach ($userRecords as $record) {
        $userData = explode(" | ", $record);

        if ($userData[0] === $id) {
            $userData = array_map('htmlspecialchars', $userData);
            return [
                'id' => $userData[0],
                'username' => $userData[1],
                'epikbux' => $userData[3],
                'rank' => $userData[4]
            ];
        }
    }

    return null;
}
  
  function abreviateTotalCount($value)
{

    $abbreviations = array(12 => 'T', 9 => 'B', 6 => 'M', 3 => 'K', 0 => '');

    foreach($abbreviations as $exponent => $abbreviation)
    {

        if($value >= pow(10, $exponent))
        {

            return round(floatval($value / pow(10, $exponent))).$abbreviation;

        }

    }

}

$userData = getUserById($_SESSION['id']);
if ($userData) {
    $id = $userData['id'];
    $username = $userData['username'];
    $epikbux = $userData['epikbux'];
    $rank = $userData['rank'];
?>
<!DOCTYPE html>
<html>
<head>
<style type="text/css">@charset "UTF-8";[ng\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,ix-ng-cloak,.ng-hide{display:none !important;}ng\:form{display:block;}.ng-animate-block-transitions{transition:0s all!important;-webkit-transition:0s all!important;}.ng-hide-add-active,.ng-hide-remove{display:block!important;}</style>

<link href="../favicon.ico" rel="icon">
        <link rel="manifest" href="https://www.roblox.com/push-notifications/chrome-manifest" crossorigin="use-credentials">
            <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600" rel="stylesheet" type="text/css">
<script type='text/javascript' src='https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js'></script>
<script type='text/javascript'>window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-1.11.1.js'><\/script>")</script>
<script type='text/javascript' src='https://ajax.aspnetcdn.com/ajax/jquery.migrate/jquery-migrate-1.2.1.min.js'></script>
<script type='text/javascript'>window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-migrate-1.2.1.js'><\/script>")</script>
<link rel="canonical" href="/home">
<link onerror="Roblox.BundleDetector &amp;&amp; Roblox.BundleDetector.reportBundleError(this)" rel="stylesheet" data-bundlename="Chat" href="https://static.rbxcdn.com/css/d4ea5fce70b8009044c02f73117827c92c07782ab871b64a0b22a078e74989e3.css/fetch">
<link rel='stylesheet' href='https://dtjatwg9u87ct.cloudfront.net/content/css/CSSmain.css' />
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,500,600,700" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="/content/css/leanbasenew.css"/>
<link rel="stylesheet" href="https://static.rbxcdn.com/css/page___15b72d6b9fcc13c7ee29a13cfa4558ab_m.css/fetch"/>
    <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js"></script>
<script type="text/javascript">window.jQuery || document.write("<script type='text/javascript' src='js/jquery/jquery-1.11.1.js'><\/script>")</script>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.migrate/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript">window.jQuery || document.write("<script type='text/javascript' src='js/jquery/jquery-migrate-1.2.1.js'><\/script>")</script>
    <script type="text/javascript" src="https://js.rbxcdn.com/379cff48ae23ba8f6ba4ce43ff9630f7.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>

 
  <script type="text/javascript">
    var Roblox = Roblox || {};
    Roblox.AdsHelper = Roblox.AdsHelper || {};
    Roblox.AdsLibrary = Roblox.AdsLibrary || {};
    Roblox.AdsHelper.toggleAdsSlot = function (slotId, GPTRandomSlotIdentifier) {
        var gutterAdsEnabled = false;
        if (gutterAdsEnabled) {
            googletag.display(GPTRandomSlotIdentifier);
            return;
        }
        if (typeof slotId !== 'undefined' && slotId && slotId.length > 0) {
            var slotElm = $("#"+slotId);
            if (slotElm.is(":visible")) {
                googletag.display(GPTRandomSlotIdentifier);
            }else {
                var adParam = Roblox.AdsLibrary.adsParameters[slotId];
                if (adParam) {
                    adParam.template = slotElm.html();
                    slotElm.empty();
                }
            }
        }
    }
</script><script type="text/javascript">
    $(function () {
        Roblox.JSErrorTracker.initialize({ 'suppressConsoleError': true});
    });
</script>

<script type="text/javascript">
        $(function () {
            RobloxEventManager.triggerEvent('rbx_evt_newuser', {});
        });
    </script>

<link rel="stylesheet" href="https://static.rbxcdn.com/css/page___532f8fc30ac54e7ea2b94313bac1040e_m.css/fetch">
<script type="text/javascript">
    if (Roblox && Roblox.PageHeartbeatEvent) {
        Roblox.PageHeartbeatEvent.Init([2,8,20,60]);
    }
</script>        <script type="text/javascript">
if (typeof(Roblox) === "undefined") { Roblox = {}; }
Roblox.Endpoints = Roblox.Endpoints || {};
Roblox.Endpoints.Urls = Roblox.Endpoints.Urls || {};
Roblox.Endpoints.Urls['/api/item.ashx'] = 'https://www.roblox.com/api/item.ashx';
Roblox.Endpoints.Urls['/asset/'] = 'https://assetgame.roblox.com/asset/';
Roblox.Endpoints.Urls['/client-status/set'] = 'https://www.roblox.com/client-status/set';
Roblox.Endpoints.Urls['/client-status'] = 'https://www.roblox.com/client-status';
Roblox.Endpoints.Urls['/game/'] = 'https://assetgame.roblox.com/game/';
Roblox.Endpoints.Urls['/game-auth/getauthticket'] = 'https://www.roblox.com/game-auth/getauthticket';
Roblox.Endpoints.Urls['/game/edit.ashx'] = 'https://assetgame.roblox.com/game/edit.ashx';
Roblox.Endpoints.Urls['/game/getauthticket'] = 'https://assetgame.roblox.com/game/getauthticket';
Roblox.Endpoints.Urls['/game/placelauncher.ashx'] = 'https://assetgame.roblox.com/game/placelauncher.ashx';
Roblox.Endpoints.Urls['/game/preloader'] = 'https://assetgame.roblox.com/game/preloader';
Roblox.Endpoints.Urls['/game/report-stats'] = 'https://assetgame.roblox.com/game/report-stats';
Roblox.Endpoints.Urls['/game/report-event'] = 'https://assetgame.roblox.com/game/report-event';
Roblox.Endpoints.Urls['/game/updateprerollcount'] = 'https://assetgame.roblox.com/game/updateprerollcount';
Roblox.Endpoints.Urls['/login/default.aspx'] = 'https://www.roblox.com/login/default.aspx';
Roblox.Endpoints.Urls['/my/character.aspx'] = 'https://www.roblox.com/my/character.aspx';
Roblox.Endpoints.Urls['/my/money.aspx'] = 'https://www.roblox.com/my/money.aspx';
Roblox.Endpoints.Urls['/chat/chat'] = 'https://www.roblox.com/chat/chat';
Roblox.Endpoints.Urls['/presence/users'] = 'https://www.roblox.com/presence/users';
Roblox.Endpoints.Urls['/presence/user'] = 'https://www.roblox.com/presence/user';
Roblox.Endpoints.Urls['/friends/list'] = 'https://www.roblox.com/friends/list';
Roblox.Endpoints.Urls['/navigation/getCount'] = 'https://www.roblox.com/navigation/getCount';
Roblox.Endpoints.Urls['/catalog/browse.aspx'] = 'https://www.roblox.com/catalog/browse.aspx';
Roblox.Endpoints.Urls['/catalog/html'] = 'https://search.roblox.com/catalog/html';
Roblox.Endpoints.Urls['/catalog/json'] = 'https://search.roblox.com/catalog/json';
Roblox.Endpoints.Urls['/catalog/contents'] = 'https://search.roblox.com/catalog/contents';
Roblox.Endpoints.Urls['/catalog/lists.aspx'] = 'https://search.roblox.com/catalog/lists.aspx';
Roblox.Endpoints.Urls['/asset-hash-thumbnail/image'] = 'https://assetgame.roblox.com/asset-hash-thumbnail/image';
Roblox.Endpoints.Urls['/asset-hash-thumbnail/json'] = 'https://assetgame.roblox.com/asset-hash-thumbnail/json';
Roblox.Endpoints.Urls['/asset-thumbnail-3d/json'] = 'https://assetgame.roblox.com/asset-thumbnail-3d/json';
Roblox.Endpoints.Urls['/asset-thumbnail/image'] = 'https://assetgame.roblox.com/asset-thumbnail/image';
Roblox.Endpoints.Urls['/asset-thumbnail/json'] = 'https://assetgame.roblox.com/asset-thumbnail/json';
Roblox.Endpoints.Urls['/asset-thumbnail/url'] = 'https://assetgame.roblox.com/asset-thumbnail/url';
Roblox.Endpoints.Urls['/asset/request-thumbnail-fix'] = 'https://assetgame.roblox.com/asset/request-thumbnail-fix';
Roblox.Endpoints.Urls['/avatar-thumbnail-3d/json'] = 'https://www.roblox.com/avatar-thumbnail-3d/json';
Roblox.Endpoints.Urls['/avatar-thumbnail/image'] = 'https://www.roblox.com/avatar-thumbnail/image';
Roblox.Endpoints.Urls['/avatar-thumbnail/json'] = 'https://www.roblox.com/avatar-thumbnail/json';
Roblox.Endpoints.Urls['/avatar-thumbnails'] = 'https://www.roblox.com/avatar-thumbnails';
Roblox.Endpoints.Urls['/avatar/request-thumbnail-fix'] = 'https://www.roblox.com/avatar/request-thumbnail-fix';
Roblox.Endpoints.Urls['/bust-thumbnail/json'] = 'https://www.roblox.com/bust-thumbnail/json';
Roblox.Endpoints.Urls['/group-thumbnails'] = 'https://www.roblox.com/group-thumbnails';
Roblox.Endpoints.Urls['/groups/getprimarygroupinfo.ashx'] = 'https://www.roblox.com/groups/getprimarygroupinfo.ashx';
Roblox.Endpoints.Urls['/headshot-thumbnail/json'] = 'https://www.roblox.com/headshot-thumbnail/json';
Roblox.Endpoints.Urls['/item-thumbnails'] = 'https://www.roblox.com/item-thumbnails';
Roblox.Endpoints.Urls['/outfit-thumbnail/json'] = 'https://www.roblox.com/outfit-thumbnail/json';
Roblox.Endpoints.Urls['/place-thumbnails'] = 'https://www.roblox.com/place-thumbnails';
Roblox.Endpoints.Urls['/thumbnail/asset/'] = 'https://www.roblox.com/thumbnail/asset/';
Roblox.Endpoints.Urls['/thumbnail/avatar-headshot'] = 'https://www.roblox.com/thumbnail/avatar-headshot';
Roblox.Endpoints.Urls['/thumbnail/avatar-headshots'] = 'https://www.roblox.com/thumbnail/avatar-headshots';
Roblox.Endpoints.Urls['/thumbnail/user-avatar'] = 'https://www.roblox.com/thumbnail/user-avatar';
Roblox.Endpoints.Urls['/thumbnail/resolve-hash'] = 'https://www.roblox.com/thumbnail/resolve-hash';
Roblox.Endpoints.Urls['/thumbnail/place'] = 'https://www.roblox.com/thumbnail/place';
Roblox.Endpoints.Urls['/thumbnail/get-asset-media'] = 'https://www.roblox.com/thumbnail/get-asset-media';
Roblox.Endpoints.Urls['/thumbnail/remove-asset-media'] = 'https://www.roblox.com/thumbnail/remove-asset-media';
Roblox.Endpoints.Urls['/thumbnail/set-asset-media-sort-order'] = 'https://www.roblox.com/thumbnail/set-asset-media-sort-order';
Roblox.Endpoints.Urls['/thumbnail/place-thumbnails'] = 'https://www.roblox.com/thumbnail/place-thumbnails';
Roblox.Endpoints.Urls['/thumbnail/place-thumbnails-partial'] = 'https://www.roblox.com/thumbnail/place-thumbnails-partial';
Roblox.Endpoints.Urls['/thumbnail_holder/g'] = 'https://www.roblox.com/thumbnail_holder/g';
Roblox.Endpoints.Urls['/users/{id}/profile'] = 'https://www.roblox.com/users/{id}/profile';
Roblox.Endpoints.Urls['/service-workers/push-notifications'] = 'https://www.roblox.com/service-workers/push-notifications';
Roblox.Endpoints.addCrossDomainOptionsToAllRequests = true;
</script>

    <script type="text/javascript">
if (typeof(Roblox) === "undefined") { Roblox = {}; }
Roblox.Endpoints = Roblox.Endpoints || {};
Roblox.Endpoints.Urls = Roblox.Endpoints.Urls || {};
</script>

</head>

<body id="rbx-body" class="obc-theme" data-performance-relative-value="0.005" data-internal-page-name="Home" data-send-event-percentage="0.01">
    <div id="roblox-linkify" data-enabled="true" data-regex="(https?\:\/\/)?(?:www\.)?([a-z0-9\-]{2,}\.)*(((m|de|www|web|api|blog|wiki|help|corp|polls|bloxcon|developer|devforum|forum)\.roblox\.com|robloxlabs\.com)|(www\.shoproblox\.com))((\/[A-Za-z0-9-+&amp;@#\/%?=~_|!:,.;]*)|(\b|\s))" data-regex-flags="gm" data-as-http-regex="((blog|wiki|[^.]help|corp|polls|bloxcon|developer|devforum)\.roblox\.com|robloxlabs\.com)"></div>

<div id="image-retry-data" data-image-retry-max-times="10" data-image-retry-timer="1500">
</div>
<div id="http-retry-data" data-http-retry-max-timeout="0" data-http-retry-base-timeout="0">
</div>

<div id="fb-root"></div>

<div id="wrap" class="wrap no-gutter-ads logged-in" data-gutter-ads-enabled="false">

<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600" rel="stylesheet" type="text/css"><div id="header"
           class="navbar-fixed-top rbx-header"
           role="navigation">
          <div class="container-fluid">
              <div class="rbx-navbar-header">
                  <div data-behavior="nav-notification" class="rbx-nav-collapse" onselectstart="return false;">
                          <span class="icon-nav-menu"></span>

                  </div>
                  <div class="navbar-header">
                      <a class="navbar-brand" href="/">
                          <span class="icon-logo"></span>
                          <span class="icon-logo-r"></span>
                      </a>
                  </div>
              </div>

            <ul class="nav rbx-navbar hidden-xs hidden-sm col-md-4 col-lg-3">
                  <li>
                      <a class="nav-menu-title" href="/games">Games</a>
                  </li>
                  <li>
                      <a class="nav-menu-title" href="/Catalog">Catalog</a>
                  </li>
                  <li>
                      <a class="nav-menu-title" href="/Catalog/upload.php">Develop</a>
                  </li>
                  <li>
                      <a class="buy-robux nav-menu-title" href="/upgrade/BuildersClub.aspx">Upgrade</a>
                  </li>

              </ul><!--rbx-navbar-->
              <div id="navbar-universal-search" class="navbar-left rbx-navbar-search col-xs-5 col-sm-6 col-md-3" data-behavior="univeral-search" role="search">
                  <div class="input-group">

                      <input id="navbar-search-input" class="form-control input-field" type="text" placeholder="Search" maxlength="120" />
                      <div class="input-group-btn">
                          <button id="navbar-search-btn" class="input-addon-btn" type="submit">
                              <span class="icon-nav-search"></span>
                          </button>
                      </div>
                  </div>
                  <ul data-toggle="dropdown-menu" class="dropdown-menu" role="menu">
                      <li class="rbx-navbar-search-option selected" data-searchurl="/search/users?keyword=">
                          <span class="rbx-navbar-search-text">Search <span class="rbx-navbar-search-string"></span> in People</span>
                      </li>
                              <li class="rbx-navbar-search-option" data-searchurl="/search/games/?Keyword=">
                                  <span class="rbx-navbar-search-text">Search <span class="rbx-navbar-search-string"></span> in Games</span>
                              </li>
                              <li class="rbx-navbar-search-option" data-searchurl="/Catalog?search=">
                                  <span class="rbx-navbar-search-text">Search <span class="rbx-navbar-search-string"></span> in Catalog</span>
                              </li>
                              <li class="rbx-navbar-search-option" data-searchurl="/search/groups/search.aspx?val=">
                                  <span class="rbx-navbar-search-text">Search <span class="rbx-navbar-search-string"></span> in Groups</span>
                              </li>
                              <li class="rbx-navbar-search-option" data-searchurl="/search/develop/library?CatalogContext=2&amp;Category=6&amp;Keyword=">
                                  <span class="rbx-navbar-search-text">Search <span class="rbx-navbar-search-string"></span> in Library</span>
                              </li>
                  </ul>
              </div><!--rbx-navbar-search-->
              <div class="navbar-right rbx-navbar-right col-xs-4 col-sm-3">

      <ul class="nav navbar-right rbx-navbar-icon-group">
          <li id="navbar-setting" class="navbar-icon-item">

       <a class="rbx-menu-item" data-toggle="popover" data-bind="popover-setting" data-viewport="#header">
                  <span class="icon-nav-settings" id="nav-settings"></span>
                  <span class="xsmall nav-setting-highlight hidden">0</span>
              </a>
              <div class="rbx-popover-content" data-toggle="popover-setting">
                  <ul class="dropdown-menu" role="menu">
                      <li>
                          <a class="rbx-menu-item" href="account">
                              Settings
                              <span class="xsmall nav-setting-highlight hidden">0</span>
                          </a>
                      </li>
                      <li><a class="rbx-menu-item" href="" target="_blank">Help</a></li>
                      <li><a class="rbx-menu-item" href="/logout.php" data-behavior="logout" data-bind="/logout.php">Logout</a></li>
                  </ul>
              </div>
          </li>

          <li id="navbar-robux" class="navbar-icon-item">
                <a id="nav-robux-icon" class="rbx-menu-item" data-toggle="popover" data-bind="popover-robux">
                    <span class="icon-nav-robux" id="nav-robux"></span>
                    <span class="rbx-text-navbar-right" id="nav-robux-amount"><?php echo abreviateTotalCount($epikbux); ?></span>
                </a>
                <div class="rbx-popover-content" data-toggle="popover-robux">
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/money" id="nav-robux-balance" class="rbx-menu-item"><?php echo number_format($epikbux); ?> EpikBux</a></li>
                        <li><a href="../upgrade" class="rbx-menu-item">Get EpikBux</a></li>
                    </ul>
                </div>
            </li>

           <li id="navbar-notifications" class="navbar-icon-item">
               <a id="nav-notifications-icon" class="rbx-menu-item" data-toggle="popover" data-bind="popover-notifications">
                   <span class="icon-notifications" id="nav-notifications"></span>
               </a>
             <?php
$file_path = __DIR__ . '/notif.txt';
if (file_exists($file_path)) {
    $lines = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $line_count = count($lines);
    if ($line_count > 0) {
        echo "<span class='xsmall nav-setting-highlight'>$line_count</span>";
    }
} else {
    echo "File not found: $file_path";
}
?>

       
               <div class="rbx-popover-content" data-toggle="popover-notifications">
                   <ul class="dropdown-menu" role="menu">
                       <?php

$file = __DIR__ . '/notif.txt';

$contents = file_get_contents($file);

if ($contents !== false) {
    $lines = explode("\n", $contents);
    $lines = array_reverse($lines);
    
    foreach ($lines as $line) {
        $parts = explode(" & ", $line);
        
        if (count($parts) === 2) {
            $content = trim($parts[0]);
            $url = trim($parts[1]);
            
            echo "<li><a href='$url'>$content</a></li>";
        }
    }
} else {
    echo "Error: File not found or not readable.";
}


?>

                   </ul>
               </div>
           </li>

          <li class="rbx-navbar-right-search" data-toggle="toggle-search">
              <a class="rbx-menu-icon rbx-menu-item">
                  <span class="icon-nav-search-white"></span>
              </a>
          </li>
      </ul>        </div><!-- navbar right-->
              <ul class="nav rbx-navbar hidden-md hidden-lg col-xs-12">
                  <li>
                      <a class="nav-menu-title" href="/games">Games</a>
                  </li>
                  <li>
                      <a class="nav-menu-title" href="/Catalog">Catalog</a>
                  </li>
                  <li>
                      <a class="nav-menu-title" href="/Catalog/upload.php">Develop</a>
                  </li>
                  <li>
                      <a class="buy-robux nav-menu-title" href="/Upgrade">Upgrade</a>
                  </li>
              </ul><!--rbx-navbar-->
          </div>
      </div>

      <!-- LEFT NAV MENU -->
          <div id="navigation" class="rbx-left-col" data-behavior="left-col">
              <ul>
                  <li class="text-lead">
                      <a class="text-overflow" href="/users/<?php echo $id; ?>/profile"><?php echo $username; ?></a>
                  </li>
                  <li class="rbx-divider"></li>
              </ul>

              <div class="rbx-scrollbar" data-toggle="scrollbar" onselectstart="return false;">
                  <ul>
                      <li><a href="/" id="nav-home"><span class="icon-nav-home"></span><span>Home</span></a></li>
                      <li><a href="/users/<?php echo $id; ?>/profile" id="nav-profile"><span class="icon-nav-profile"></span><span>Profile</span></a></li>
                      <li>
                          <a href="/my/messages/#!/inbox" id="nav-message" data-count="0">
                              <span class="icon-nav-message"></span><span>Messages</span>
                              
                          </a>
                      </li>
                      <li>
                          <a href="/Friends.aspx" id="nav-friends" data-count="0">
                              <span class="icon-nav-friends"></span><span>Friends</span>
                              
                          </a>
                      </li>
                      <li>
                          <a href="/Avatar.php" id="nav-character">
                              <span class="icon-nav-charactercustomizer"></span><span>Avatar</span>
                          </a>
                      </li>
                      <li>
                          <a href="/inventory" id="nav-inventory">
                              <span class="icon-nav-inventory"></span><span>Inventory</span>
                          </a>
                      </li>
                      <li>
                          <a href="/trade" id="nav-trade">
                              <span class="icon-nav-trade"></span><span>Trade</span>
                          </a>
                      </li>
                      <li>
                          <a href="/groups" id="nav-group">
                              <span class="icon-nav-group"></span><span>Groups</span>
                          </a>
                      </li>
                      <li>
                          <a href="/forum/" id="nav-forum">
                              <span class="icon-nav-forum"></span><span>Forum</span>
                          </a>
                      </li>
                      <li>
                          <a href="/blog/" id="nav-blog">
                              <span class="icon-nav-blog"></span><span>Blog</span>
                          </a>
                      </li>
                          <li>
                              <a id="nav-shop" class="roblox-shop-interstitial">
                                  <span class="icon-nav-shop"></span><span>Shop</span>
                              </a>
                          </li>
                    <?php if($rank === 'admin') { ?>
                    <li>
                      <a href="/Admin/" id="nav-admin">
                        <span class="icon-develop"></span><span>Admin Panel</span>
                      </a>
                     </li>
                        <?php } ?>
                      <li class="rbx-upgrade-now">
                          <a href="/upgrade" class="btn-secondary-md" id="upgrade-now-button">Upgrade Now</a>
                      </li>
                          <li class="font-bold small">
                              Events
                          </li>
                          <li class="rbx-nav-sponsor" ng-non-bindable>
                                  <span class="menu-item">No events.</span>
                          </li>
                              <!--li class="rbx-nav-sponsor" ng-non-bindable>
                                  <a class="menu-item" href="https://www.roblox.com/sponsored/TrickOrTreatCountdown" title="TrickOrTreatCountdown">
                                          <img src="https://images.rbxcdn.com/afb2cf5cfcf786eaf8af131529fc64f6" />
                                    </a>
                              </li-->
                  </ul>
              </div>
          </div>
<script type="text/javascript">
    var Roblox = Roblox || {};
    (function() {
        if (Roblox && Roblox.Performance) {
            Roblox.Performance.setPerformanceMark("navigation_end");
        }
    })();
</script>
  

<!--div class="container-main">
    <div class="alert-info">
        <h5>Avatar not rendered. Go render yourself on the avatar page!</h5>
    </div>
</div-->



<?php
} else {
    header('Location: /');
    exit();
}
  //}
?>
