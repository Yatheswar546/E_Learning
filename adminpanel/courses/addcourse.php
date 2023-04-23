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

	$title = "";
	$category = "";
	// $video = "";
	$description = "";
	// $file = "";
	$type = "";
	$price = "";

	$errormsg = "";

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$title = $_POST['title'];
		$category = $_POST['category'];
		$description = $_POST['description'];
		$type = $_POST['type'];
		$price = $_POST['price'];

		$courseid = md5(substr($title,0,3).substr($category,0,3).random_int(100000,999999));
		// $name = $_FILES['video'];
		// print_r($name);

		$image_target = "../database/courses/";
        $image_filename = $_FILES['image']['name'];
        $image_filetype = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION)); // filetype
        $image_target_file = $image_target.basename(md5("userid".$_FILES['image']['name']).".".$image_filetype); //target final path
        $imagefile = md5("userid".$_FILES['image']['name']).".".$image_filetype; // file created

		// $video_filename = $_FILES['video']['name'];
		// $video_filetype = $_FILES['video']['type'];
		// $video_tempname = $_FILES['video']['tmp_name'];
		// $vide_filesize = $_FILES['video']['size'];
		// $videofile = md5("userid".$_FILES['video']['name']).".".$video_filetype; // file created
		// $video_target = "../database/videos/";
		// $video_target_file = $video_target.basename(md5("userid".$_FILES['video']['name']).".".$video_filetype); //target final path

		$video_filename = $_FILES['video']['name'];
		$video_filetype = strtolower(pathinfo($_FILES['video']['name'], PATHINFO_EXTENSION)); // file extension
		$video_tempname = $_FILES['video']['tmp_name'];
		$video_filesize = $_FILES['video']['size'];
		$videofile = md5("userid".$video_filename).".".$video_filetype; // file name with md5 hash
		$video_target = "../database/videos/";
		$video_target_file = $video_target.$videofile; //target final path

		

		do{
			if(empty($title) || empty($category) || empty($description) || empty($type) || empty($price)){
				$errormsg = "All Fields are required";
				break;
			}
			else{
				if(move_uploaded_file($video_tempname,$video_target_file)){
					if(move_uploaded_file($_FILES['image']['tmp_name'],$image_target_file)){
						$sql = mysqli_query($db,"INSERT INTO `courses`(`title`, `category`, `description`, `video`, `image`, `price`, `type`, `courseid`) VALUES ('$title','$category','$description','$videofile','$imagefile','$price','$type','$courseid')");
					
						if($sql){
							// $errormsg = "Video & Image uploaded succesfully";
							header("Location: courses.php");
							exit;
						}
						else{
							$errormsg = "Something went wrong".mysqli_connect_error();
						}
					}
					else{
						$errormsg = "Image not moved Successfully";
					}
				}
				else{
					$errormsg = "Video not moved Successfully";
				}
			}
		}while(false);
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	
	<!-- Custom CSS -->
	<link rel="stylesheet" href="../../css/admin.css">
	<link rel="stylesheet" href="../../css/adminforms.css">


	<title>AdminHub</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text" style="color:white; ">AdminHub</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="..\admin.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="..\category\category.php">
					<i class='bx bx-book-reader' ></i>
					<span class="text">Categories</span>
				</a>
			</li>
			<li class="active">
				<a href="..\courses\courses.php">
					<i class='bx bxs-school'></i>					
					<span class="text">courses</span>
				</a>
			</li>
			<li>
				<a href="..\admins\admins.php">
					<i class='bx bxs-user-circle'></i>					
					<span class="text">Admins</span>
				</a>
			</li>
			<li>
				<a href="..\teachers\teachers.php">
					<i class='bx bx-chalkboard'></i>
					<span class="text">Teachers</span>
				</a>
			</li>
			<li>
				<a href="..\payment\payment.html">
					<i class='bx bxl-paypal'></i>
					<span class="text">payment</span>
				</a>
			</li>			
			<li>
				<a href="..\faqs\faqs.php">
					<i class='bx bx-question-mark'></i>
					<span class="text">FAQs</span>
				</a>
			</li>			
			<li>
				<a href="..\feedback\feedback.php">
					<i class='bx bxs-pencil'></i>
					<span class="text">Feedback</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="../../index.php">
					<i class='bx bxs-cog' ></i>
					<span class="text">Back To Home</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>

			<li>
				<a href="../../logout.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>	
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Search</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
			<a href="#" class="profile">
				<img src="..\img/people.png">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1> Add Course</h1>
				</div>
                <a href="..\courses\courses.php" class="btn-download">
                    <i class='bx bx-plus-circle'></i>
                    <span class="text">back</span>
                </a>
			</div>
			<div class="container">
				<input type="checkbox" id="check">
				<div class="login form">

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
                    	<span> Enter Title</span>
						<input type="text" name="title" placeholder="Enter Title">

						<span> Enter Category</span>
						<input type="text" name="category" placeholder="Enter Category">

						<span> Upload Video</span>
						<input type="file" name="video" placeholder="Enter Title">

						<span> Upload Image</span>
						<input type="file" name="image" placeholder="Enter Title">

						<span> Type of Course </span>
						<select name="type" id="">
							<option value="Free">Free</option>
							<option value="Not Free">Not Free</option>
						</select>
						<br><br>
						<span> Price</span>
						<input type="text" name="price" placeholder="Enter Price">

						<span>Enter Description</span>
						<input type="text" name="description" placeholder="Enter discription" style="height: 200px;">

						<input type="submit" class="button" value="Add">
				  	</form>
				</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="..\js\script.js"></script>
</body>
</html>

<?php
	}
	else{
		header("Location: ../../login.php");
	}
?>