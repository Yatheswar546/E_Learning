<?php

	header("Pragma: no-cache");
	header("Cache-Control: no-cache");
	header("Expires: 0");

	session_start();
	// if(isset($_SESSION['admin']) && $_SESSION['admin'] == 'admin' && isset($_SESSION['farmer_id']))
	// Database Connection
    require_once('./config.php');
    
    // Check Connection
    if(!$conn){
        die("Connection Failed".mysqli_connect_error());
    }
    else{
        // echo "Connection Successful";
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
      // GET Method : Show the Data
      if(!isset($_GET["id"])){
          header("location: index.php");
          exit;
      }

      $id = $_GET["id"];
      // Read the Data
      $result = mysqli_query($conn,"SELECT * FROM `courses` WHERE id=$id");
      $row = $result->fetch_assoc();

      if(!$row){
          header("Location: index.php");
          exit;
      }

      $title = $row['title'];
      $description = $row['description'];
      $price = $row['price'];
      $image = $row['image'];
      $courseid = $row['courseid'];
      $type = $row['type'];
  }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">

<head>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Page</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/singlecourse.css">
    
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
       
      <section id="about-home">
          <h2>Enroll Our Popular Courses and skill up</h2>
      </section>

      <section id="course-inner">
          <div class="overview">
              <img class="course-img" src="./adminpanel/database/courses/<?php echo $row['image']; ?>" alt='image'>
              <!-- <img class="course-img" src="./images/c1.jpg" alt=""> -->
              <div class="course-head">
                  <div class="c-name">
                        <h2><?php echo $title; ?></h2>
                        <div class="star">
                            <i class='bx bxs-star'></i> 
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star-half'></i>
                            <i class='bx bx-star'></i>
                        </div>
                        <p><?php echo $description; ?></p>
                  </div>
                  <span><?php echo $price; ?></span>
              </div>
              <h3>Instructor</h3>
              <div class="tutor">
                  <img src="./adminpanel/database/courses/<?php echo $row['image']; ?>" alt="">
                  <div class="tutor-det">
                      <h5>John Doe</h5>
                      <p>Web Developer at Amazon</p>
                  </div>
              </div>
              <hr>
              <h3>Course Overview</h3>
              <p>
                <?php echo $description; ?>
                Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.

                The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.
              </p>
              <hr>
              <h3>What you'll Learn</h3>
              <div class="learn">
                  <p><i class='bx bxs-check-circle'></i><?php echo $title; ?> from scratch -begineer to advanced</p>
                  <p><i class='bx bxs-check-circle'></i><?php echo $title; ?> from scratch -begineer to advanced</p>
                  <p><i class='bx bxs-check-circle'></i><?php echo $title; ?> from scratch -begineer to advanced</p>
                  <p><i class='bx bxs-check-circle'></i><?php echo $title; ?> from scratch -begineer to advanced</p>
                  <p><i class='bx bxs-check-circle'></i><?php echo $title; ?> from scratch -begineer to advanced</p>
                  <p><i class='bx bxs-check-circle'></i><?php echo $title; ?> from scratch -begineer to advanced</p>
                  
              </div>

          </div>

          <div class="enroll">
            <h3>This course include:</h3>
            <p><i class='bx bxs-video-recording'></i></i>52 hours video</p>
            <p><i class='bx bxs-paper-plane'></i>75 articles</p>
            <p><i class='bx bx-cloud-download'></i>Download resources</p> 
            <p><i class='bx bx-infinite'></i>Full lifetime access</p>
            <p><i class='bx bx-mobile-alt'></i>Access on mobile and TV</p>
            <p><i class='bx bx-paperclip'></i>Assignment</p>
            <p><i class='bx bx-trophy'></i>Certificate of Completion</p>
                  
            <form method="post" action="pgRedirect.php">
              <div class="enroll-btn">
                <input type="submit" value="Proceed to Payment" class="blue" id ="logon" onclick=""> 
              </div>
            </form>
          </div>
      </section>

      <footer>
        <div class="row">
          <div class="col">
            <img src="./images/logo.png" alt="" class="logo">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, voluptates quos! Sequi repellendus neque cum minus eos consequatur saepe provident recusandae animi quidem? Non libero pariatur saepe perferendis mollitia possimus.</p>
          </div>
          <div class="col">
            <h3>office <div class="underline"><span></span></div></h3>
            <p>Kurmannapalem</p>
            <p>Visakhapatnam</p>
            <p>Andhra Pradesh, 530046</p>
            <p class="email-id">e-learning@gmail.com</p>
            <h4>+91 - 0123456789</h4>
          </div>
          <div class="col">
            <h3>Links <div class="underline"><span></span></div></h3>
            <ul>
              <li><a href="./index.php#home">Home</a></li>
              <li><a href="./index.php#trending">Trending</a></li>
              <li><a href="./index.php#categories">Category</a></li>
              <li><a href="./index.php#courses">Courses</a></li>
              <li><a href="./index.php#faq">FAQ</a></li>
              <li><a href="./index.php#contact">Contact</a></li>
            </ul>
          </div>
          <div class="col">
            <h3>Newsletter <div class="underline"><span></span></div></h3>
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