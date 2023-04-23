<?php

    session_start(); 
    if(isset($_SESSION['login']) && $_SESSION['login'] == true){
        if(isset($_GET["id"])){
            $id = $_GET["id"];

             // Database Connection
        	require('../config.php');

            $sql = mysqli_query($db,"DELETE FROM `teachers` WHERE id=$id");
        }
        header("location: teachers.php");
        exit; 
    }
    else{
        header("location: ../../login.php");
    }
?>