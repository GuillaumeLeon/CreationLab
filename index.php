<?php
include 'database/db.php';
session_start();
if ($_SESSION['connected'] == 1) {
    header("Location:autre.php");
    exit;
} else {
    $_SESSION['connected'] = 0;
}
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
    <button type="button" class="btn btn-light m-1"><a href="inscription.php">Inscription</a></button>
    <button type="button" class="btn btn-light m-1"><a href="connexion.php">Connexion</a></button>
    <span class="logo"><a href="index.php"><img src="image/Creation_Lab.png" alt="logo_creationLab" width="149"
	  height="71"></a></span>
  </nav>
<?php
$get_post = $db->prepare('SELECT * FROM post_text');
$get_post->execute();
$post = $get_post->fetchAll();
?>
</div>
<?php 
for ($i = count($post) - 1; $i >= 0; $i--) {
	include('partials/data_not_connected.php');
 }?>
<?php include 'partials/footer.php';?>
</body>
</html>
