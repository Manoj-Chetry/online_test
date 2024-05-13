<?php

session_start();

if($_SESSION['id']==NULL){
    header("location: ../../login.html");
}

require "../../config/dbconfig.php";

$test_id = $_GET['search'];

$query = "Select * from test where test_id='$test_id';";

$sql = mysqli_query($con, $query);
$found = mysqli_num_rows($sql);


if($found==0){
    echo "<script>alert('No such test found')</script>";
    header("refresh:1; url=../home.php?testname=0&totalquestions=0&marks=0&test=0");
}else{
    $row = mysqli_fetch_assoc($sql);
    $test_name = $row['test_name'];
    $marks = $row['total_marks'];
    $totalquestion = $row['total_questions'];
    header("refresh:1; url=../home.php?testname=$test_name&totalquestions=$totalquestion&marks=$marks&test=$test_id");
}



?>