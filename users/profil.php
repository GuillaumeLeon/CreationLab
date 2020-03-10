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
  <link rel="icon" href="../public/image/favicon.ico" />
  <link rel="stylesheet" href="../public/css/bootstrap.min.css">
  <link rel="stylesheet" href="../public/css/style.css">
  <title>Creation Lab</title>
</head>

<body>
<nav class="navbar">
    <div class="logo row">
	<div class="red_line-nav col"></div>
       <a href="../index.php" class="ml-5 mr-5" ><img src="../public/image/Creation_Lab.png" class="logo-creation_lab" alt="logo_creationLab" width="350" height="180"></a>
	<div class="red_line-nav col"></div>
    </div>
    <div class="button-menu d-flex flex-row row m-2">
	<a href="../users/profil.php"><img class="m-2" src="../public/image/user.png" alt="user" width="45" height="45"></a>
	<a href="project.php"><img class="m-2" src="../public/image/star.png" alt="" width="45" height="45"></a>
	<a href="new_project.php"><img class="m-2" src="../public/image/cross.png" alt="" width="45" height="45"></a>
	<a href="../deco.php"><img class="m-2" src="../public/image/door.svg" alt="deconnexion" width="45" height="45"/></a>
    </div></nav>
<?php include '../includes/menu.php';?>
<div class="main">
    <h1> Profil </h1>
<div class="container" style="display:flex;">
    <img src="https://via.placeholder.com/150x250" alt="photoprofile" id="photoprofil" height='250' width='150' class="m-5">
<div class="profil" class="ml-5">
<table class="content-profil">
   <tr>
      <th><p>Pseudo : <?= $result[0]['username'] ?></p></th>
      <th><input type="button" value="Modifier" class="modifier"></th>
   </tr>
<tr>
   <th><p>Nom : <?= $result[0]['name'] ?></p></th>
   <th><input type="button" value="Modifier" class="modifier"></th>
</tr>
<tr>
   <th><p>Prenom : <?= $result[0]['surname'] ?></p></th>
   <th><input type="button" value="Modifier" class="modifier"> </th>
</tr>
<tr>
   <th><p>Email : <?= $result[0]['email'] ?></p></th>
   <th><input type="button" value="Modifier" class="modifier"></th>
</tr>
<tr>
   <th><p>Description :<br/> <?= $result[0]['desc'] ?> </th>
   <th><input type="button" value="Modifier" class="modifier"></th>
</tr>
<tr>
   <th><p>Nombre abonnés : <?= $result[0]['nb_follower'] ?></p></th>
</tr>
<tr>
   <th><p>Nombre abonnements : <?= $result[0]['nb_sub'] ?></p></th>
</tr>
<tr>
<th> <p>Site internet : <?php if(isset($result[0]['website_url'])) {
echo "<a href='http://" . $result[0]['website_url'] . "' target='_blank'>" . $result[0]['website_url'] . "</a>";
}?> </th>
   <th><input type="button" value="Modifier" class="modifier"> </p></th>
</tr>
</table>
  </div>
  </div>
</div>
<?php include '../includes/footer.php';?>
</body>
</html>
