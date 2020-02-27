<?php
require 'database/db.php';

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
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/style.css">
    <title>Creation Lab</title>
</head>

<body>
<nav class="navbar">
	<span><button type="button" class="btn btn-light"><a href="new_project.php">Créer un nouveau projet</a></button></span>
    <span class="logo"><a href="index.php"><img src="image/Creation_Lab.png" alt="logo_creationLab" width="149"
						height="71"></a></span>
    <span><a href="deco.php"><button type="button" class="btn btn-light">Déconnexion</button></a></span>
</nav>
<?php include 'partials/menu.php';?>
<?php
$query = "SELECT * FROM post_text WHERE author='" . $_SESSION['username'] . "'";
$get_post = $db->prepare($query);
$get_post->execute();
$post = $get_post->fetchAll();
?>
</div>
<h1>Voici vos projets</h1>
<?php for ($i = count($post) - 1; $i >= 0; $i--) {
include 'partials/data_connected.php';
}?>
<?php include 'partials/footer.php';?>
</body>
</html>
