<?php
$user = $_SESSION['username'];
$id = $db->prepare("SELECT Uid FROM users WHERE username='$user'");
$id->execute();
$uid = $id->fetch(PDO::FETCH_ASSOC);

$post_id = $post[$i]['post_id'];
$get_upvote = $db->prepare("SELECT count(id) as upvote_nb FROM upvote WHERE post_id='$post_id'");
$get_upvote->execute();
$upvote_nb = $get_upvote->fetch();

$get_downvote = $db->prepare("SELECT count(id) as downvote_nb FROM downvote WHERE post_id='$post_id'");
$get_downvote->execute();
$downvote_nb = $get_downvote->fetch();

$has_upvoted = $db->prepare("SELECT user_id FROM upvote WHERE post_id='$post_id'");
$has_upvoted->execute();
$upvote = $has_upvoted->fetchALL(PDO::FETCH_ASSOC);

$has_downvoted = $db->prepare("SELECT user_id FROM downvote WHERE post_id='$post_id'");
$has_downvoted->execute();
$downvote = $has_downvoted->fetchALL(PDO::FETCH_ASSOC);

if(isset($upvote) && !empty($upvote)){
    foreach($upvote as $upvotes) {
        if($upvotes['user_id'] === $uid['Uid']){
            $upvoted = true;
        }
    }
} else {
    $upvoted = false;
}
if(isset($downvote) && !empty($downvote)) {
    foreach ($downvote as $downvotes) {
        if ($downvotes['user_id'] === $uid['Uid']) {
            $downvoted = true;
        }
    }
} else {
    $downvoted = false;
}
?>
<div class="container row post mt-3 mb-3">
    <div class="corps">
        <div class="info" style="justify-content: space-between">
            <div class="vote">
                <button type="button" class="btn btn-light upvote" <?php if($upvoted){ echo "style='color:green;'"; } ?>
                        id="<?= $post[$i]['post_id']?> upvote" onclick="upvote(this.id)"><i class="fa fa-arrow-up"></i></button>
                <div class="numberVote"><?= $upvote_nb[0] - $downvote_nb[0] ?></div>
                <button type="button" class="btn btn-light downvote"<?php if($downvoted){ echo "style='color:red;'"; } ?>
                        id="<?= $post[$i]['post_id']?> downvote" onclick="downvote(this.id)"><i class="fa fa-arrow-down"></i></button>
            </div>
            <p><?= "Crée par " . $post[$i]['author'] . " le " . $post[$i]['date_post']; ?></p>
        </div>
        <div class="title">
            <h1><?= $post[$i]['post_name'] ?></h1>
        </div>
        <div class="contenue p-4">
            <?= $post[$i]['contenue'] ?>
        </div>
        <div class="interaction">
            <a href="../post/<?= $post[$i]['post_id']; ?>"><button type="button" class="btn btn-light">Commenter</button></a>
            <button type="button" class="btn btn-light">Partager</button>
            <a href="<?= $post[$i]['post_id']; ?>"><button type="button" class="btn btn-light">Continuer l'histoire</button></a>
        </div>
    </div>
</div>
