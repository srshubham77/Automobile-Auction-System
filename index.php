<script type="text/javascript">
function get_states(self) { // Call to ajax function
   
    var model=document.getElementById("comp").value;
    //alert(model);
    
    var dataString="comp="+model;
    //alert(dataString);
    //alert("hello");
    var http=new XMLHttpRequest();
    var url="getstates.php";
    var params="comp="+model;
    //alert(params);

    http.open('POST', url, true);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.onreadystatechange = function() {//Call a function when the state changes.
    if(http.readyState == 4 && http.status == 200) {
        //alert(http.responseText);
        var mmodels=document.getElementById("mymodels");
        mmodels.innerHTML=http.responseText;
    }
}
http.send(params);
}

function bidding(){

}
</script>

<?php 
  session_start(); 
  $db = mysqli_connect('localhost', 'root', '', 'Resume');
  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
  $new;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bid</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
	<h2>Bidding Place</h2>
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
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    	<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
    <form method="post" action="server.php" style="max-width: 100%; max-height: 100%;">
    <div class="input-group">
      <label id="first">Company :</label>
      <select id="comp" name = 'comp' onchange="get_states(self)">
        <!-- <option value="pick" name="compname"></option> -->
        <option value="select">SELECT</option>
          <?php 
            $sql = mysqli_query($db, "SELECT DISTINCT(name) From item");
            $row = mysqli_num_rows($sql);
            while ($row = mysqli_fetch_array($sql)){
             // $_SESSION['model']=$row['name'];

            echo "<option value='". $row['name'] ."'name='compname'>" .$row['name'] ."</option>" ;
            }

          ?>
      </select>
      <label id="first">Model :</label>
    <select id="mymodels" name="models">
    <div id="get_state" class="input-group">
    
    </div>
    </select>
    </div>
    <br>
    <div class="input-group">
      <label id="first">Bid Price:</label>
      <input type="number" name="bidprice"/>
    </div>
    <br>
    <div class="wrapper">
      <button type="submit" name="subbid" class="btn">BID</button>
    </div>
    <br>
    <div class="wrapper">
      <button type="submit" name="result" class="btn" onclick="window.location.href='localhost/Resume/result.php'">Results</button>
    </div>
  </form>
</div>

		
</body>
</html>