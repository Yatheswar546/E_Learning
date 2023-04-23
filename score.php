<?php

    session_start();

    if(isset($_SESSION['id']) && isset($_SESSION['userid'])){
        $userid = $_SESSION['userid'];

        // Database Connection
        require_once('./config.php');

        // Check Connection
    	if(!$conn){
    		die("Connection Failed...".mysqli_connect_error());
    	} 
    	else{
    		// echo "Success";
    	}

        $errormsg = "";

        if(isset($_GET["courseid"])){
            // GET Method : Show the Data
  
            $courseid = $_GET["courseid"]; 
            
            $sql = mysqli_query($conn,"SELECT * FROM `certificates` WHERE userid='$userid' AND courseid='$courseid'");
            
            if(mysqli_num_rows($sql)<1){
                header("location: quiz.php");
                exit;
            }

            $row = mysqli_fetch_assoc($sql);
            $result = $row['score'];
            $date = $row['time'];

            $user = mysqli_query($conn,"SELECT * FROM `user_form` WHERE userid='$userid'");
            $row1 = mysqli_fetch_assoc($user);
            $name = $row1['name'];
        }   

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/css/swiper.min.css'>

    <!-- Font Awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Box Icons Link -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/quiz.css">



</head>

<body>


    <!------------------------------------------- Header --------------------------------------->
    <header class="sticky">
        <a href="#" class="logo">
            <img src="./images/logo.png" alt="">
        </a>
        <ul class="navbar">
            <li><a href="./index.php#home">Home</a></li>
            <li><a href="./index.php#trending">Trending</a></li>
            <li><a href="./index.php#categories">Categories</a></li>
            <li><a href="./index.php#courses">Courses</a></li>
            <li><a href="./index.php#faq">FAQ</a></li>
            <li><a href="./index.php#contact">Contact</a></li>
        </ul>
        <div class="header-icons">
            <?php if(isset($_SESSION['role']) && $_SESSION['role'] == "user"): ?>
            <a href="./profile.php"><i class='bx bxs-user'></i></a>
            <a href="#"><i class='bx bx-heart'></i></a>
            <a href="#"><i class='bx bx-cart'></i></a>
            <a href="./logout.php" class="logout">Logout</a>
            <?php elseif(isset($_SESSION['role']) && $_SESSION['role'] == "admin"): ?>
            <a href="./adminpanel/admin.php" class="login">Admin</a>
            <?php else: ?>
            <a href="./login.php" class="login">Login</a>
            <?php endif; ?>
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    </header>
    
    <!---------------------------------------- SCORE --------------------------------------->
    <div class="score">
        <h3><?php echo $result ?>%</h3>
    </div>

    <!------------------------------------- CERTIFICATE ------------------------>
    <div class="cert-container">
        <div class="name">
            <h4><?php echo $name; ?></h4>
        </div>
        <div class="date">
            <h6><?php echo $date; ?></h6>
        </div>
        <img src="./images/certificate.jpg" alt="">
    </div>

    <!------------------------ footer ------------------------------------------->
    <footer style="position:relative; top: 1100px;">
        <div class="row">
            <div class="col">
                <img src="./images/logo.png" alt="" class="logo">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, voluptates quos! Sequi
                    repellendus
                    neque cum minus eos consequatur saepe provident recusandae animi quidem? Non libero pariatur saepe
                    perferendis
                    mollitia possimus.</p>
            </div>
            <div class="col">
                <h3>office <div class="underline"><span></span></div>
                </h3>
                <p>Kurmannapalem</p>
                <p>Visakhapatnam</p>
                <p>Andhra Pradesh, 530046</p>
                <p class="email-id">e-learning@gmail.com</p>
                <h4>+91 - 0123456789</h4>
            </div>
            <div class="col">
                <h3>Links <div class="underline"><span></span></div>
                </h3>
                <ul>
                    <li><a href="">Trending</a></li>
                    <li><a href="">Category</a></li>
                    <li><a href="">Free courses</a></li>
                    <li><a href="">Teachers</a></li>
                    <li><a href="">Testimonials</a></li>
                </ul>
            </div>
            <div class="col">
                <h3>Newsletter <div class="underline"><span></span></div>
                </h3>
                <form class="footer-form">
                    <i class="far fa-envelope"></i>
                    <input type="email" placeholder="Enter your email id" required>
                    <button type="submit"><i class="fas fa-arrow-right"></i></button>
                </form>
                <div class="social-icons">
                    <i class="fab fa-facebook-f"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-whatsapp"></i>
                    <i class="fab fa-pinterest"></i>
                </div>
            </div>
        </div>
        <hr>
        <p class="copyright">E-learning © 2023 - All Rights Reserved</p>
    </footer>

</body>

</html>

<?php
    }
    else{
        header('Location: index.php');
    }
?>
