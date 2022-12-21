<?php

include 'config.php';
    
if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $current_date = date("Y-m-d");
    $user = $_POST['username'];
}

$query = "INSERT INTO notes VALUES ('', '$title', '$desc', '$current_date', '$user')";
$result = mysqli_query($conn, $query);

if(!$result){
    echo "Error in storing records....";
}else{
    echo "Records saved successfullu:)";
    header("Location: index.php");
}

?>