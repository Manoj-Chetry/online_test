<?php

session_start();

if($_SESSION['id']==NULL){
    header("location: ../login.html");
}

require "../config/dbconfig.php";

$test_id = $_GET['test'];

$query = "Select * from question where test='$test_id' order by question_id;";

$sql = mysqli_query($con, $query);
$found = mysqli_num_rows($sql);


if($found==0){
    echo "<script>alert('No questions set yet for this test')</script>";
    header("refresh:1; url=./home.php?testname=0&totalquestions=0&marks=0&test=0");
}else{?>
    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../global.css">
    <link rel="stylesheet" href="styles/test.css">
    <title>Test</title>
</head>
<body>
<div class="container">
        <form action="./action/submit.php" method="post">
            <h2>Test Page</h2>
            <?php
            $count=0;
            while($row=mysqli_fetch_assoc($sql)){
                $question = $row['question'];
                $option1 = $row['option_1'];
                $option2 = $row['option_2'];
                $option3 = $row['option_3'];
                $option4 = $row['option_4'];
                $qid = $row['question_id'];

                $count++;
                $found++;


                echo"<div class='question'>
                <p class='question-text'>$count. $question</p>
                <input type='hidden' name='$count' value='$qid' >
                <div class='options'>

                    <label for='option1'>
                        <input type='radio' id='option1' name='$found' value='option_1'> $option1
                    </label>
                    <label for='option2'>
                        <input type='radio' id='option2' name='$found' value='option_2'> $option2
                    </label>
                    <label for='option3'>
                        <input type='radio' id='option3' name='$found' value='option_3'> $option3
                    </label>
                    <label for='option4'>
                        <input type='radio' id='option4' name='$found' value='option_4'> $option4
                    </label>
                </div>
                </div>"; 
            }
            ?>
            <input type='text' name='count' id="count" value='<?php echo$count?>' style='display: none;'>
            <input type='text' name='found' id="found" value='<?php echo$found?>' style='display: none;'>
            <input type='text' name='testid' id="testid" value='<?php echo$test_id?>' style='display: none;'>

            <button type="submit">Submit</button>

        </form>
</body>
</html>
<?php }

?>