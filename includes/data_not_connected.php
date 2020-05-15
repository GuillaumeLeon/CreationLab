<?php
$post_id = $value['post_id'];
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
            <div class="vote">
                <a href="connexion.php"><button type="button" class="btn btn-light upvote"><i class="fas fa-arrow-up"></i></button></a>
                <div class="numberVote"><?= $upvote_nb[0] - $downvote_nb[0] ?></div>
                <a href="connexion.php"><button type="button" class="btn btn-light downvote"><i class="fas fa-arrow-down"></i></button></a>
            </div>
            <div class="mr-3"><?= "Crée par " . $value['author'] . " le " . $value['date_post']; ?></div>
        </div>
        <div class="title">
            <h1><?= $value['post_name'] ?></h1>
        </div>
        <div class="contenue p-4">
            <?= $value['contenue'] ?>
        </div>
        <div class="interaction">
            <a href="connection.php"><i class="fas fa-comments ml-3" data-toggle="tooltip" data-placement="top" title="Commentez" style="font-size:30px"></i> </a>
            <a href="#"><i class="fas fa-share ml-3" data-toggle="tooltip" data-placement="top" title="Partager" style="font-size:30px"></i></a>
            <a href="connection.php"><i class="far fa-bookmark ml-3" data-toggle="tooltip" data-placement="top" title="Enregistrer" style="font-size:30px"></i></a>
            <a href="connection.php"><i class="fas fa-sign-in-alt ml-3" data-toggle="tooltip" data-placement="top" title="Continuer l'histoire" style="font-size:30px"></i></a>
        </div>
    </div>
</div>
