<?php
   include_once("./library.php");
 // Form the SQL query (an INSERT query)
 $sql="INSERT INTO user_role (username, password, role_id)
 VALUES
 ('$_POST[username]','$_POST[password]', '1')";
 if (!mysqli_query($conn,$sql))
 {
  session_start();
  $_SESSION['login']="";
  $_SESSION['username'] = '';
  header('Location: https://cs4750.cs.virginia.edu/~reg3dq/cs4750-baseballDB/signup.php');
   mysqli_close($conn);
 exit; 
}
 else{
 mysqli_close($conn);
 session_start();
 $_SESSION['login']="1";
 $_SESSION['username']=$_POST[username];
 header('Location: index.php');
 exit;
}
?>
