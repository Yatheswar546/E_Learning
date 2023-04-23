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

	$que = "";
	$ans = "";

	$errormsg = "";
    $successmsg = "";

	if( $_SERVER['REQUEST_METHOD'] == 'POST'){
        $que = $_POST['que'];
	    $ans = $_POST['ans'];

        do{
            if(empty($que) || empty($ans)){
                $errormsg = "All Fields are required !!!";
                break;
            }
            else{
                // Insert new Faq into table
                $sql = mysqli_query($db,"INSERT INTO `faqs`(`que`, `ans`) VALUES ('$que','$ans')");

                if(!$sql){
                    $errormsg = "Invalid Query".mysqli_connect_error();
                    break;
                }
                $que = "";
                $ans = "";

                $successmsg = "FAQ Added Successfully";
                header("Location: faqs.php");
                exit;
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
			<li >
				<a href="..\category\category.php">
					<i class='bx bx-book-reader' ></i>
					<span class="text">Categories</span>
				</a>
			</li>
			<li >
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
			<li class="active">
				<a href=".\faqs\faqs.php">
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
					<h1> Add FAQs</h1>
				</div>

				<?php 
                    if(!empty($errormsg)){
                        echo "
                            <div class='error_msg'>
                                <strong>$errormsg</strong>
                            </div>
                        ";
                    }
                ?>

				<a href="..\faqs\faqs.php" class="btn-download">
					<i class='bx bx-plus-circle'></i>
					<span class="text">Back</span>
				</a>
			</div>
			<div class="container">
				<input type="checkbox" id="check">
				<div class="login form">
				  <form action="#" method="post"  enctype="multipart/form-data">
					  
				  	  	<span class="span"> question</span>
                      	<input type="text" name="que" placeholder="Enter queston" style="height: 100px;" value="<?php echo $que; ?>">
					
					  	<span class="span"> Enter description</span>
                      	<input type="text" name="ans" placeholder="Enter discription" style="height: 200px;" value="<?php echo $ans; ?>">
					
					  	<?php 
                        	if(!empty($successmsg)){
                        	    echo "
                        	        <div class='success_msg'>
                        	            <strong>$successmsg</strong>
                        	        </div>
                        	    ";
                        	} 
                      	?>

					  	<input type="submit" class="button" value="Add">
				  </form>
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