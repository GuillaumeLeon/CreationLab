<?php
require '../database/db.php';

session_start();
if ($_SESSION['connected'] != 1) {
    header('Location:index.php');
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="image/favicon.ico" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Creation Lab</title>
</head>

<body>
<nav class="navbar">
    <div class="logo row">
        <div class="red_line-nav col"></div>
        <div class="col"><a href="index.php" style="grid-column: 1"><img src="image/Creation_Lab.png" class="logo-creation_lab" alt="logo_creationLab" width="350" height="180" ></a></div>
        <div class="red_line-nav col"></div>
    </div>
    <div class="button">
        <button type="button" class="btn btn-light"><a href="new_project.php">Créer un nouveau projet</a></button>
        <a href="../deco.php"><button type="button" class="btn btn-light">Déconnexion</button></a>
    </div>
</nav>
<?php include '../includes/menu.php';?>
<?php
$query = "SELECT * FROM post_text WHERE author='" . $_SESSION['username'] . "'";
$get_post = $db->prepare($query);
$get_post->execute();
$post = $get_post->fetchAll();
?>
</div>
<h1>Voici vos projets</h1>
<?php for ($i = count($post) - 1; $i >= 0; $i--) {
    include '../includes/data_connected.php';
}?>
<?php include '../includes/footer.php';?>
<script src="https://kit.fontawesome.com/f6b4bd03ce.js" crossorigin="anonymous"></script>
</body>
</html>
