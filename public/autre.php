<?php
require '../database/db.php';

session_start();

if ($_SESSION['connected'] != 1) {
    header('Location:index.php');
    exit;
}
$get_post = $db->prepare('SELECT author,date_post,post_id,contenue,post_name,slug FROM post_text WHERE parent_node IS NULL LIMIT 10');
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
    <div class="logo row">
        <div class="red_line-nav col"></div>
        <div class="col"><a href="index.php" style="grid-column: 1"><img src="image/Creation_Lab.png" class="logo-creation_lab" alt="logo_creationLab" width="350" height="180" ></a></div>
        <div class="red_line-nav col"></div>
    </div>
    <div class="d-flex flex-row-reverse row m-2">
        <div class="d-flex justify-content-start">
            <div><a href="new_project.php"><button type="button" class="btn btn-light">Créer un nouveau projet</button></a></div>
            <div><a href="../deco.php"><button type="button" class="btn btn-light">Déconnexion</button></a></div>
        </div>
    </div>
</nav>
<?php include '../includes/menu.php';?>
<?php
for ($i = count($post) - 1; $i >= 0; $i--) {
    include '../includes/data_connected.php';
}
?>
<?php include '../includes/footer.php';?>

<script>
    function upvote(id) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../vote.php');
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
        xhr.open('POST', '../vote.php');
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
<script src="https://kit.fontawesome.com/f6b4bd03ce.js" crossorigin="anonymous"></script>
</body>
</html>
