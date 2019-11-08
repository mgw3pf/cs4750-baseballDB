<?php
session_start();
if(!(isset($_SESSION['login']) && $_SESSION['login']!='')){
	header("Location: login.php");
}
$username = $_GET['id'];
$SERVER = 'cs4750.cs.virginia.edu';
$USERNAME = 'reg3dq';
$PASSWORD = 'Databases2019';
$DATABASE = 'reg3dq';
$conn = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
  if (mysqli_connect_error()) {
      die('Connect Error ('. mysqli_connect_errno() .')'. mysqli_connect_error());
  } else {
	$sql = "UPDATE user_role SET role_id = 2 WHERE username = '$username'";
	if (mysqli_query($conn, $sql)){
		mysqli_close($conn);
		header("Location: admin.php");
		exit;
	}
	else{
		echo "Error updating admin permissions";
	}
}

?>
