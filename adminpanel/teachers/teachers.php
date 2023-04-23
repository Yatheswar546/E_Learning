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

	<title>AdminHub</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile' ></i>			
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
			<li class="active">
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
					<h1>Teachers</h1>
				</div>
				<a href="..\teachers\teachersAdd.php" class="btn-download">
                    <i class='bx bx-plus-circle'></i>
					<span class="text">Add Teacher</span>
				</a>
			</div>

			<ul class="box-info">
			
				<li style="width: 270px;">
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3>284</h3>
						<p>Users</p>
					</span>
				</li>

			</ul>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Teachers List</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>Sr. No</th>
								<th>Name</th>
								<th>Image</th>
								<th>Email</th>
								<th>Phone No.</th>
								<th>Course Name</th>
								<th>Joining Date</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								// read the data from teachers table
								$result = mysqli_query($db,"SELECT * FROM `teachers`");

								if(!$result){
									die("Invalid Query !!!".mysqli_connect_error());
								}
								else{
									// read data of each row ; 
									// $row = $result->fetch_assoc()
									while($row = mysqli_fetch_assoc($result)){
										echo "
										<tr>
											<td><p>$row[id]</p></td>
											<td>$row[name]</td>
											<td><img src='../database/teachers/$row[image]'></td>
											<td><p>$row[email]</p></td>
											<td>$row[phone]</td>
											<td><p>$row[course]</p></td>
											<td><p>$row[joinedat]</p></td>
											<td><a href='./teachersedit.php?id=$row[id]'><i class='bx bx-edit-alt'></i></a>
												<a href='./delete.php?id=$row[id]'><i class='bx bxs-trash'></i>
											</td>
										</tr>

										";
									}
								}
							?>
							<!-- <tr>
                                    <td><p>1</p></td>
                                    <td>Anuradha</td>
									<td><img src="..\img/people.png"></td>
									<td><p>anu@gmail.com</p></td>
									<td>9391052445</td>
									<td><p>Web Developement</p></td>
									<td><p>22-05-2023 09:06:12</p></td>
									<td><a href="..\teachers\teachersedit.html"><i class='bx bx-edit-alt'></i></a>
										<i class='bx bxs-trash'></i>
										</td>

							</tr> -->
                                              
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
		header("Location: ../../login.php");
	}
?>