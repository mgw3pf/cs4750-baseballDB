<?PHP
  session_start();
  if(!(isset($_SESSION['login']) && $_SESSION['login']!='')){
	  header("Location: index.php");}
  if (isset($_SESSION['username'])){
	  $username = $_SESSION['username'];
}
?>

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
  <a href="search_index.php" class="w3-bar-item w3-button w3-padding-large w3-black">
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
<div class="w3-padding-large w3-center" id="main">

    <h1>Search for Baseball Players based on Career Statistics</h1>
    <br> 
    <form action="StatSelect.php" method="post">
        Select all players that have
        <select name="tail">
            <option value="greater">more than</option>
            <option value="fewer">fewer than</option>
            <option value="equal">exactly</option>
        </select>
        <input type="number" name="quantity" id="quantity" min="0" max="10000">
        <select name="stats">
            <option value="HR">Home Runs</option>
            <option value="RBI">Runs Batted In</option>
            <option value="BB">Walks</option>
            <option value="stolenBases">Stolen Bases</option>
        </select>
        <input type="Submit", value="Stat", name="Stat">
	    <input type="Submit", value = "Export to CSV", name="Export">
    </form>


<!--
    <h1><strong>Search by Career Statistics</strong></h1>
    <br>
    <ul>
        <li><h2><a href="stat_hr.php">Home Runs</a></h2></li>
        <li><h2><a href="stat_rbi.php">Runs Batted In</a></h2></li>
        <li><h2><a href="stat_avg.php">Batting Average</a></h2></li>
        <li><h2><a href="stat_bb.php">Bases on Balls</a></h2></li>
    </ul>

    <h1>Search for Baseball Players by Statistics</h1>
        <BR>
        <form action="PlayerSelect.php" method="post">
            First Name: <input type="text" name="firstname" id="firstname">
            Last Name: <input type="text" name="lastname">
            <input type="Submit", value="Search", name="Search">
	    <input type="Submit", value = "Export to CSV", name="Export">
    </form>
    -->

 <!-- Footer -->
  <footer class="w3-content w3-padding-64 w3-text-grey w3-xlarge">
    <p class="w3-medium">Thanks to <a href="http://www.seanlahman.com/baseball-archive/statistics/" target="_blank" class="w3-hover-text-green">Lahman's Database</a></p>
    <p class="w3-medium">Website by Robyn Guarriello, Mike Wood, Tate Haga, Aria Kumar, and Galen Palowitch
  <!-- End footer -->
  </footer>

<!-- END PAGE CONTENT -->
</div>

</body>
</html>
