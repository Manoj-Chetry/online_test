<?php
session_start();
if($_SESSION['id']==NULL){
    header("location: ../login.html");
}

require "../config/dbconfig.php";

$id = $_SESSION['id'];
$name = $_SESSION['name'];
$test_id = $_SESSION['test_id'];
if($test_id==NULL){
    header("location:./test.php");
}
$total_question = (int)$_SESSION['total_question'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../global.css">
    <link rel="stylesheet" href="./styles/questions.css">
    <title>Questions-Setup</title>
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
            <h2>Quiz Question: <?php echo$total_question ?></h2>
            <form action="./action/questions-setup.php" method="post">
                <div class="form-group">
                    <label for="question">Question:</label>
                    <textarea id="question" name="question" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="option1">Option 1:</label>
                    <input type="text" id="option1" name="option1" required>
                </div>
                <div class="form-group">
                    <label for="option2">Option 2:</label>
                    <input type="text" id="option2" name="option2" required>
                </div>
                <div class="form-group">
                    <label for="option3">Option 3:</label>
                    <input type="text" id="option3" name="option3" required>
                </div>
                <div class="form-group">
                    <label for="option4">Option 4:</label>
                    <input type="text" id="option4" name="option4" required>
                </div>
                <div class="form-group">
                    <label for="answer">Correct Answer:</label>
                    <select id="answer" name="answer" required>
                        <option value="">Select an option</option>
                        <option value="option_1">option_1</option>
                        <option value="option_2">option_2</option>
                        <option value="option_3">option_3</option>
                        <option value="option_4">option_4</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="marks">Marks:</label>
                    <input type="text" id="marks" name="marks" required>
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
    </main>
</body>
</html>