<?php
require '../database/db.php';
session_start();

if ($_SESSION['connected'] != 1) {
    header('Location:index.php');
}
$user = $_SESSION["username"];
$query = $db->prepare("SELECT * FROM users WHERE username='$user'");
$query->execute();
$result = $query->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="../image/favicon.ico" />
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <title>Creation Lab</title>
</head>

<body>
<nav class="navbar">
	<span><a href="../new_project.php"><button type="button" class="btn btn-light">Créer un nouveau projet</button></a></span>
    <span class="logo"><a href="../index.php"><img src="../image/Creation_Lab.png" alt="logo_creationLab" width="149"
                                                   height="71"></a></span>
    <span><a href="../deco.php"><button type="button" class="btn btn-light">Déconnexion</button></a></span>
</nav>
<?php include '../includes/menu.php';?>
<div class="main">
    <h1> Profil </h1>
<div class="container" style="display:flex;">
    <img src="https://via.placeholder.com/150x250" alt="photoprofile" id="photoprofil" height='250' width='150' class="m-5">
<div class="profil" class="ml-5">
    <p>Pseudo : <?=  $result[0]['username'] ?> <input type="button" value="Modifier" class="modifier"></p>
    <p>Nom : <?=  $result[0]['name'] ?> <input type="button" value="Modifier" class="modifier"> </p>
    <p>Prenom : <?=  $result[0]['surname'] ?> <input type="button" value="Modifier" class="modifier"> </p>
    <p>Email : <?=  $result[0]['email'] ?> <input type="button" value="Modifier" class="modifier"> </p>
    <p>Description :<br/> <?=  $result[0]['desc'] ?> <input type="button" value="Modifier" class="modifier"></p>
    <p>Nombre abonnés : <?=  $result[0]['nb_follower'] ?></p>
    <p>Nombre abonnements : <?=  $result[0]['nb_sub'] ?></p>
    <p>Site internet : <?php if (isset($result[0]['website_url'])) {
    echo "<a href='http://" . $result[0]['website_url'] . "' target='_blank'>" . $result[0]['website_url'] . "</a>";
}?> <input type="button" value="Modifier" class="modifier"> </p>
  </div>
  </div>
</div>
<?php include '../includes/footer.php';?>
</body>
</html>
