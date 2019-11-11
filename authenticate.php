<?php  
 include_once('library.php');
	
// Assigning POST values to variables.
$username = $_POST['username'];
$password = $_POST['password'];

$conn = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);


if(mysqli_connect_error()){
	die('Connect Error (' . mysqli_connect_errno() .')'. mysqli_connect_error());}
else{
// CHECK FOR THE RECORD FROM TABLE
$query = "SELECT * FROM `user_role` WHERE username='$username' and password='$password'"; 
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
$count = mysqli_num_rows($result);

if ($count == 1){
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
}
?>
