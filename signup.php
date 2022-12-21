<?php
    include 'config.php';

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $duplicate = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
        if(mysqli_num_rows($duplicate) > 0){
            echo "<script> alert('Email Already Exist!'); </script>";
        } 
        else{
            $query = "INSERT INTO users VALUES ('', '$name', '$email', '$password')";
            mysqli_query($conn, $query);
            echo "<script> alert('Registration Successfull:)'); </script>";

            header("Location: login.php");
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- CSS Only -->
    <link rel="stylesheet" href="signupstyle.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
</head>
<body class="bg-light">
    <div class="ext-box raw">

        <!-- image_box -->
        <div class="col-lg-6 col-md-12 col-sm-12 col-12 box-1">
            <img src="./sourse/signup_logo_svg_animate.svg" alt="SignUp_Img" class="imeg" style="margin-top: 20px;">
        </div>

        <!-- form-box -->
        <div class="col-lg-6 col-md-12 col-sm-12 col-12 box-2">
            <h2 class="wel">Welcome!</h2>
            <p class="cret_ac">Create Account</p>

            <!--<form action="insert.php" class="form-box" method="post" onsubmit="return validate" name="signup_form">-->

            <form action="" class="form-box" method="post">
                <div class="form-items">
                <input type="text" class="input-box" name="name" placeholder="Name" required/>
                <input type="email" class="input-box" name="email" placeholder="Email" required/>
                <input type="password" class="input-box" id="password" name="password" placeholder="Password" 
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least 1 number and 1 uppercase and lowercase letter, and at least 6 or more characters"
                />
                <i class="bi bi-eye-slash" id="togglePassword"></i>

                <button type="submit" name="submit" class="butn">Create account</button>

            </div>
            </form>
            <p class="txt-below ">Already have account? <a href="./login.php"> Log in </a></p>
        </div>
    </div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="signup.js"></script>
</body>
</html>