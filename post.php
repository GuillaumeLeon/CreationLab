<?php
require 'database/db.php';
session_start();

if ($_SESSION['connected'] != 1) {
    header('Location:index.php');
}
$id = $_GET["post"];
$get_post = $db->prepare("SELECT * FROM post_text WHERE post_id='$id'");
$get_post->execute();
$post = $get_post->fetchAll();

$get_com = $db->prepare("SELECT * FROM comment WHERE post_id='$id'");
$get_com->execute();
$com = $get_com->fetchAll();

$_SESSION['post'] = $post;
if (empty($post)) {
    header('Location:autre.php');
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
    <title><?php echo $post[0]['post_name']; ?></title>
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
        <button type="button" class="btn btn-light"name="upvote" onclick="upvote()"><img src="image/arrow_up.svg" alt="upvote"></button>
        <div class="numberVote"><?php echo ($post[0]['upvote'] - $post[0]['downvote']) ?></div>
        <button type="button" class="btn btn-light"name="downvote" onclick="downvote()"><img src="image/arrow_down.svg" alt="downvote" ></button>
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
            <button type="button" class="btn btn-light">Partager</button>
            <button type="button" class="btn btn-light">Continuer l'histoire</button>
        </div>
    </div>
</div>
<div class="container add_comment">
    <form action="comment.php" method="POST">
        <textarea class="form-control add_comment mb-1" id="com_content" name="com_content" placeholder="Commentez !!" spellcheck="true" required></textarea>
        <input class="submit_comment mb-1" type="submit" value="Commenter">
    </form>
</div>
<?php if (!empty($com)) {
    for ($i = count($com) - 1; $i > 0 ; $i--) {
        ?>
        <div class="container row comment mb-3" >
            <p class="info"> Crée le <?php echo $com[$i]['created_at'] . " par " . $com[$i]['author']; ?></p>
            <p class="content "><?php echo $com[$i]['content']; ?></p>
            <form action="replies.php" method="POST">
                <input id="content_com" type="text" style="display: none">
                <input class="send_but" type="submit" value="Répondre" name="answer" style="display: none">
            </form>
            <!-- <button class="replies" onclick="comment();">Répondre</button>-->
        </div>
    <?php }
}
?>
<?php include 'partials/footer.php';?>
<script>
    function upvote() {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'vote.php');
        xhr.onload = function(){
            if(xhr.status === 200) {
                console.log('upvote');
            } else if(xhr.status !== 200){
                console.log('c\'est la merde');
            }
        };
        xhr.send("voteType=downvote&post_id=<?php echo $post[0]['post_id']?>");
    }
    function downvote() {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'vote.php');
        xhr.onload = function(){
            if(xhr.status === 200) {
                console.log('downvote');
            } else if(xhr.status !== 200){
                console.log('c\'est la merde');
            }
        };
        xhr.send("voteType=downvote&post_id=<?php echo $post[0]['post_id']?>");
    }
</script>
<script src="js/index.js"></script>
</form>
</body>
</html>
