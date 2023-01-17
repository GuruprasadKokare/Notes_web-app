<?php
    include 'config.php';
    if(!empty($_SESSION["id"])){
        $id = $_SESSION["id"];
        $query = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
        $row = mysqli_fetch_assoc($query);
    }else{
        header("Location: index.php");
    }
?>   

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Notes</title>

        <!-- CSS only -->
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="navbarstyle.css">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    </head>

    <body class="bg-light">
        <!-- Navbar -->
        <nav class="nav_bar  raw">
            <div class="col-3 box-1 ">
                <a href="index.php" class="logo">Notes<p>.</p></a>
            </div>

            <div class="col-8 box-2 " style="font-size: 18px;">
                Hello,  <p class="user-name"> <?php echo $row["name"]; ?> </p>

                <a href="logout.php" class="logout-btn">
                    <i class="fa-solid fa-power-off"></i>
                    <!-- <i class="fa-solid fa-arrow-right-from-bracket"></i> -->
                </a>
            </div>
        </nav>
        <!-- Navbar -->

        <div class="raw  search-bar">
            <div class="col-8 search-box  ">
                <input type="text" name="search" placeholder="Search" class="search" id="searchbar" onkeyup="search_function()">
                <button class="search-btn "> <i class="fa-sharp fa-solid fa-magnifying-glass"></i> </button>
            </div>
            <div class="col-4 " style="padding: 5px 10% 1px 18%;">
                <button type="button" name="add-note" data-bs-toggle="modal" data-bs-target="#insertModal" class="addnote"> <i class="fa-sharp fa-solid fa-plus"></i> </button>
            </div>
        </div>
        <!-- Search bar -->


        <!-- Add Note Modal -->
        <div class="modal fade" id="insertModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form method="POST" action="code.php" autocomplete="off">
                        <input type="hidden" name="username" value="<?php echo $row["email"]; ?>">
                        <input type="text" name="title" placeholder="Add Title" class="inp"> <br>
                        <br>
                        <textarea id="textarea" name="description" rows="8" cols="47" placeholder="Add Description"></textarea>
                        <br>
                        <br>
                        <button type="submit" name="add-note" class="btn btn-primary" style="background: #972DD9; border: none; float: right; margin-right: 10%;">Add Note</button> 
                    </form>
                </div>
                
            </div>
            </div>
        </div>
        <!-- Add Note Modal-->


        <!-- Notes card -->
            <div class="cards">

                <?php
                    $user = $row["email"];
                    $select_query = "SELECT * FROM notes WHERE user = '$user'";
                    $result = mysqli_query($conn, $select_query);

                    if(mysqli_num_rows($result) > 0)
                    {
                        while ($row1 = mysqli_fetch_array($result))
                        {
                            ?>
                            <div class="card">
                                <p hidden class="note_id"><?php echo $row1['id']; ?></p>  <!-- ID of the Note -->
                                
                                <p class="ctitle"> <?php echo $row1['title']; ?> </p>
                                <p class="card-data"> <?php echo $row1['description']; ?></p>
                                <p class="card-date"> <?php echo $row1['date']; ?> </p>
                                
                                <p hidden><?php echo $row1['user']; ?></p>  <!-- Email of the User -->

                                <a class="view" data-bs-toggle="modal" data-bs-target="#displaycardmodal"><i class="fa-solid fa-eye"></i></a>
                                <a class="edit" ><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="" class="delete"><i class="fa-solid fa-trash"></i></a>
                            </div>
                            <?php
                        }
                    }
                    else{
                        echo "<h5>No Records Found...!</h5>";
                    }
                	?>
            </div>

        <!-- Notes card -->


        <!-- Card Display Modal -->
        <div class="modal fade" id="displaycardmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="max-height: 350px;">
               
            <div class="modal-body body-modal b-s-modal" id="data-details" >
                    <button type="button" class="btn-close btn-c" data-bs-dismiss="modal" aria-label="Close" style="float: right;"></button>
                    
                    <div class="display_data">
                        <!---- Card Data is Displayed ---->
                    </div>
                
                </div>
               
                </div>
                
            </div>
            </div>
        </div>
        <!-- Card Display Modal -->


        <!--- Edit Note Modal --->
        <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form method="POST" action="code.php" autocomplete="off">
                        <input type="hidden" id="n_id" name="n_id">
                        <input type="text" name="n_title" class="inp" id="edit_title" value=""> <br>
                        
                        <br>
                        <textarea class="edit-textarea" id="edit_description" name="n_description" rows="8" cols="47"></textarea>
                        <br>
                        <br>
                        
                        <input type="hidden" name="n_date" id="edit_date">
                        <input type="hidden" name="n_user" id="n_user">
                        
                        <button type="submit" name="update-note" class="btn btn-primary" style="background: #972DD9; border: none; float: right; margin-right: 10%;">Update Note</button> 
                    </form>
                </div>
                
            </div>
            </div>
        </div>
        <!--- Edit Note Modal --->


        <!--- Delete Note Modal --->
        <div class="modal fade" id="deletemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="border: none;">
                
                <h1 class="modal-title title-modal" id="modal-title">  </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="code.php" method="POST">
                    <div class="modal-body body-modal" id="data-details">
                        <input type="hidden" name="note_id" id="delete_note">
                        <h4 class="delete-text">Are Your Sure You Want to Delete the Note ?</h4>
                    </div>
                    <div class="modal-footer" style="border: none;">
                        <button type="submit" name="delete-note" class="btn btn-primary delete-btn">YES..! Delete</button>
                    </div>
                </form>

            </div>
            </div>
        </div>
        <!--- Delete Note Modal --->


        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

        <!-- JQuery Link -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
       
        <script>

            //Search Bar Code
            function search_function(){
                var input, filter;
                input = document.getElementById("searchbar");
                filter = input.value.toUpperCase();
                cards = document.getElementsByClassName("card")
                titles = document.getElementsByClassName("card-data");

                // Loop through all list items, and hide those who don't match the search query
                for (i = 0; i < cards.length; i++) {
                    a = titles[i];
                    if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        cards[i].style.display = "";
                    } else {
                        cards[i].style.display = "none";
                    }
                }
            }

            $(document).ready(function (){

                //-- Display card data in Modal --//
                $('.view').click(function (e){
                    e.preventDefault();

                    var note_id = $(this).closest('.card').find('.note_id').text();
                    //console.log(note_id);
                    
                    $.ajax({
                        type: "POST",
                        url: "code.php",
                        data: {
                            'checking_view': true,
                            'NOTE_ID': note_id,
                        },
                        success: function (response) {
                            $('.display_data').html(response);
                            $('#displaycardmodal').modal('show');
                        }
                    });
                });


                //-- Edit Note Modal --//
                $('.edit').click(function (e){
                    e.preventDefault();

                    var note_id = $(this).closest('.card').find('.note_id').text();
                    //console.log(note_id);
                    
                    $.ajax({
                        type: "POST",
                        url: "code.php",
                        data: {
                            'checking_edit': true,
                            'NOTE_ID': note_id,
                        },
                        success: function (response) {
                            $.each(response, function (key, value) {
                                $('#n_id').val(value['id']);  
                                $('#edit_title').val(value['title']);   //Here the 'title' is the column name 
                                $('#edit_description').val(value['description']); 
                                $('#edit_date').val(value['date']); 
                                $('#n_user').val(value['user']); 
                            });

                            $('#editmodal').modal('show');
                        }
                    });
                });

                //-- Delete Card --//
                $('.delete').click(function (e) { 
                    e.preventDefault();
                    var note_id = $(this).closest('.card').find('.note_id').text();
                    $('#delete_note').val(note_id);
                    $('#deletemodal').modal('show');
                });

            });
        </script>
    </body>
</html>
