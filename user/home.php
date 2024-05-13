<?php
session_start();
if($_SESSION['id']==NULL){
    header("location: ../login.html");
}

require "../config/dbconfig.php";

$type = $_SESSION['type'];
$id = $_SESSION['id'];
$name = $_SESSION['name'];
$email = $_SESSION['email'];
$phone = $_SESSION['phone'];

$test_query = "select count(*) as count from score where user = '$id';";
$sql = mysqli_query($con, $test_query);
$test_count = mysqli_fetch_assoc($sql);



$test_name = $_GET['testname'];
$marks = $_GET['marks'];
$totalquestion = $_GET['totalquestions'];
$test_id = $_GET['test'];

$q = "select score from score where user = '$id' and test = '$test_id';";
$sql = mysqli_query($con, $q);

$sc_cnt = mysqli_num_rows($sql);
$s = mysqli_fetch_assoc($sql);
$score = $s['score'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../global.css">
    <link rel="stylesheet" href="styles/home.css">
    <title>Online-Test Home</title>
</head>
<body>
    <nav>
        <h1>Online-Test-App</h1>
        <div id="right-nav">
            <p>Welcome  <i> <?php echo $name ?></i></p>
            <button><a href="../php/logout.php">Logout</a></button>
        </div>
    </nav>

    <main>
        <div class="container">
            <div class="profile">
                <div class="profile-picture">
                    <img src="../images/profile-picture.png" alt="Profile Picture">
                </div>
                <div class="profile-details">
                    <h1>User Profile</h1>
                    <p id="name">Name: <?php echo $name ?></p>
                    <p>Email: <?php echo $email ?></p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="test-details">
                <h1>Tests</h1>
                <p>Total tests attended: <?php echo $test_count['count']; ?></p>
                <a class="more" href="#">more info..</a>
            </div>
        </div>
        <div class="container">
            <form action="./action/search.php" method="get">
                <h3>Looking for a test</h3>
                <label for="search">Enter test Id here:</label>
                <br>
                <input type="text" name="search" id="search" required>
                <button id="btn" type="submit">Search a Test</button>
            </form>
            <div class=" result">
                <?php
                        
                    if($sc_cnt==0){
                        if($test_name!=0&&$marks!=0&&$totalquestion!=0){
                            echo"
                            <div class='left'>
                            <h4>Test Name: $test_name</h4>
                            <p>Total Questions: $totalquestion</p>
                            <p>Total Marks: $marks</p>
                            </div>
                            <div class='right'>
                                <a href='test.php?test=$test_id'><button>Start</button></a>
                            </div>
                            ";
                        }
                    }else{
                        echo"
                        <div class='left'>
                            <h4>Test Name: $test_name</h4>
                            <p>Total Questions: $totalquestion</p>
                            <p>Total Marks: $marks</p>
                            </div>
                            <div class='right'>
                                <p>Your Score: <strong>$score</strong></p>
                            </div>
                        ";
                    }
                ?>
            </div>
        </div>
    </main>

    <script></script>
</body>
</html>