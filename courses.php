<?php 
  session_start();

  // Database Connection
	require('./config.php');
	
	// Check Connection
	if(!$conn){
		die("Connection Failed...".mysqli_connect_error());
	}
	else{
		// echo "Success";
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blogging</title>

  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/courses.css">

  <style>
    @media (max-width: 1023px){
      .container .box-container {
        grid-template-columns: repeat(2,1fr);
      }
    }


    @media (max-width: 768px){
      .container .box-container {
        /* margin-left: 10%; */
        justify-content: center;
        align-items: center;
        grid-template-columns: repeat(1,1fr);
      } 
    }
    
  </style>

</head>

<body>

  <!-- header -->
  <header class="sticky">
    <a href="#" class="logo">
      <img src="./images/logo.png" alt="">
    </a>
    <ul class="navbar">
      <li><a href="./index.php#home">Home</a></li>
      <li><a href="./index.php#trending">Trending</a></li>
      <li><a href="./index.php#categories">Categories</a></li>
      <li><a href="#">Courses</a></li>
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

  <!-- header -->

  <!-- home -->
  <!-- <section class="home1" id="home">
        <div class="home1-text container">
            <h2 class="home1-title">Development</h2>
            <span class="home1-subtitle">Build Now</span>
        </div> 
    </section> -->
  <!-- home -->
  <!-- post filter -->
  <div class="post-filter container">
    <!-- <span class="filter-item active-filter" data-filter="all">All</span>
        <span class="filter-item" data-filter="design">App Development</span>
        <span class="filter-item" data-filter="tech">Web Development</span>
        <span class="filter-item" data-filter="mobile">AI</span> -->
  </div>

  <!----------------------------- course -------------------------------------->
  <section class="free_course" id="courses">

    <div class="container">
      <h1 class="heading">COURSES</h1>

      <div class="box-container">

        <?php
          // read data from `courses` table
          $courses = mysqli_query($conn, "SELECT * FROM `courses`");
          if(!$courses){
            die("Invalid Query...".mysqli_connect_error());
          }
          else{
              while($row = mysqli_fetch_assoc($courses)){
                echo "
                  <div class='box'>
                    <div class='image'>
                      <img src='./adminpanel/database/courses/$row[image]' alt=''>
                    </div>
                    <div class='content'>
                      <h3>$row[title]</h3>
                      <p>$row[description]</p>
                      <a href='./singlecourse.php?id=$row[id]' class='btn'>read more</a>
                      <div class='icons'>
                        <span> <i class='fas fa-calendar'></i> $row[createdat] </span>
                        <span> <i class='fas fa-user'></i> By Admin </span>
                      </div>
                    </div>
                  </div>
                ";
              }
          }
        ?>
        <div class="box">
          <div class="image">
            <img src="images/2.jpg" alt="">
          </div>
          <div class="content">
            <h3>blog title goes here</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quod, adipisci!</p>
            <a href="./singlecourse.php" class="btn">read more</a>
            <div class="icons">
              <span> <i class="fas fa-calendar"></i> 21st may, 2022 </span>
              <span> <i class="fas fa-user"></i> by admin </span>
            </div>
          </div>
        </div>
      </div>

      <!-- <div id="load-more"> load more </div>
      <div id="load-less">load less</div> -->
    </div>
  </section>
  <!-- post filter -->

  <!-- footer -->

  <footer>
    <div class="row">
      <div class="col">
        <img src="./images/logo.png" alt="" class="logo">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, voluptates quos! Sequi repellendus
          neque cum minus eos consequatur saepe provident recusandae animi quidem? Non libero pariatur saepe perferendis
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
          <li><a href="">Home</a></li>
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


  <!-- /footer -->

  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>


  <script src="./js/script.js"></script>
  <script src="./js/ac.js"></script>
</body>

</html>