<?php
require '../database/db.php';
require '../vendor/autoload.php';

session_start();
if ($_SESSION['connected'] != 1) {
    header('Location:index.php');
}

$get_user = $db->prepare("SELECT * FROM users WHERE username='".$_SESSION['username']."'");
$get_user->execute();
$user = $get_user->fetch();

$get_post = $db->prepare("SELECT * FROM post_text WHERE author='" . $_SESSION['username'] . "' AND parent_node IS NULL ORDER BY date_post DESC");
$get_post->execute();
$post = $get_post->fetchALL(PDO::FETCH_ASSOC);
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
    <script src="js/jquery.min.js"></script>
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
	<a href="index.php" class="ml-5 mr-5" ><img src="image/Creation_Lab.png" class="logo-creation_lab" alt="logo_creationLab" width="350" height="180"></a>
	<div class="red_line-nav col"></div>
    </div>
    <div class="button-menu d-flex m-2">
	<a href="../users/profil.php"><i class="fas fa-user m-2" data-toggle="tooltip" data-placement="top" title="Profil"></i></a>
	<a href=fav_post.php><i class="fas fa-bookmark m-2" data-toggle="tooltip" data-placement="top" title="Favoris"></i></a>
	<a href="new_project.php"><i class="fas fa-plus-circle m-2" data-toggle="tooltip" data-placement="top" title="Nouveaux projet"></i></a>
	<a href="../app/deco.php"><i class="fas fa-sign-out-alt m-2" data-toggle="tooltip" data-placement="top" title="Déconnexion"></i></a>
    </div>
    <div class="search_bar">
	<form class="" action="search.php" method="GET">
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
<h1>Voici vos projets</h1>
<?php
foreach ($post as $value) {
    include '../includes/data_connected.php';
}
?>
<button id="back2Top" class="btn btn-primary btn-lg back-to-top" onclick="window.scroll(0,0);" data-toggle="tooltip" data-placement="top" title="Retour en hauts"><i class="fa fa-arrow-up"></i></button>
<?php include '../includes/footer.php';?>

<script src="js/index.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/font_awesome.js"></script>
</body>
</html>
