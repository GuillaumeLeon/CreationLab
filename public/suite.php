<?php
require '../database/db.php';
session_start();
if(isset($_GET['post'])){
    $post_id = $_GET['post'];
}
if ($_SESSION['connected'] != 1) {
    header('Location:index.php');
    exit;
}
$get_post = $db->prepare("SELECT * FROM post_text WHERE post_id='$post_id'");
$get_post->execute();
$post = $get_post->fetchAll();
$_SESSION['post_id'] = $post_id;
$get_upvote = $db->prepare("SELECT count(id) as upvote_nb FROM upvote WHERE post_id='$post_id'");
$get_upvote->execute();
$upvote_nb = $get_upvote->fetch();

$get_downvote = $db->prepare("SELECT count(id) as downvote_nb FROM downvote WHERE post_id='$post_id'");
$get_downvote->execute();
$downvote_nb = $get_downvote->fetch();
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
    <title><?= $post[0]['post_name'] ?></title>
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
        <form action="search.php" method="get">
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

<div class="container row post mt-3 mb-3">
    <div class="corps">
        <div class="info" style="justify-content: space-between">
            <div class="vote">
                <button type="button" class="btn btn-light upvote" id="<?= $post[0]['post_id'] ?>" onclick="upvote(this.id)"><img src="image/arrow_up.svg" alt="upvote"></button>
                <div class="numberVote"><?= $upvote_nb[0] - $downvote_nb[0] ?></div>
                <button type="button" class="btn btn-light downvote" id="<?= $post[0]['post_id'] ?>" onclick="downvote(this.id)"><img src="image/arrow_down.svg" alt="downvote"></button>
            </div>
            <?= "Crée par " . $post[0]['author'] . " le " . $post[0]['date_post']; ?>
        </div>
        <div class="title">
            <h1><?= $post[0]['post_name'] ?></h1>
        </div>
        <div class="contenue p-4">
            <?= $post[0]['contenue'] ?>
        </div>
    </div>
</div><div class="main">
    <div class="container" id="form_text">
        <form action="../add_suite.php" method="post">
            <div class="form-group">
                <label for="contenue">Ecrivez votre histoire :</label>
                <textarea class="form-control" name="content" id="content" rows="20" spellcheck="true" role="textbox" maxlength='280'></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>

    <?php include '../includes/footer.php';?>
    <script src="js/font_awesome.js"></script>
</body>
</html>


