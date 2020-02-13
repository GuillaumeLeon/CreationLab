<div class="container row post mt-3 mb-3" style="overflow:hidden;">
    <div class="vote text-center">
	<button type="button" class="btn btn-light"><img src="image/arrow_up.svg" alt="upvote"></button>
	<div class="numberVote"><?php echo ($post[$i]['upvote'] - $post[$i]['downvote']) ?></div>
	<button type="button" class="btn btn-light"><img src="image/arrow_down.svg" alt="downvote"></button>
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