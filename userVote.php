<?php
session_start();
if(!(isset($_SESSION['login']) && $_SESSION['login']!='')){
	header("Location: login.php");
}
$currentUser = $_SESSION['username'];
$player = $_GET['id'];
include_once("./library.php");
$sql = "SELECT * FROM user_role NATURAL JOIN roles NATURAL JOIN role_perm NATURAL JOIN permissions WHERE username = '$currentUser' AND perm_id = '4'";
$result = $conn->query($sql);
if ($result->num_rows > 0){
  
if (mysqli_connect_error()) {
      die('Connect Error ('. mysqli_connect_errno() .')'. mysqli_connect_error());
  } else {
	$sql = "UPDATE Players SET votes = votes+1 WHERE playerID = '$player'";
	if (mysqli_query($conn, $sql)){
		mysqli_close($conn);
		header("Location: vote.php");
		exit;
	}
	else{
		echo "Error updating admin permissions";
	}
}
}
else{
	header("Location: index.php");
}
?>
