<?php
require 'database/db.php';
session_start();

if ($_SESSION['connected'] != 1) {
    header('Location:index.php');
}
$user = $_SESSION["username"];
$query = $db->prepare('SELECT * FROM USERS WHERE username="' . $user . '"');
$query->execute();
$result = $query->fetchAll();
?>
<!DOCTYPE.php>
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
    <span class="logo"><a href="index.php"><img src="image/Creation_Lab.png" alt="logo_creationLab" width="149"
	  height="71"></a></span>
  </nav>
<?php include 'partials/menu.php';?>
    <h1> Profil </h1>
<div class="container" style="display:flex;">
    <img src="image/Creation_Lab.png" alt="photoprofile" id="photoprofil" class="m-5">
<div class="profil" class="ml-5">
    <p>Pseudo : <?php echo $result[0]['username'] ?> <input type="button" value="Modifier" class="modifier"></p>
    <p>Nom : <?php echo $result[0]['name'] ?> <input type="button" value="Modifier" class="modifier"> </p>
    <p>Prenom : <?php echo $result[0]['surname'] ?> <input type="button" value="Modifier" class="modifier"> </p>
    <p>Email : <?php echo $result[0]['email'] ?> <input type="button" value="Modifier" class="modifier"> </p>
    <p>Description :<br/> <?php echo $result[0]['desc'] ?> <input type="button" value="Modifier" class="modifier"></p>
    <p>Nombre abonnés : <?php echo $result[0]['nb_follower'] ?></p>
    <p>Nombre abonnements : <?php echo $result[0]['nb_sub'] ?></p>
    <p>Site internet : <?php if (isset($result[0]['website_url'])) {
    echo "<a href='http://" . $result[0]['website_url'] . "' target='_blank'>" . $result[0]['website_url'] . "</a>";
}?> <input type="button" value="Modifier" class="modifier"> </p>
  </div>
  </div>
<?php include 'partials/footer.php';?>
</body>
</html>

