<?php
session_start();
if(!(isset($_SESSION['login']) && $_SESSION['login']!='')){
	header("Location: login.php");
}
if (isset($_SESSION['username'])){
	$username = $_SESSION['username'];
}
include_once("./library.php");
$tail = filter_input(INPUT_POST, 'tail');
$quantity = filter_input(INPUT_POST, 'quantity');
$stats = filter_input(INPUT_POST, 'stats');
if (!empty($quantity)) {
  if (mysqli_connect_error()) {
      die('Connect Error ('. mysqli_connect_errno() .')'. mysqli_connect_error());
  } else {
       if ($tail == "greater") {
        $sql = "SELECT * FROM (SELECT SUM($stats), nameFirst, nameLast, playerID FROM Players NATURAL JOIN Batting GROUP BY playerID) AS CAREER HAVING `SUM($stats)` > $quantity ORDER BY `SUM($stats)` DESC";
      } elseif ($tail == "fewer") {
        $sql = "SELECT * FROM (SELECT SUM($stats), nameFirst, nameLast, playerID FROM Players NATURAL JOIN Batting GROUP BY playerID) AS CAREER HAVING `SUM($stats)` < $quantity ORDER BY `SUM($stats)` DESC";
      } else {
        $sql = "SELECT * FROM (SELECT SUM($stats), nameFirst, nameLast, playerID FROM Players NATURAL JOIN Batting GROUP BY playerID) AS CAREER HAVING `SUM($stats)` = $quantity ORDER BY `SUM($stats)` DESC";
      }
      $result = $conn->query($sql);
if($result->num_rows > 0){
if($_POST["Export"]){
              header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=results.csv');
              $output = fopen("php://output", "w");
	      $delimiter = ',';
while($row = $result->fetch_assoc()){
			$lineData = array($row["nameFirst"], $row["nameLast"], $row["playerID"], $row["SUM($stats)"]);
			fputcsv($output, $lineData, $delimiter);
		}
	      exit();
        }
}
}
}
?>
<!DOCTYPE html>
<html>
<title>Baseball Database</title>
<meta charset="UTF-8">
<meta name="viewport" cointent="width=device-width, initial-scale=1">
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

table, th, td {
  border: 1px solid white;
}

th, td {
  padding: 5px;
}

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
	include_once("./library.php");
	$sql = "SELECT * FROM user_role NATURAL JOIN roles NATURAL JOIN role_perm NATURAL JOIN permissions WHERE username = '$username' AND perm_id = '3'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0){?>
	<a href = "admin.php" class = "w3-bar-item w3-button w3-padding-large w3-hover-black">
	<i class = "fa fa-address-book-o w3-xxlarge"></i>
	<p>MANAGE ADMINS</p>
	</a>
	<?php }?>
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
        <select name="tail" id="tail">
            <option value="greater">more than</option>
            <option value="fewer">fewer than</option>
            <option value="equal">exactly</option>
        </select>
        <input type="number" name="quantity" id="quantity" min="0" max="10000">
        <select name="stats" id="stats">
            <option value="HR">Home Runs</option>
            <option value="RBI">Runs Batted In</option>
            <option value="BB">Walks</option>
            <option value="stolenBases">Stolen Bases</option>
        </select>
        <input type="Submit", value="Search", name="Search">
	    <input type="Submit", value = "Export to CSV", name="Export">
    </form>
 <div class="w3-content w3-justify w3-black w3-padding-64">
<?php
include_once("./library.php");
$tail = filter_input(INPUT_POST, 'tail');
$quantity = filter_input(INPUT_POST, 'quantity');
$stats = filter_input(INPUT_POST, 'stats');
if (!empty($quantity)) {
      if ($tail == "greater") {
        $sql = "SELECT * FROM (SELECT SUM($stats), nameFirst, nameLast, playerID FROM Players NATURAL JOIN Batting GROUP BY playerID) AS CAREER HAVING `SUM($stats)` > $quantity ORDER BY `SUM($stats)` DESC";
      } elseif ($tail == "fewer") {
        $sql = "SELECT * FROM (SELECT SUM($stats), nameFirst, nameLast, playerID FROM Players NATURAL JOIN Batting GROUP BY playerID) AS CAREER HAVING `SUM($stats)` < $quantity ORDER BY `SUM($stats)` DESC";
      } else {
        $sql = "SELECT * FROM (SELECT SUM($stats), nameFirst, nameLast, playerID FROM Players NATURAL JOIN Batting GROUP BY playerID) AS CAREER HAVING `SUM($stats)` = $quantity ORDER BY `SUM($stats)` DESC";
      }
      $result = $conn->query($sql);
      if($result->num_rows > 0){
        echo "<table>";
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>" . $stats . "</th>";
        echo "</tr>";
	      while($row = $result->fetch_assoc()) {
          $name = $row['nameFirst'] . " " . $row['nameLast'];
          echo "<tr>";
          #echo "<table><tr><td><a href = 'player.php?id=".$row["playerID"]."'>$name</a></td><td>$row["SUM($stats)"]</td></tr></table>";
          echo "<td><a href = 'player.php?id=" . $row["playerID"] . "'>$name</a></td>";
          echo "<td>" . $row["SUM($stats)"] . "</td>";
          echo "</tr>";
        }
        echo "</table>";

      } else {
        echo "No Results found!";
      }
      $conn->close();
  
} else {
  echo "Please enter a stat quantity!";
  die();
}
?>
