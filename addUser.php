<?php
 include_once("./library.php"); // To connect to the database
 $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
 // Check connection
 if (mysqli_connect_errno())
 {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }
 // Form the SQL query (an INSERT query)
 $sql="INSERT INTO user_role (username, password, role_id)
 VALUES
 ('$_POST[username]','$_POST[password]', '1')";
 if (!mysqli_query($con,$sql))
 {
  session_start();
  $_SESSION['login']="";
  $_SESSION['username'] = '';
  header('Location: https://cs4750.cs.virginia.edu/~reg3dq/cs4750-baseballDB/signup.php');
   mysqli_close($con);
 exit; 
}
 else{
 mysqli_close($con);
 session_start();
 $_SESSION['login']="1";
 $_SESSION['username']=$_POST[username];
 header('Location: https://cs4750.cs.virginia.edu/~reg3dq/cs4750-baseballDB/index.php');
 exit;
}
?>
