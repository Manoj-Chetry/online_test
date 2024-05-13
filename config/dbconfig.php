<?php
$servername = "localhost";
$username = "root";
$password = "India@4557";
$database = "testapp";

$con = mysqli_connect($servername,$username,$password,$database);

if(!$con){
    die("Connection Failed".mysqli_connect_error());
}


?>