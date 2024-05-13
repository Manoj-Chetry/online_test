<?php
session_start();
if($_SESSION['id']==NULL){
    header("location: ../login.html");
}

require "../../config/dbconfig.php";

$id = $_SESSION['id'];
$name = $_SESSION['name'];
$test_id = $_SESSION['test_id'];
$total_question = (int)$_SESSION['total_question'];

$question = $_POST['question'];
$option1 = $_POST['option1'];
$option2 = $_POST['option2'];
$option3 = $_POST['option3'];
$option4 = $_POST['option4'];
$answer = $_POST['answer'];
$marks = $_POST['marks'];

$query = "insert into question (question_id,test,question,option_1,option_2,option_3,option_4,answer,marks) values (NULL,'$test_id','$question','$option1','$option2','$option3','$option4','$answer','$marks');";
$sql = mysqli_query($con, $query);

if(!$sql){
    echo "<script>alert('Failed to create question')</script>";
    header("refresh:1; url=questions-setup.php");
}else{
    echo "<script>alert('Successfully created question')</script>";
    $total_question = $total_question - 1;
    if($total_question==0){
        unset($_SESSION['test_id']);
        unset($_SESSION['total_question']);
        echo "<script>alert('Test Creation Completed')</script>";
        header("refresh:1; url=../test.php");
    }else{
        $_SESSION['total_question'] = $total_question;
        header("refresh:1; url=../questions-setup.php");
    }
}

?>