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
    <script src="../public/js/jquery.min.js"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <title>Creation Lab</title>
</head>

<body>
<nav id="nav" class="navbar">
    <div class="logo row">
        <div class="red_line-nav col"></div>
        <a href="../index.php" class="ml-5 mr-5" ><img src="../public/image/Creation_Lab.png" class="logo-creation_lab" alt="logo_creationLab" width="350" height="180"></a>
        <div class="red_line-nav col"></div>
    </div>
    <div class="button-menu d-flex m-2">
        <a href="../users/profil.php"><i class="fas fa-user m-2" data-toggle="tooltip" data-placement="top" title="Profil"></i></a>
        <a href="../public/project.php"><i class="fas fa-bookmark m-2" data-toggle="tooltip" data-placement="top" title="Favoris"></i></a>
        <a href="../public/new_project.php"><i class="fas fa-plus-circle m-2" data-toggle="tooltip" data-placement="top" title="Nouveaux projet"></i></a>
        <a href="../app/deco.php"><i class="fas fa-sign-out-alt m-2" data-toggle="tooltip" data-placement="top" title="Déconnexion"></i></a>
    </div>
    <div class="search_bar">
        <form class="" action="../public/search.php" method="get">
            <div class="input-group md-form form-sm form-2 pl-0">
                <input class="form-control my-0 py-1 lime-border search-field" type="text" placeholder="recherche" name="q" id="search" required>
                <div class="input-group-append">
                    <span class="input-group-text"><button class="submit-button" type="submit"><i class="fas fa-search"></i></button></span>
                </div>
            </div>
        </form>
    </div>
</nav>


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
<script src="../public/js/bootstrap.bundle.min.js"></script>
<script src="../public/js/font_awesome.js"></script>
</body>
</html>
