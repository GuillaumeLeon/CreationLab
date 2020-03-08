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
    </nav>
    <div class="main">
    <form class="inscription mt-3" action="../connexion_confirm.php" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Adresse Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Mot de passe </label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <button type="submit" class="btn btn-light">Envoyer</button>
    </form>
</div>
  <?php include '../includes/footer.php';?>
    <script src="https://kit.fontawesome.com/f6b4bd03ce.js" crossorigin="anonymous"></script>
</body>

</html>
