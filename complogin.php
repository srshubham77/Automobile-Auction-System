<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Company Login</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Company Login</h2>
  </div>
	 
  <form method="post" action="complogin.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
      <label>Company Name</label>
      <input type="text" name="username" >
    </div>
    <div class="input-group">
  		<label>Email</label>
  		<input type="text" name="email" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_comp">Login</button>
  	</div>
  	<p>
  		New Seller? <a href="compreg.php">Sign up</a>
  	</p>
    <br>
    <p>
      New Customer? <a href="Register.php">Sign up</a>
    </p>
  </form>
</body>
</html>