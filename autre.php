<?php
require 'database/db.php';
session_start();

if ($_SESSION['connected'] != 1) {
    header('Location:index.php');
    exit;
}
$get_post = $db->prepare('SELECT author,date_post,post_id,contenue,post_name  FROM post_text limit 10');
$get_post->execute();
$post = $get_post->fetchAll();
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
for ($i = count($post) - 1; $i >= 0; $i--) {
    include 'partials/data_connected.php';
}
?>
<?php include 'partials/footer.php';?>

<script>
    function upvote(id) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'vote.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function(){
            if(xhr.status === 200){
                //console.log('upvote');
            } else if(xhr.status !== 200){
                //console.log('c\'est la merde');
            }
        };
        xhr.send("voteType=upvote&post_id="+id);
    }
    function downvote(id) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'vote.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function(){
            if(xhr.status === 200) {
                //console.log('downvote');
            } else if(xhr.status !== 200) {
                //console.log('c\'est la merde');
            }
        };
        xhr.send("voteType=downvote&post_id="+id);
    }
</script>
</body>
</html>
