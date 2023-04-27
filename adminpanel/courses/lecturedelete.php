<?php

    session_start();
    if(isset($_SESSION['login']) && $_SESSION['login'] == true){

        // Database Connection
        require('../config.php');
        
        if(isset($_GET["id"])){
            $id = $_GET["id"];
            $sql = mysqli_query($db,
            "UPDATE courses
            SET video = NULL
            WHERE id = $id;");
        }
        header("location: courses.php");
        exit;
    }
	else{
		header("Location: ../../login.php");
	}
?>