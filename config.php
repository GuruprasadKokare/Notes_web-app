<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "notes_db");

    /*For checking the connection
    if($conn){
        echo "Connection Successfull:)";
    } else{
        echo "Error...!";
    }*/
?>