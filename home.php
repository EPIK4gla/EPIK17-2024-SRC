<?php
  session_start();
  
  if($_SESSION['username']) {
    
  } else {
    header('Location: /');
  }
  
  if(isset($_GET['u'])) { header("Location: /render/?u=". $_GET['u']); exit; } else { }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EPIK17</title>
</head>
<body>
<?php include('doc/header.php'); ?>
  <div class="container-main">
            <script type="text/javascript">
                if (top.location != self.location) {
                    top.location = self.location.href;
                }
            </script>
        <noscript><div&gt;<div class="alert-info" role="alert"&gt;Please enable Javascript to use all the features on this site.</div&gt;</div&gt;</noscript>
        <div class="content ">

                            <div id="Skyscraper-Adp-Left" class="abp abp-container left-abp"></div>

        <div id="HomeContainer" class="row home-container" data-update-status-url="/home/updatestatus">

    <div class="col-xs-12 home-header">
        <a href="users/<?php echo $_SESSION['id']; ?>/profile" class="avatar avatar-headshot-lg">
        <img alt="avatar" src="/Thumbs/Headshots/<?php echo $_SESSION['username']; ?>.png?c=<?php echo rand('0', '10000000'); ?>" id="home-avatar-thumb" class="avatar-card-image">
            </a>

        <script type="text/javascript">
            $("img#home-avatar-thumb").on('load', function () {
                if (Roblox && Roblox.Performance) {
                    Roblox.Performance.setPerformanceMark("head_avatar");
                }
            });
        </script>
        <div class="home-header-content ">
            <h1>
                <a href="users/<?php echo $_SESSION['id']; ?>/profile">Hello, <?php echo $_SESSION['username']; ?>!</a>
            </h1>
            <?php
  /*
            if($usr['MembershipType'] == "BuildersClub"){
            echo '<span class="icon-bc"></span>';
            }else if($usr['MembershipType'] == "TurboBuildersClub"){
                echo '<span class="icon-tbc"></span>';
            }else if($usr['MembershipType'] == "OutrageousBuildersClub"){
                echo '<span class="icon-obc"></span>';
            } */
            ?>
        </div>
    </div>

    <div class="col-xs-12 section home-friends">
            <div class="container-header">
                <h2>Friends (0)</h2>
                <a href="Friends.aspx" class="btn-secondary-xs btn-more btn-fixed-width">See All</a>
            </div>

            <div class="section-content">
                <span>Looks like you have no friends. How sad.</span>
            </div>
        </div>

        <div id="recently-visited-places" class="col-xs-12 container-list home-games">
            <div class="container-header">
                <h2>Recently Played</h2>
<a href="" class="btn-secondary-xs btn-more btn-fixed-width">See All</a>            </div>

<ul class="hlist game-cards ">


<!--li class="list-item game-card">
    <div class="game-card-container">
        <a href="/view.aspx?id=1" class="game-card-link">
            <div class="game-card-thumb-container">
                <img class="game-card-thumb" src="https://tr.rbxcdn.com/e1e35f53f2547279a765cf04fe61ab7b/150/150/Image/Jpeg" width="150" title="Natural Disaster Survival" alt="Natural Disaster Survival" thumbnail="{&quot;Final&quot;:true,&quot;Url&quot;:&quot;https://t3.rbxcdn.com/1765189db47405c5132e629e8b88ef16&quot;,&quot;RetryUrl&quot;:null}" image-retry="">
            </div>
            <div class="text-overflow game-card-name" title="Natural Disaster Survival" ng-non-bindable="">
                Natural Disaster Survival
            </div>
            <div class="game-card-name-secondary">
                0 Playing
            </div>
            <div class="game-card-vote">
                <div class="vote-bar" data-voting-processed="true">
                    <div class="vote-thumbs-up">
                        <span class="icon-thumbs-up"></span>
                    </div>
                    <div class="vote-container" data-upvotes="0" data-downvotes="0">
                        <div class="vote-background no-votes"></div>
                        <div class="vote-percentage" style="width: 0%;"></div>
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
                    <div class="vote-down-count">0</div>
                    <div class="vote-up-count">0</div>

                </div>
            </div>
        </a>
        <span class="game-card-footer">
        <span class="text-label xsmall">By </span>
        <a class="text-link xsmall text-overflow" href="/users/1/profile">lvtkr</a>
    </span>
    </div>
</li-->

</ul>
        </div>

<div id="my-favorties-games" class="col-xs-12 container-list home-games">
            <div class="container-header">
                <h2>My Favorites</h2>
<a href="" class="btn-secondary-xs btn-more btn-fixed-width">See All</a>            </div>

<div class="section-content">
<span>No Favorite Games.</span>
</div>
</div>

<div class="col-xs-12 col-sm-6 home-right-col">

        <div class="section">
            <div class="section-header">
                <h2>Blog News</h2>
                </div>
            <div class="section-content">

<ul class="blog-news">
            <!--li class="news">
                <span class="text-overflow news-link"><a href="" ref="news-article" class="text-name text-lead"></a></span>
            </li-->

</ul>
            </div>
        </div>
    </div><!-- .home-right-col -->

   <div class="col-xs-12 col-sm-6 home-left-col">
        <div class="section">
            <div class="section-header">
                <h2>My Feed</h2>
            </div>
            <?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $content = htmlspecialchars($_POST['content']); 

    

    $feedData = $_SESSION['username'] . ' > ' . $_SESSION['id'] . ' > ' . $content . ' > ' . date("M d, Y | h:i A") . ' (GMT) > ' . $_SESSION['rank'] . PHP_EOL;
    file_put_contents('doc/feeds.txt', $feedData, FILE_APPEND);
  $logEntry = "[" . date("m/d/Y | H:i:s") . "] " .$_SESSION['username'] . " Made a feed: '$content'.";
  if (file_put_contents('Admin/logs.txt', $logEntry . PHP_EOL, FILE_APPEND) !== false) {
            
}
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="section-content">
        <div class="form-horizontal" id="statusForm" role="form">
            <div class="form-group">
                <input class="form-control input-field" name="content" id="txtStatusMessage" maxlength="254" placeholder="What are you doing on EPIK17?" value="">
                <p class="form-control-label">Status update failed.</p>
            </div>
            <button type="submit" class="btn-primary-md btn-fixed-width" name="submit" id="shareButton">Share</button>
            <img id="loadingImage" class="share-login" alt="Sharing..." src="https://images.rbxcdn.com/ec4e85b0c4396cf753a06fade0a8d8af.gif" height="17" width="48">
        </div>
    
</form>

          
       <ul class="vlist feeds">
        
<?php
$feeds = file('doc/feeds.txt', FILE_IGNORE_NEW_LINES);
$posts = [];
foreach ($feeds as $feed) {
    $data = explode(' > ', $feed);
    $post = [
        'username' => $data[0],
        'uid' => $data[1],
        'content' => htmlspecialchars_decode(html_entity_decode($data[2])), 
        'time' => $data[3],
        'rank' => $data[4]
    ];
    $posts[] = $post;
}

function cmp($a, $b) {
    return strtotime($a['time']) - strtotime($b['time']);
}

usort($posts, 'cmp');
  

   
      
foreach (array_reverse($posts) as $post) {
  
    echo '<li class="list-item">
            <a href="users/' . $post['uid'] . '/profile" style="width:60px;height:60px;" class="list-header avatar avatar-headshot-lg"><img class="header-thumb" style="border-radius: 50%;" src="/Thumbs/Headshots/' . $post['username'] . '.png?c='. rand('0', '100000') . '"></a>
            <div class="list-body">
                <p class="list-content"><a href="users/' .  $post['uid'] . '/profile"><b>' . $post['username'] . '</b></a></p>
                <a class="feedtext linkify">"' . htmlspecialchars($post['content']) . '"</a>' . ($post['rank'] == 'admin' ? ' (posted by an admin)' : '') . '<p></p>
                <span class="xsmall text-date-hint">' . $post['time'] . '</span>
                <a href="">
                    <span class="icon-report"></span>
                </a>
            </div>
        </li>';
  
}
  
?>

</ul>


            </div>
        </div>
    </div>





</div>
<div id="Skyscraper-Adp-Right" class="abp abp-container right-abp"></div>

        <?php include('doc/footer.php'); ?>