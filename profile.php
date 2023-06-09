<?php
  session_start();
  if(isset($_SESSION['id'])){
  
    $id = $_SESSION['id'];
    $userid = $_SESSION['userid'];
    // echo $userid;
  // Database Connection
	require('./config.php');
	
	// Check Connection
	if(!$conn){
		die("Connection Failed...".mysqli_connect_error());
	}
	else{
		// echo "Success";
	}

  
  $sql = mysqli_query($conn,"SELECT * from user_form WHERE id = '$id'");
  $row = mysqli_fetch_assoc($sql);
  $name = $row['name'];
  $email = $row['email'];

  $details = mysqli_query($conn,"SELECT * FROM `profile` WHERE profile_id='$userid'");
  if($details === false) {
    // Handle the error, e.g. log it, display an error message, etc.
    echo "Error: " . mysqli_error($conn);
  }
  elseif(mysqli_num_rows($details)>0){
    $row1 = mysqli_fetch_assoc($details);
    $city = $row1['city'];
    $country = $row1['country'];
    $college = $row1['college'];
    $fname = $row1['fname'];
    $lname = $row1['lname'];
    $branch = $row1['branch'];
    $address = $row1['address'];
    $postal = $row1['postal_code'];
    $about = $row1['about'];
    $image = $row1['image'];
  }
  else{
    $city = "";
    $country = "";
    $college = "";
    $fname = "";
    $lname = "";
    $branch = "";
    $address = "";
    $postal = "";
    $about = "";
    $image = "";
  }
    
?>


<!DOCTYPE html>
<html lang="en">
 
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="./css/profile.css">
</head>

<body>

  <!--------------------------------MAIN CONTENT -------------------------------------------------->
  <div class="main-content">
    <!------------------------------------ Top navbar -------------------------------------->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!--------------------------------- Brand ------------------------------->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="">User profile</a>
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="./index.php" style="margin-left:10px;">Back to Home</a>
        <!------------------------ Form ---------------------------->
        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
          <div class="form-group mb-0">
            <div class="input-group input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
              <input class="form-control" placeholder="Search" type="text">
            </div>
          </div>
        </form>
        <!------------------------- User ----------------------->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">
              <div class="media align-items-center">
                <?php if(isset($image)): ?>
                  <span class="avatar avatar-sm rounded-circle">
                    <?php echo "<img src='./images/db_images/{$image}'>"; ?>
                  </span>
                <?php elseif(!isset($image)): ?>
                  <span class="avatar avatar-sm rounded-circle">
                    <img src="./images/pp.png" alt="">
                  </span>
                <?php endif; ?>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"><?php echo $name; ?></span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <a href="../examples/profile.html" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>My profile</span>
              </a>
              <a href="../examples/profile.html" class="dropdown-item">
                <i class="ni ni-settings-gear-65"></i>
                <span>Settings</span>
              </a>
              <a href="../examples/profile.html" class="dropdown-item">
                <i class="ni ni-calendar-grid-58"></i>
                <span>Activity</span>
              </a>
              <a href="../examples/profile.html" class="dropdown-item">
                <i class="ni ni-support-16"></i>
                <span>Support</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#!" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>

    <!------------------------------- Header ------------------------------------->
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center"
      style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg'); background-position-y: 50%;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h1 class="display-2 text-white">Hello <?php echo $name; ?></h1>
            <p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've made with your
              work and manage your projects or assigned tasks</p>
            <a href="./profile_update.php" class="btn btn-info">Edit profile</a>
          </div>
        </div>
      </div>
    </div>

    <!----------------------------------- Page content ---------------------------->
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <?php if(isset($image)): ?>
                  <a href="#">
                    <?php echo "<img src='./images/db_images/{$image}'>"; ?>
                  </a>
                  <?php else: ?>
                  <a href="#">
                    <img src="./images/pp.png" alt="">
                  </a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <div class="d-flex justify-content-between">
                <a href="#courses" class="btn btn-sm btn-info mr-4">Courses</a>
                <a href="#" class="btn btn-sm btn-default float-right">Certificates</a>
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                    <div>
                      <span class="heading">5</span>
                      <span class="description">Courses</span>
                    </div>
                    <div>
                      <span class="heading">3</span>
                      <span class="description">Certificates</span>
                    </div>
                    <div>
                      <span class="heading">8</span>
                      <span class="description">Saved Courses</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <h3>
                <h3><?php echo $name; ?></h3><span class="font-weight-light"></span>
                </h3>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i><?php echo $city ?> , <?php echo $country; ?>
                </div>
                <div class="h5 mt-4">
                  <i class="ni branch_briefcase-24 mr-2"></i><?php echo $branch; ?>
                </div>
                <div>
                  <i class="ni education_hat mr-2"></i><h3><?php echo $college; ?></h3>
                </div>
                <hr class="my-4">
                <p>About technical skills.</p>
                <a href="#">Show more</a>
              </div>
            </div>
          </div>
          <div class="certificates">
            <h1 class="heading">Certificates</h1>
            <img src="./images/profile_certificate.png" alt="">
            <a href="#" class="btn btn-info btn-sm ">See all</a>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">My account</h3>
                </div>
                <div class="col-4 text-right">
                  <a href="#!" class="btn btn-sm btn-primary">Settings</a>
                </div>
              </div>
            </div>

            <!-- User Information -->
            <div class="card-body">
              <form>
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-username">Username</label>
                        <h4><?php echo $name; ?></h4>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email address</label>
                        <h4><?php echo $email; ?></h4>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">First name</label>
                        <h4><?php echo $fname; ?></h4>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-last-name">Last name</label>
                        <h4><?php echo $lname; ?></h4>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-branch">Branch</label>
                        <h4><?php echo $branch; ?></h4>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">College</label>
                        <h4><?php echo $college; ?></h4>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4">
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Contact information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-address">Address</label>
                        <h4><?php echo $address; ?></h4>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-city">City</label>
                        <h4><?php echo $city; ?></h4>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-country">Country</label>
                        <h4><?php echo $country; ?></h4>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Postal code</label>
                        <h4><?php echo $postal; ?></h4>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4">
                <!-- Description -->
                <h6 class="heading-small text-muted mb-4">About me</h6>
                <div class="pl-lg-4">
                  <div class="form-group focused">
                    <label>About Me</label>
                    <h4><?php echo $about; ?></h4>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--------------------------------- courses ----------------------------------------------------->
  <section class="courses" id="courses">

    <div class="container">

      <h1 class="heading">COURSES</h1>

      <div class="box-container">

        <?php
          $courses = mysqli_query($conn,"SELECT enrollment.*, courses.*
          FROM enrollment
          JOIN courses ON enrollment.courseid = courses.courseid
          WHERE enrollment.userid = '$userid'");

          // $count = mysqli_num_rows($courses);
          if(mysqli_num_rows($courses)>0){
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
              ";
            }
          }
          else{
            echo "No courses Enrolled !!!";
          }

        ?>

        <!-- <div class="box">
          <div class="image">
            <img src="images/1.jpeg" alt="">
          </div>
          <div class="content">
            <h3>blog title goes here</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quod, adipisci!</p>
            <a href="#" class="btn">read more</a>
            <div class="icons">
              <span> <i class="fas fa-calendar"></i> 21st may, 2022 </span>
              <span> <i class="fas fa-user"></i> by admin </span>
            </div>
          </div>
        </div>

        <div class="box">
          <div class="image">
            <img src="images/2.jpg" alt="">
          </div>
          <div class="content">
            <h3>blog title goes here</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quod, adipisci!</p>
            <a href="#" class="btn">read more</a>
            <div class="icons">
              <span> <i class="fas fa-calendar"></i> 21st may, 2022 </span>
              <span> <i class="fas fa-user"></i> by admin </span>
            </div>
          </div>
        </div>

        <div class="box">
          <div class="image">
            <img src="images/3.png" alt="">
          </div>
          <div class="content">
            <h3>blog title goes here</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quod, adipisci!</p>
            <a href="#" class="btn">read more</a>
            <div class="icons">
              <span> <i class="fas fa-calendar"></i> 21st may, 2022 </span>
              <span> <i class="fas fa-user"></i> by admin </span>
            </div>
          </div>
        </div> -->



      </div>

    </div>
  </section>

  <!------------------------------ footer -------------------------------------------->
  <footer class="footer">
    <div class="row align-items-center justify-content-xl-between">
      <div class="col-xl-6 m-auto text-center">
        <div class="copyright">
          <p>Credentials</p>
        </div>
      </div>
    </div>
  </footer>
</body>

</html>

<?php

  }
  else{
    header('Location: index.php');
  }

?>