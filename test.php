<?php

include_once("library.php")
$firstname = filter_input(INPUT_POST, 'firstname')
if (!empty($firstname)) {
    // Create Connection
    $conn = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);

    if (mysqli_connect_error()) {
        die('Connect Error ('. mysqli_connect_errno() .')'. mysqli_connect_error()); 
    } else {
        $sql = "SELECT * FROM Players WHERE namefirst = '$firstname'";
        if ($conn->query($sql)) {
            echo "A ha ha!";
        } else {
            echo "Error: ". $sql ."<br>". $conn->error;
        }
        $conn->close();
    }
} else {
    echo "Please enter a First Name!";
    die();
}

?>