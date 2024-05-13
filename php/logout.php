<?php
session_start();
if($_SESSION['id']==NULL){
    header("location: ../login.html");
}
session_destroy();

echo "<script>alert('Logged-Out Successfully')</script>";
header("refresh:1; url=../login.html");


?>