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



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../global.css">
    <link rel="stylesheet" href="./styles/create-test.css">
    <title>Create-Test</title>
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
          <h2>Create Test</h2>
          <form action="./action/create-test.php" method="post">
              <div class="form-group">
                  <label for="test_name">Test Name:</label>
                  <input type="text" id="test_name" name="test_name" required>
              </div>
              <div class="form-group">
                  <label for="total_question">Total Question:</label>
                  <input type="number" id="total_question" name="total_question" required>
              </div>
              <div class="form-group">
                  <label for="total_marks">Total Marks:</label>
                  <input type="number" id="total_marks" name="total_marks" required>
              </div>
              <div class="form-group">
                  <label for="duration">Duration:</label>
                  <input type="number" id="duration" name="duration" required>
              </div>
              <button type="submit">Create</button>
          </form>
      </div>
    </main>
  </body>
</html>


