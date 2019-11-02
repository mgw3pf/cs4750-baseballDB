<?php

    $SERVER = 'cs4750.cs.virginia.edu';
    $USERNAME = 'reg3dq';
    $PASSWORD = 'Databases2019';
    $DATABASE = 'reg3dq';
    //include_once("./library.php"); // To connect to the database
    $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
    // Check connection
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    // Form the SQL query (a SELECT query)
    $sql="SELECT * FROM People WHERE nameFirst='("$_POST[firstname]")'";
    if (!mysqli_query($con,$sql))
 
    {
        die('Error: ' . mysqli_error($con));
    }
 
    // echo "1 record added"; // Output to user
    mysqli_close($con);
?>