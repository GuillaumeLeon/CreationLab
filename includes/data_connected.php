<?php
$user = $_SESSION['username'];
$id = $db->prepare("SELECT Uid FROM users WHERE username='$user'");
$id->execute();
$uid = $id->fetch(PDO::FETCH_ASSOC);
$user_id = $uid['Uid'];

$post_id = $value['post_id'];
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

$is_favorite = $db->prepare("SELECT * FROM favoris WHERE user_id='$user_id' AND post_id='$post_id'");
$is_favorite->execute();
$is_favorite = $is_favorite->fetch();

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
<div class="container row post mt-3 mb-3 shadow">
  <div class="corps">
    <div class="info" style="justify-content: space-between">
      <div class="vote">
	<button type="button" class="btn btn-light upvote" <?php if($upvoted){ echo "style='color:green;'"; } ?>
	  id="<?= $value['post_id']?>" onclick="upvote(this.id)"><i class="fa fa-arrow-up"></i></button>
	  <div class="numberVote"><?= $upvote_nb[0] - $downvote_nb[0] ?></div>
	  <button type="button" class="btn btn-light downvote" <?php if($downvoted){ echo "style='color:red;'"; } ?>
	    id="<?= $value['post_id']?>" onclick="downvote(this.id)"><i class="fa fa-arrow-down"></i></button>
	  </div>
	  <p class="mr-3"><?= "Crée par " . $value['author'] . " le " . $value['date_post']; ?></p>
	</div>
	<div class="title">
	  <h1><?= $value['post_name'] ?></h1>
	</div>
	<div class="contenue p-4">
	  <?= $value['contenue'] ?>
	</div>
	<div class="interaction">
	  <div class="row">
	    <div class="col-1 icon-bar ml-3"><a href="../post/<?= $value['post_id']; ?>"> <i class="fas fa-comments" data-toggle="tooltip" data-placement="top" title="Commentez" style="font-size:30px"></i> </a></div>
	    <div class="col-1 icon-bar"><a href="#modal_<?= $value['post_id']?>" onclick="$('#modal_<?= $value['post_id']?>').modal('show');"><i class="fas fa-share" data-toggle="tooltip" data-placement="top" title="Partager" style="font-size:30px"></i></a></div>
	    <div class="col-1 icon-bar"><button id="<?= $value['post_id']?>" class="fav_btn bg-transparent <?= $value['post_id'] ?>" onclick="favoris(this.id)"><i class="<?php if($is_favorite != null) {echo 'fas';} else { echo 'far';} ?> fa-bookmark" data-toggle="tooltip" data-placement="top" title="Enregistrer" style="font-size:30px"></i></button></div>
	    <div class="col-1 icon-bar"><a href="<?= $value['post_id']; ?>"><i class="fas fa-sign-in-alt" data-toggle="tooltip" data-placement="top" title="Continuer l'histoire" style="font-size:30px"></i></a></div>
	  </div>
	</div>
      </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="modal_<?= $value['post_id']?>">
      <div class="modal-dialog modal-dialog-centered" role="document">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
	    <div class="modal-header">
	      <h5 class="modal-title"><?= $value['post_name']?></h5>
	      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	      </button>
	    </div>
	    <div class="modal-body">
	      <label for="lien">Partager le lien</label>
	      <input type="text" name="lien" value='creationlab.local/post/<?=$value['post_id']?>' readonly>
	    </div>
	  </div>
	</div>
      </div>
    </div>
