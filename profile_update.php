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

  if(isset($_SESSION['id']) && isset($_SESSION['userid'])){ 
    $id = $_SESSION['id'];
    $sql = mysqli_query($conn,"SELECT * from user_form WHERE id = '$id'");
    $row = mysqli_fetch_assoc($sql);
    $name = $row['name'];
    $email = $row['email'];
    $profileid = $_SESSION['userid'];

    $fname = "";
    $lname = "";
    $branch = "";
    $college = "";
    $address = "";
    $city = "";
    $country = "";
    $postal_code = "";
    $about = "";
    $file = "";

    $errormsg = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $branch = $_POST['branch'];
        $college = $_POST['college'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $postal_code = $_POST['postal'];
        $about = $_POST['about'];
        $target = "./images/db_images/";
        $filename = $_FILES['image']['name'];
        $filetype = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION)); // filetype
        $target_file = $target.basename(md5("fname".$_FILES['image']['name']).".".$filetype); //target path
        $file = md5("fname".$_FILES['image']['name']).".".$filetype; // file created

        do{
            if( empty($fname) || empty($lname) || empty($branch) || empty($college) || empty($address) || empty($city) || empty($country) || empty($postal_code) || empty($about)){
                $errormsg = "All Fields are required !!!";
                break;
            }
            else{
                if($filetype == "png" || $filetype == "jpg" || $filetype == "jpeg"){
                    if(move_uploaded_file($_FILES['image']['tmp_name'],$target_file)){
                        $sql = mysqli_query($conn,"INSERT INTO `profile`(`fname`, `lname`, `branch`, `college`, `address`, `city`, `country`, `postal_code`, `about`, `image`, `profile_id`) VALUES ('$fname','$lname','$branch','$college','$address','$city','$country','$postal_code','$about','$file','$profileid')");
                        if($sql){
                            header("Location: profile.php");
                            exit;
                        }
                        else{
                            $errormsg = "Something went wrong";
                        }
                    }
                    else{
                        $errormsg = "Image not moved";
                    }
                }
                else{
                    $errormsg = "Image not accepted";
                }
            }
        }while(false);
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="./css/profile.css">
</head>

<body>
    <div class="main-content">
        
        <!-------------------------------------- Top navbar ---------------------------------->
        <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
            <div class="container-fluid">
                <!-- Brand -->
                <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="">User profile</a>
                <!-- Form -->
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
                <!-- User -->
                <ul class="navbar-nav align-items-center d-none d-md-flex">
                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <div class="media align-items-center">
                                <span class="avatar avatar-sm rounded-circle">
                                    <img alt="Image placeholder" src="./images/pp.png">
                                </span>
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

        <!----------------------------------- Header -------------------------------->
        <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center"
            style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg'); background-position-y: 50%;">
            <!-- Mask -->
            <span class="mask bg-gradient-default opacity-8"></span>
            <!-- Header container -->
            <div class="container-fluid d-flex align-items-center">
                <div class="row">
                    <div class="col-lg-7 col-md-10">
                        <h1 class="display-2 text-white">Hello <?php echo $name; ?></h1>
                        <p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've made
                            with your
                            work and manage your projects or assigned tasks</p>
                        <!-- <a href="#!" class="btn btn-info">Edit profile</a> -->
                    </div>
                </div>
            </div>
        </div>

        <!--------------------------- Page content ---------------------------------->
        <div class="container-fluid mt--7">
            <div class="row">
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

                        <!------------------------------ FORM --------------------------------------->
                        <div class="card-body">
                            <?php 
                                if(!empty($errormsg)){
                                    echo "
                                        <div class='error_msg'>
                                            <strong>$errormsg</strong>
                                        </div>
                                    ";
                                }
                            ?>
                            <form action="#" method="post" enctype="multipart/form-data">
                                <h6 class="heading-small text-muted mb-4">User information</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-username">Image</label>
                                                <input type="file" id="input-username" name="image"
                                                    class="form-control form-control-alternative" placeholder="Upload Image"
                                                    value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-first-name">First
                                                    name</label>
                                                <input type="text" id="input-first-name" name="fname"
                                                    class="form-control form-control-alternative"
                                                    placeholder="First name" value="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-last-name">Last
                                                    name</label>
                                                <input type="text" id="input-last-name" name="lname"
                                                    class="form-control form-control-alternative"
                                                    placeholder="Last name" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-branch">Branch</label>
                                                <input type="text" id="input-branch" name="branch"
                                                    class="form-control form-control-alternative" placeholder="Branch"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-email">College</label>
                                                <input type="text" id="input-college" name="college"
                                                    class="form-control form-control-alternative" placeholder="College">
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
                                                <input id="input-address" name="address" class="form-control form-control-alternative"
                                                    placeholder="Home Address" value="" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-city">City</label>
                                                <input type="text" id="input-city" name="city"
                                                    class="form-control form-control-alternative" placeholder="City"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-country">Country</label>
                                                <input type="text" id="input-country" name="country"
                                                    class="form-control form-control-alternative" placeholder="Country"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-country">Postal
                                                    code</label>
                                                <input type="number" id="input-postal-code" name="postal"
                                                    class="form-control form-control-alternative"
                                                    placeholder="Postal code">
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
                                        <textarea rows="4" name="about" class="form-control form-control-alternative"
                                            placeholder="A few words about you ..."></textarea>
                                    </div>
                                </div> 
                                
                                <div>
                                    <button type="submit" name="submit" id="" class="submit">Save</button>
                                    <!-- <input type="submit" name="submit" id="" class="submit" value="Save"> -->
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php

  }
  else{
    header('Location: index.php');
  }
  
?>