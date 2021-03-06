<?php
session_start();
if (isset($_SESSION['connected']) && $_SESSION['connected'] == 1) {
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
<nav class="navbar mb-2">
    <div class="logo row">
        <div class="red_line-nav col"></div>
        <a href="index.php" class="ml-5 mr-5" ><img src="image/Creation_Lab.png" class="logo-creation_lab" alt="logo_creationLab" width="350" height="180"></a>
        <div class="red_line-nav col"></div>
    </div>

</nav>
<div class="red_line"></div>
<div class="yellow_line"></div>
<div class="blue_line"></div>

<div class="main">
    <form class="inscription mt-3" action="../app/connexion_confirm.php" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Adresse Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Mot de passe </label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <?php
        if (isset($_SESSION['login_error'])) {
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <!-- <div class="container-fluid"> -->
                <div class="alert-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
                <b>Attention ! Mot de passe ou adresse email incorrect </b>
                <!-- </div> -->
            </div>
            <?php
        }
        unset($_SESSION['login_error']);
        ?>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>

</div>
<?php include '../includes/footer.php';?>
<script src="js/font_awesome.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
