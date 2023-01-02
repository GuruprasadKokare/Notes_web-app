<?php

    include 'config.php';

    //---- Insert Data into Database----//
    if(isset($_POST['add-note']))
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $date = date("Y-m-d");
        $user = $_POST['username'];

        $query = "INSERT INTO notes VALUES ('', '$title', '$description', '$date', '$user')";
        $query_run = mysqli_query($conn, $query);

        if($query_run){
            header('Location: index.php');
        }else{
            echo "Error in Adding Note...!";
            header('Location: index.php');
        }
    }


    //---- Display Data In Modal ----//
    if(isset($_POST['checking_view']))
    {
        $note_id = $_POST['NOTE_ID'];

        $select_query = "SELECT * FROM notes WHERE id = '$note_id'";
        $result = mysqli_query($conn, $select_query);

        if(mysqli_num_rows($result) > 0){
            while($row1 = mysqli_fetch_array($result))
            {
                echo $return = "
                    <h3 hidden>$row1[id]</h3>
                    <h2>$row1[title]</h2>
                    <p>$row1[description]</p>
                    <h3>$row1[date]</h3>
                    <h3 hidden>$row1[user]</h3>
                ";
            }
        }
        else{
            echo $return = "<h5>No Records Found...!</h5>";
        }
    }


    //---- Edit Data Modal ----//
    if(isset($_POST['checking_edit']))
    {
        $note_id = $_POST['NOTE_ID'];
        $result_array = [];

        $select_query = "SELECT * FROM notes WHERE id = '$note_id'";
        $result = mysqli_query($conn, $select_query);

        if(mysqli_num_rows($result) > 0){
            while($row1 = mysqli_fetch_array($result))
            {
                array_push($result_array, $row1);
                header('Content-type: application/json');
                echo json_encode($result_array);
            }
        }
        else{
            echo $return = "<h5>No Records Found...!</h5>";
        }
    }

    if(isset($_POST['update-note']))
    {
        $id = $_POST['n_id'];
        $title = $_POST['n_title'];
        $description = $_POST['n_description'];
        $date = date("Y-m-d");
        $user = $_POST['n_user'];

        $update_query = "UPDATE notes SET title = '$title', description = '$description', date = '$date' WHERE id = '$id'";
        $result = mysqli_query($conn, $update_query);

        if($result)
        {
            header('Location: index.php');
        }else{
            echo "Error in Updating Record...!";
        }
    }


    //---- Delete Note ----//
    if(isset($_POST['delete-note']))
    {
        $id = $_POST['note_id'];

        $delete_query = "DELETE FROM notes WHERE id = '$id'";
        $result = mysqli_query($conn, $delete_query);

        if($result)
        {
            header('Location: index.php');
        }else {
            echo "Error in Deleting Record...!";
        }
    }
?>