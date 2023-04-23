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

        if(isset($_GET['id'])){
            $id = $_GET['id'];

            $sql = mysqli_query($db,"DELETE FROM `admins` WHERE id='$id'");
            if($sql){
                header("Location: admins.php");
            }
            else{
                die("Invalid Query".mysqli_connect_error());
            }
        }

	}
	else{
		header("Location: ../../login.php");
	}
?>