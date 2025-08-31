<?php
  session_start();
  
  if($_SESSION['rank'] !== 'admin') {
    header('Location: /home.php');
  }
  
    if(isset($_GET['delete'])) {
        $file_path = '../doc/feeds.txt';
        
        if(file_exists($file_path)) {
            $file = fopen($file_path, 'w');
            
            if($file) {
                fclose($file);
                $logEntry = "[" . date("m/d/Y | H:i:s") . "] " .$_SESSION['username'] . " Reseted feeds.";
                file_put_contents('logs.txt', $logEntry . PHP_EOL, FILE_APPEND);
                
                ob_start();
                header('Location: /Admin/feeds.php');
                exit();
                ob_flush();
            } else {
                echo "Failed to open the file.";
            }
        } else {
            echo "File not found.";
        }
    }
    
?>
      
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EPIK17 Admin Panel</title>
  
</head>

<body>
  
  <?php include('header.php'); ?>

  <div class="col-xs-12 container-header">
    <h3>Feeds Managing</h3>
    <a href="?delete" class="btn-secondary-xs btn-more btn-fixed-width">Reset Feeds</a>
  </div>
  <hr>
<ul class="vlist feeds">
        
<?php
$feeds = file('../doc/feeds.txt', FILE_IGNORE_NEW_LINES);
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

if (isset($_GET['delete']) && isset($_GET['username'])) {
    $contentToDelete = $_GET['delete'];
    $usernameToDelete = $_GET['username'];

    foreach ($feeds as $key => $feed) {
        $data = explode(' > ', $feed);
        $content = htmlspecialchars_decode(html_entity_decode($data[2]));
        $username = $data[0];

        if ($content == $contentToDelete && $username == $usernameToDelete) {
            unset($feeds[$key]);
            break;
        }
    }

    file_put_contents('../doc/feeds.txt', implode("\n", $feeds));
}

foreach (array_reverse($posts) as $post) {
    echo '<li class="list-item">
            <a href="/users/' . $post['uid'] . '/profile" style="width:60px;height:60px;" class="list-header avatar avatar-headshot-lg"><img class="header-thumb" style="border-radius: 50%;" src="/Thumbs/Headshots/' . $post['username'] . '.png?c='. rand('0', '100000') . '"></a>
            
                                                                                                                                                                                                                              
                                                                                                                                                                                                                              <div class="list-body">
                <p class="list-content"><a href="/users/' .  $post['uid'] . '/profile"><b>' . $post['username'] . '</b></a></p>
                <a class="feedtext linkify">"' . htmlspecialchars($post['content']) . '"</a>' . ($post['rank'] == 'admin' ? ' (posted by an admin)' : '') . '<p></p>
                <span class="xsmall text-date-hint">' . $post['time'] . '</span>
                
            </div>
                                                               <a style="float:right;" href="?delete=' . urlencode($post['content']) . '&username=' . urlencode($post['username']) . '">
                    <span class="icon-close"></span>
                </a>
        </li>';
}
?>


</ul>
     
    </div>
  </div>

  <?php include('../doc/footer.php'); ?>
  
</body>

</html>
<?php
  
  if($_SESSION['rank'] !== 'admin') {
    header('Location: /home.php');
  }
?>
      
