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
  <title>E-learning</title>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/css/swiper.min.css'>
  
  <!-- Font Awesome Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  
  <!-- Box Icons Link -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  
  <!-- Custom CSS --> 
  <link rel="stylesheet" href="./css/style.css">

</head>
 
<body>

  <!---------------------- header --------------------------------------------->
  <header class="sticky">
    <a href="#" class="logo">
      <img src="./images/logo.png" alt="">
    </a> 
    <ul class="navbar">
      <li><a href="#home">Home</a></li>
      <li><a href="#trending">Trending</a></li>
      <li><a href="#categories">Categories</a></li>
      <li><a href="#courses.php">Courses</a></li>
      <li><a href="#faq">FAQ</a></li>
      <li><a href="#contact">Contact</a></li>
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

  <!-------------------------- home ---------------------------------------------->
  <section class="home" id="home">
    <div class="home-text">
      <h6>Best online learning platform</h6>
      <h1>Accessible Online Courses For All</h1>
      <p>Own your future learning new skills online</p>
      <div class="latter">
        <form class="form1">
          <input type="email" placeholder="Write Your Email" required>
          <input type="submit" value="Let's Start" required>
        </form>
      </div>
    </div>
    <div class="home-img">
      <img src="./images/home.png" alt="">
    </div>
  </section>

  <!----------------------------- counting ----------------------------------->
  <div class="wrapper">
    <div class="container1">
      <i class='bx bx-clipboard'></i>
      <span class="num" data-val="160">000</span>
      <span class="text">Courses</span>
    </div>

    <div class="container1">
      <i class='bx bxs-graduation'></i>
      <span class="num" data-val="1000">000</span>
      <span class="text">Students</span>
    </div>

    <div class="container1">
      <i class='bx bxs-user'></i>
      <span class="num" data-val="70">000</span>
      <span class="text">Teachers</span>
    </div>

    <div class="container1">
      <i class='bx bxs-star'></i>
      <span class="num" data-val="100">000</span>
      <span class="text">Satisfaction</span>
    </div>

  </div>

  <!----------------------------- trending ---------------------------->
  <section class="trending" id="trending">
    <div class="title">
      <h1>TRENDING</h1>
    </div>
    <div class="trend">
      <div class="blog-slider">
        <div class="blog-slider__wrp swiper-wrapper">
          <div class="blog-slider__item swiper-slide">
            <div class="blog-slider__img">
              <img src="./images/1.jpeg" alt="">
            </div>
            <div class="blog-slider__content">
              <span class="blog-slider__code">08 February 2022</span>
              <div class="blog-slider__title">Lorem Ipsum Dolor</div>
              <div class="blog-slider__text">Lorem ipsum, dolor sit amet consectetur
                adipisicing elit. Eos esse vero cumque pariatur.</div>
              <a href="./singlecourse.php" class="blog-slider__button">READ MORE</a>
            </div>
          </div>

          <div class="blog-slider__item swiper-slide">
            <div class="blog-slider__img">
              <img src="./images/2.jpg" alt="">
            </div>
            <div class="blog-slider__content">
              <span class="blog-slider__code">08 February 2022</span>
              <div class="blog-slider__title">Lorem Ipsum Dolor</div>
              <div class="blog-slider__text">Lorem ipsum, dolor sit amet consectetur
                adipisicing elit. Eos esse vero cumque pariatur.</div>
              <a href="./singlecourse.php" class="blog-slider__button">READ MORE</a>
            </div>
          </div>
          <div class="blog-slider__item swiper-slide">
            <div class="blog-slider__img">
              <img src="./images/3.png" alt="">
            </div>
            <div class="blog-slider__content">
              <span class="blog-slider__code">08 February 2022</span>
              <div class="blog-slider__title">Lorem Ipsum Dolor</div>
              <div class="blog-slider__text">Lorem ipsum, dolor sit amet consectetur
                adipisicing elit. Eos esse vero cumque pariatur.</div>
              <a href="./singlecourse.php" class="blog-slider__button">READ MORE</a>
            </div>
          </div>
        </div>
        <div class="blog-slider__pagination"></div>
      </div>
    </div>
  </section>

  <!---------------------------- category ------------------------------------>
  <section class="category" id="categories">
    <div class="categories">
      <div class="title">
        <h1>CATEGORIES</h1>
      </div>
      <div class="container_cat">
      
        <?php
          // read data from `categories` table
          $categories = mysqli_query($conn, "SELECT * FROM `categories`");
          if(!$categories){
            die("Invalid Query...".mysqli_connect_error());
          }
          else{
              while($row = mysqli_fetch_assoc($categories)){
                echo "
                  <div class='card_cat'>
                    <div class='imgBx'>
                      <img src='./adminpanel/database/categories/$row[image]' alt=''>
                    </div>
                    <div class='content_cat'>
                      <h2>$row[title]</h2>
                      <p>$row[description]</p>
                    </div>
                  </div>
                ";
              }
          }
        ?>
      </div>
      <div id="load-More1"> Load More </div>
    </div>
  </section>

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

      <div id="load-more"> load more </div>
      <div id="load-less">load less</div>
    </div>
  </section>

  <!---------------------- teachers ----------------------------------------->
  <section id="teachers">
    <div class="faculty">
      <h2>Our Featured <span>Teachers</span></h2>
      <div class="flexBox">

        <?php
          // read data from `teachers` table
          // $teachers = mysqli_query($conn,"SELECT * FROM `teachers`");
          // if(!$teachers){
          //   die("Invalid Query...".mysqli_connect_error());
          // }
          // else{
          //   while($row = mysqli_fetch_assoc($teachers)){
          //     echo "
          //       <div class='teacher teacher1' data-name='$row[name]' data-field='$row[course]'></div>
          //     "; 
          //   }
          // }
        ?>

        <div class="teacher teacher1" data-name="Roshini" data-field="UI Expert"></div>
        <div class="teacher teacher2" data-name="Arun" data-field="Frontend Dev"></div>
        <div class="teacher teacher3" data-name="Kumari" data-field="Backend Dev"></div>
        <div class="teacher teacher4" data-name="Dileep" data-field="UX Specialist"></div>
      </div>
    </div>
  </section>

  <!----------------------------- testimonials ---------------------------->
  <section class="testimonials">
    <div class="container_testimonial">
      <div class="title">
        <h1>Testimonials</h1>
      </div>
      <div class="testimonial">
        <div class="testimonial-text">
          <div class="user-text">
            <i class="fas fa-quote-left"></i>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro odit magni vitae ipsam beatae ipsa earum,
              culpa qui animi dolorem, inventore facilis ipsum nobis laboriosam. Exercitationem doloremque enim
              molestias rem.</p>
            <span>JOHN RAYAN</span>
          </div>


          <div class="user-text active-text">
            <i class="fas fa-quote-left"></i>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro odit magni vitae ipsam beatae ipsa earum,
              culpa qui animi dolorem, inventore facilis ipsum nobis laboriosam. Exercitationem doloremque enim
              molestias rem.</p>
            <span>RIYANA THOMAS</span>
          </div>


          <div class="user-text">
            <i class="fas fa-quote-left"></i>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro odit magni vitae ipsam beatae ipsa earum,
              culpa qui animi dolorem, inventore facilis ipsum nobis laboriosam. Exercitationem doloremque enim
              molestias rem.</p>
            <span>JOSH HUESTON</span>
          </div>


          <div class="user-text">
            <i class="fas fa-quote-left"></i>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro odit magni vitae ipsam beatae ipsa earum,
              culpa qui animi dolorem, inventore facilis ipsum nobis laboriosam. Exercitationem doloremque enim
              molestias rem.</p>
            <span>AYAN MISHRA</span>
          </div>

          <div class="user-text">
            <i class="fas fa-quote-left"></i>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro odit magni vitae ipsam beatae ipsa earum,
              culpa qui animi dolorem, inventore facilis ipsum nobis laboriosam. Exercitationem doloremque enim
              molestias rem.</p>
            <span>RALPH DOBRE</span>
          </div>
        </div>
        <div class="testimonial-pic">
          <img src="./images/testimonials/1.jpg" class="user-pic" onclick="showReview()">
          <img src="./images/testimonials/2.jpg" class="user-pic active-pic" onclick="showReview()">
          <img src="./images/testimonials/3.jpg" class="user-pic" onclick="showReview()">
          <img src="./images/testimonials/4.jpg" class="user-pic" onclick="showReview()">
          <img src="./images/testimonials/5.jpg" class="user-pic" onclick="showReview()">
        </div>
      </div>
    </div>
  </section>

  <!------------------------- FAQ ------------------------------------>
  <section class="faq" id="faq">
    <div class="accordion">
      <div class="image-box">
        <img src="./images/faq.png" alt="Accordion Image">
      </div>
      <div class="accordion-text">
        <div class="title">FAQ</div>
        <ul class="faq-text">

          <?php 
            // read data from `faqs` table
            $faqs = mysqli_query($conn, "SELECT * FROM `faqs`");
            if(!$faqs){
              die("Invalid Query...".mysqli_connect_error());
            }
            else{
              while($row = mysqli_fetch_assoc($faqs)){
                echo"
                  <li>
                    <div class='question-arrow'>
                      <span class='question'>$row[que]</span>
                      <i class='bx bxs-chevron-down arrow'></i>
                    </div>
                    <p>$row[ans]</p>
                    <span class='line'></span>
                  </li>
                ";
              }
            }
          ?>
        </ul>
      </div>
    </div>


    <script>
      let li = document.querySelectorAll(".faq-text li");
      for (var i = 0; i < li.length; i++) {
        li[i].addEventListener("click", (e) => {
          let clickedLi;
          if (e.target.classList.contains("question-arrow")) {
            clickedLi = e.target.parentElement;
          } else {
            clickedLi = e.target.parentElement.parentElement;
          }
          clickedLi.classList.toggle("showAnswer");
        });
      }
    </script>
  </section>
  <!-- /FAQ -->

  <!--------------------------- feedback ---------------------------->
  <div class="feed-container" id="contact">
    <div class="contact-box">
      <div class="left">
        <img src="./images/Contact.png" alt="">
      </div>
      <div class="right">
        <h2>Contact Us</h2>
        <form action="./adminpanel/feedback/form.php" method="post" enctype="multipart/form-data">
          <input type="text" name="name" class="field" placeholder="Your Name">
          <input type="text" name="email" class="field" placeholder="Your Email">
          <input type="text" name="phone" class="field" placeholder="Your Phone">
          <textarea name="message" placeholder="Message" class="field"></textarea>
          <input type="submit" name="submit" id="submit" class="btn" value="Send">
        </form>
      </div>
    </div>
  </div>

  <!--------------------------------- footer -------------------------------->
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


  <!-- Tredning Section -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/js/swiper.min.js'></script>

  <!-- Free Courses Section --> 
  <script>

    let loadMoreBtn = document.querySelector('#load-more');
    let loadLessBtn = document.querySelector('#load-less');
    let currentItem = 3;
    loadLessBtn.style.display = 'none'

    loadMoreBtn.onclick = () => {
      let boxes = [...document.querySelectorAll('.container .box-container .box')];
      for (var i = currentItem; i < currentItem + 3; i++) {
        boxes[i].style.display = 'inline-block';
      }
      currentItem += 3; 

      if (currentItem >= boxes.length) {
        loadMoreBtn.style.display = 'none';
        loadLessBtn.style.display = 'block';
      }
    }
    loadLessBtn.onclick = () => {
      display = 'inline-block'
    }
  </script>

  <!-- Custom JS -->
  <script src="./js/script.js"></script>

</body>

</html>