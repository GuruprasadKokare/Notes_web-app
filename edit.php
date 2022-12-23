<?php 
    include 'config.php';

    if(isset($_POST['update'])){
        $id = $_POST['n_id'];
        $title = $_POST['n_title'];
        $description = $_POST['n_description'];
        $date = date("d-m-Y");

        $update_query = "UPDATE notes SET title = '$title', description ='$description' date = '$date' WHERE id = '$id'";
        $update_result = mysqli_query($conn, $update_query);

        if($update_result){
            echo '<script>alert("Data Updated Successfully...");</script>';
            header("Location: index.php");
        } else{
            echo '<script>alert("Error in Updating Record...!");</script>';
        }
    }
?>