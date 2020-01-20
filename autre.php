<?php
require 'database/db.php';

session_start();
if ($_SESSION['connected'] != 1) {
   header('Location:index.php');
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
    <title>Creation Lab</title>
</head>

<body>
<nav class="navbar">
	<span><a href="new_project.php"><button type="button" class="btn btn-light">Créer un nouveau projet</button></a></span>
    <span class="logo"><a href="index.php"><img src="image/Creation_Lab.png" alt="logo_creationLab" width="149"
						height="71"></a></span>
    <span><a href="deco.php"><button type="button" class="btn btn-light">Déconnexion</button></a></span>
</nav>
<?php include 'partials/menu.php';?>
<?php
$get_post = $db->prepare('SELECT * FROM post_text');
$get_post->execute();
$post = $get_post->fetchAll();
?>
</div>
<?php 
for ($i = count($post) - 1; $i >= 0; $i--) {
   include 'partials/data_connected.php';
}
?>
<script>
/*function getPage(id) {
	$('#output').html('<img src="image/ajax_load.gif" />');
	jQuery.ajax({
		url: "partials/data_connected.php",
		data:'id='+id,
		type: "POST",
		success:function(data){$('#output').html(data);}
	});
}
</script>
<?php include 'partials/footer.php';?>
</body>
</html>
