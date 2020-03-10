<?php
session_start();
    if($_SESSION['connected'] == 1) {
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
        <a href="index.php" class="ml-5 mr-5" ><img src="image/Creation_Lab.png" class="logo-creation_lab" alt="logo_creationLab" width="350" height="180" ></a>
        <div class="red_line-nav col"></div>

    </div>
    </nav>
<div class="main">
    <form class="inscription mt-3" action="../add_users.php" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Adresse Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="form-group">
            <label>Nom d'utilisateur</label>
            <input type="username" class="form-control" id="username" name="username">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Mot de passe </label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Confirmer le mot de passe </label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <div class="form-group">
        <input type="checkbox" name="cgu" id="cgu" required>
        <p>En cochant cette case vous acceptez les conditions générals d'utilisation</p>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>
<script src="js/password_validation.js"></script>
<?php include '../includes/footer.php';?>
<script src="js/font_awesome.js"></script>
</body>
</html>
