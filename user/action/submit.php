<?php
session_start();

if($_SESSION['id']==NULL){
    header("location: ../../login.html");
}

require "../../config/dbconfig.php";

$uid = $_SESSION['id'];
$count = $_POST['count'];
$found = $_POST['found'];
$test_id = $_POST['testid'];
echo $uid;
$total_marks = 0;

for($i=1; $i<=$count; $i=$i+1){
    $qid = $_POST[$i];
    echo" ".$qid;
    $question = $found-$count+$i;
    if(isset($_POST[$question])){
        $respond = $_POST[$question];
    }else{
        $respond = null;
    }

    $query = "insert into response (user, question, respond) values ('$uid', '$qid', '$respond')";
    $sql = mysqli_query($con,$query);

    $q2 = "select marks, answer from question where question_id = '$qid';";
    $sql2 = mysqli_query($con, $q2);

    $row = mysqli_fetch_assoc($sql2); 
    $marks = $row['marks'];
    $response = $row['answer'];

    if($respond==$response){
        $total_marks = $total_marks + $marks;
    }

    
}

    // echo "<script>alert('Thank You. Your test is completed. $total_marks')</script>";
    
    $query = "insert into score (user, test, score) values ('$uid','$test_id','$total_marks');";
    $sql = mysqli_query($con, $query);
    
    if($sql){
        echo "<script>alert('Thank You. Your test is completed.')</script>";
        header("refresh:1; url=../home.php?testname=0&totalquestions=0&marks=0&test=0");
    }



// $query = "Select * from test where test_id='$test_id';";

// $sql = mysqli_query($con, $query);
// $found = mysqli_num_rows($sql);


// if($found==0){
//     echo "<script>alert('No such test found')</script>";
//     header("refresh:1; url=../home.php?testname=0&totalquestions=0&marks=0&test=0");
// }
?>