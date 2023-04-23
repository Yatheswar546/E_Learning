<?php
	session_start();
	if(isset($_SESSION['login']) && $_SESSION['login'] == true){
		if(isset($_SESSION["image"]) && !empty($_SESSION["image"])){
			// echo $_SESSION["image"];
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
	<link rel="stylesheet" href="../css/admin.css">

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
			<li class="active">
				<a href="#">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="./category/category.php">
					<i class='bx bx-book-reader' ></i>
					<span class="text">Categories</span>
				</a>
			</li>
			<li>
				<a href="./courses/courses.php">
					<i class='bx bxs-school'></i>
					<span class="text">courses</span>
				</a>
			</li>
			<li>
				<a href="./admins/admins.php">
					<i class='bx bxs-user-circle'></i>
					<span class="text">Admins</span>
				</a>
			</li>
			<li>
				<a href="./teachers/teachers.php">
					<i class='bx bx-chalkboard'></i>
					<span class="text">Teachers</span>
				</a>
			</li>
			<li>
				<a href="./payment/payment.html">
					<i class='bx bxl-paypal'></i>
					<span class="text">payment</span>
				</a>
			</li>			
			<li>
				<a href="./faqs/faqs.php">
					<i class='bx bx-question-mark'></i>
					<span class="text">FAQs</span>
				</a>
			</li>			
			<li>
				<a href="./feedback/feedback.php">
					<i class='bx bxs-pencil'></i>
					<span class="text">Feedback</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="../index.php">
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
				<a href="../logout.php" class="logout">
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
				<img src="./img/people.png">
			</a>

			<?php 
				// if(isset($_SESSION["image"]) && !empty($_SESSION["image"])){
					// echo "<img src='./database/admins/{$_SESSION["image"]}'>"; 
				// }
			?>

		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bx-book-reader' ></i>					
					<span class="text">
						<h3>10</h3>
						<p>Courses</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3>2834</h3>
						<p>Users</p>
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
						<h3>Courses Orders</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>Order ID</th>
								<th>Course ID</th>
								<th>Name</th>
								<th>Email</th>
								<th>Order Date</th>
								<th>Amount</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><p>10000000</p> </td>
									<td><p>1AP10005A5</p></td>
									<td><img src="./img/people.png">
										<p>John Doe</p></td>
									<td><p>anu@gmail.com</p></td>
									<td>01-10-2021</td>
									<td><p>$8</p></td>
									<td><p><i class='bx bxs-trash'></i></p></td>
							</tr>
							<tr>
								<td><p>10000000</p> </td>
									<td><p>1AP10005A5</p></td>
									<td><img src="./img/people.png">
										<p>John Doe</p></td>
									<td><p>anu@gmail.com</p></td>
									<td>01-10-2021</td>
									<td><p>$8</p></td>
									<td><p><i class='bx bxs-trash'></i></p></td>
							</tr>
							<tr>
								<td><p>10000000</p> </td>
									<td><p>1AP10005A5</p></td>
									<td><img src="./img/people.png">
										<p>John Doe</p></td>
									<td><p>anu@gmail.com</p></td>
									<td>01-10-2021</td>
									<td><p>$8</p></td>
									<td><p><i class='bx bxs-trash'></i></p></td>
							</tr>
							<tr>
								<td><p>10000000</p> </td>
									<td><p>1AP10005A5</p></td>
									<td><img src="./img/people.png">
										<p>John Doe</p></td>
									<td><p>anu@gmail.com</p></td>
									<td>01-10-2021</td>
									<td><p>$8</p></td>
									<td><p><i class='bx bxs-trash'></i></p></td>
							</tr>
							<tr>
								<td><p>10000000</p> </td>
									<td><p>1AP10005A5</p></td>
									<td><img src="./img/people.png">
										<p>John Doe</p></td>
									<td><p>anu@gmail.com</p></td>
									<td>01-10-2021</td>
									<td><p>$8</p></td>
									<td><p><i class='bx bxs-trash'></i></p></td>
							</tr>

						</tbody>
					</table>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section> 
	<!-- CONTENT -->
	

	<script src="./js/script.js"></script>
</body>
</html>

<?php
	}
	else{
		header("Location: ../login.php");
	}
?>