<?php
session_start();
ob_start();
include 'function.php';
if (empty($_SESSION['username']) or empty($_SESSION['password'])) {
    echo "<p align='center'>Anda Harus Login Terlebih dahulu!</p>";
    echo "<meta http-equiv='refresh' content='2;url=login.php'>";
} else {
    define('INDEX', true);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <div class="main">
        <div class="navbar">
            <label class="logo">Sekha School</label>
            <ul>
                <li>
                    <a href="#">Home</a>
                </li>
                <li>
                    <a href="#">Add List</a>
                </li>
                <li>
                    <a href="#">Log out</a>
                </li>
            </ul>
        </div>
        
    </div>
</body>
</html>