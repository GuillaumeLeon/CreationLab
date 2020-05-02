<?php
$post_id = $post[$i]['post_id'];
$get_upvote = $db->prepare("SELECT count(id) as upvote_nb FROM upvote WHERE post_id='$post_id'");
$get_upvote->execute();
$upvote_nb = $get_upvote->fetch();

$get_downvote = $db->prepare("SELECT count(id) as downvote_nb FROM downvote WHERE post_id='$post_id'");
$get_downvote->execute();
$downvote_nb = $get_downvote->fetch();
?>
<div class="container row post mt-3 mb-3">
    <div class="corps">
        <div class="info" style="justify-content: space-between">
            <div class="vote ">
                <a href="connexion.php"><button type="button" class="btn btn-light upvote"><i class="fas fa-arrow-up"></i></button></a>
                <div class="numberVote"><?= $upvote_nb[0] - $downvote_nb[0] ?></div>
                <a href="connexion.php"><button type="button" class="btn btn-light downvote"><i class="fas fa-arrow-down"></i></button></a>
            </div>
            <div class="mr-3"><?= "Crée par " . $post[$i]['author'] . " le " . $post[$i]['date_post']; ?></div>
        </div>
        <div class="title">
            <h1><?= $post[$i]['post_name'] ?></h1>
        </div>
        <div class="contenue p-4">
            <?= $post[$i]['contenue'] ?>
        </div>
        <div class="interaction">
            <a href="connexion.php"><button type="button" class="btn btn-light">Commenter</button></a>
            <button type="button" class="btn btn-light">Partager</button>
            <a href="connexion.php"><button type="button" class="btn btn-light">Continuer l'histoire</button></a>
        </div>
    </div>
</div>
