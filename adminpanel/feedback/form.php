<?php
    $db = mysqli_connect('localhost','root','','e_learning');

    if(!$db){
        die("Connection Failed!!!".mysqli_connect_error());
    } 
    else{
        // echo "Hurray Connection Successful";
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];   

    $sql = mysqli_query($db,"INSERT INTO `feedbacks`(`name`, `email`, `phone`, `message`) VALUES ('$name','$email',' $phone','$message')");

    if(!$sql){
        $errormsg = "Invalid Query".mysqli_connect_error();
    }
    else{
        header("Location: ../../index.php");
        exit;
    }
?>