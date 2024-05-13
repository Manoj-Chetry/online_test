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

$test = $_GET['test'];

$query = "Select * from score where test = '$test';";
$sql = mysqli_query($con, $query);
$num = mysqli_num_rows($sql);

$querytest = "Select test_name from test where test_id='$test';";
$s2 = mysqli_query($con,$querytest);
$testname = mysqli_fetch_assoc($s2); 


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../global.css" />
    <link rel="stylesheet" href="./styles/performance.css" />

    <title>Performance</title>
  </head>
  <body>
    <nav>
      <h1>Online-Test-App</h1>
      <div id="right-nav">
        <p>
          <i> <?php echo $name ?></i>
        </p>
        <button><a href="../php/logout.php">Logout</a></button>
      </div>
    </nav>
    <main>
      <div class="container">
        <h1>Performance</h1>
        <h2><?php echo$testname['test_name']; ?></h2>
        <table class="custom-table">
          <thead>
            <tr>
              <th>User ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Score</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if($num==0){
              echo"
              <h2>No one appeared the test yet.</h2>
              ";}else{
              while($row=mysqli_fetch_assoc($sql)){
                $u =$row['user'];
                $score = $row['score'];

                $q2 = "select * from user where user_id = '$u';";
                $s3 = mysqli_query($con, $q2);
                $user = mysqli_fetch_assoc($s3);

                $uid = $user['user_id'];
                $uname = $user['name'];
                $umail = $user['email'];

                echo"
                <tr>
                  <td>$uid</td>
                  <td>$uname</td>
                  <td>$umail</td>
                  <td>$score</td>
                </tr>";
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </main>
  </body>
</html>
