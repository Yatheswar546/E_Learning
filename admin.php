<?php

require 'config.php';

if(!isset($_SESSION['admin_name'])){
    header('location:login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <div class="container">
        <div class="content">
            <h3>hi, <span>admin</span></h3>
            <h1>Welcome <span><?php echo $row['name']?></span></h1>
            <p>this is an admin page</p>
            <a href="login.php" class="btn">login</a>
            <a href="register.php" class="btn">register</a>
            <a href="logout.php" class="btn">logout</a>
        </div>
    </div>
</body>
</html>
