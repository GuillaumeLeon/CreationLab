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
    <div class="vote text-center">
        <a href="connexion.php"><button type="button" class="btn btn-light upvote"><img src="image/arrow_up.svg" alt="upvote"></button></a>
        <div class="numberVote"><?= $upvote_nb[0] - $downvote_nb[0] ?></div>
        <a href="connexion.php"><button type="button" class="btn btn-light downvote"><img src="image/arrow_down.svg" alt="downvote"></button></a>
    </div>

    <div class="corps">
        <div class="info">
            <?= "Crée par " . $post[$i]['author'] . " le " . $post[$i]['date_post']; ?>
        </div>
        <div class="title">
            <?= $post[$i]['post_name'] ?>
        </div>
        <div class="contenue">
            <?= $post[$i]['contenue'] ?>
        </div>
        <div class="interaction">
            <a href="connexion.php"><button type="button" class="btn btn-light">Commenter</button></a>
            <button type="button" class="btn btn-light">Partager</button>
            <a href="connexion.php"><button type="button" class="btn btn-light">Continuer l'histoire</button></a>
        </div>
    </div>
</div>