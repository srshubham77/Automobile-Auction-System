
<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: complogin.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: complogin.php");
  }
?>
<?php
  if(isset($_POST['additem'])){
  header("Location: additem.php");
  exit;
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
  <h2>Home Page</h2>
</div>
<div class="content">
    <!-- notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
        <h3>
          <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
          ?>
        </h3>
      </div>
    <?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
      <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong>
       <a style="color:red;" href="cindex.php?logout='1'">logout</a> </p>
    <?php endif ?>
    <form method="post" action="cindex.php">
      <div class="input-group">
      <button type="submit" class="btn" name="additem">Add Item</button>
    </div>
    <br>
    <div class="input-group">
      <button type="submit" class="btn" name="sale">View Sale</button>
    </div>
    </form>
</div>

    
</body>
</html>