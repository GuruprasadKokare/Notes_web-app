<?php
    include 'config.php';

    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
        $row = mysqli_fetch_assoc($result);

        if(mysqli_num_rows($result) > 0){
            if($password == $row["password"]){
                $_SESSION["login"] = true;
                $_SESSION["id"] = $row["id"];
                header("Location: index.php");
            }
            else{
                echo "<script> alert('Wrong Password!'); </script>";
            }
        } else{
            echo "<script> alert('User Not Registered'); </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>

    <!-- CSS Only -->
    <link rel="stylesheet" href="signupstyle.css">
    <link rel="stylesheet" href="loginstyle.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body class="bg-light">
    <div class="ext-box raw">

        <!-- image_box -->
        <div class="col-lg-6 col-md-12 col-sm-12 col-12 box-1">
            <img src="./sourse/mobile-login-animate.svg" alt="SignUp_Img" class="imeg">
        </div>

        <!-- form-box -->
        <div class="col-lg-6 col-md-12 col-sm-12 col-12 box-2">
            <h2 class="wel">Welcome Back!</h2>
            <p class="cret_ac">Login</p>

            <form action="" method="post" class="form-box">
                <div class="form-items">
                
                <input type="email" class="input-box" name="email" id="email" placeholder="Email" required values=""/>
                <input type="password" class="input-box" name="password" id="password" placeholder="Password" required values=""/>

                <button type="submit" name="submit" class="butn">Log in</button>

                
            </div>
            </form>
            <p class="txt-below ">New User? <a href="./signup.php"> Register Now </a></p>
        </div>
    </div>

    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>