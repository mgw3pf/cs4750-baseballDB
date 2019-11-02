<?php
$SERVER = 'cs4750.cs.virginia.edu';
$USERNAME = 'reg3dq';
$PASSWORD = 'Databases2019';
$DATABASE = 'reg3dq';
// include_once("library.php")
$firstname = filter_input(INPUT_POST, 'firstname');
if (!empty($firstname)) {
    // Create Connection
    $conn = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);

    if (mysqli_connect_error()) {
        die('Connect Error ('. mysqli_connect_errno() .')'. mysqli_connect_error()); 
    } else {
        $sql = "SELECT * FROM Players WHERE namefirst = '$firstname'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo $row["nameFirst"] . " " . $row["nameLast"] . "<br>";
            }
        } else {
            echo "No Results found!";
        }
        $conn->close();
    }
} else {
    echo "Please enter a First Name!";
    die();
}

?>