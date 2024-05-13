<?php
require "../config/dbconfig.php";

$type = $_POST['type'];
$email = mysqli_escape_string($con, $_POST['email']);
$password = mysqli_escape_string($con, $_POST['password']);

if($type=="user"){
    $check_query = "select * from user where email='$email'";
}else{
    $check_query = "select * from organizer where email='$email'";
}

$check = mysqli_query($con, $check_query);

$row = mysqli_num_rows($check);

if($row==0){
    echo "<script>alert('$type not registered: $email')</script>";
    header("refresh:1; url=../signup.html");
}else{
    $result = mysqli_fetch_array($check);
    $pswd = $result['password'];
    if($pswd!=$password){
        echo "<script>alert('Wrong password: $email')</script>";
        header("refresh:1; url=../login.html");
    }else{
        echo "<script>alert('$type Login Successful: $email')</script>";
        session_start();
        $_SESSION['type'] = $type;
        $_SESSION['id'] = ($type=="user")?$result['user_id']:$result['organizer_id'];
        $_SESSION['name'] = $result['name'];
        $_SESSION['email'] = $result['email'];
        $_SESSION['phone'] = $result['phone'];

        ($type=="user")?header("refresh:1; url=../$type/home.php?testname=0&totalquestions=0&marks=0&test=0"):header("refresh:1; url=../$type/home.php");
        
    }
}