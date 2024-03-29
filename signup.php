<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Create Account</title>
	        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">	
		<link href="style.css" rel="stylesheet" type="text/css">
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
	</head>
	<body class="w3-black">
<!-- Icon Bar (Sidebar - hidden on small screens) -->
<nav class="w3-sidebar w3-bar-block w3-small w3-hide-small w3-center">
  <a href="index.html" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
    <i class="fa fa-home w3-xxlarge"></i>
    <p>HOME</p>
  </a>
  <a href="login.php" class="w3-bar-item w3-button w3-padding-large w3-black">
    <i class="fa fa-user-circle-o w3-xxlarge"></i>
    <p>LOGIN</p>
</a>
</nav>
		<div class="w3-content w3-justify w3-text-grey w3-padding-64" id="signup">
			<h1 class="w3-jumbo"><span class = "w3-hide-small">Create Account</h1>
			<hr style="width:200px" class="w3-opacity">
<?php print $errorMessage;?>
			<form action="addUser.php" method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				
				
				<input type="submit" value="Create Account" id="submit" >
				
			</form>
		<a href="login.php">Already have an account? Login!</a>
		</div>
<footer class="w3-content w3-padding-64 w3-text-grey w3-xlarge">
    <p class="w3-medium">Thanks to <a href="http://www.seanlahman.com/baseball-archive/statistics/" target="_blank" class="w3-hover-text-green">Lahman's Database</a></p>
    <p class="w3-medium">Website by Robyn Guarriello, Mike Wood, Tate Haga, Aria Kumar, and Galen Palowitch
  <!-- End footer -->
  </footer>
	</body>
</html>
