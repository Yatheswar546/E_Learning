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

	$users = mysqli_query($db,"SELECT * FROM `user_form`");
	$users_count = mysqli_num_rows($users);

	$teachers = mysqli_query($db,"SELECT * FROM `teachers`");
	$teachers_count = mysqli_num_rows($teachers);

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
			<li>
				<a href="..\courses\courses.php">
					<i class='bx bxs-school'></i>					
					<span class="text">courses</span>
				</a>
			</li>
			<li class="active">
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
		</ul>		<ul class="side-menu">
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
					<h1>Admins</h1>
					
				</div>
				<a href="..\admins\adminsadd.php" class="btn-download">
                    <i class='bx bx-plus-circle'></i>
					<span class="text">Add admins</span>
				</a>
			</div>

			<ul class="box-info">
			
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3><?php echo $users_count; ?></h3>
						<p>Users</p>
					</span>
				</li> 
                <li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3><?php echo $teachers_count; ?></h3>
						<p>Teachers</p>
					</span>
				</li>
                <li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3>48</h3>
						<p>Working Professionals</p>
					</span>
				</li>
			</ul>

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Admins List</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>Sr. No</th>
								<th>Name</th>
								<th>Email</th>
								<th>Phone No.</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>

							<?php
								// read data from `admins` table
								$admins = mysqli_query($db,"SELECT * FROM `admins`");
								if(!$admins){
									die("Invalid Query".mysqli_connect_error());
								}
								else{
									while($row = mysqli_fetch_assoc($admins)){
										echo"
											<tr>
												<td><p>1</p></td>
												<td><img src='../database/admins/$row[image]'>
													<p>$row[name]</p></td>
												<td>$row[email]</p></td>
												<td>$row[phone]</td>
												<td><a href='adminsedit.php?id=$row[id]'><i class='bx bx-edit-alt'></i></a>
													<a href='delete.php?id=$row[id]'><i class='bx bxs-trash'></i>></a>
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