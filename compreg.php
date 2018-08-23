<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Company Registration</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Company Register</h2>
  </div>
	
  <form method="post" action="compreg.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Company Name</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_comp">Register</button>
  	</div>
  	<p>
  		Already a seller? <a href="complogin.php">Sign in</a>
  	</p>
    <br>
    <p>
      New Customer? <a href="Register.php">Sign in</a>
    </p>
  </form>
</body>
</html>