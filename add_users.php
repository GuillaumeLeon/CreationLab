<?php
require "database/db.php";
session_start();
if ($_SESSION['connected'] == 0) {
    if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
    } else {
        header("Location:inscription.php");
        exit;
    }
} else {
    header("Location:inscription.php");
    exit;
}

$password = hash('sha256', $password);
$add_users = $db->prepare("INSERT INTO users (username, password, email) VALUE (?,?,?)");
$add_users->execute(array($username, $password, $email));

header("Location:connexion.php");
