<?php
session_start();
var_dump($_SESSION['connected']);
if($_SESSION['connected'] == 1) {
  header("Location:autre.php");
  exit;
} else {
  $_SESSION['connected'] = 0;
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
    <span class="logo"><a href="index.php"><img src="image/Creation_Lab.png" alt="logo_creationLab" width="149"
          height="71"></a></span>
    <span class="gp-bt-log"><button><a href="inscription.php">Inscription</a></button><button><a
          href="connexion.php">Connexion</a></button></span>
  </nav>

</body>

</html>