<?php
session_start();
include "function.php";

//menangkap data yang dikirim dari form login
$username=$_POST["username"];
$password=$_POST["password"];

$query=mysqli_query($connection,"SELECT * FROM user WHERE username='$username' AND password='$password'");

$cek=mysqli_num_rows($query); //melakukan pencocokan
if($cek==TRUE)
{
        $_SESSION['username']=$username; 
        header("location:home.php"); 
}
else
{
        echo '<p align="center">Login Gagal</p>';
        echo '<meta http-equiv="refresh" content="2;url=login.html">';
}
?>