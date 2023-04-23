<?php
    session_start();

    if(isset($_SESSION['id']) && isset($_SESSION['userid'])){
        $userid = $_SESSION['userid'];

        // Database Connection
        require_once('./config.php');

        // Check Connection
    	if(!$conn){
    		die("Connection Failed...".mysqli_connect_error());
    	} 
    	else{
    		// echo "Success";
    	}

        $errormsg = "";

        $correct_answers = [
            'q1' => 'c',
            'q2' => 'b',
            'q3' => 'b',
            'q4' => 'a',
            'q5' => 'a',
            'q6' => 'a',
            'q7' => 'd',
            'q8' => 'c',
            'q9' => 'b',
            'q10' => 'c'
        ];

        $user_answers = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $courseid = $_POST['courseid'];

            // get the user's answers
            foreach ($_POST as $key => $value) {
                if (strpos($key, 'q') === 0) {
                    $user_answers[$key] = $value;
                }
            }

            // check if all questions were answered
            if (count($user_answers) !== count($correct_answers)) {
                $errormsg = 'Please answer all questions!';
            }
            else{
                // check the user's answers against the correct answers
                $score = 0;
                foreach ($correct_answers as $key => $value) {
                    if ($user_answers[$key] == $value) {
                        $score++;
                    }
                }

                $result = ($score/10)*100;
                $sql = mysqli_query($conn,"INSERT INTO `certificates`(`userid`, `score`, `courseid`, `certificateid`) VALUES ('$userid','$result','$courseid','certificate')");
                
                if(!$sql){
                    echo "Something went wrong".mysqli_connect_error();
                }
                else{
                    header('Location: score.php?courseid='.$courseid);
                }
            }
        }

        else{
            if(!isset($_GET["courseid"])){
                header("location: index.php");
                exit;
          }
      
          $courseid = $_GET["courseid"];
        }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/css/swiper.min.css'>

    <!-- Font Awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Box Icons Link -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/quiz.css">



</head>

<body>


    <!------------------------------------------- Header --------------------------------------->
    <header class="sticky">
        <a href="#" class="logo">
            <img src="./images/logo.png" alt="">
        </a>
        <ul class="navbar">
            <li><a href="./index.php#home">Home</a></li>
            <li><a href="./index.php#trending">Trending</a></li>
            <li><a href="./index.php#categories">Categories</a></li>
            <li><a href="./index.php#courses">Courses</a></li>
            <li><a href="./index.php#faq">FAQ</a></li>
            <li><a href="./index.php#contact">Contact</a></li>
        </ul>
        <div class="header-icons">
            <?php if(isset($_SESSION['role']) && $_SESSION['role'] == "user"): ?>
            <a href="./profile.php"><i class='bx bxs-user'></i></a>
            <a href="#"><i class='bx bx-heart'></i></a>
            <a href="#"><i class='bx bx-cart'></i></a>
            <a href="./logout.php" class="logout">Logout</a>
            <?php elseif(isset($_SESSION['role']) && $_SESSION['role'] == "admin"): ?>
            <a href="./adminpanel/admin.php" class="login">Admin</a>
            <?php else: ?>
            <a href="./login.php" class="login">Login</a>
            <?php endif; ?>
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    </header>

    <!----------------------------- Quiz Form ------------------------------------->
    <div class="quiz-form">

        <form action="#" method="post">
            <h2>Quiz</h2>
            
            <?php 
                if(!empty($errormsg)){
                    echo "
                        <div class='error_msg'>
                            <strong>$errormsg</strong>
                        </div>
                    ";
                }
            ?>

            <input type="hidden" name="courseid" value="<?php echo $courseid; ?>">
            <div class="question">

                <div class="question">
                    <h3>Question 1:</h3>
                    <p>Which of the following can read and render HTML web pages</p>
                    <input type="radio" name="q1" value="a" id="q2a">
                    <label for="q2a"> Server</label><br>
                    <input type="radio" name="q1" value="b" id="q2b">
                    <label for="q2b"> head Tak</label><br>
                    <input type="radio" name="q1" value="c" id="q2c">
                    <label for="q2c"> web browser</label><br>
                    <input type="radio" name="q1" value="d" id="q2d">
                    <label for="q2d"> empty</label><br>
                </div>

                <h3>Question 2:</h3>
                <p>What does PHP stand for?</p>
                <input type="radio" name="q2" value="a" id="q1a">
                <label for="q1a"> Personal Home Page</label><br>
                <input type="radio" name="q2" value="b" id="q1b">
                <label for="q1b"> Hypertext Preprocessor</label><br>
                <input type="radio" name="q2" value="c" id="q1c">
                <label for="q1c"> Pretext Hypertext Processor</label><br>
                <input type="radio" name="q2" value="d" id="q1d">
                <label for="q1d"> Preprocessor Home Page</label><br>
            </div>

            <div class="question">
                <h3>Question 3:</h3>
                <p>Identify the range of byte data types in JavaScript</p>
                <input type="radio" name="q3" value="a" id="q2a">
                <label for="q2a"> -10 to 9</label><br>
                <input type="radio" name="q3" value="b" id="q2b">
                <label for="q2b"> -128 to 127</label><br>
                <input type="radio" name="q3" value="c" id="q2c">
                <label for="q2c"> -32768 to 32767</label><br>
                <input type="radio" name="q3" value="d" id="q2d">
                <label for="q2d"> -2147483648 to 2147483647</label><br>
            </div>

            <div class="question">
                <h3>Question 4:</h3>
                <p>What is the correct syntax for a PHP function?</p>
                <input type="radio" name="q4" value="a" id="q3a">
                <label for="q3a"> function myFunction() { }</label><br>
                <input type="radio" name="q4" value="b" id="q3b">
                <label for="q3b"> myFunction() { }</label><br>
                <input type="radio" name="q4" value="c" id="q3c">
                <label for="q3c"> myFunction() = { }</label><br>
                <input type="radio" name="q4" value="d" id="q3d">
                <label for="q3d"> function { myFunction() }</label><br>
            </div>

            <div class="question">
                <h3>Question 5:</h3>
                <p>Among the following operators identify the one which is used to allocate memory to array variables in
                    JavaScript.</p>
                <input type="radio" name="q5" value=" a" id="q3a">
                <label for="q3a"> new</label><br>
                <input type="radio" name="q5" value=" b" id="q3b">
                <label for="q3b"> new malloc</label><br>
                <input type="radio" name="q5" value=" c" id="q3c">
                <label for="q3c"> alloc</label><br>
                <input type="radio" name="q5" value=" d" id="q3d">
                <label for="q3d"> malloc</label><br>
            </div>

            <div class="question">
                <h3>Question 6:</h3>
                <p>Why were cookies designed?</p>
                <input type="radio" name="q6" value=" a" id="q3a">
                <label for="q3a">for server-side programming</label><br>
                <input type="radio" name="q6" value=" b" id="q3b">
                <label for="q3b">for client-side programming</label><br>
                <input type="radio" name="q6" value=" c" id="q3c">
                <label for="q3c">both a and b</label><br>
                <input type="radio" name="q6" value=" d" id="q3d">
                <label for="q3d">None</label><br>
            </div>

            <div class="question">
                <h3>Question 7:</h3>
                <p>Simple network management protocol uses which of the following port number</p>
                <input type="radio" name="q7" value=" a" id="q3a">
                <label for="q3a"> 164</label><br>
                <input type="radio" name="q7" value=" b" id="q3b">
                <label for="q3b"> 163</label><br>
                <input type="radio" name="q7" value=" c" id="q3c">
                <label for="q3c"> 160</label><br>
                <input type="radio" name="q7" value=" d" id="q3d">
                <label for="q3d"> 161</label><br>
            </div>

            <div class="question">
                <h3>Question 8:</h3>
                <p>Which of the following attribute is used for merging two or more adjacent columns?</p>
                <input type="radio" name="q8" value=" a" id="q3a">
                <label for="q3a">ROWSPAN</label><br>
                <input type="radio" name="q8" value=" b" id="q3b">
                <label for="q3b">CELLSPACING</label><br>
                <input type="radio" name="q8" value=" c" id="q3c">
                <label for="q3c">COLSPAN</label><br>
                <input type="radio" name="q8" value=" d" id="q3d">
                <label for="q3d">CELLPADDING</label><br>
            </div>

            <div class="question">
                <h3>Question 9:</h3>
                <p>A website is a _______ cookie.</p>
                <input type="radio" name="q9" value=" a" id="q3a">
                <label for="q3a"> volatile</label><br>
                <input type="radio" name="q9" value=" b" id="q3b">
                <label for="q3b"> transient</label><br>
                <input type="radio" name="q9" value=" c" id="q3c">
                <label for="q3c"> in transient</label><br>
                <input type="radio" name="q9" value=" d" id="q3d">
                <label for="q3d"> non-volatile</label><br>
            </div>

            <div class="question">
                <h3>Question 10:</h3>
                <p>Why is XPATH used?</p>
                <input type="radio" name="q10" value=" a" id="q3a">
                <label for="q3a"> TO address the server</label><br>
                <input type="radio" name="q10" value=" b" id="q3b">
                <label for="q3b"> to store the IP address of this server</label><br>
                <input type="radio" name="q10" value=" c" id="q3c">
                <label for="q3c"> to address the document by specifying a location path</label><br>
                <input type="radio" name="q10" value=" d" id="q3d">
                <label for="q3d"> none</label><br>
            </div>

            <div class="submit-btn">
                <input type="submit" value="Submit">
            </div>

        </form>
    </div>

    <!------------------------ footer ------------------------------------------->
    <footer>
        <div class="row">
            <div class="col">
                <img src="./images/logo.png" alt="" class="logo">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, voluptates quos! Sequi
                    repellendus
                    neque cum minus eos consequatur saepe provident recusandae animi quidem? Non libero pariatur saepe
                    perferendis
                    mollitia possimus.</p>
            </div>
            <div class="col">
                <h3>office <div class="underline"><span></span></div>
                </h3>
                <p>Kurmannapalem</p>
                <p>Visakhapatnam</p>
                <p>Andhra Pradesh, 530046</p>
                <p class="email-id">e-learning@gmail.com</p>
                <h4>+91 - 0123456789</h4>
            </div>
            <div class="col">
                <h3>Links <div class="underline"><span></span></div>
                </h3>
                <ul>
                    <li><a href="">Trending</a></li>
                    <li><a href="">Category</a></li>
                    <li><a href="">Free courses</a></li>
                    <li><a href="">Teachers</a></li>
                    <li><a href="">Testimonials</a></li>
                </ul>
            </div>
            <div class="col">
                <h3>Newsletter <div class="underline"><span></span></div>
                </h3>
                <form class="footer-form">
                    <i class="far fa-envelope"></i>
                    <input type="email" placeholder="Enter your email id" required>
                    <button type="submit"><i class="fas fa-arrow-right"></i></button>
                </form>
                <div class="social-icons">
                    <i class="fab fa-facebook-f"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-whatsapp"></i>
                    <i class="fab fa-pinterest"></i>
                </div>
            </div>
        </div>
        <hr>
        <p class="copyright">E-learning © 2023 - All Rights Reserved</p>
    </footer>

</body>

</html>

<?php
    }
    else{
        header('Location: index.php');
    }
?>
