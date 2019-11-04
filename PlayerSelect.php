<?php
session_start();
if(!(isset($_SESSION['login']) && $_SESSION['login']!='')){
	header("Location: login.php");
}
if (isset($_SESSION['username'])){
	$username = $_SESSION['username'];
}?>
<!DOCTYPE html>
<html>
<title>Baseball Database</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body, h1,h2,h3,h4,h5,h6 {font-family: "Montserrat", sans-serif}
.w3-row-padding img {margin-bottom: 12px}
/* Set the width of the sidebar to 120px */
.w3-sidebar {width: 150px;background: #222;}
/* Add a left margin to the "page content" that matches the width of the sidebar (120px) */
#main {margin-left: 110px}
/* Remove margins from "page content" on small screens */
@media only screen and (max-width: 600px) {#main {margin-left: 0}}
</style>
<body class="w3-black">

<!-- Icon Bar (Sidebar - hidden on small screens) -->
<nav class="w3-sidebar w3-bar-block w3-small w3-hide-small w3-center">
  <p> Welcome, <?php session_start(); echo $_SESSION['username'];?>!</p>
  <a href="index.php" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
    <i class="fa fa-home w3-xxlarge"></i>
    <p>HOME</p>
  </a>
  <a href="search.php" class="w3-bar-item w3-button w3-padding-large w3-black">
    <i class="fa fa-search w3-xxlarge"></i>
    <p>SEARCH</p>
  </a>
  <a href="vote.php" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
    <i class="fa fa-thumbs-up w3-xxlarge"></i>
    <p>VOTE</p>
  </a>
  <a href="leaderboard.php" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
    <i class="fa fa-diamond w3-xxlarge"></i>
    <p>LEADERBOARD</p>
  </a>
  <?php
	$SERVER = 'cs4750.cs.virginia.edu';
	$USERNAME = 'reg3dq';
	$PASSWORD = 'Databases2019';
	$DATABASE = 'reg3dq';
	$conn = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
	 if (mysqli_connect_error()) {
        die('Connect Error ('. mysqli_connect_errno() .')'. mysqli_connect_error()); 
    } else {
	$sql = "SELECT * FROM user_role NATURAL JOIN roles NATURAL JOIN role_perm NATURAL JOIN permissions WHERE username = '$username' AND perm_id = '3'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0){?>
	<a href = "admin.php" class = "w3-bar-item w3-button w3-padding-large w3-hover-black">
	<i class = "fa fa-address-book-o w3-xxlarge"></i>
	<p>MANAGE ADMINS</p>
	</a>
	<?php }}?>
  <a href="logout.php" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
    <i class="fa fa-times-circle-o w3-xxlarge"></i>
    <p>LOG OUT</p>
</a>
</nav>
<!-- Page Content -->
<div class="w3-padding-large" id="main">
  <!-- Header/Home -->
<header class="w3-container w3-padding-32 w3-center w3-black" id="home">
    <h1 class="w3-jumbo"><span class="w3-hide-small">Search Results</h1>
 <div class="w3-content w3-justify w3-black w3-padding-64">
<?php
$SERVER = 'cs4750.cs.virginia.edu';
$USERNAME = 'reg3dq';
$PASSWORD = 'Databases2019';
$DATABASE = 'reg3dq';
// include_once("library.php")
$firstname = filter_input(INPUT_POST, 'firstname');


if (!empty($firstname)) {
    // Create Connection
    $conn = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
    if (mysqli_connect_error()) {
        die('Connect Error ('. mysqli_connect_errno() .')'. mysqli_connect_error()); 
    } else {
        $sql = "SELECT * FROM Players WHERE namefirst = '$firstname'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo $row["nameFirst"] . " " . $row["nameLast"] . "<br>";
            }
        } else {
            echo "No Results found!";
        }
        $conn->close();
    }
} else {
    echo "Please enter a First Name!";
    die();
}
?>
