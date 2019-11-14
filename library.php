<?php
   session_start();

   if (isset($_SESSION['username'])){
	$username = $_SESSION['username'];
   }

   $SERVER = 'cs4750.cs.virginia.edu';
   $ADMIN_UN = 'reg3dq_a';
   $USER_UN = 'reg3dq_b';
   $PASSWORD = 'Databases2019';
   $DATABASE = 'reg3dq';

   $conn = new mysqli($SERVER, $USER_UN, $PASSWORD, $DATABASE);
	 if (mysqli_connect_error()) {
        die('Connect Error ('. mysqli_connect_errno() .')'. mysqli_connect_error()); 
    } else {
	$sql = "SELECT * FROM user_role NATURAL JOIN roles NATURAL JOIN role_perm NATURAL JOIN permissions WHERE username = '$username'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0){
		while ($row=$result->fetch_assoc()){
			if ($row['role_id'] == '2'){
				mysqli_close($conn);
				$conn = new mysqli($SERVER, $ADMIN_UN, $PASSWORD, $DATABASE);
				
			}
		}
	}
}

?>
