<?php  
   include_once("./library.php");
	
// Assigning POST values to variables.
$username = $_POST['username'];
$password = $_POST['password'];


// CHECK FOR THE RECORD FROM TABLE
$query = "SELECT password, role_id, username FROM `user_role` WHERE username= ? and password= ? "; 
$stmt = mysqli_prepare($conn, $query) or die ("Unable to prepare statment: " . $conn->error);
mysqli_stmt_bind_param($stmt, "ss", $username, $password);
mysqli_stmt_execute($stmt) or die ("Unable to execute query: " . $stmt->error);

$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_array($result)){
session_start();
$_SESSION['login'] = "1";
$_SESSION['username'] = $username;
header('Location: https://cs4750.cs.virginia.edu/~reg3dq/cs4750-baseballDB/index.php');

}else{
session_start();
$_SESSION['login']='';
$_SESSION['username'] = '';
header('Location: https://cs4750.cs.virginia.edu/~reg3dq/cs4750-baseballDB/login.php');
}
$query->close();
?>
