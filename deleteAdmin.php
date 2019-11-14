<?php
session_start();
if(!(isset($_SESSION['login']) && $_SESSION['login']!='')){
        header("Location: login.php");
}
$usernameToRemove = $_GET['id'];
$currentUser = $_SESSION['username'];
include_once("./library.php");
$sql = "SELECT * FROM user_role NATURAL JOIN roles NATURAL JOIN role_perm NATURAL JOIN permissions WHERE username = '$currentUser' AND perm_id = '3'";
$result = $conn->query($sql);   
if ($result->num_rows > 0){
  if (mysqli_connect_error()) {
      die('Connect Error ('. mysqli_connect_errno() .')'. mysqli_connect_error());
  } else {
        $sql = "UPDATE user_role SET role_id = 1 WHERE username = '$usernameToRemove'";
        if (mysqli_query($conn, $sql)){
                mysqli_close($conn);
                header("Location: admin.php");
                exit;
        }
        else{
                echo "Error updating admin permissions";
        }
}
}
else{
        header("Location: index.php");
}

?>
