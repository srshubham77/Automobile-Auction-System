
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

<!DOCTYPE html>
<html>
<head>
  <title>Add Item</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
  <h2>Add Item</h2>
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
    <form action="server.php" method="post" style="position: absolute;">
      <div class="input-group"> 
        <label> Company Name:</label>
        <input type="text" name="name">
      </div>
      <div class="input-group">
        <label>Model</label>
        <input type="text" name="model">
      </div>
      <div class="input-group">
        <label>Base Price</label>
        <input type="number" name="price">
      </div>
      <div class="input-group">
        <label>Date</label>
        <input type="Date" name="date">
      </div>
      <div class="input-group">  
        <label>Start Time</label>
        <input type="Time" name="stime">
      </div>
      <div class="input-group">
        <label>End Time</label>
        <input type="Time" name="etime">
      </div>
    <div class="input-group">
      <button type="submit" class="btn" name="add_item">Add</button>
    </div>
    </form>

</div>

    
</body>
</html>