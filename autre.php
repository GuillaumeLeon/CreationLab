<?php
require 'db.php';

session_start();
var_dump($_SESSION['connected']);
if ($_SESSION['connected'] != 1) {
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
	<span><button type="button" class="btn btn-light"><a href="new_project.php">Créer un nouveau projet</a></button></span>
    <span class="logo"><a href="index.php"><img src="image/Creation_Lab.png" alt="logo_creationLab" width="149"
						height="71"></a></span>
    <span><a href="deco.php"><button type="button" class="btn btn-light">Déconnexion</button></a></span>
</nav>
<?php
$get_post = $db->prepare('SELECT * FROM post_text');
$get_post->execute();
$post = $get_post->fetchAll();

?>
</div>
<?php for ($i = count($post)-1; $i >= 0 ; $i--) {?>
<div class="container row post mt-5">
    <div class="vote text-center">
	<button type="button" class="btn btn-light"><img src="image/arrow_up.svg" alt="upvote"></button>
	<div class="numberVote"><?php echo ($post[$i]['upvote'] - $post[$i]['downvote']) ?></div>
	<button type="button" class="btn btn-light"><img src="image/arrow_down.svg" alt="downvote"></button>
	</div>
    <div class="corps">
	<div class="info">
	   <?php echo "Crée par " . $post[$i]['author'] . " le " . $post[$i]['date_post']; ?>
	</div>
	<div class="title">
	    <?php echo $post[$i]['post_name'] ?>
	</div>
	<div class="contenue">
	   <?php echo $post[$i]['contenue'] ?>
	</div>
	<div class="interaction">
	    <button type="button" class="btn btn-light">Commenter</button>
	    <button type="button" class="btn btn-light">Partager</button>
	    <button type="button" class="btn btn-light">Continuer l'histoire</button>
	</div>
	</div>
</div>
<?php }?>
</body>
</html>
