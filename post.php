<?php
require 'database/db.php';
session_start();

if ($_SESSION['connected'] != 1) {
header('Location:index.php');
}
$title = $_GET["post"];
$title = str_replace('_', ' ', $title);
$get_post = $db->prepare("SELECT * FROM post_text WHERE post_name='$title'");
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
    <span><a href="new_project.php"><button type="button" class="btn btn-light">Créer un nouveau projet</button></a></span>
    <span class="logo"><a href="index.php"><img src="image/Creation_Lab.png" alt="logo_creationLab" width="149"
                                                height="71"></a></span>
    <span><a href="deco.php"><button type="button" class="btn btn-light">Déconnexion</button></a></span>
</nav>
<?php include 'partials/menu.php';?>

<div class="container row post mt-3 mb-3" style="overflow:hidden;">
    <div class="vote text-center">
        <button type="button" class="btn btn-light"><img src="image/arrow_up.svg" alt="upvote"></button>
        <div class="numberVote"><?php echo ($post[0]['upvote'] - $post[0]['downvote']) ?></div>
        <button type="button" class="btn btn-light"><img src="image/arrow_down.svg" alt="downvote"></button>
    </div>
    <div class="corps">
        <div class="info">
            <?php echo "Crée par " . $post[0]['author'] . " le " . $post[0]['date_post']; ?>
        </div>
        <div class="title">
            <?php echo $post[0]['post_name'] ?>
        </div>
        <div class="contenue">
            <?php echo $post[0]['contenue'] ?>
        </div>
        <div class="interaction">
            <a href="post.php?post=<?php echo $title; ?>"><button type="button" class="btn btn-light">Commenter</button></a>
            <button type="button" class="btn btn-light">Partager</button>
            <button type="button" class="btn btn-light">Continuer l'histoire</button>
        </div>
    </div>
</div>
<?php include 'partials/footer.php';?>
</body>
</html>