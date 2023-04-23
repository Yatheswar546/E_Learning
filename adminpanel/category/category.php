<?php

	session_start();
	if(isset($_SESSION['login']) && $_SESSION['login'] == true){

	// Database Connection
	require('../config.php');

	// Check Connetion
	if(!$db){
		die("Connection Failed!!!".mysqli_connect_error());
	}
	else{
		// echo "Connected Successfully";
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
				<a href="../admin.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li class="active">
				<a href="./category.php">
					<i class='bx bx-book-reader' ></i>
					<span class="text">Categories</span>
				</a>
			</li>
			<li>
				<a href="../courses/courses.php">
					<i class='bx bxs-school'></i>					
					<span class="text">courses</span>
				</a>
			</li>
			<li>
				<a href="../admins/admins.php">
					<i class='bx bxs-user-circle'></i>					
					<span class="text">Admins</span>
				</a>
			</li>
			<li>
				<a href="../teachers/teachers.php">
					<i class='bx bx-chalkboard'></i>
					<span class="text">Teachers</span>
				</a>
			</li>
			<li>
				<a href="../payment/payment.html">
					<i class='bx bxl-paypal'></i>
					<span class="text">payment</span>
				</a>
			</li>			
			<li>
				<a href="../faqs/faqs.php">
					<i class='bx bx-question-mark'></i>
					<span class="text">FAQs</span>
				</a>
			</li>			
			<li>
				<a href="../feedback/feedback.php">
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
				<img src="../img/people.png">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Category</h1>
				</div>
				<a href="../category/categoryAdd.php" class="btn-download">
                    <i class='bx bx-plus-circle'></i>
					<span class="text">Add Category</span>
				</a>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bx-book-reader' ></i>					
					<span class="text">
						<h3>10</h3>
						<p>Categories</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-school'></i>
					<span class="text">
						<h3>64</h3>
						<p>Courses</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">
						<h3>$254</h3>
						<p>Total Sales</p>
					</span>
				</li>
			</ul>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>List of Categories</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>S. No</th>
								<th>Category</th>
								<th>Image</th>
								<th>Description</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
							<?php 

								// read the data from categories table
								$result = mysqli_query($db,"SELECT * FROM `categories`");
								
								if(!$result){
									die("Invalid Query !!!".mysqli_connect_error());
								}
								else{
									// read data of each row ; 
									// $row = $result->fetch_assoc()
									while($row = mysqli_fetch_assoc($result)){
										echo "
										<tr>
											<td>$row[id]</td>
											<td>$row[title]</td>
											<td><img src='../database/categories/$row[image]'></td>
											<td>$row[description]</td>
											<td><a href='./categoryEdit.php?id=$row[id]' class='edit'>Edit</a></td>
											<td><a href='./delete.php?id=$row[id]' class='delete'>Delete</a></td>
										</tr>
										";
									}
								}
							?>
							<!-- <tr>
								<td><p>1</p></td>
								<td><p> Development</p></td>
								<td><img src="../img/people.png"></td>
								<td><p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Necessitatibus, et.</p></td>
								<td><a href="../category/categoryEdit.html"><i class='bx bx-edit-alt'></i></a></td>
								<td><i class='bx bxs-trash'></i></td>
							</tr>
							<tr>
								<td><p>1</p></td>
								<td><p> Music</p></td>
								<td><img src="../img/people.png"></td>
								<td><p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Necessitatibus, et.</p></td>
								<td><a href="../category/categoryEdit.html"><i class='bx bx-edit-alt'></i></a></td>
								<td><i class='bx bxs-trash'></i></td>
							</tr> -->

						</tbody>
					</table>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="../js/script.js"></script>
</body>
</html>

<?php
	}
	else{
		header("Location: ../../login.php");
	}
?>