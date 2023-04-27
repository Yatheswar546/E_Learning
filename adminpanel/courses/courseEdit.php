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

    $id = "";
	$title = "";
	$category = "";
	// $video = "";
	$description = "";
	// $file = "";
	$type = "";
	$price = "";

	$errormsg = "";

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
		// GET Method : Show the Data
        if(!isset($_GET["id"])){
            header("location: courses.php");
            exit;
        }

        $id = $_GET["id"];
        // Read the Data
        $result = mysqli_query($db,"SELECT * FROM `courses` WHERE id='$id'");
        $row = $result->fetch_assoc();

        if(!$row){
            header("Location: courses.php");
            exit;
        }

        $title = $row['title'];
	    $category = $row['category'];
	    // $video = "";
	    $description = $row['description'];
	    // $file = "";
	    $type = $row['type'];
	    $price = $row['price'];

    }

    elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
	    $title = $_POST['title'];
		$category = $_POST['category'];
		$description = $_POST['description'];
		$type = $_POST['type'];
		$price = $_POST['price'];

		// $courseid = md5(substr($title,0,3).substr($category,0,3).random_int(100000,999999));
		// $name = $_FILES['video'];
		// print_r($name);

		$image_target = "../database/courses/";
        $image_filename = $_FILES['image']['name'];
        $image_filetype = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION)); // filetype
        $image_target_file = $image_target.basename(md5("userid".$_FILES['image']['name']).".".$image_filetype); //target final path
        $imagefile = md5("userid".$_FILES['image']['name']).".".$image_filetype; // file created

		$video_filename = $_FILES['video']['name'];
		$video_filetype = strtolower(pathinfo($_FILES['video']['name'], PATHINFO_EXTENSION)); // file extension
		$video_tempname = $_FILES['video']['tmp_name'];
		$video_filesize = $_FILES['video']['size'];
		$videofile = md5("userid".$video_filename).".".$video_filetype; // file name with md5 hash
		$video_target = "../database/videos/";
		$video_target_file = $video_target.$videofile; //target final path

	    // check if course already exists in the database
	    $sql = "SELECT * FROM courses WHERE id = '$id'";
	    $result = mysqli_query($db, $sql);

	    if (mysqli_num_rows($result) > 0) {
		    // update user details
		    $update_fields = [];
		    if (!empty($title)) {
		    	$update_fields[] = "title='$title'";
		    }
		    if (!empty($category)) {
		    	$update_fields[] = "category='$category'";
		    }
            if (!empty($description)) {
		    	$update_fields[] = "description='$description'";
		    }
            if (!empty($type)) {
		    	$update_fields[] = "type='$type'";
		    }
            if (!empty($price)) {
		    	$update_fields[] = "price='$price'";
		    }
            if (!empty($videofile)) {
		    	$update_fields[] = "video='$videofile'";
                move_uploaded_file($video_tempname,$video_target_file);
		    }
            if (!empty($imagefile)) {
		    	$update_fields[] = "image='$imagefile'";
                move_uploaded_file($_FILES['image']['tmp_name'],$image_target_file);
		    }

		    $sql = "UPDATE courses SET " . implode(", ", $update_fields) . " WHERE id='$id'";

		    if (mysqli_query($db, $sql)) {
		    	header('Location: courses.php');
                exit;
		    } else {
		    	$errormsg = "Error updating user details: " . mysqli_error($db);
		    }
	    } 
        else {
	    	$errormsg = "User not found in the database";
	    }
	    mysqli_close($db);
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
					<i class='bx bxs-dashboard'></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li class="active">
				<a href="..\category\category.php">
					<i class='bx bx-book-reader'></i>
					<span class="text">Categories</span>
				</a>
			</li>
			<li>
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
					<i class='bx bxs-cog'></i>
					<span class="text">Back To Home</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-cog'></i>
					<span class="text">Settings</span>
				</a>
			</li>

			<li>
				<a href="../../logout.php" class="logout">
					<i class='bx bxs-log-out-circle'></i>
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
			<i class='bx bx-menu'></i>
			<a href="#" class="nav-link">Search</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell'></i>
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
					<h1> Edit Course</h1>
				</div>
                <a href="..\courses\courses.php" class="btn-download">
                    <i class='bx bx-plus-circle'></i>
                    <span class="text">Back</span>
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
                        <!-- <input type="hidden" name="courseid" value="<?php echo $id; ?>"> -->
                        <input type="hidden" name="id" value="<?php echo $id; ?>">

                    	<span> Enter Title</span>
						<input type="text" name="title" placeholder="Enter Title" value="<?php echo $title; ?>">

						<span> Enter Category</span>
						<input type="text" name="category" placeholder="Enter Category" value="<?php echo $category; ?>">

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
						<input type="text" name="price" placeholder="Enter Price" value="<?php echo $price; ?>">

						<span>Enter Description</span>
						<input type="text" name="description" placeholder="Enter discription" value="<?php echo $description; ?>" style="height: 200px;">

						<input type="submit" class="button" value="Edit">
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