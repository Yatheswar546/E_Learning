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

	$id = "";
	$title = "";
	$description = "";
	$file = "";

	$errormsg = "";
    $successmsg = "";

	if($_SERVER['REQUEST_METHOD'] == 'GET'){
		// GET Method : Show the Data
        if(!isset($_GET["id"])){
            header("location: index.php");
            exit;
        }

		$id = $_GET["id"];
        // Read the Data
        $result = mysqli_query($db,"SELECT * FROM `categories` WHERE id=$id");
        $row = $result->fetch_assoc();

        if(!$row){
            header("Location: index.php");
            exit;
        }
		$title = $row['title'];
		$description = $row['description'];
		$file = $row['image'];
	}
	else{
		// POST Method : Update the data
        $id = $_POST['id'];
        $title = $_POST['title'];
	    $description = $_POST['description'];
        $target = "../database/categories/";
        $filename = $_FILES['image']['name'];
        $filetype = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION)); // filetype
        $target_file = $target.basename(md5("userid".$_FILES['image']['name']).".".$filetype); //target path
        $file = md5("userid".$_FILES['image']['name']).".".$filetype; // file created
        $teamid = md5(substr($title,0,3).substr($description,0,3).random_int(10000,99999));

        do{
            if(empty($id) || empty($title) || empty($description) || empty($file)){
                $errormsg = "All Fields are required !!!";
                break;
            }
            else{
                if($filetype == "png" || $filetype == "jpg" || $filetype == "jpeg"){
                    if(move_uploaded_file($_FILES['image']['tmp_name'],$target_file)){
                        $sql = mysqli_query($db,"UPDATE `categories` SET `title`='$title',`description`='$description',`image`='$file' WHERE id=$id");
                        if($sql){
                            $successmsg = "You have successfully updates a Team Member";
                            header("Location: category.php");
                            exit;
                        } 
                        else{
                            $errormsg = "Something went wrong!!!";
                        }
                    }
                    else{
                        $errormsg = "Image not moved!!";
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
			<li class="active">
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
					<h1> Edit Category</h1>
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

				<a href="..\category\category.php" class="btn-download">
					<i class='bx bx-plus-circle'></i>
					<span class="text">Back</span>
				</a>
			</div>



			<div class="container">
				<input type="checkbox" id="check">
				<div class="login form">
				  <form action="#" method="post" enctype="multipart/form-data">
				  	<input type="hidden" name="id" value="<?php echo $id; ?>">
					
					<span class="span"> Enter Title</span>
					<input type="text" name="title" placeholder="Category Title"  value="<?php echo $title; ?>">
					
					<span>iIage</span>
					<input type="file" name="image" placeholder="Select Image"  value="<?php echo $file; ?>">
					
					<span class="span">Enter Description</span>
					<input type="text" name="description" placeholder="Enter Description" style="height: 200px;"  value="<?php echo $description; ?>">
					
					<?php 
                        if(!empty($successmsg)){
                            echo "
                                <div class='success_msg'>
                                    <strong>$successmsg</strong>
                                </div>
                            ";
                        } 
                    ?>

					<input type="submit" class="button" value="Edit">
				  </form>
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