<?php
session_start();
if($_SESSION['id']==NULL){
    header("location: ../login.html");
}

require "../config/dbconfig.php";

$id = $_SESSION['id'];
$name = $_SESSION['name'];
$email = $_SESSION['email'];
$phone = $_SESSION['phone'];

$query = "Select * from test where organizer = '$id';";
$sql = mysqli_query($con, $query);

$num = mysqli_num_rows($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../global.css">
    <link rel="stylesheet" href="./styles/test.css">
    <title>Document</title>
</head>
<body>
    <nav>
        <h1>Online-Test-App</h1>
        <div id="right-nav">
        <p><i> <?php echo $name ?></i></p>
        <button><a href="../php/logout.php">Logout</a></button>
        </div>
    </nav>
    <main>
        <div class="container">
            <h1 id="header">Tests: <?php echo$num ?></h1>
            <?php 
            while($row=mysqli_fetch_assoc($sql)){
                $test_name = $row['test_name'];
                $test_id = $row['test_id'];
                $total_question = $row['total_questions'];
                
                $q_count = "select * from score where test = '$test_id';";
                $exec = mysqli_query($con, $q_count);
                $count = mysqli_num_rows($exec);

                echo "
                <div class='test'>
                <div class='test-details'>
                    <h3>Test Name: $test_name </h3>
                    <p id='name'>Test id: $test_id</p>
                    <p>Number of Questions: $total_question </p>
                    <p>Number of Appeared: $count</p>
                </div>
                <div class='action'>
                    <a href='performance.php?test=$test_id'><button>Performance</button></a>
                    <button>Edit Test</button>
                </div>
            </div>
                ";
            }
            ?>
        
    </main>
    
</body>
</html>