<?php

session_start();
if(!(isset($_SESSION['login']) && $_SESSION['login']!='')){
	header("Location: login.php");
}
if (isset($_SESSION['username'])){
	$username = $_SESSION['username'];
}
include_once("./library.php");
if(mysqli_connect_error()){
        die('Connect Error ('. mysqli_connect_errno() .')' . mysqli_connect_error());
}
else{

$sql = "SELECT * FROM user_role NATURAL JOIN roles NATURAL JOIN role_perm NATURAL JOIN permissions WHERE username = '$username' AND perm_id = '9'";
$result = $conn->query($sql);
if ($result->num_rows > 0){

$comment = $_GET['id'];

$sql = 'DELETE FROM Comments WHERE cID = "'.$_GET['id'].'"';
if (mysqli_query($conn, $sql)){
	mysqli_close($conn);
	header('Location: player.php?id='.$_GET['p_id']);
	exit;
}

	header('Location: player.php?id='.$_GET['p_id']);
}
}


?>
