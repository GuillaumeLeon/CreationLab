<?php
require '../database/db.php';

session_start();
if ($_SESSION['connected'] != 1) {
    header('Location:index.php');
}

$query = "SELECT * FROM post_text WHERE author='" . $_SESSION['username'] . "'";
$get_post = $db->prepare($query);
$get_post->execute();
$post = $get_post->fetchAll();
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
        <a href="index.php" class="ml-5 mr-5" ><img src="image/Creation_Lab.png" class="logo-creation_lab" alt="logo_creationLab" width="350" height="180"></a>
        <div class="red_line-nav col"></div>
    </div>
    <div class="button-menu d-flex m-2">
        <a href="../users/profil.php"><img class="m-2" src="image/user.png" alt="user" width="45" height="45"></a>
        <a href="project.php"><img class="m-2" src="image/star.png" alt="" width="45" height="45"></a>
        <a href="new_project.php"><img class="m-2" src="image/cross.png" alt="" width="45" height="45"></a>
        <a href="../deco.php"><img class="m-2" src="image/door.svg" alt="deconnexion" width="45" height="45"/></a>
    </div>
    <div class="search_bar">
        <form class="" action="search.php" method="GET">
            <div class="md-form mt-0">
                <input class="form-control search-field" type="text" placeholder="recherche" name="search" id="search" required>
                <button class="submit-button" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>
</nav>

<?php include '../includes/menu.php';?>
<h1>Voici vos projets</h1>
<?php for ($i = count($post) - 1; $i >= 0; $i--) {
    include '../includes/data_connected.php';
}?>
<?php include '../includes/footer.php';?>
<script src="js/font_awesome.js"></script>
</body>
</html>
