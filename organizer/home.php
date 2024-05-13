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

$test_query = "select count(*) as count from test where organizer = '$id';";
$sql = mysqli_query($con, $test_query);
$test_count = mysqli_fetch_assoc($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../global.css">
    <link rel="stylesheet" href="./styles/home.css">
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
                    <h1>Organizer Profile</h1>
                    <p id="name">Name: <?php echo $name ?></p>
                    <p>Email: <?php echo $email ?></p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="test-details">
                <h1>Tests</h1>
                <p>Total tests conducted: <?php echo $test_count['count']; ?></p>
                <button onclick="search()"><a href="create-test.php">Create a Test</a></button>
                <a class="more" href="./test.php">more info..</a>
            </div>
            </div>
        </div>
    </main>
</body>
</html>