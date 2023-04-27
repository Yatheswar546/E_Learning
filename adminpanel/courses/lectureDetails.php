<?php
	session_start();
    if($_SESSION['id'] == true){

    // Database Connection
    require_once('../config.php');
		
	$title = "";
	$video_link = "";

	if($_SERVER['REQUEST_METHOD'] == 'GET'){
        // GET Method : Show the Data
        if(!isset($_GET["id"])){
            header("location: courses.php");
            exit;
        }

        $id = $_GET["id"];
        // Read the Data
        $result = mysqli_query($db,"SELECT * FROM `courses` WHERE id=$id");
        $row = $result->fetch_assoc();

		if(!$row){
            header("Location: courses.php");
            exit;
        }

		$title = $row['title'];
		$video_link = $row['video'];
		$price = $row['price'];
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
			<li>
				<a href="..\category\category.php">
					<i class='bx bx-book-reader'></i>
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
					<h1>Lecture Details</h1>
				</div>
				<a href="..\courses\addLecture.html" class="btn-download">
					<i class='bx bx-plus-circle'></i>
					<span class="text">Add Lecture</span>
				</a>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bx-book-reader'></i>
					<span class="text">
						<h3>5</h3>
						<p>No of Lectures</p>
					</span>
				</li>

			</ul>

			<div class="head-title" style="margin-top: 15px;">
				<a href="..\courses\courses.php" class="btn-download">
					<i class='bx bx-plus-circle'></i>
					<span class="text">Back</span>
				</a>
			</div>
			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Lecture details</h3>
						<i class='bx bx-search'></i>
						<i class='bx bx-filter'></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>S.No.</th>
								<th>Lecture Title</th>
								<th>Video Link</th>
								<th>Price</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<p>1</p>
								</td>
								<td>
									<p> <?php echo $title; ?> </p>
									<!-- <p><i class='bx bx-code-alt'></i> WebDevelopment</p> -->
								</td>
								<td>
								<p> <?php echo $video_link; ?> </p>
									<!-- <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Necessitatibus, et.</p> -->
								</td>
								<td>
									<p> <?php echo $price; ?> </p>
								</td>
								<?php echo " <td><a href='..\courses\courseEdit.php?id=$row[id]'><i class='bx bx-edit-alt'></i></a></td>" ?>
								<?php echo " <td><a href='..\courses\lecturedelete.php?id=$row[id]'><i class='bx bxs-trash'></a></i></td>" ?>
							</tr>
						</tbody>
					</table>
				</div>
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
        header("Location: ../../index.php");
    }
?>