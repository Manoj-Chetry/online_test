<?php
session_start();

if($_SESSION['id']==NULL){
    header("location: ../login.html");
}

require "../../config/dbconfig.php";

$id = $_SESSION['id'];

$total_question = $_POST['total_question'];
$total_marks = $_POST['total_marks'];
$duration = $_POST['duration'];
$test_name = $_POST['test_name'];

$unique = uniqid($id);
$unique2 = uniqid($test_name);
$test_id = $unique.$unique2;

$_SESSION['test_id'] = $test_id;

$_SESSION['total_question'] = $total_question;

$query = "insert into test (test_id,test_name,total_questions, total_marks, duration, organizer) values ('$test_id','$test_name','$total_question','$total_marks','$duration','$id')";
$sql = mysqli_query($con, $query);


if(!$sql){
    echo "<script>alert('Failed')</script>";
    header("refresh:1; url=questions-setup.php");
}else{
    echo "<script>alert('Successful $test_id')</script>";
    header("refresh:1; url=../questions-setup.php");
}


?>