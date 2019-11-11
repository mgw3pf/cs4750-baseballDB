<?PHP
session_start();
if(!(isset($_SESSION['login']) && $_SESSION['login']!='')){
	header("Location: login.php");
}
if (isset($_SESSION['username'])){
	$username = $_SESSION['username'];
}
$player = $_GET['id'];
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

<!-- Navbar on small screens (Hidden on medium and large screens) -->
<div class="w3-top w3-hide-large w3-hide-medium" id="myNavbar">
  <div class="w3-bar w3-black w3-opacity w3-hover-opacity-off w3-center w3-small">
    <a href="#" class="w3-bar-item w3-button" style="width:25% !important">HOME</a>
    <a href="#search" class="w3-bar-item w3-button" style="width:25% !important">SEARCH</a>
    <a href="#vote" class="w3-bar-item w3-button" style="width:25% !important">VOTE</a>
    <a href="#leaderboard" class="w3-bar-item w3-button" style="width:25% !important">LEADERBOARD</a>
  </div>
</div>

<?php
	$playerDataQuery = "SELECT * FROM Players WHERE playerID = '$player'";
	$playerData = $conn->query($playerDataQuery);
	$playerDataRow = $playerData->fetch_assoc();

	$AllstarQuery = "SELECT year, name, positionName FROM Allstar NATURAL JOIN Teams NATURAL JOIN Positions WHERE playerID = '$player' ORDER BY year DESC";
	$AllstarData = $conn->query($AllstarQuery);
	if($AllstarData->num_rows>0){
	$AllstarDataRow = $AllstarData->fetch_assoc();}

	$battingQuery = "SELECT year, name, positionName, battingGames, atBats, runs, hits, doubles, triples, HR, RBI, stolenBases, BB, strikeouts FROM Batting NATURAL JOIN Teams NATURAL JOIN Positions WHERE playerID = '$player'";
	$battingData = $conn->query($battingQuery);
	if($battingData->num_rows>0){
	$battingDataRow = $battingData->fetch_assoc();}

	$fieldingQuery = "SELECT year, name, positionName, fieldingGames, assists, errors, doublePlays, oppStolenBases, oppCaughtStealing FROM Fielding NATURAL JOIN Teams NATURAL JOIN Positions WHERE playerID = '$player'";
	$fieldingData = $conn->query($fieldingQuery);
	if($fieldingData->num_rows>0){
	$fieldingDataRow = $fieldingData->fetch_assoc();}
	
	$HOFQuery = "SELECT year, inducted, category FROM HallOfFame WHERE playerID = '$player'";
	$HOFData = $conn->query($HOFQuery);
	if($HOFData->num_rows>0){
	$HOFDataRow = $HOFData->fetch_assoc();}

	$outfieldersQuery = "SELECT year, leftField, centerField, rightField FROM Outfielders WHERE playerID = '$player'";
	$outfieldersData = $conn->query($outfieldersData);
	if($outfieldersData->num_rows>0){
	$outfieldersDataRow = $outfieldersData->fetch_assoc();}

	$pitchingQuery = "SELECT year, name, wins, losses, pitchingGames, gamesStarted, completeGames, shutouts, saves, hits, earnedRuns, HR, BB, strikeouts, opponentsBattingAverage, ERA, runs FROM Pitching NATURAL JOIN Teams WHERE playerID = '$player'";
	$pitchingData = $conn->query($pitchingQuery);
	if($pitchingData->num_rows>0){
	$pitchingDataRow = $pitchingData->fetch_assoc();}

	$salaryQuery = "SELECT year, name, salary FROM Salaries NATURAL JOIN Teams WHERE playerID = '$player'";
	$salaryData = $conn->query($salaryQuery);
	if($salaryData->num_rows>0){
	$salaryDataRow = $salaryData->fetch_assoc();}
?>


<!-- Page Content -->
<div class="w3-padding-large" id="main">
  <!-- Header/Home -->
  <header class="w3-container w3-padding-32 w3-center w3-black" id="home">
    <h1 class="w3-jumbo"><span class="w3-hide-small"><?php echo $playerDataRow['nameFirst'] . " " . $playerDataRow['nameLast'] ?></h1>
    <h2 class="w3-large"><span class="w3-hide-small"><?php echo $playerDataRow['birthCountry']. "  " . $playerDataRow['weight'] . "lbs.  " . $playerDataRow['height'] . "in.  Bats: " . $playerDataRow['bats'] . "    Throws: " . $playerDataRow['throws'] ?></h2>
  </header>

<div class="w3-content w3-medium w3-justify w3-text-grey w3-padding-32">
<?php
	if($AllstarData->num_rows>0){?>
		<h2 class="w3-text-light-grey">Allstar Stats</h2><?php ;
	while($AllstarDataRow = $AllstarData->fetch_assoc()){?>
		<p><?php echo $AllstarDataRow['year'] . " " . $AllstarDataRow['name'] . ";     Starting position: " . $AllstarDataRow['positionName'] ?></p><?php ;  
	}
	}
?>
</div>  
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
