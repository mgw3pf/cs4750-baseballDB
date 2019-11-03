<?php
 include_once("./library.php"); // To connect to the database
 $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
 // Check connection
 if (mysqli_connect_errno())
 {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }
 // Form the SQL query (an INSERT query)
 $sql="INSERT INTO user_role (username, email, password, role_id)
 VALUES
 ('$_POST[username]','$_POST[email]','$_POST[password]', '1')";
 if (!mysqli_query($con,$sql))
 {
 die('Error: ' . mysqli_error($con));
 }
 
 mysqli_close($con);
 header('Location: https://cs4750.cs.virginia.edu/~reg3dq/cs4750-baseballDB/');
 exit;
?>
