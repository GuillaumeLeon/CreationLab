<?php
require '../database/db.php';
require '../vendor/autoload.php';
session_start();
if ($_SESSION['connected'] == 0) {
    if (isset($_POST['email'], $_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
    } else {
        header("Location:public/connexion.php");
        exit;
    }
} else {
    header("Location:public/connexion.php");
    exit;
}

$password = hash('sha256', $password);

$connect = $db->prepare("SELECT password FROM users WHERE email='$email'");
$connect->execute();
$pass = $connect->fetch();

$auth = 1;
if ($password == $pass[0]) {
    $_SESSION['connected'] = 1;
    $get_username = $db->prepare("SELECT username, Uid FROM users WHERE email='$email'");
    $get_username->execute();
    $username = $get_username->fetch();
    $_SESSION['username'] = $username[0];
    $_SESSION['id'] = $username[1];
    header("Location:../public/autre.php");
} else {
    $_SESSION['login_error'] = 1;
    header("Location:../public/connexion.php");
    exit;
}
