<?php
require '../database/db.php';
session_start();
if(isset($_GET['post'])){
    $post_id = $_GET['post'];
}
if ($_SESSION['connected'] != 1) {
    header('Location:index.php');
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
    <link rel="icon" href="image/favicon.ico" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title><?= $post[0]['post_name'] ?></title>
</head>

<body>
<nav id="nav" class="navbar">
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
        <form action="search.php" method="get">
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

<div class="container row post mt-3 mb-3">
    <div class="corps">
        <div class="info" style="justify-content: space-between">
            <div class="vote">
                <button type="button" class="btn btn-light upvote" <?php if($upvoted){ echo "style='color:green;'"; } ?>
                        id="<?= $post[0]['post_id']?> upvote" onclick="upvote(this.id)"><i class="fa fa-arrow-up"></i></button>
                <div class="numberVote"><?= $upvote_nb[0] - $downvote_nb[0] ?></div>
                <button type="button" class="btn btn-light downvote"<?php if($downvoted){ echo "style='color:red;'"; } ?>
                        id="<?= $post[0]['post_id']?> downvote" onclick="downvote(this.id)"><i class="fa fa-arrow-down"></i></button>
            </div>
            <?= "Crée par " . $post[0]['author'] . " le " . $post[0]['date_post']; ?>
        </div>
        <div class="title">
            <h1><?= $post[0]['post_name'] ?></h1>
        </div>
        <div class="contenue p-4">
            <?= $post[0]['contenue'] ?>
        </div>
        <?php if($suite == false){ ?>
            <div class="interaction">
                <button type="button" class="btn btn-light">Partager</button>
            </div>
        <?php }?>
    </div>
</div>

<div class="main">
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
                            </div>
                        <?php }?>
                    </div>
                </div>

                <?php
                $_SESSION['post_id'] = $suite['post_id'];
            }
        }
    }
    ?>
    <div class="container" id="form_text">
        <form action="../add_suite.php" method="post">
            <div class="form-group">
                <label for="content">Ecrivez votre histoire :</label>
                <textarea class="form-control" name="content" id="content" rows="20" spellcheck="true" role="textbox" maxlength='280' required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>

    <?php include '../includes/footer.php';?>
    <script src="js/font_awesome.js"></script>
</body>
</html>


