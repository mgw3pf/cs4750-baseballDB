<?php include(INCLUDE_PATH . "common_functions.php");
include "library.php" ?>
<?php
// variable declaration
$username = "";
$errors  = [];
// SIGN UP USER
if (isset($_POST['signup_btn'])) {
	// validate form values
	$errors = validateUser($_POST, ['signup_btn']);

	// receive all input values from the form. No need to escape... bind_param takes care of escaping
	$username = $_POST['username'];
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT); //encrypt the password before saving in the database

	// if no errors, proceed with signup
	if (count($errors) === 0) {
		// insert user into database
		$query = "INSERT INTO user_role SET username=?, password=?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param('sssss', $username, $password);
		$result = $stmt->execute();
		if ($result) {
		  $user_id = $stmt->insert_id;
			$stmt->close();
			loginById($user_id); // log user in
		 } else {
			 $_SESSION['error_msg'] = "Database error: Could not register user";
		}
	 }
}
