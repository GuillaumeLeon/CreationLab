<?php
require "database/db.php";
session_start();
if ($_SESSION['connected'] == 0) {
    if (isset($_POST['email'], $_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
    } else {
        header("Location:connexion.php");
        exit;
    }
} else {
    header("Location:connexion.php");
    exit;
}

$password = hash('sha256', $password);

$connect = $db->prepare("SELECT password FROM users WHERE email='$email'");
$connect->execute();
$pass = $connect->fetch();

$auth = 1;
if ($password == $pass[0]) {
    header("Location:autre.php");
} else {
    header("Location:connexion.php");
    exit;
}
$_SESSION['connected'] = 1;

$get_username = $db->prepare("SELECT username FROM users WHERE email='$email'");
$get_username->execute();
$username = $get_username->fetch();
$_SESSION['username'] = $username[0];
