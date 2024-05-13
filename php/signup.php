<?php
require "../config/dbconfig.php";


$type = $_POST['type'];
$name = mysqli_escape_string($con, $_POST['name']);
$email = mysqli_escape_string($con, $_POST['email']);
$phone = mysqli_escape_string($con, $_POST['phone']);
$password = mysqli_escape_string($con, $_POST['password']);

if($type=="user"){
    $check_query = "select user_id from user where email='$email'";
}else{
    $check_query = "select organizer_id from organizer where email='$email'";
}

$check = mysqli_query($con, $check_query);

$row = mysqli_num_rows($check);

if($row>0){
    echo "<script>alert('User Already Registered with the email $email')</script>";
    header("refresh:1; url=../login.html");
}else{
    if($type=="user"){
        $query = "insert into user (user_id,name,email,phone,password) values (NULL, '$name', '$email', '$phone', '$password')";
    }else{
        $query = "insert into organizer (organizer_id,name,email,phone,password) values (NULL, '$name', '$email', '$phone', '$password')";
    }
    
    $sql = mysqli_query($con, $query);
    
    if(!$sql){
        echo "<script>alert('SignUp Failed')</script>";
        header("refresh:1; url=../signup.html");
    }else{
        echo "<script>alert('Registered $type Successfully')</script>";
        header("refresh:1; url=../login.html");
    }    

}

?>