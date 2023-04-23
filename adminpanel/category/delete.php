<?php

    session_start();
    if(isset($_SESSION['login']) && $_SESSION['login'] == true){

        // Database Connection
        require('../config.php');
        
        if(isset($_GET["id"])){
            $id = $_GET["id"];
            $sql = mysqli_query($db,"DELETE FROM `categories` WHERE id=$id");
        }
        header("location: category.php");
        exit;
    }
	else{
		header("Location: ../../login.php");
	}
?>