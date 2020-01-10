<?php 
while($post = $get_post->fetchAll()){
?>
<div class="container post mt-5">
    <div class="vote text-center">
	<button><img src="image/arrow_up.svg" alt="upvote"></button>
	<div class="numberVote"><?php echo ($post[0]['upvote'] - $post[0]['downvote']) ?></div>
	<button><img src="image/arrow_down.svg" alt="downvote"></button>
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
	    <button>Commenter</button>
	    <button>Partager</button>
	</div>
    </div>
</div>
<?php 
}
?>
