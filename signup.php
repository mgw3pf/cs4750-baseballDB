<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Create Account</title>
	        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">	
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="signup">
			<h1>Create Account</h1>
			<form action="addUser.php" method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="email"></label>
				<input type="email" name="email" placeholder="Email" id="email" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<input type="submit" value="Create Account">
			</form>
		</div>
<a href="login.php">Already have an account? Login!</a>
	</body>
</html>
