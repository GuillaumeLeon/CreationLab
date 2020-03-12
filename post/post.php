<?php
require '../database/db.php';
session_start();

if ($_SESSION['connected'] != 1) {
    header('Location:index.php');
    exit;
}
if (!isset($_GET['post'])){
    header('Location:../index.php');
    exit;
}
$id = $_GET["post"];

$get_post = $db->prepare("SELECT * FROM post_text WHERE post_id='$id'");
$get_post->execute();
$post = $get_post->fetchAll();

$get_com = $db->prepare("SELECT * FROM comment WHERE post_id='$id' ORDER BY created_at");
$get_com->execute();
$com = $get_com->fetchAll();
$_SESSION['post'] = $post;

$get_suite = $db->prepare("SELECT * FROM post_text WHERE parent_node='$id'");
$get_suite->execute();
$suite = $get_suite->fetch();

$post_id = $post[0]['post_id'];

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
    <link rel="icon" href="../public/image/favicon.ico" />
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
    <title><?= $post[0]['post_name']; ?></title>
</head>

<body>
<nav class="navbar">
    <div class="logo row">
        <div class="red_line-nav col"></div>
        <a href="../index.php" class="ml-5 mr-5" ><img src="../public/image/Creation_Lab.png" class="logo-creation_lab" alt="logo_creationLab" width="350" height="180" ></a>
        <div class="red_line-nav col"></div>
    </div>
    <div class="button-menu d-flex flex-row row m-2">
        <a href="../users/profil.php"><img class="m-2" src="../public/image/user.png" alt="user" width="45" height="45"></a>
        <a href="../public/project.php"><img class="m-2" src="../public/image/star.png" alt="" width="45" height="45"></a>
        <a href="../public/new_project.php"><img class="m-2" src="../public/image/cross.png" alt="" width="45" height="45"></a>
        <a href="../deco.php"><img class="m-2" src="../public/image/door.svg" alt="deconnexion" width="45" height="45"/></a>
    </div>
</nav>

<div id="menu">
    <div class="red_line"></div>
    <div class="yellow_line"></div>
    <div class="blue_line"></div>
    <nav class="menu text-center">
        <ul>
            <li class="deroulant"><a href="#"> Mon profil </a>
                <ul class="sous text-center">

                    <li id="firstli"> <a href="../users/profil.php"> Profil Détaillé </a></li>
                    <li> <a href="../public/user_project.php"> Mes projets </a></li>
                    <li> <a href="#"> Abonnements </a></li>
                    <li> <a href="#"> Mes projets préféres </a></li>
                    <li> <a href="#"> Aléatoire </a></li>
                </ul>
            </li>
            <li><a href="#"> Abonnements </a></li>
            <li><a href="#"> Tendances </a></li>
            <li><a href="#"> Nouveautés </a></li>
        </ul>

    </nav>
    <div class="red_line"></div>
    <div class="yellow_line"></div>
    <div class="blue_line"></div>
</div>

<div class="container row post mt-3 mb-3">
    <div class="corps">
        <div class="info" style="justify-content: space-between">
            <div class="vote">
                <button type="button" class="btn btn-light upvote" id="<?= $post[0]['post_id'] ?>" onclick="upvote(this.id)"><img src="../public/image/arrow_up.svg" alt="upvote"></button>
                <div class="numberVote"><?= $upvote_nb[0] - $downvote_nb[0] ?></div>
                <button type="button" class="btn btn-light downvote" id="<?= $post[$i]['post_id'] ?>" onclick="downvote(this.id)"><img src="../public/image/arrow_down.svg" alt="downvote"></button>
            </div>
            <?= "Crée par " . $post[0]['author'] . " le " . $post[0]['date_post']; ?>
        </div>
        <div class="title">
            <h1><?= $post[0]['post_name'] ?></h1>
        </div>
        <div class="contenue p-4">
            <?= $post[0]['contenue'] ?>
        </div>

        <div class="interaction">
            <?php if($suite == false) {?>
                <button type="button" class="btn btn-light">Partager</button>
                <a href="../public/suite.php?post=<?= $post[0]['post_id']; ?>"><button type="button" class="btn btn-light">Continuer l'histoire</button></a>
            <?php }?>

        </div>
    </div>
</div>
<?php if($suite != false) {?>
    <div class="container row post mt-3 mb-3">
        <div class="corps">
            <div class="info">
                <?= "Crée par " . $suite['author'] . " le " . $suite['date_post']; ?>
            </div>
            <div class="title">
                <h1><?=  $suite['post_name'] ?></h1>
            </div>
            <div class="contenue p-4">
                <?=  $suite['contenue'] ?>
            </div>
            <div class="interaction">
                <button type="button" class="btn btn-light">Partager</button>
                <a href="../public/suite.php?post=<?= $suite['post_id']; ?>"><button type="button" class="btn btn-light">Continuer l'histoire</button></a>
            </div>
        </div>
    </div>
<?php } ?>
<div class="container add_comment">
    <form action="../comment.php" method="POST">
        <textarea class="form-control add_comment mb-1" id="com_content" name="com_content" placeholder="Commentez !!" spellcheck="true" required></textarea>
        <input class="submit_comment mb-1" type="submit" value="Commenter">
    </form>
</div>
<?php if (!empty($com)) {
    for ($i = 0; $i < count($com)  ; $i++) {
        ?>
        <div class="container comment mb-3" >
            <div class="info_bar">
                <p> Crée le <?= $com[$i]['created_at'] . " par " . $com[$i]['author']; ?></p>
            </div>
            <div class="content">
                <p><?= $com[$i]['content']; ?></p>
            </div>
            <!--
            <form action="replies.php" method="POST">
                <input id="content_com" type="text" style="display: none">
                <input class="send_but" type="submit" value="Répondre" name="answer" style="display: none">
            </form>
             <button class="replies" onclick="comment();">Répondre</button>-->
        </div>
    <?php }
}
?>
<?php include '../includes/footer.php';?>
<script>
    function upvote() {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../vote.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function(){
            if(xhr.status === 200) {
            } else if(xhr.status !== 200){
            }
        };
        xhr.send("voteType=upvote&post_id=<?= $post[0]['post_id']?>");
    }
    function downvote() {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../vote.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function(){
            if(xhr.status === 200) {
            } else if(xhr.status !== 200){
            }
        };
        xhr.send("voteType=downvote&post_id=<?= $post[0]['post_id']?>");
    }
</script>
<script src="../public/js/index.js"></script>
</form>
</body>
</html>
