<?php 
   $db = mysqli_connect('localhost', 'root', '', 'Resume');
   //echo "welcome";
   $comp = $_POST['comp'];
   //echo "$comp";
   if ($comp != '') {
      $sql1 = "SELECT model FROM item WHERE name= '$comp';";
      $result1 = mysqli_query($db,$sql1);
      #echo "<select name='model'>";
      echo "<option value=''>Select</option>"; 
      while ($row = mysqli_fetch_array($result1)) {
        echo "<option value='" . $row['model'] . "'>" . $row['model'] . "</option>";}
      #echo "</select>";
    }
    else
      {
        echo  '';
      }
    
?>