<?php
session_start();
if(!(isset($_SESSION['login']) && $_SESSION['login']!='')){
	header("Location: login.php");
}
include_once("./library.php");
if(mysqli_connect_error()){
	die('Connect Error ('. mysqli_connect_errno() .')' . mysqli_connect_error());
}
else{
$player = $_GET['id'];
$sql="INSERT INTO Comments (playerID, comment) VALUES ('$player','$_POST[comment]')";
if(mysqli_query($conn, $sql)){
        mysqli_close($conn);
        header('Location: player.php?id='.$_GET['id']);
        exit;
}
else{
	echo "Error submitting comment";
}
}
?>
