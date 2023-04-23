<?php

    require 'config.php';

    if(isset($_POST['submit'])){
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $pass = md5($_POST['password']);
    
        $users = "SELECT * FROM user_form WHERE email = '$email' && password = '$pass'";
        $result = mysqli_query($conn, $users);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
 
            session_start();

            $_SESSION['login']='true';
            $_SESSION["id"] = $row["id"];
            $_SESSION["role"] = $row["role"];
            $_SESSION["userid"] = $row["userid"];
            header('location: index.php');
        }
        else{
            $admins = "SELECT * FROM `admins` WHERE email = '$email' && password = '$pass'";
            $result = mysqli_query($conn, $admins);
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);

                session_start();

                $_SESSION['login']='true';
                $_SESSION["id"] = $row["id"];
                $_SESSION["role"] = $row["role"];
                $_SESSION["image"] = $row["image"];
                header('location: ./adminpanel/admin.php');
            }
        }
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/login.css">

    <!-- Box Icons Link -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<header class="sticky">
    <a href="#" class="logo">
      <img src="./images/logo.png" alt="">  
    </a>
    <ul class="navbar">
      <li><a href="./index.php">Home</a></li>
      <li><a href="./index.php#trending">Trending</a></li>
      <li><a href="./index.php#categories">Categories</a></li>
      <li><a href="./all-courses.php">Courses</a></li>
      <li><a href="./index.php#faq">FAQ</a></li>
      <li><a href="./index.php#contact">Contact</a></li>
    </ul>
    <div class="header-icons">
      <!-- <a href="#"><i class='bx bxs-user'></i></a>
      <a href="#"><i class='bx bx-heart'></i></a>
      <a href="#"><i class='bx bx-cart'></i></a>
      <div class="bx bx-menu" id="menu-icon"></div> -->
    </div>
  </header>
    <div class="form-container">
        <form action="" method="post">
            <h3>Login Now</h3>
            
            <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
                };
            };
            ?>

            <input type="email"name="email" required placeholder="enter your email">
            <input type="password"name="password" required placeholder="enter your password">
            <input type="submit" name="submit" value="login now" class="form-btn">
            <p>don't have an account? <a href="register.php">register now</a></p>
        </form>
    </div>
</body>
</html>