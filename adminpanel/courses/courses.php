<?php
    session_start();
    if($_SESSION['id'] == true){
		
		// Database Connection
		require_once('../config.php');

		// Check Connetion
		if(!$db){
			die("Connection Failed!!!".mysqli_connect_error());
		}
		else{
			// echo "Connected Successfully";
		}

		$courses = mysqli_query($db,"SELECT * FROM `courses`");
		$courses_count = mysqli_num_rows($courses);

		$users = mysqli_query($db,"SELECT * FROM `user_form`");
		$users_count = mysqli_num_rows($users);

		$free_courses = mysqli_query($db,"SELECT * FROM `courses` WHERE type='Free'");
		$free_courses_count = mysqli_num_rows($free_courses);

		$paid_courses = mysqli_query($db,"SELECT * FROM `courses` WHERE type='Not Free'");
		$paid_courses_count = mysqli_num_rows($paid_courses);

		
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
					<h1>Courses</h1>
					
				</div>
				<a href="..\courses\addcourse.php" class="btn-download">
                    <i class='bx bx-plus-circle'></i>
					<span class="text">Add Course</span>
				</a>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bx-book-reader' ></i>					
					<span class="text">
						<h3><?php echo $courses_count; ?></h3>
						<p>Courses</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3><?php echo $users_count; ?></h3>
						<p>Users</p>
					</span>
				</li>
                <li>
					<i class='bx bxs-cart-alt'></i>
					<span class="text">
						<h3><?php echo $free_courses_count; ?></h3>
						<p>Free Courses</p>
					</span>
				</li>
                <li>
                    <i class='bx bxs-wallet-alt'></i>					
                    <span class="text">
						<h3><?php echo $paid_courses_count; ?></h3>
						<p>Paid Courses</p>
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
						<h3>Courses </h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>S.No.</th>
								<th>Name</th>
								<th>Image</th>
                                <th>Category</th>
								<th>Lecture Details</th>
								<th>Type</th>
								<th>Price</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<!-- <tr>
								<td><p>1</p></td>
                                <td><p>Basics of Web Development</p></td>
								<td><p><img src="../../images/1.jpeg" alt=""></p></td>
                                <td><p>Development</p></td>
                                <td><p><a href="..\courses\lectureDetails.php"><i class='bx bx-info-circle'></i></a></p></td>
                                <td><p>Free</p></td>
								<td><p>$50.00</p></td>
                                <td><a href="..\courses\courseEdit.php"><i class='bx bx-edit-alt'></i></a>
								<i class='bx bxs-trash'></i>
                                </td>
                            </tr> -->
							<?php 

								// read the data from courses table
								$result = mysqli_query($db,"SELECT * FROM `courses`");

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
												<td><p>$row[title]</p></td>
												<td><p><img src='../database/courses/$row[image]'></p></td>
												<td><p>$row[category]</p></td>
												<td><p><a href='./lectureDetails.php?id=$row[id]'><i class='bx bx-info-circle'></i></a></p></td>
												<td><p>$row[type]</p></td>
												<td><p>$row[price]</p></td>
												<td><a href='..\courses\courseEdit.php?id=$row[id]'><i class='bx bx-edit-alt'></i></a>
												<a href='..\courses\coursedelete.php?id=$row[id]'><i class='bx bxs-trash'></i></a>
												</td>
											</tr>
										";
									}
								}
							?>

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