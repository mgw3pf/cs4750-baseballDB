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

table, th, td {
  border: 1px solid white;
}

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
	include_once("./library.php");
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

	$battingQuery = "SELECT * FROM Batting NATURAL JOIN Teams WHERE playerID = '$player'";
	$battingData = $conn->query($battingQuery);

	$fieldingQuery = "SELECT year, name, position, fieldingGames, assists, errors, doublePlays FROM Fielding NATURAL JOIN Teams WHERE playerID = '$player'";
	$fieldingData = $conn->query($fieldingQuery);
	
	$HOFQuery = "SELECT year, inducted, category FROM HallOfFame WHERE playerID = '$player'";
	$HOFData = $conn->query($HOFQuery);

	$outfieldersQuery = "SELECT year, leftField, centerField, rightField FROM Outfielders WHERE playerID = '$player'";
	$outfieldersData = $conn->query($outfieldersData);

	$pitchingQuery = "SELECT year, name, wins, losses, pitchingGames, gamesStarted, completeGames, shutouts, saves, hits, earnedRuns, HR, BB, strikeouts, opponentsBattingAverage, ERA, runs FROM Pitching NATURAL JOIN Teams WHERE playerID = '$player'";
	$pitchingData = $conn->query($pitchingQuery);

	$salaryQuery = "SELECT year, name, salary FROM Salaries NATURAL JOIN Teams WHERE playerID = '$player'";
	$salaryData = $conn->query($salaryQuery);

	$commentsQuery = "SELECT comment, cID FROM Comments WHERE playerID = '$player'";
	$commentsData = $conn->query($commentsQuery);
?>


<!-- Page Content -->
<div class="w3-padding-large" id="main">
  <!-- Header/Home -->
  <header class="w3-container w3-padding-32 w3-center w3-black" id="home">
    <h1 class="w3-jumbo"><span class="w3-hide-small"><?php echo $playerDataRow['nameFirst'] . " " . $playerDataRow['nameLast'] ?></h1>
    <h2 class="w3-large"><span class="w3-hide-small"><?php echo $playerDataRow['birthCountry']. "  " . $playerDataRow['weight'] . "lbs.  " . $playerDataRow['height'] . "in.  Bats: " . $playerDataRow['bats'] . "    Throws: " . $playerDataRow['throws'] ?></h2>
    <?php echo "<a href = 'comment.php?id=".$playerDataRow["playerID"]."'>ADD COMMENT</a><br>";?>
  </header>

<div class="w3-content w3-medium w3-justify w3-text-grey w3-padding-32">
<?php
	if($AllstarData->num_rows>0){?>
		<h2 class="w3-text-light-grey">Allstar Stats</h2><?php ;
		echo "<table>";
		echo "<tr><th>Year</th><th>Team</th><th>Starting Position</th></tr>";
	while($AllstarDataRow = $AllstarData->fetch_assoc()){?>
		<?php echo "<tr><td>" . $AllstarDataRow['year'] . "</td><td>" . $AllstarDataRow['name'] . "</td><td>" . $AllstarDataRow['positionName'] . "</td></tr>" ?><?php ;  
	}
	echo "</table>";
	}

	if($battingData->num_rows>0){?>
		<h2 class="w3-text-light-grey">Batting Stats</h2><?php ;
		echo "<table>";
		echo "<tr><th>Year</th><th>Team</th><th>Games</th><th>At Bats</th><th>Runs</th><th>Hits</th><th>2B</th><th>3B</th><th>HR</th><th>RBI</th><th>SB</th><th>BB</th><th>SO</th></tr>";
	while($battingDataRow = $battingData->fetch_assoc()){?>
		<?php echo "<tr><td>" . $battingDataRow['year'] . "</td><td>" . $battingDataRow['name'] . "</td><td>" . $battingDataRow['battingGames'] . "</td><td>" . $battingDataRow['atBats'] . "</td><td>" . $battingDataRow['runs'] . "</td><td>" . $battingDataRow['hits'] . "</td><td>". $battingDataRow['doubles'] . "</td><td>" . $battingDataRow['triples'] . "</td><td>" . $battingDataRow['HR'] . "</td><td>" . $battingDataRow['RBI'] . "</td><td>" . $battingDataRow['stolenBases'] . "</td><td>" . $battingDataRow['BB'] . "</td><td>" . $battingDataRow['strikeouts'] . "</td></tr>" ?><?php ;
	}
	echo "</table>";
	}

	if($fieldingData->num_rows>0){?>
		<h2 class="w3-text-light-grey">Fielding Stats</h2><?php ;
	while($fieldingDataRow = $fieldingData->fetch_assoc()){?>
		<p><?php echo $fieldingDataRow['year'] . " " . $fieldingDataRow['name'] . "; Position: " . $fieldingDataRow['position'] . ", Games: " . $fieldingDataRow['fieldingGames'] . ", Assists: " . $fieldingDataRow['assists'] . ", Errors: " . $fieldingDataRow['errors'] . ", Double Plays: " . $fieldingDataRow['doublePlays'] ?></p><?php ;
	}
	}

	if($HOFData->num_rows>0){?>
		<h2 class="w3-text-light-grey">Hall of Fame</h2><?php ;
	while($HOFDataRow= $HOFData->fetch_assoc()){?>
		<p><?php echo $HOFDataRow['year'] . ", Inducted (Y/N): " . $HOFDataRow['inducted'] . ", Category: " . $HOFDataRow['category'] ?></p><?php ;
	}
	}

	if($pitchingData->num_rows>0){?>
		<h2 class="w3-text-light-grey">Pitching Stats</h2><?php ;
	while($pitchingDataRow = $pitchingData->fetch_assoc()){?>
		<p><?php echo $pitchingDataRow['year'] . " " . $pitchingDataRow['name'] . "; Wins: " . $pitchingDataRow['wins'] . ", Losses: " . $pitchingDataRow['losses'] . ", Games: " . $pitchingDataRow['pitchingGames'] . ", Games Started: " . $pitchingDataRow['gamesStarted'] . ", Complete Games: " . $pitchingDataRow['completeGames'] . ", Shutouts: " . $pitchingDataRow['shutouts'] . ", Saves: " . $pitchingDataRow['saves'] . ", Hits: " . $pitchingDataRow['hits'] . ", Earned Runs: " . $pitchingDataRow['earnedRuns'] . ", HR Given Up: " . $pitchingDataRow['HR'] . ", Walks Given Up: " . $pitchingDataRow['BB'] . ", Strikeouts: " . $pitchingDataRow['strikeouts'] . ", Opponents AVG: " . $pitchingDataRow['opponentsBattingAverage'] . ", ERA: " . $pitchingDataRow['ERA'] . ", Runs: " . $pitchingDataRow['runs'] ?></p><?php ;
	}
	}
	
	if($salaryData->num_rows>0){?>
		<h2 class="w3-text-light-grey">Salaries</h2><?php ;
	while($salaryDataRow = $salaryData->fetch_assoc()){?>
	<p><?php echo $salaryDataRow['year'] . " " . $salaryDataRow['name'] . " Salary: $" . $salaryDataRow['salary'] ?></p><?php ;
	}
	}

	if($commentsData->num_rows>0){?>
		<h2 class="w3-text-light-grey">Comments</h2><?php ;
	while($commentsDataRow=$commentsData->fetch_assoc()){?>
	<p><?php echo $commentsDataRow['comment']?></p><?php ;
	$sql = "SELECT * FROM user_role NATURAL JOIN roles NATURAL JOIN role_perm NATURAL JOIN permissions WHERE username = '$username' AND perm_id = '9'";
$result = $conn->query($sql);
if ($result->num_rows > 0){
	echo "<a href = 'deleteComment.php?id=".$commentsDataRow['cID']."&p_id=".$playerDataRow["playerID"]."'>Delete Comment</a><br>";
	}
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
