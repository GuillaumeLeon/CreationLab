<?php
require '../database/db.php';

session_start();

if ($_SESSION['connected'] != 1) {
    header('Location:index.php');
    exit;
}
if (!isset($_GET['post'])){
    header('Location:../index.php');
    exit;
}
$id = $_GET["post"];
$user = $_SESSION['username'];
$user_id = $db->prepare("SELECT Uid FROM users WHERE username='$user'");
$user_id->execute();
$uid = $user_id->fetch(PDO::FETCH_ASSOC);

$get_post = $db->prepare("SELECT * FROM post_text WHERE post_id='$id'");
$get_post->execute();
$post = $get_post->fetchAll();

$get_com = $db->prepare("SELECT * FROM comment WHERE post_id='$id'");
$get_com->execute();
$com = $get_com->fetchAll();
$_SESSION['post'] = $post;

$get_suite = $db->prepare("SELECT author,date_post,post_name,post_id,contenue FROM post_text WHERE parent_node='$id'");
$get_suite->execute();
$suite = $get_suite->fetch();

$post_id = $post[0]['post_id'];

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
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="../public/image/favicon.ico" />
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
    <title><?= $post[0]['post_name']; ?></title>
</head>

<body>
<nav id="nav"  class="navbar">
    <div class="logo row">
        <div class="red_line-nav col"></div>
        <a href="../index.php" class="ml-5 mr-5" ><img src="../public/image/Creation_Lab.png" class="logo-creation_lab" alt="logo_creationLab" width="350" height="180"></a>
        <div class="red_line-nav col"></div>
    </div>
    <div class="button-menu d-flex m-2">
        <a href="../users/profil.php"><img class="m-2" src="../public/image/user.png" alt="user" width="45" height="45"></a>
        <a href="project.php"><img class="m-2" src="../public/image/star.png" alt="" width="45" height="45"></a>
        <a href="new_project.php"><img class="m-2" src="../public/image/cross.png" alt="" width="45" height="45"></a>
        <a href="../deco.php"><img class="m-2" src="../public/image/door.svg" alt="deconnexion" width="45" height="45"/></a>
    </div>
    <div class="search_bar">
        <form class="" action="../public/search.php" method="get">
            <div class="input-group md-form form-sm form-2 pl-0">
                <input class="form-control my-0 py-1 lime-border search-field" type="text" placeholder="recherche" name="q" id="search" required>
                <div class="input-group-append">
                    <span class="input-group-text"><button class="submit-button" type="submit"><i class="fas fa-search"></i></button></span>
                </div>
            </div>
        </form>
    </div>

</nav>

<div id="menu">
    <div class="red_line"></div>
    <div class="yellow_line"></div>
    <div class="blue_line"></div>
    <nav class="menu text-center">
        <ul>
            <li class="deroulant"><a href="#"> Mon profil </a>
                <ul class="sous text-center">

                    <li id="firstli"> <a href="../users/profil.php"> Profil Détaillé </a></li>
                    <li> <a href="../public/user_project.php"> Mes projets </a></li>
                    <li> <a href="#"> Abonnements </a></li>
                    <li> <a href="#"> Mes projets préféres </a></li>
                    <li> <a href="#"> Aléatoire </a></li>
                </ul>
            </li>
            <li><a href="#"> Abonnements </a></li>
            <li><a href="#"> Tendances </a></li>
            <li><a href="#"> Nouveautés </a></li>
        </ul>

    </nav>
    <div class="red_line"></div>
    <div class="yellow_line"></div>
    <div class="blue_line"></div>
</div>

<div class="container row post mt-3 mb-3">
    <div class="corps">
        <div class="info" style="justify-content: space-between">
            <div class="vote">
                <button type="button" class="btn btn-light upvote" <?php if($upvoted){ echo "style='color:green;'"; } ?>id="<?= $post[0]['post_id']?> upvote" onclick="upvote(this.id)"><i class="fa fa-arrow-up"></i></button>
                <div class="numberVote"><?= $upvote_nb[0] - $downvote_nb[0] ?></div>
                <button type="button" class="btn btn-light downvote"<?php if($downvoted){ echo "style='color:red;'"; } ?> id="<?= $post[0]['post_id']?> downvote" onclick="downvote(this.id)"><i class="fa fa-arrow-down"></i></button>
            </div>
            <?= "Crée par " . $post[0]['author'] . " le " . $post[0]['date_post']; ?>
        </div>
        <div class="title">
            <h1><?= $post[0]['post_name'] ?></h1>
        </div>
        <div class="contenue p-4">
            <?= $post[0]['contenue'] ?>
        </div>
        <div class="interaction">
            <?php if($suite == false) {?>
                <button type="button" class="btn btn-light">Partager</button>
                <a href="../public/suite.php?post=<?= $post[0]['post_id']; ?>"><button type="button" class="btn btn-light">Continuer l'histoire</button></a>
            <?php }?>

        </div>
    </div>
</div>
<?php
if($suite != false) {
    $id_suite = $suite['post_id'];

    $get_upvote_suite = $db->prepare("SELECT count(id) as upvote_nb FROM upvote WHERE post_id='$id_suite'");
    $get_upvote_suite->execute();
    $upvote_nb_suite = $get_upvote_suite->fetch();
    $get_downvote_suite = $db->prepare("SELECT count(id) as downvote_nb FROM downvote WHERE post_id='$id_suite'");
    $get_downvote_suite->execute();
    $downvote_nb_suite = $get_downvote_suite->fetch();

    $get_suite_existing = $db->prepare("SELECT post_id FROM post_text WHERE parent_node='$id_suite'");
    $get_suite_existing->execute();
    $suite_existing = $get_suite_existing->fetch();
    ?>
    <div class="container row post mt-3 mb-3">
        <div class="corps">
            <div class="info" style="justify-content: space-between">
                <div class="vote">
                    <button type="button" class="btn btn-light upvote" <?php if($upvoted){ echo "style='color:green;'"; } ?>id="<?= $suite['post_id']?> upvote" onclick="upvote(this.id)"><i class="fa fa-arrow-up"></i></button>
                    <div class="numberVote"><?= $upvote_nb[0] - $downvote_nb[0] ?></div>
                    <button type="button" class="btn btn-light downvote"<?php if($downvoted){ echo "style='color:red;'"; } ?> id="<?= $suite['post_id']?> downvote" onclick="downvote(this.id)"><i class="fa fa-arrow-down"></i></button>
                </div>
                <?= "Crée par " . $suite['author'] . " le " . $suite['date_post']; ?>
            </div>
        <div class="title">
            <h1><?= $suite['post_name'] ?></h1>
        </div>
        <div class="contenue p-4">
            <p><?= $suite['contenue'] ?></p>
        </div>
        <?php if($suite_existing == false){ ?>
            <div class="interaction">
                <button type="button" class="btn btn-light">Partager</button>
                <a href="../public/suite.php?post=<?= $post[0]['post_id']; ?>"><button type="button" class="btn btn-light">Continuer l'histoire</button></a>
            </div>
        <?php }?>
        </div>
    </div>
    <?php
    while($suite != false) {
        $id_suite = $suite['post_id'];

        $get_upvote_suite = $db->prepare("SELECT count(id) as upvote_nb FROM upvote WHERE post_id='$id_suite'");
        $get_upvote_suite->execute();
        $upvote_nb_suite = $get_upvote_suite->fetch();
        $get_downvote_suite = $db->prepare("SELECT count(id) as downvote_nb FROM downvote WHERE post_id='$id_suite'");
        $get_downvote_suite->execute();
        $downvote_nb_suite = $get_downvote_suite->fetch();

        $get_suite = $db->prepare("SELECT author,date_post,post_name,post_id,contenue FROM post_text WHERE parent_node='$id_suite'");
        $get_suite->execute();
        $suite = $get_suite->fetch();

        if($suite != false) {
            $id_suite = $suite['post_id'];
            $get_suite_existing = $db->prepare("SELECT post_id FROM post_text WHERE parent_node='$id_suite'");
            $get_suite_existing->execute();
            $suite_existing = $get_suite_existing->fetch();
            ?>
            <div class="container row post mt-3 mb-3">
                <div class="corps">
                    <div class="info">
                        <button type="button" class="btn btn-light upvote" id="<?= $suite['post_id'] ?>" onclick="upvote(this.id)"><i class="fa fa-arrow-up"></button>
                        <div class="numberVote"><?= $upvote_nb_suite[0] - $downvote_nb_suite[0] ?></div>
                        <button type="button" class="btn btn-light downvote" id="<?= $suite['post_id'] ?>" onclick="downvote(this.id)"><i class="fa fa-arrow-down"></i></button>
                        <?= "Crée par " . $suite['author'] . " le " . $suite['date_post']; ?>
                    </div>
                    <div class="title">
                        <h1><?= $suite['post_name'] ?></h1>
                    </div>
                    <div class="contenue p-4">
                        <?= $suite['contenue'] ?>
                    </div>
                    <?php if ($suite_existing == false) { ?>
                        <div class="interaction">
                            <button type="button" class="btn btn-light">Partager</button>
                            <a href="../public/suite.php?post=<?= $suite['post_id']; ?>"><button type="button" class="btn btn-light">Continuer l'histoire</button></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php
        }
    }
}
?>
<div class="container add_comment">
    <form action="../comment.php" method="POST">
        <textarea class="form-control add_comment mb-1" id="com_content" name="com_content" placeholder="Commentez !!" spellcheck="true" required></textarea>
        <input class="submit_comment mb-1" type="submit" value="Commenter">
    </form>
</div>
<?php if (!empty($com)) {
    for ($i = 0; $i < count($com) ; $i++) {
        ?>
        <div class="container comment mb-3" >
            <div class="row">
                <p> Crée le <?= $com[$i]['created_at'] . " par " . $com[$i]['author']; ?></p>
            </div>
            <div class="content row p-4">
                <p><?= $com[$i]['content']; ?></p>
            </div>
        </div>
    <?php }
}
?>
<?php include '../includes/footer.php';?>
<script src="../public/js/index.js"></script>
<script src="../public/js/font_awesome.js"></script>
</body>
</html>
