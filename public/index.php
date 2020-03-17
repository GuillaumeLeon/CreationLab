<?php
include '../database/db.php';
session_start();
if(isset($_SESSION['connected'])) {
    if ($_SESSION['connected'] == 1) {
        header("Location:autre.php");
        exit;
    } else {
        $_SESSION['connected'] = 0;
    }
}
$get_post = $db->prepare('SELECT author,date_post,post_id,contenue,post_name FROM post_text ORDER BY date_post DESC');
$get_post->execute();
$post = $get_post->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="image/favicon.ico"/>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Creation Lab</title>
</head>

<body>
<nav class="navbar">
    <div class="logo row">
        <div class="red_line-nav col"></div>
        <a href="index.php" class="ml-5 mr-5" ><img src="image/Creation_Lab.png" class="logo-creation_lab" alt="logo_creationLab" width="350" height="180" ></a>
        <div class="red_line-nav col"></div>
    </div>
    <div class="button">
        <button type="button" class="btn btn-outline-primary m-1"><a href="inscription.php">Inscription</a></button>
        <button type="button" class="btn btn-outline-primary m-1"><a href="connexion.php">Connexion</a></button>
    </div>
</nav>
<div class="red_line"></div>
<div class="yellow_line"></div>
<div class="blue_line"></div>
<?php

for ($i = count($post) - 1; $i >= 0; $i--) {
    include('../includes/data_not_connected.php');
}
?>

}?>
<?php include '../includes/footer.php';?>
<script src="js/font_awesome.js"></script>
</body>
</html>
