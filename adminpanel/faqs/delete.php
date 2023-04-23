<?php
    session_start();
	if(isset($_SESSION['login']) && $_SESSION['login'] == true){

    	// Database Connection
    	require('../config.php');
        
    	// Check Connection
    	if(!$db){
    		die("Connection Failed...".mysqli_connect_error());
    	}
    	else{
    		// echo "Success";
    	}
        if(isset($_GET["id"])){
            $id = $_GET["id"];
            $sql = mysqli_query($db,"DELETE FROM `faqs` WHERE id=$id");
        }
        header("location: faqs.php");
        exit;
    }
    else{
        header("Location: ../../login.php");
    }
?>