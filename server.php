<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 
// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'Resume');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_array($result);

  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}

if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}


if (isset($_POST['reg_comp'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_array($result);

  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO company (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: cindex.php');
  }
}

if (isset($_POST['login_comp'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM company WHERE email='$email' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: cindex.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}


if (isset($_POST['add_item'])) {
  // receive all input values from the form
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $model = mysqli_real_escape_string($db, $_POST['model']);
  $price = mysqli_real_escape_string($db, $_POST['price']);
  $date = (mysqli_real_escape_string($db, $_POST['date']));//date format
  $stime = mysqli_real_escape_string($db, $_POST['stime']);//timestamp
  $etime = mysqli_real_escape_string($db, $_POST['etime']);
//die($etime);
  //die($name);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($name)) { array_push($errors, "Company Name is required"); }
  if (empty($model)) { array_push($errors, "Model No. is required"); }
  if (empty($price)) { array_push($errors, "Base price is required"); }
  if (empty($date)) { array_push($errors, "Date is required"); }
  if (empty($stime)) { array_push($errors, "Starting time is required"); }
  if (empty($etime)) { array_push($errors, "Ending time is required"); }
  if (strtotime($stime)>  strtotime($etime)) {
	array_push($errors, "Start Time should be before than End time");
  }
 

  // $date1= strtotime($date);
  // $newformat = date('Y-m-d',$date1);
  // $newstime=strtotime($stime);
  // $newetime=strtotime($etime);
  $newstime=$date.' '.$stime;
  $newetime=$date.' '.$etime;
  
  // Finally, register user if there are no errors in the form
  	// $numErrors = count($errors);
  	 if (count($errors)==0) {
  	

  	$query = "INSERT INTO item (name, model, price, datee, stime, etime) 
  			  VALUES('$name', '$model', '$price', '$date', '$newstime', '$newetime')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	header('location: cindex.php');
    }
    else{
    	print_r($errors);
    }
}
if(isset($_POST['subbid'])){
	$companyname = mysqli_real_escape_string($db, $_POST['comp']);
	$model = mysqli_real_escape_string($db, $_POST['models']);
	$bidprice = mysqli_real_escape_string($db, $_POST['bidprice']);	
	if (empty($companyname)) { array_push($errors, "Company Name is required"); }
  	if (empty($model)) { array_push($errors, "Model No. is required"); }
  	if (empty($bidprice)) { array_push($errors, "Bidding Price is required"); }
  	$sqlbid="SELECT price FROM item WHERE name='$companyname' AND model='$model'";
  	$sqlbidc=mysqli_query($db, $sqlbid);
  	$sqlb=mysqli_fetch_array($sqlbidc);
  	
  	$sqlbidm="SELECT MAX(bidprice) FROM bid WHERE company='$companyname' AND model='$model'";
  	$sqlbidmc=mysqli_query($db, $sqlbidm);
  // 	if (!$sqlbidmc) {
  //   	printf("Error: %s\n", mysqli_error($db));
  //   	exit();
	 // }
  	$sqlc=mysqli_fetch_array($sqlbidmc);
  	$maxibid=$sqlc['MAX(bidprice)'];
  	

  	date_default_timezone_set('Asia/Kolkata');
	  	$date = date('Y-m-d H:i:s',time());
	  	$username='';
	if(isset($_SESSION['username'])){
	 	$username=$_SESSION['username'];
	} 	

	$maxibid=(int)$maxibid;
	
	$sqlu="SELECT username FROM bid WHERE bidprice='$maxibid'";
	$sqlusee=mysqli_query($db, $sqlu);
	$sqluse=mysqli_fetch_array($sqlusee);
	$sqluser=$sqluse['username'];
	//echo $sqluser

	$sql="SELECT stime,etime FROM item WHERE name='$companyname' AND model='$model'";
	$sqlim=mysqli_query($db, $sql);
	$sqli=mysqli_fetch_array($sqlim);
	$stimee=$sqli['stime'];
	$etimee=$sqli['etime'];
	if($date<$stimee){
		array_push($errors, "Bidding time yet to start.");
	}
	elseif ($date>$etimee) {
		array_push($errors, "Bidding time is over.");
	}
	else{
		if($bidprice<=$sqlb['price']){
  			array_push($errors, "Bid Price should be greater than base price.");
  		}
  		else{
			if($bidprice<=$maxibid){
				array_push($errors, "Bid Price should be greater than previous bid.");
			}
			if(strcmp($username,$sqluser)==0){	
			array_push($errors, "Maximum Bid is yours. Wait.");
			}
		}
		
	}

  	if(count($errors)==0){
  	 	$query = "INSERT INTO bid (username, bidprice, company, model, btime) 
  	 		  VALUES('$username', '$bidprice', '$companyname', '$model', '$date')";
  	 	mysqli_query($db, $query);
  	 	$_SESSION['username'] = $username;
		echo "<script>
		alert('Bid Submitted Successfully.';
		</script>";
  		header('location: index.php');
    }
 
  	else{
    	print_r($errors);
    }

}

if(isset($_POST['result'])){

	date_default_timezone_set('Asia/Kolkata');
	  	$date = date('Y-m-d H:i:s',time());
	$sqlii="SELECT COUNT(etime) FROM item WHERE etime<'$date'";
	$sqlimi=mysqli_query($db, $sqlii);
	$sqliiii=mysqli_fetch_array($sqlimi);
	$amt=$sqliiii['COUNT(etime)'];    	
	echo "<html>
<head>
  <title>Results</title>
  <link rel='stylesheet' type='text/css' href='style.css'>
</head>
<style>
table, th, td {

    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;
}
</style>
</head>
<body>
";
	echo "<table style='width:100%'>
  		<caption>Winner</caption>
  		<tr>
    		<th>Company Name</th>
    <th>Model</th>
    <th>Winner</th>
    <th>Bid</th>
  </tr>";
	$sql="SELECT bid.company , bid.model, bid.username, MAX(bidprice) FROM bid INNER JOIN item ON bid.model=item.model WHERE item.etime<'$date' GROUP BY bid.model";
	//echo $sql;
	$msqli=mysqli_query($db, $sql);
	while($sqli=mysqli_fetch_row($msqli)){
			echo "<tr>";
			echo "<td>";
				echo $sqli[0];
				//print_r($sqli);
			echo "</td>";
			echo "<td>";
				echo $sqli[1];
			echo "</td>";
			echo "<td>";
				echo $sqli[2];
			echo "</td>";
			echo "<td>";
				echo $sqli[3];
			echo "</td>";
			echo "</tr>";
		}
		echo "</table>";
	
		echo "</body>
</html>";

}

?>