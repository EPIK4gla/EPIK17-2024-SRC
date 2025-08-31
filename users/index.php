<?php
session_start();

if (!$_SESSION['username']) {
    header('Location: /');
    exit();
}
  
  


function getUserInfo($id) {
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
        return "File not found.";
    }
    header('Location: /');
    exit();
}


function followUser($follower, $followed) {
    $filePath = "follow.txt";
    $followData = file_get_contents($filePath);
    if (strpos($followData, "$followed by $follower") === false) {
        file_put_contents($filePath, "$followed by $follower\n", FILE_APPEND);
    } else {
        $followData = str_replace("$followed by $follower\n", "", $followData);
        file_put_contents($filePath, $followData);
    }
}

$id = $_GET['id'];
$user = getUserInfo($id);
if (is_array($user)) {
    if (isset($_POST['followbtn'])) {
        $follower = $_SESSION['username'];
        $followed = $user['username'];
        followUser($follower, $followed);
        header("Location: {$_SERVER['REQUEST_URI']}");
        exit();
    }
    
    $follower = $_SESSION['username'];
    $followed = $user['username'];
    $followData = file_get_contents("follow.txt");
    if (strpos($followData, "$followed by $follower") === false) {
        $buttonText = "Follow";
    } else {
        $buttonText = "Unfollow";
    }
    
    $followersCount = substr_count($followData, "$user[username] by ");
    $followingsCount = substr_count($followData, "by $user[username]");

  $docPath = '../doc/banned.txt';

if (file_exists($docPath)) {
    $bannedUsers = file($docPath, FILE_IGNORE_NEW_LINES);

    $username = isset($user['username']) ? $user['username'] : '';
    $userBanned = false;

    foreach ($bannedUsers as $bannedUser) {
        $userData = explode('|', $bannedUser);
        if ($userData[0] === $username) {
            header("Location: /errors/404.html");
            exit();
        }
    }
  }
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EPIK17</title>
  <link rel="stylesheet" href="https://web.archive.org/web/20180223202128cs_/https://static.rbxcdn.com/css/page___178b163f0acd5df7054642d743431fdb_m.css/fetch">
  <style>
    .item-list {
        display: flex;
        flex-wrap: nowrap;
    }
  </style>
  <link rel="stylesheet" href="https://web.archive.org/web/20170903003821cs_/https://static.rbxcdn.com/css/leanbase___787079a2d857f22bf174d0a75b0a846a_m.css/fetch">
  <link rel="stylesheet" href="https://web.archive.org/web/20170903003821cs_/https://static.rbxcdn.com/css/page___c19b19fc90881848aa63e8e0e644b825_m.css/fetch">
   <link rel="stylesheet" type="text/css" href="https://web-static.archive.org/_static/css/banner-styles.css?v=S1zqJCYt">
  
  <link href="https://web.archive.org/web/20170903003821im_/https://images.rbxcdn.com/1387da00c070fd34110985aee87f3155.ico.gzip" rel="icon">
  </head>
<body>
    <?php include('../doc/header.php'); ?>
   <div class="container-main    ">
            <script type="text/javascript">
                if (top.location != self.location) {
                    top.location = self.location.href;
                }
            </script>
        <noscript><div class="SystemAlert"><div class="alert-info" role="alert">Please enable Javascript to use all the features on this site.</div></div></noscript>
        <div class="content  ">
<script type="text/javascript">
    var Roblox = Roblox || {};
</script>

<div class="profile-container" ng-modules="robloxApp, profile, robloxApp.helpers">
<div class="section profile-header">
    <div class="section-content profile-header-content" ng-controller="profileHeaderController">
<div data-userid="0" data-profileuserid="<?=$user['id']?>" data-profileusername="<?=$cleanuser?>" data-friendscount="1" data-followerscount="0" data-followingscount="0" data-acceptfriendrequesturl="" data-incomingfriendrequestid="0" data-arefriends="false" data-friendurl="https://www.xsscape.cf/Friends.aspx?ID=<?=$user['id']?>" data-incomingfriendrequestpending="false" data-maysendfriendinvitation="false" data-friendrequestpending="false" data-sendfriendrequesturl="" data-removefriendrequesturl="" data-promptforpushregistrationonfriendrequest="false" data-mayfollow="false" data-isfollowing="false" data-followurl="" data-unfollowurl="" data-canmessage="true" data-messageurl="/messages/compose?recipientId=<?=$user['id']?>" data-canbefollowed="false" data-cantrade="false" data-isblockbuttonvisible="false" data-getfollowscript="" data-ismorebtnvisible="false" data-isvieweeblocked="false" data-mayimpersonate="false" data-impersonateurl="" data-mayupdatestatus="false" data-updatestatusurl="" data-statustext="" data-editstatusmaxlength="254" profile-header-data profile-header-layout="profileHeaderLayout" class="hidden"></div>
        <div class="profile-header-top">
            <div class="avatar avatar-headshot-lg card-plain profile-avatar-image" ng-non-bindable>
                <span class="avatar-card-link avatar-image-link">
                 <img alt="<?=$username?>" class="avatar-card-image profile-avatar-thumb" src="/Thumbs/Headshots/<?php echo $user['username']; ?>.png?c=<?php echo rand('0', '10000000'); ?>"* alt=""/> </span>
                <script type="text/javascript">
                $("img.profile-avatar-thumb").on('load', function() {
                    if (Roblox && Roblox.Performance) {
                        Roblox.Performance.setPerformanceMark("head_avatar");
                    }
                });
                </script>

<!--span class="avatar-status game icon-game profile-avatar-status" title="In Game"></span-->
            </div>
            <div class="header-caption">
                <div class="header-title">
                    <h2><?=$user['username'];?></h2>
                        <!--<span class="icon-obc"></span>-->
                </div>

<div class="header-details">
                    <ul class="details-info">
                        <li>
                            <div class="text-label">Friends</div>
                            <a class="text-name" href="Friends.aspx?ID=<?=$user['id']?>">
                                <h3>
                                    0
                                </h3>
                            </a>
                        </li>

     <li>
                            <div class="text-label">Followers</div>
                            <a class="text-name" href="">
                                <h3 id="fcount"><?php echo $followersCount; ?></h3>
                            </a>
                        </li>

         <li>
                            <div class="text-label">Following</div>
                            <a class="text-name" href="">
                                <h3>
                                    <?php echo $followingsCount; ?>
                                </h3>
                            </a>
                        </li>
             </ul>
  </div>
  

             <div class="header-userstatus">
    <div class="header-userstatus-text" ng-hide="profileHeaderLayout.statusFormShown">
        <span id="userStatusText" class="text-overflow" ng-class="{'userstatus-editable' : profileHeaderLayout.mayUpdateStatus}" ng-bind="profileHeaderLayout.statusText | statusfilter" ng-click="revealStatusForm()" ng-cloak>N/A</span>
    </div>
</div>

</div>
        </div>

    <p ng-show="profileHeaderLayout.hasError" ng-cloak class="small text-error header-details-error">{{profileHeaderLayout.errorMsg}}</p>
        <div id="profile-header-more" class="profile-header-more" ng-show="profileHeaderLayout.isMoreBtnVisible">
            <a id="popover-link" class="rbx-menu-item" data-toggle="popover" data-bind="profile-header-popover-content">
                <span class="icon-more"></span>
            </a>
            <div id="popover-content" class="rbx-popover-content" data-toggle="profile-header-popover-content">
                <ul class="dropdown-menu" role="menu">
                    <li ng-show="profileHeaderLayout.mayFollow" ng-cloak>
                        <a ng-bind="profileHeaderLayout.isFollowing ? 'Unfollow' : 'Follow'" ng-click="follow()" id="profile-follow-user" ng-cloak></a>
                    </li>
                        <li ng-show="profileHeaderLayout.canTrade" ng-cloak><a ng-click="tradeItems()" id="profile-trade-items">Trade Items</a></li>
                    <li ng-show="profileHeaderLayout.isBlockButtonVisible" ng-cloak>
                        <a ng-bind="!profileHeaderLayout.isVieweeBlocked ? 'Block User' : 'Unblock User'" ng-click="blockUser()" id="profile-block-user" ng-cloak></a>
                    </li>
                                                                <li>
                            <a href="/inventory/?id=<?php echo $_GET['id']; ?>">Inventory</a>
                        </li>
                                            <li>
                            <a href="">Favorites</a>
                        </li>
                  <?php if($user['username'] === $_SESSION['username']) { } else { ?>
                  <li>
                            <form method="post">
        <button style="background-color: transparent; border: none;" type="submit" name="followbtn"><?php echo $buttonText; ?></button>
    </form>
                        </li> <?php } ?>
                </ul>
            </div>
            <script type="text/javascript">
                $(function() {
                    $(".details-actions, .mobile-details-actions").on("click touchstart", ".profile-join-game", function() {
                        // NOTE: global var set due to legacy game launch code.
                        play_placeId = 0;
                    });
                });
            </script>
<div>
    <script type="text/javascript">
        Roblox.uiBootstrap = Roblox.uiBootstrap || {};
        Roblox.uiBootstrap.modalBackdropTemplateLink = "viewapp/common/template/modal/backdrop.html";
        Roblox.uiBootstrap.modalWindowTemplateLink = "/viewapp/common/template/modal/window.html";
    </script>

<script type="text/ng-template" id="profile-block-user-modal.html">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" ng-click="close()">
                    <span aria-hidden="true"><span class="icon-close"></span></span><span class="sr-only">Close</span>
                </button>
                <h5>
                    Warning
                </h5>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to unblock this user?</p>
            </div>
            <div class="modal-footer">
                    <button type="submit" id="purchaseConfirm" class="btn-control-md" ng-click="submit()">
                        Unblock
                    </button>
                                    <button type="button" class="btn-fixed-width btn-secondary-md" ng-click="close()">
                        Cancel
                    </button>
            </div>
            </div><!-- /.modal-content -->
    </script>
</div>

<div>
    <script type="text/javascript">
        Roblox.uiBootstrap = Roblox.uiBootstrap || {};
        Roblox.uiBootstrap.modalBackdropTemplateLink = "viewapp/common/template/modal/backdrop.html";
        Roblox.uiBootstrap.modalWindowTemplateLink = "/viewapp/common/template/modal/window.html";
    </script>
    <script type="text/ng-template" id="profile-unblock-user-modal.html">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" ng-click="close()">
                    <span aria-hidden="true"><span class="icon-close"></span></span><span class="sr-only">Close</span>
                </button>
                <h5>
                    Warning
                </h5>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to block this user?</p>
            </div>
            <div class="modal-footer">
                    <button type="submit" id="purchaseConfirm" class="btn-control-md" ng-click="submit()">
                        Block
                    </button>
                                    <button type="button" class="btn-fixed-width btn-secondary-md" ng-click="close()">
                        Cancel
                    </button>
            </div>
                <p class="small modal-footer-note">When you&#39;ve blocked a user, neither of you can directly contact the other.</p>
            </div><!-- /.modal-content -->
    </script>
</div>
        </div>
    </div><!--profile-header-content-->

</div><!-- profile-header -->
    <div class="rbx-tabs-horizontal">
        <ul id="horizontal-tabs" class="nav nav-tabs" role="tablist">
            <li class="rbx-tab active">
                <a class="rbx-tab-heading" href="#about" id="tab-about">
                    <span class="text-lead">About</span>
                    <span class="rbx-tab-subtitle"></span>
                </a>
            </li>
            <li class="rbx-tab">
                <a class="rbx-tab-heading" href="#creations" id="tab-creations">
                    <span class="text-lead">Creations</span>
                    <span class="rbx-tab-subtitle"></span>
                </a>
            </li>
        </ul>
        <div class="tab-content rbx-tab-content">
            <div class="tab-pane active" id="about">
                <div class="section profile-about" ng-controller="profileUtilitiesController">
    <div class="container-header">
        <h3>About</h3>
    </div>
    <div class="section-content">
        <div class="profile-about-content">
            <p class="para-overflow-toggle para-height para-overflow-page-loading">
                <span class="profile-about-content-text" ng-non-bindable></span>
            </p>
        </div>

     <div class="profile-about-footer">
                <a href="" class="abuse-report-link">
                    <span class="text-error">Report Abuse</span>
                </a>

        <div>
    <script type="text/javascript">
        Roblox.uiBootstrap = Roblox.uiBootstrap || {};
        Roblox.uiBootstrap.modalBackdropTemplateLink = "viewapp/common/template/modal/backdrop.html";
        Roblox.uiBootstrap.modalWindowTemplateLink = "/viewapp/common/template/modal/window.html";
    </script>

   <script type="text/ng-template" id="profile-past-usernames-modal.html">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="close" ng-click="close()">
                    <span aria-hidden="true"><span class="icon-close"></span></span><span class="sr-only">Close</span>
                </button>
                <h5>
                    Past Usernames
                </h5>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
                            </div>
            </div><!-- /.modal-content -->
    </script>
</div>
        </div>
    </div>
</div>

<div class="container-list profile-avatar">
    <h3>Currently Wearing</h3>
    <div class="col-sm-4 profile-avatar-left">
<div id="UserAvatar" class="thumbnail-holder" data-reset-enabled-every-page data-3d-thumbs-enabled data-url="https://www.roblox.com/thumbnail/user-avatar?userId=1848960&amp;thumbnailFormatId=124&amp;width=300&amp;height=300" style="width:300px; height:300px;">
    <span class="thumbnail-span" data-3d-url="http://web.archive.org/web/20160807153806im_/https://t5.rbxcdn.com/b082c01b099e8a0e8bd6a50c2b06e135" data-js-files="https://js.rbxcdn.com/95518cef4aea4b89a95e61452d70c3bb.js">
  <img src="/Thumbs/Avatars/<?php echo $user['username']; ?>.png?c=<?php echo rand('0', '10000000'); ?>"></span><img class="user-avatar-overlay-image thumbnail-overlay" src="/Thumbs/Avatars/<?php echo $_SESSION['username']; ?>.png?c=<?php echo rand('0', '10000000'); ?>" alt=""/><span class="enable-three-dee btn-control btn-control-small"></span>
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

$file_content = @file_get_contents("http://eb2.ct8.pl/Avatars/".$user['username'].".txt");

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
</div>
            </div>
        </div>
                
                      <div class="section ng-scope" ng-controller="profileUtilitiesController">
                <div class="container-header">
                    <h3>EPIK17 Badges</h3>

                    <a ng-click="toggleContent(layoutContent.showMore)" class="btn-fixed-width btn-secondary-xs btn-more see-more-roblox-badges-button ng-binding" ng-show="layoutContent.hasMoreContent">See More</a>
                </div>
        <div class="section-content">
                    <ul class="hlist badge-list ng-isolate-scope" truncate="" layout-content="layoutContent" ng-class="{'badge-list-more': !layoutContent.showMore}">
                        <!--li class="list-item badge-item asset-item" ng-non-bindable="">
                            <a href="https://web.archive.org/web/20170705200351/https://web.roblox.com/info/roblox-badges#Badge6" class="badge-link" title="Homestead">
                                <span class="icon-homestead" title="Homestead"></span>
                                <span class="text-overflow item-name">Homestead</span>
                            </a>
                        </li>
                        <li class="list-item badge-item asset-item" ng-non-bindable="">
                            <a href="https://web.archive.org/web/20170705200351/https://web.roblox.com/info/roblox-badges#Badge7" class="badge-link" title="Bricksmith">
                                <span class="icon-bricksmith" title="Bricksmith"></span>
                                <span class="text-overflow item-name">Bricksmith</span>
                            </a>
                        </li>
                        <li class="list-item badge-item asset-item" ng-non-bindable="">
                            <a href="https://web.archive.org/web/20170705200351/https://web.roblox.com/info/roblox-badges#Badge3" class="badge-link" title="Combat Initiation">
                                <span class="icon-combat-initiation" title="Combat Initiation"></span>
                                <span class="text-overflow item-name">Combat Initiation</span>
                            </a>
                        </li>
                        <li class="list-item badge-item asset-item" ng-non-bindable="">
                            <a href="https://web.archive.org/web/20170705200351/https://web.roblox.com/info/roblox-badges#Badge12" class="badge-link" title="Veteran">
                                <span class="icon-veteran" title="Veteran"></span>
                                <span class="text-overflow item-name">Veteran</span>
                            </a>
                        </li>
                        <li class="list-item badge-item asset-item" ng-non-bindable="">
                            <a href="https://web.archive.org/web/20170705200351/https://web.roblox.com/info/roblox-badges#Badge4" class="badge-link" title="Warrior">
                                <span class="icon-warrior" title="Warrior"></span>
                                <span class="text-overflow item-name">Warrior</span>
                            </a>
                        </li>
                        <li class="list-item badge-item asset-item" ng-non-bindable="">
                            <a href="https://web.archive.org/web/20170705200351/https://web.roblox.com/info/roblox-badges#Badge2" class="badge-link" title="Friendship">
                                <span class="icon-friendship" title="Friendship"></span>
                                <span class="text-overflow item-name">Friendship</span>
                            </a>
                        </li-->
                        <!--li class="list-item badge-item asset-item" ng-non-bindable="">
                            <a href="https://web.archive.org/web/20170705200351/https://web.roblox.com/info/roblox-badges#Badge5" class="badge-link" title="Bloxxer">
                                <span class="icon-bloxxer" title="Bloxxer"></span>
                                <span class="text-overflow item-name">Bloxxer (Beta Tester)</span>
                            </a>
                        </li-->
                                                <!--li class="list-item badge-item asset-item" ng-non-bindable="">
                            <a href="https://web.archive.org/web/20170705200351/https://web.roblox.com/info/roblox-badges#Badge8" class="badge-link" title="Inviter">
                                <span class="icon-inviter" title="Inviter"></span>
                                <span class="text-overflow item-name">Inviter</span>
                            </a>
                        </li-->
                      <?php if ($user['rank'] === 'admin'): ?>
    <li class="list-item badge-item asset-item" ng-non-bindable="">
        <a href="" class="badge-link" title="Administrator">
            <span class="icon-administrator" title="Administrator"></span>
            <span class="text-overflow item-name">Administrator</span>
        </a>
    </li>
<?php endif; ?>

                                                                                                <!--li class="list-item badge-item asset-item" ng-non-bindable="">
                            <a href="https://web.archive.org/web/20170705200351/https://web.roblox.com/info/roblox-badges#Badge16" class="badge-link" title="Outrageous Builders Club">
                                <span class="icon-outrageous-builders-club" title="Outrageous Builders Club"></span>
                                <span class="text-overflow item-name">Outrageous Builders Club</span>
                            </a>
                        </li-->
                </ul>   
        </div>
    </div>
             
              
<div class="tab-pane" id="creations" profile-empty-tab="">
                
    <!--div class="profile-game ng-scope" ng-controller="profileGridController" ng-init="init('game-cards','game-container')">
        <div class="container-header">
            <h3 ng-non-bindable="">Games</h3>
            <div class="container-buttons">
                <button class="profile-view-selector btn-secondary-xs" title="Slideshow View" type="button" ng-click="updateDisplay(false)" ng-class="{'btn-secondary-xs': !isGridOn, 'btn-control-xs': isGridOn}">
                    <span class="icon-slideshow selected" ng-class="{'selected': !isGridOn}"></span>
                </button>
                <button class="profile-view-selector btn-control-xs" title="Grid View" type="button" ng-click="updateDisplay(true)" ng-class="{'btn-secondary-xs': isGridOn, 'btn-control-xs': !isGridOn}">
                    <span class="icon-grid" ng-class="{'selected': isGridOn}"></span>
                </button>
            </div>
        </div>
        <div ng-show="isGridOn" class="game-grid ng-hide">
            <ul class="hlist game-cards" style="max-height: -8px" horizontal-scroll-bar="loadMore()">
                        <!--div class="game-container shown" data-index="0" ng-class="{'shown': 0 < visibleItems}">


<li class="list-item game-card">
    <div class="game-card-container">
        <a href="https://web.archive.org/web/20170705200351/https://web.roblox.com/games/refer?PlaceId=41324860&amp;Position=1&amp;PageType=Profile" class="game-card-link">
            <div class="game-card-thumb-container">
                <img class="game-card-thumb ng-isolate-scope" data-src="https://web.archive.org/web/20170705200351/https://t3.rbxcdn.com/f5f4cb1e3339fb4348c0bbe8c954ac1c" alt="Welcome to ROBLOX Building" thumbnail="{&quot;Final&quot;:true,&quot;Url&quot;:&quot;https://t3.rbxcdn.com/f5f4cb1e3339fb4348c0bbe8c954ac1c&quot;,&quot;RetryUrl&quot;:null,&quot;UserId&quot;:0,&quot;EndpointType&quot;:&quot;Avatar&quot;}" image-retry="" src="https://web.archive.org/web/20170705200351im_/https://t3.rbxcdn.com/f5f4cb1e3339fb4348c0bbe8c954ac1c">
            </div>
            <div class="text-overflow game-card-name" title="Welcome to ROBLOX Building" ng-non-bindable="">
                Welcome to ROBLOX Building
            </div>
            <div class="game-card-name-secondary">
                0 Playing
            </div>
            <div class="game-card-vote">
                <div class="vote-bar" data-voting-processed="true">
                    <div class="vote-thumbs-up">
                        <span class="icon-thumbs-up"></span>
                    </div>
                    <div class="vote-container" data-upvotes="16773" data-downvotes="4890">
                        <div class="vote-background  has-votes"></div>
                        <div class="vote-percentage" style="width: 77%;"></div>
                        <div class="vote-mask">
                            <div class="segment seg-1"></div>
                            <div class="segment seg-2"></div>
                            <div class="segment seg-3"></div>
                            <div class="segment seg-4"></div>
                        </div>
                    </div>
                    <div class="vote-thumbs-down">
                        <span class="icon-thumbs-down"></span>
                    </div>
                </div>
                <div class="vote-counts">
                    <div class="vote-down-count">4,890</div>
                    <div class="vote-up-count">16,773</div>

                </div>
            </div>
        </a>
        <span class="game-card-footer">
        <span class="text-label xsmall">By </span>
        <a class="text-link xsmall text-overflow" href="https://web.archive.org/web/20170705200351/https://web.roblox.com/users/1/profile" ng-non-bindable="">ROBLOX</a>
    </span>
    </div>
</li>

                        </div>
                        
                        

            </ul>

            <a ng-click="loadMore()" class="btn btn-control-xs load-more-button ng-hide" ng-show="7 > 6 * NumberOfVisibleRows">Load More</a>
        </div>
        <!div id="games-switcher" class="switcher slide-switcher games ng-isolate-scope" ng-hide="isGridOn" switcher="" itemscount="switcher.games.itemsCount" currpage="switcher.games.currPage">
                        <ul class="slide-items-container switcher-items hlist">
                    <li class="switcher-item slide-item-container active" ng-class="{'active': switcher.games.currPage == 0}" data-index="0">
                        <div class="col-sm-6 slide-item-container-left">
                            <div class="slide-item-emblem-container">
                                <a href="https://web.archive.org/web/20170705200351/https://web.roblox.com/games/refer?PlaceId=41324860&amp;Position=1&amp;PageType=Profile">
                            <img class="slide-item-image ng-isolate-scope" src="https://web.archive.org/web/20170705200351im_/https://t3.rbxcdn.com/f5f4cb1e3339fb4348c0bbe8c954ac1c" data-src="https://web.archive.org/web/20170705200351/https://t3.rbxcdn.com/f5f4cb1e3339fb4348c0bbe8c954ac1c" data-emblem-id="41324860" thumbnail="{&quot;Final&quot;:true,&quot;Url&quot;:&quot;https://t3.rbxcdn.com/f5f4cb1e3339fb4348c0bbe8c954ac1c&quot;,&quot;RetryUrl&quot;:null,&quot;UserId&quot;:0,&quot;EndpointType&quot;:&quot;Avatar&quot;}" image-retry="">

                                </a>
                            </div>
                        </div>
                        <div class="col-sm-6 slide-item-container-right games">
                            <div class="slide-item-info">
                                <h2 class="text-overflow slide-item-name games" ng-non-bindable="">Welcome to ROBLOX Building</h2>
                                <p class="text-description para-overflow slide-item-description games" ng-non-bindable="">What will you build?</p>
                            </div>
                            <div class="slide-item-stats">
                                <ul class="hlist">
                                    <li class="list-item">
                                        <div class="text-label slide-item-stat-title">Playing</div>
                                        <div class="text-lead slide-item-members-count">0</div>
                                    </li>
                                    <li class="list-item">
                                        <div class="text-label slide-item-stat-title">Visits</div>
                                        <div class="text-lead text-overflow slide-item-my-rank games">23M+</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="switcher-item slide-item-container " ng-class="{'active': switcher.games.currPage == 1}" data-index="1">
                        <div class="col-sm-6 slide-item-container-left">
                            <div class="slide-item-emblem-container">
                                <a href="https://web.archive.org/web/20170705200351/https://web.roblox.com/games/refer?PlaceId=65033&amp;Position=2&amp;PageType=Profile">
                            <img class="slide-item-image ng-isolate-scope" data-src="https://web.archive.org/web/20170705200351/https://t2.rbxcdn.com/4536bbe202381824c3c4dcbdc1e987a6" data-emblem-id="65033" thumbnail="{&quot;Final&quot;:true,&quot;Url&quot;:&quot;https://t2.rbxcdn.com/4536bbe202381824c3c4dcbdc1e987a6&quot;,&quot;RetryUrl&quot;:null,&quot;UserId&quot;:0,&quot;EndpointType&quot;:&quot;Avatar&quot;}" image-retry="">

                                </a>
                            </div>
                        </div>
                        <div class="col-sm-6 slide-item-container-right games">
                            <div class="slide-item-info">
                                <h2 class="text-overflow slide-item-name games" ng-non-bindable="">Classic: Happy Home in Robloxia</h2>
                                <p class="text-description para-overflow slide-item-description games" ng-non-bindable="">A nice peaceful level with a starting house and a car. Hop in your car and explore the world! Insert furniture into your house! Start a garden! Add houses for friends! Grow your starting level into a huge city! Spice your game up with some hilarious weapons! A police station! A bank! A mountain lair for a criminal mastermind! Your imagination is the limit! Welcome to ROBLOX!</p>
                            </div>
                            <div class="slide-item-stats">
                                <ul class="hlist">
                                    <li class="list-item">
                                        <div class="text-label slide-item-stat-title">Playing</div>
                                        <div class="text-lead slide-item-members-count">11</div>
                                    </li>
                                    <li class="list-item">
                                        <div class="text-label slide-item-stat-title">Visits</div>
                                        <div class="text-lead text-overflow slide-item-my-rank games">838K+</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="switcher-item slide-item-container " ng-class="{'active': switcher.games.currPage == 2}" data-index="2">
                        <div class="col-sm-6 slide-item-container-left">
                            <div class="slide-item-emblem-container">
                                <a href="https://web.archive.org/web/20170705200351/https://web.roblox.com/games/refer?PlaceId=33913&amp;Position=3&amp;PageType=Profile">
                            <img class="slide-item-image ng-isolate-scope" data-src="https://web.archive.org/web/20170705200351/https://t5.rbxcdn.com/5134a9ea07f96466ee6237e0fa2cc986" data-emblem-id="33913" thumbnail="{&quot;Final&quot;:true,&quot;Url&quot;:&quot;https://t5.rbxcdn.com/5134a9ea07f96466ee6237e0fa2cc986&quot;,&quot;RetryUrl&quot;:null,&quot;UserId&quot;:0,&quot;EndpointType&quot;:&quot;Avatar&quot;}" image-retry="">

                                </a>
                            </div>
                        </div>
                        <div class="col-sm-6 slide-item-container-right games">
                            <div class="slide-item-info">
                                <h2 class="text-overflow slide-item-name games" ng-non-bindable="">Classic: Glass Houses</h2>
                                <p class="text-description para-overflow slide-item-description games" ng-non-bindable="">Battle it out with friends in this classic destructible environment!</p>
                            </div>
                            <div class="slide-item-stats">
                                <ul class="hlist">
                                    <li class="list-item">
                                        <div class="text-label slide-item-stat-title">Playing</div>
                                        <div class="text-lead slide-item-members-count">7</div>
                                    </li>
                                    <li class="list-item">
                                        <div class="text-label slide-item-stat-title">Visits</div>
                                        <div class="text-lead text-overflow slide-item-my-rank games">498K+</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="switcher-item slide-item-container " ng-class="{'active': switcher.games.currPage == 3}" data-index="3">
                        <div class="col-sm-6 slide-item-container-left">
                            <div class="slide-item-emblem-container">
                                <a href="https://web.archive.org/web/20170705200351/https://web.roblox.com/games/refer?PlaceId=25415&amp;Position=4&amp;PageType=Profile">
                            <img class="slide-item-image ng-isolate-scope" data-src="https://web.archive.org/web/20170705200351/https://t0.rbxcdn.com/437f784bf0651c4cc618465d132bca34" data-emblem-id="25415" thumbnail="{&quot;Final&quot;:true,&quot;Url&quot;:&quot;https://t0.rbxcdn.com/437f784bf0651c4cc618465d132bca34&quot;,&quot;RetryUrl&quot;:null,&quot;UserId&quot;:0,&quot;EndpointType&quot;:&quot;Avatar&quot;}" image-retry="">

                                </a>
                            </div>
                        </div>
                        <div class="col-sm-6 slide-item-container-right games">
                            <div class="slide-item-info">
                                <h2 class="text-overflow slide-item-name games" ng-non-bindable="">Classic: Rocket Arena</h2>
                                <p class="text-description para-overflow slide-item-description games" ng-non-bindable="">This map goes back to the basics: rockets, jetboots, and blowing up bridges. Out-maneuver your foes using your jetboots, cut off their escape by nuking the bridges, and rain doom down upon them using a rapid-fire rocket launcher. But don't fall in the lava - ouch!</p>
                            </div>
                            <div class="slide-item-stats">
                                <ul class="hlist">
                                    <li class="list-item">
                                        <div class="text-label slide-item-stat-title">Playing</div>
                                        <div class="text-lead slide-item-members-count">1</div>
                                    </li>
                                    <li class="list-item">
                                        <div class="text-label slide-item-stat-title">Visits</div>
                                        <div class="text-lead text-overflow slide-item-my-rank games">1M+</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="switcher-item slide-item-container " ng-class="{'active': switcher.games.currPage == 4}" data-index="4">
                        <div class="col-sm-6 slide-item-container-left">
                            <div class="slide-item-emblem-container">
                                <a href="https://web.archive.org/web/20170705200351/https://web.roblox.com/games/refer?PlaceId=45778683&amp;Position=5&amp;PageType=Profile">
                            <img class="slide-item-image ng-isolate-scope" data-src="https://web.archive.org/web/20170705200351/https://t5.rbxcdn.com/78aa2e26106efdafacda48670663248f" data-emblem-id="45778683" thumbnail="{&quot;Final&quot;:true,&quot;Url&quot;:&quot;https://t5.rbxcdn.com/78aa2e26106efdafacda48670663248f&quot;,&quot;RetryUrl&quot;:null,&quot;UserId&quot;:0,&quot;EndpointType&quot;:&quot;Avatar&quot;}" image-retry="">

                                </a>
                            </div>
                        </div>
                        <div class="col-sm-6 slide-item-container-right games">
                            <div class="slide-item-info">
                                <h2 class="text-overflow slide-item-name games" ng-non-bindable="">Classic: Temple of the Ninja Masters!</h2>
                                <p class="text-description para-overflow slide-item-description games" ng-non-bindable="">Alone at the edge of the world sits a sacred temple, guarded by 4 powerful Ninja Masters, each given control of one of the elements.  Many brave and powerful warriors have attempted to plunder the treasures of this temple, but all who have attempted it have failed.  Until nao.  Can you and your crew of the world's most resourceful pirates stand against the might of the Ninja Masters?  Only time will tell.</p>
                            </div>
                            <div class="slide-item-stats">
                                <ul class="hlist">
                                    <li class="list-item">
                                        <div class="text-label slide-item-stat-title">Playing</div>
                                        <div class="text-lead slide-item-members-count">2</div>
                                    </li>
                                    <li class="list-item">
                                        <div class="text-label slide-item-stat-title">Visits</div>
                                        <div class="text-lead text-overflow slide-item-my-rank games">641K+</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="switcher-item slide-item-container " ng-class="{'active': switcher.games.currPage == 5}" data-index="5">
                        <div class="col-sm-6 slide-item-container-left">
                            <div class="slide-item-emblem-container">
                                <a href="https://web.archive.org/web/20170705200351/https://web.roblox.com/games/refer?PlaceId=1818&amp;Position=6&amp;PageType=Profile">
                            <img class="slide-item-image ng-isolate-scope" data-src="https://web.archive.org/web/20170705200351/https://t1.rbxcdn.com/5975bad14a4cc76aa8e1bbd4de99c022" data-emblem-id="1818" thumbnail="{&quot;Final&quot;:true,&quot;Url&quot;:&quot;https://t1.rbxcdn.com/5975bad14a4cc76aa8e1bbd4de99c022&quot;,&quot;RetryUrl&quot;:null,&quot;UserId&quot;:0,&quot;EndpointType&quot;:&quot;Avatar&quot;}" image-retry="">

                                </a>
                            </div>
                        </div>
                        <div class="col-sm-6 slide-item-container-right games">
                            <div class="slide-item-info">
                                <h2 class="text-overflow slide-item-name games" ng-non-bindable="">Classic: Crossroads</h2>
                                <p class="text-description para-overflow slide-item-description games" ng-non-bindable="">The classic ROBLOX level is back!</p>
                            </div>
                            <div class="slide-item-stats">
                                <ul class="hlist">
                                    <li class="list-item">
                                        <div class="text-label slide-item-stat-title">Playing</div>
                                        <div class="text-lead slide-item-members-count">17</div>
                                    </li>
                                    <li class="list-item">
                                        <div class="text-label slide-item-stat-title">Visits</div>
                                        <div class="text-lead text-overflow slide-item-my-rank games">4M+</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="switcher-item slide-item-container " ng-class="{'active': switcher.games.currPage == 6}" data-index="6">
                        <div class="col-sm-6 slide-item-container-left">
                            <div class="slide-item-emblem-container">
                                <a href="https://web.archive.org/web/20170705200351/https://web.roblox.com/games/refer?PlaceId=14403&amp;Position=7&amp;PageType=Profile">
                            <img class="slide-item-image ng-isolate-scope" data-src="https://web.archive.org/web/20170705200351/https://t4.rbxcdn.com/cad32ba2dc058f0884645d9bb26e29cf" data-emblem-id="14403" thumbnail="{&quot;Final&quot;:true,&quot;Url&quot;:&quot;https://t4.rbxcdn.com/cad32ba2dc058f0884645d9bb26e29cf&quot;,&quot;RetryUrl&quot;:null,&quot;UserId&quot;:0,&quot;EndpointType&quot;:&quot;Avatar&quot;}" image-retry="">

                                </a>
                            </div>
                        </div>
                        <div class="col-sm-6 slide-item-container-right games">
                            <div class="slide-item-info">
                                <h2 class="text-overflow slide-item-name games" ng-non-bindable="">Classic: Chaos Canyon</h2>
                                <p class="text-description para-overflow slide-item-description games" ng-non-bindable="">Experience Chaos Canyon - Escape from Desolation Valley, explore the ruins on the cliffs, walk on the Sky Bridge and hold the Battle Cube from invaders! This map features models created by the community, including: PilotLuke, tingc222, and Yahoo.</p>
                            </div>
                            <div class="slide-item-stats">
                                <ul class="hlist">
                                    <li class="list-item">
                                        <div class="text-label slide-item-stat-title">Playing</div>
                                        <div class="text-lead slide-item-members-count">0</div>
                                    </li>
                                    <li class="list-item">
                                        <div class="text-label slide-item-stat-title">Visits</div>
                                        <div class="text-lead text-overflow slide-item-my-rank games">1M+</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                        </ul>

                    <a class="carousel-control left" data-switch="prev"><span class="icon-carousel-left"></span></a>
                    <a class="carousel-control right" data-switch="next"><span class="icon-carousel-right"></span></a>

        </div>
    </div-->


    <div class="section ng-scope" ng-controller="profileUtilitiesController" ng-init="getPlayerAssets('10')">
        <!-- ngIf: assets.length > 0 -->
    </div>
    <div class="section ng-scope" ng-controller="profileUtilitiesController" ng-init="getPlayerAssets('11')">
        <!-- ngIf: assets.length > 0 -->
    </div>


                <!-- ngIf: profileLayout.userHasNoCreations -->
            </div>
                      
                      <?php
} else {
    echo $user;
} include'../doc/footer.php';
?>