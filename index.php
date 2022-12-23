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

            <div class="col-9 box-2 " style="font-size: 18px;">
                Hello,  <p> <?php echo $row["name"]; ?> </p>

                <a href="logout.php" class="logout-btn">
                    <i class="fa-solid fa-power-off"></i>
                    <!-- <i class="fa-solid fa-arrow-right-from-bracket"></i> -->
                </a>
            </div>
        </nav>
        <!-- Navbar -->

        <div class="raw  search-bar">
            <div class="col-8 search-box  ">
                <input type="text" name="search" placeholder="Search" class="search">
                <button class="search-btn "> <i class="fa-sharp fa-solid fa-magnifying-glass"></i> </button>
            </div>
            <div class="col-4 " style="padding: 5px 10% 1px 18%;">
                <button type="button" name="add-note" data-bs-toggle="modal" data-bs-target="#exampleModal" class="addnote"> <i class="fa-sharp fa-solid fa-plus"></i> </button>
            </div>
        </div>
        <!-- Search bar -->

        <!-- Add Note Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form method="POST" action="insert.php" autocomplete="off">
                        <input type="hidden" name="username" value="<?php echo $row["email"]; ?>">
                        <input type="text" name="title" placeholder="Add Title" class="inp"> <br>
                        <br>
                        <textarea id="textarea" name="description" rows="8" cols="47" placeholder="Add Description"></textarea>
                        <br>
                        <br>
                        <button type="submit" name="submit" class="btn btn-primary" style="background: #972DD9; border: none; float: right; margin-right: 10%;">Add Note</button> 
                    </form>
                </div>
                
            </div>
            </div>
        </div>
        <!-- Add Note Modal-->

        <!-- Notes card --
            <div class="cards">
                <div class="card" >
                    <h3>Title</h2>
                    <p class="card-data">Lorem ipsum dolor, sit ameit est tempora! Magni nobis, voluptatum assumenda ex error vitae quasi provident voluptate sapiente nihil tempora. Voluptatem, doloribus! Iusto, deserunt ullam? </p>
                    <p class="card-date">28/01/2022</p>
                </div>
            </div> -->
        <!-- Notes card -->

        <div class="cards">
            <?php
                $user = $row["email"];
                $sql_query = "SELECT * FROM notes WHERE user = '$user'";
                $result = $conn->query($sql_query);
            ?>
            <?php
                while ($row1 = $result->fetch_array()){ ?>
                    <div class="card">
                        <p class="ctitle"><?php echo $row1['title']?></p>
                        <i class="fa-regular fa-star fav"></i>
                        <p class="card-data"><?php echo $row1['description']?></p>
                        <p class="card-date"><?php echo $row1['date']?></p>

                        <a class="fa-solid fa-pen-to-square edit editbtn"></a>
                        <a class="fa-solid fa-trash delete"></a>
                    </div>
            <?php
                } 
            ?>
        </div> 
        

        <!-- Card modal bootstrap default -->
            <div class="modal fade" id="cardmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header" style="border: none;">
                    
                    <h1 class="modal-title title-modal" id="modal-title">  </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body body-modal" id="data-details">
                        
                    </div>
                    <div class="modal-footer" style="border: none;">
                    <p id="date">  </p>
                    </div>
                    
                </div>
                </div>
            </div>
        <!-- Card modal bootstrap default -->

        
        <!--- Edit Note Modal --->
        <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form method="POST" action="edit.php" autocomplete="off">
                        <input type="hidden" id="note_id" name="n_id">
                        <input type="text" name="n_title" class="inp" id="note_title" value=""> <br>
                        <br>
                        <textarea class="textarea" id="note_description" name="n_description" rows="8" cols="47"></textarea>
                        <br>
                        <br>
                        <input type="hidden" name="n_date" id="note_date">
                        <input type="hidden" name="n_user" id="note_user">
                        <button type="submit" name="update" class="btn btn-primary" style="background: #972DD9; border: none; float: right; margin-right: 10%;">Update Note</button> 
                    </form>
                </div>
                
            </div>
            </div>
        </div>
        <!--- Edit Note Modal --->
        

        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

        <!-- JQuery Link -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
        <script>
            
            //--------- Bootstrap Edit Modal Code -----------//
            $(document).ready(function(){
                $('.editbtn').on('click', function() {

                    $('#editmodal').modal('show');

                    $card = $(this).closest('.card');
                    var data = $card.children("p").map(function(){
                        return $(this).text();
                    }).get();

                    console.log(data);

                    $('#note_title').val(data[0]);
                    $('#note_description').val(data[1]);
                    $('#note_date').val(data[2]);
                    $('#note_user').val(data[3]);
                });
            });

        </script>
      
</body>

</html>