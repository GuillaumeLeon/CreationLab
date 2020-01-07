<?php
session_start(); 
var_dump($_SESSION['connected']);
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
    <span><a href="deco.php"><button>Déconnexion</button></a></span>
  </nav>
<?php 

?>

<div class="container post">
  <div class="vote">
    <button class="upvote"></button>
    <div class="numberVote">30</div>
    <button class="downvote"></button>
  </div>
<div class="corps">
  <div class="info">
  info (auteur, date)
  </div>
  <div class="title">
    titre
  </div>
  <div class="contenue"></div>
</div>
  </div>
</div>
</body>

</html>