<?php
    require '../database/db.php';

if(isset($_GET['q'])) {
    $search = $_GET['q'];
}
    $get_post = $db->prepare("SELECT author,date_post,post_id,contenue,post_name,slug,tag FROM post_text WHERE post_name LIKE '%$search%' OR tag LIKE '%$search%' LIMIT 10");
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
        <a href="index.php" class="ml-5 mr-5" ><img src="image/Creation_Lab.png" class="logo-creation_lab" alt="logo_creationLab" width="350" height="180"></a>
        <div class="red_line-nav col"></div>
    </div>
    <div class="button-menu d-flex m-2">
        <a href="../users/profil.php"><img class="m-2" src="image/user.png" alt="user" width="45" height="45"></a>
        <a href="project.php"><img class="m-2" src="image/star.png" alt="" width="45" height="45"></a>
        <a href="new_project.php"><img class="m-2" src="image/cross.png" alt="" width="45" height="45"></a>
        <a href="../deco.php"><img class="m-2" src="image/door.svg" alt="deconnexion" width="45" height="45"/></a>
    </div>
    <div class="search_bar">
        <form class="" action="search.php" method="get">
            <div class="input-group md-form form-sm form-2 pl-0">
                <input class="form-control my-0 py-1 lime-border search-field" type="text" placeholder="recherche" name="q" id="search" required>
                <div class="input-group-append">
                    <span class="input-group-text"><button class="submit-button" type="submit"><i class="fas fa-search"></i></button></span>
                </div>
            </div>
        </form>
    </div>

</nav>

<?php include '../includes/menu.php';?>
<div class="main">

<?php
if(!empty($post)){
for ($i = 0; $i <count($post); $i++) {
    include '../includes/data_connected.php';
}
} else {
    echo "C'EST VIDE LA PUTAIN DE TA RACE";
}
?>
</div>
<?php include '../includes/footer.php';?>
<script>
    function upvote(id) {
        let xhr = new XMLHttpRequest();
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
        let xhr = new XMLHttpRequest();
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
<script src="js/font_awesome.js"></script>
</body>
</html>