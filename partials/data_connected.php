<?php
$post_id = $post[$i]['post_id'];
$get_upvote = $db->prepare("SELECT id FROM upvote WHERE post_id='$post_id'");
$get_upvote->execute();
$upvote = $get_upvote->fetch();
if($upvote) {
    $upvote_nb = count($upvote) / 2;
} else {
    $upvote_nb = 0;
}
$get_downvote = $db->prepare("SELECT id as downvote FROM downvote WHERE post_id='$post_id'");
$get_downvote->execute();
$downvote = $get_downvote->fetch();
if($downvote){
    $downvote_nb = count($downvote)/2;
} else {
    $downvote_nb = 0;
}
?>
<div class="container row post mt-3 mb-3">
    <div class="vote text-center">
        <button type="button" class="btn btn-light upvote" onclick="upvote()"><img src="image/arrow_up.svg" alt="upvote"></button>
        <div class="numberVote"><?= $upvote_nb - $downvote_nb ?></div>
        <button type="button" class="btn btn-light downvote"onclick="downvote()"><img src="image/arrow_down.svg" alt="downvote"></button>
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
            <a href="post.php?post=<?php echo $post[$i]['post_id']; ?>"><button type="button" class="btn btn-light">Commenter</button></a>
            <button type="button" class="btn btn-light">Partager</button>
            <button type="button" class="btn btn-light">Continuer l'histoire</button>
        </div>
    </div>
</div>