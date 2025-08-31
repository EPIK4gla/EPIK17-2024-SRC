<?php 
  session_start();
  
  if($_SESSION['rank'] !== 'admin') {
    header('Location: /home.php');
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

  <h1 >EPIK17 Admin Panel</h1>
      

      

    
  
      <hr>

      <h2>Welcome to the Admin Panel</h2>
      <p>This is where you can manage things.</p>
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
      
