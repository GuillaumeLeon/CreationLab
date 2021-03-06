<?php
require '../database/db.php';
require '../vendor/autoload.php';
session_start();
if (isset($_GET['post'])) {
    $_SESSION['post_id'] = $_GET['post'];
    $post_id = $_GET['post'];
}
if ($_SESSION['connected'] != 1) {
    header('Location:index.php');
    exit;
}
$id = $_GET["post"];
$user_id = $_SESSION['id'];

$get_post = $db->prepare("SELECT * FROM post_text WHERE post_id='$id'");
$get_post->execute();
$post = $get_post->fetchALL(PDO::FETCH_ASSOC);

$is_favorite = $db->prepare("SELECT * FROM favoris WHERE user_id='$user_id' AND post_id='$post_id'");
$is_favorite->execute();
$is_favorite = $is_favorite->fetch(PDO::FETCH_ASSOC);

if (empty($post)) {
    header('Location:404.php');
    exit;
}

$get_com = $db->prepare("SELECT * FROM comment WHERE post_id='$id'");
$get_com->execute();
$com = $get_com->fetchALL(PDO::FETCH_ASSOC);
$_SESSION['post'] = $post;

// Vérification de la présence d'une suite
$get_suite = $db->prepare("SELECT author,date_post,post_name,post_id,contenue FROM post_text WHERE parent_node='$id'");
$get_suite->execute();
$suite = $get_suite->fetch();

// Vérification pour savoir si l'utilisateur à voter ou non
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

if (isset($upvote) && !empty($upvote)) {
    foreach ($upvote as $upvotes) {
        if ($upvotes['user_id'] === $user_id) {
            $upvoted = true;
        }
    }
} else {
    $upvoted = false;
}
if (isset($downvote) && !empty($downvote)) {
    foreach ($downvote as $downvotes) {
        if ($downvotes['user_id'] === $user_id) {
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
    <link rel="stylesheet" href="css/trumbowyg.min.css" media="all">
    <script src="js/jquery.min.js"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <title><?= $post[0]['post_name'] ?></title>
</head>

<body>
<nav id="nav" class="navbar">
    <div class="logo row">
        <div class="red_line-nav col"></div>
        <a href="index.php" class="ml-5 mr-5"><img src="image/Creation_Lab.png" class="logo-creation_lab"
                                                   alt="logo_creationLab" width="350" height="180"></a>
        <div class="red_line-nav col"></div>
    </div>
    <div class="button-menu d-flex m-2">
        <a href="../users/profil.php"><i class="fas fa-user m-2" data-toggle="tooltip" data-placement="top"
                                         title="Profil"></i></a>
        <a href=fav_post.php><i class="fas fa-bookmark m-2" data-toggle="tooltip" data-placement="top"
                                title="Favoris"></i></a>
        <a href="new_project.php"><i class="fas fa-plus-circle m-2" data-toggle="tooltip" data-placement="top"
                                     title="Nouveaux projet"></i></a>
        <a href="../app/deco.php"><i class="fas fa-sign-out-alt m-2" data-toggle="tooltip" data-placement="top"
                                     title="Déconnexion"></i></a>
    </div>
    <div class="search_bar">
        <form action="search.php" method="get">
            <div class="input-group md-form form-sm form-2 pl-0">
                <input class="form-control my-0 py-1 lime-border search-field" type="text" placeholder="recherche" name="q"
                       id="search" required>
                <div class="input-group-append">
            <span class="input-group-text"><button class="submit-button" type="submit"><i
                            class="fas fa-search"></i></button></span>
                </div>
            </div>
        </form>
    </div>

</nav>
<?php include '../includes/menu.php';?>
<?php if (isset($_SESSION['error'])) { ?>
    <div class="alert alert-danger alert-dismissible text-center" role="alert">
        <div class="alert-icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
        <b>La limite est de 280 charactères</b>
    </div>
    <?php
}
unset($_SESSION['error']);
?>
<div class="main">
    <div class="card position-absolute ml-3 w-25 shadow">
        <div class="card-header">
            <h6>Description du post : </h6>
        </div>
        <div class="card-body">
            <?=
            $post[0]['post_desc'];
            ?>
        </div>
    </div>
    <div class="row post mt-3 mb-3 shadow">
        <div class="corps">
            <div class="info" style="justify-content: space-between">
                <div class="vote">
                    <button type="button" class="btn <?= $post[0]['post_id']?> upvote" <?php if ($upvoted) {
                        echo "style='color:green;'";
                    } ?> id="<?= $post[0]['post_id']?>" onclick="upvote(this.id)">
                        <i class="fa fa-arrow-up"></i>
                    </button>
                    <div class="numberVote <?= $post[0]['post_id']?>"><?= $upvote_nb[0] - $downvote_nb[0] ?></div>
                    <button type="button" class="btn <?= $post[0]['post_id']?> downvote" <?php if ($downvoted) {
                        echo "style='color:red;'";
                    } ?> id="<?= $post[0]['post_id']?>" onclick="downvote(this.id)">
                        <i class="fa fa-arrow-down"></i>
                    </button>
                    <span>Partie 1</span>
                </div>
                <p class="mr-3"><?= "Crée par " . $post[0]['author'] . " le " . $post[0]['date_post']; ?></p>
            </div>
            <div class="title">
                <h1><?= $post[0]['post_name'] ?></h1>
            </div>
            <div class="contenue p-4">
                <?= $post[0]['contenue'] ?>
            </div>
            <?php if ($suite == false) { ?>
                <div class="interaction d-flex flex-row">
                    <i class="fas fa-share ml-3" data-toggle="tooltip" data-placement="top" title="Partager"
                       style="font-size:30px"></i>
                    <button id="<?= $post[0]['post_id'] ?>" class="ml-3 fav_btn bg-transparent <?= $post[0]['post_id'] ?>"
                            onclick="favoris(this.id)">
                        <i class="<?php if ($is_favorite != null) {
                            echo 'fas';
                        } else {
                            echo 'far';
                        } ?> fa-bookmark" data-toggle="tooltip" data-placement="top" title="Enregistrer" style="font-size:30px"></i>
                    </button>
                </div>
            <?php }?>
        </div>
    </div>
    <?php
    if ($suite != false) {
        $id_suite = $suite['post_id'];
        $_SESSION['post_id'] = $suite['post_id'];

        $get_upvote_suite = $db->prepare("SELECT count(id) as upvote_nb FROM upvote WHERE post_id='$id_suite'");
        $get_upvote_suite->execute();
        $upvote_nb_suite = $get_upvote_suite->fetch();
        $get_downvote_suite = $db->prepare("SELECT count(id) as downvote_nb FROM downvote WHERE post_id='$id_suite'");
        $get_downvote_suite->execute();
        $downvote_nb_suite = $get_downvote_suite->fetch();

        $get_suite_existing = $db->prepare("SELECT post_id FROM post_text WHERE parent_node='$id_suite'");
        $get_suite_existing->execute();
        $suite_existing = $get_suite_existing->fetch(); ?>
        <div class="row post mt-3 mb-3 shadow">
            <div class="corps">
                <div class="info" style="justify-content: space-between">
                    <div class="vote">
                        <button type="button" class="btn <?= $post[0]['post_id']?> upvote" <?php if ($upvoted) {
                            echo "style='color:green;'";
                        } ?> id="<?= $suite['post_id']?>" onclick="upvote(this.id)"><i class="fa fa-arrow-up"></i></button>
                        <div class="numberVote <?= $suite['post_id']?>"><?= $upvote_nb[0] - $downvote_nb[0] ?></div>
                        <button type="button" class="btn <?= $post[0]['post_id']?> downvote" <?php if ($downvoted) {
                            echo "style='color:red;'";
                        } ?> id="<?= $suite['post_id']?>" onclick="downvote(this.id)"><i class="fa fa-arrow-down"></i></button>
                        <span>Partie 2</span>
                    </div>
                    <p class="mr-3"><?= "Crée par " . $suite['author'] . " le " . $suite['date_post']; ?></p>
                </div>
                <div class="title">
                    <h1><?= $suite['post_name'] ?></h1>
                </div>
                <div class="contenue p-4">
                    <p><?= $suite['contenue'] ?></p>
                </div>
                <?php if ($suite_existing == false) { ?>
                    <div class="interaction d-flex flex-row">
                        <div class="row">
                            <div class="col-1 icon-bar ml-3">
                                <a href="../post/<?= $suite['post_id']; ?>"> <i class="fas fa-comments" data-toggle="tooltip"
                                                                                data-placement="top" title="Commentez" style="font-size:30px"></i>
                                </a>
                            </div>
                            <div class="col-1 icon-bar ml-3">
                                <button id="<?= $post[0]['post_id']?>" class="fav_btn bg-transparent <?= $suite['post_id']?>"
                                        onclick="favoris(this.id)">
                                    <i class="<?php if ($is_favorite != null) {
                                        echo 'fas';
                                    } else {
                                        echo 'far';
                                    } ?> fa-bookmark" data-toggle="tooltip" data-placement="top" title="Enregistrer" style="font-size:30px"></i>
                                </button>
                            </div>
                            <div class="col-1 icon-bar ml-3">
                                <a href="<?= $suite['post_id']; ?>">
                                    <i class="fas fa-sign-in-alt" data-toggle="tooltip" data-placement="top" title="Continuer l'histoire"
                                       style="font-size:30px"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
        $_SESSION['post_id'] = $_GET['post'];
        $nb_part = 2;
        while ($suite != false) {
            $nb_part += 1;
            $id_suite = $suite['post_id'];
            $_SESSION['post_id'] = $suite['post_id'];

            $get_upvote_suite = $db->prepare("SELECT count(id) as upvote_nb FROM upvote WHERE post_id='$id_suite'");
            $get_upvote_suite->execute();
            $upvote_nb_suite = $get_upvote_suite->fetch();
            $get_downvote_suite = $db->prepare("SELECT count(id) as downvote_nb FROM downvote WHERE post_id='$id_suite'");
            $get_downvote_suite->execute();
            $downvote_nb_suite = $get_downvote_suite->fetch();

            $get_suite = $db->prepare("SELECT author,date_post,post_name,post_id,contenue FROM post_text WHERE parent_node='$id_suite'");
            $get_suite->execute();
            $suite = $get_suite->fetch();

            if ($suite != false) {
                $id_suite = $suite['post_id'];
                $get_suite_existing = $db->prepare("SELECT post_id FROM post_text WHERE parent_node='$id_suite'");
                $get_suite_existing->execute();
                $suite_existing = $get_suite_existing->fetch(); ?>
                <div class="row post mt-3 mb-3 shadow">
                    <div class="corps">
                        <div class="info" style="justify-content: space-between">
                            <div class="vote">
                                <button type="button" class="btn <?= $post[0]['post_id']?> upvote" <?php if ($upvoted) {
                                    echo "style='color:green;'";
                                } ?> id="<?= $suite['post_id']?>" onclick="upvote(this.id)"><i class="fa fa-arrow-up"></i></button>
                                <div class="numberVote <?= $suite['post_id']?>"><?= $upvote_nb[0] - $downvote_nb[0] ?></div>
                                <button type="button" class="btn <?= $post[0]['post_id']?> downvote" <?php if ($downvoted) {
                                    echo "style='color:red;'";
                                } ?> id="<?= $suite['post_id']?>" onclick="downvote(this.id)"><i
                                            class="fa fa-arrow-down"></i></button>
                                <span>Partie <?= $nb_part ?></span>
                            </div>
                            <p class="mr-3"><?= "Crée par " . $suite['author'] . " le " . $suite['date_post']; ?></p>
                        </div>
                        <div class="title">
                            <h1><?= $suite['post_name'] ?></h1>
                        </div>
                        <div class="contenue p-4">
                            <p><?= $suite['contenue'] ?></p>
                        </div>
                        <?php if ($suite_existing == false) { ?>
                            <div class="interaction d-flex flex-row">
                                <div class="icon-bar"><i class="fas fa-share ml-3" data-toggle="tooltip" data-placement="top" title="Partager"
                                                         style="font-size:30px"></i></div>
                                <div class="icon-bar">
                                    <button id="<?= $post[0]['post_id']?>" class="fav_btn bg-transparent <?= $post[0]['post_id'] ?>"
                                            onclick="favoris(this.id)">
                                        <i class="<?php if ($is_favorite != null) {
                                            echo 'fas';
                                        } else {
                                            echo 'far';
                                        } ?> fa-bookmark" data-toggle="tooltip" data-placement="top" title="Enregistrer"
                                           style="font-size:30px"></i>
                                    </button>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?php
            }
        }
    }
    ?>
    <div class="container mb-3" id="form_text">
        <form action="../app/add_suite.php" method="post">
            <div class="form-group">
                <label for="content">Ecrivez votre suite :</label>
                <textarea id="content" name="content" required>
                    <?= isset($_SESSION['content']) ? $_SESSION['content'] : '' ?>
                </textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
</div>
<button id="back2Top" class="btn btn-primary btn-lg back-to-top" onclick="window.scroll(0,0);" data-toggle="tooltip"
        data-placement="top" title="Retour en hauts"><i class="fa fa-arrow-up"></i></button>
<?php include '../includes/footer.php';?>
<script src="js/index.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/font_awesome.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.20.0/trumbowyg.min.js"></script>

<script>
    $('#content').trumbowyg({
        autogrow: true,
    });
    // Retrait de la possibilité d'ajouter des images
    const btn = document.getElementsByClassName('trumbowyg-button-pane')[0].childNodes[5];
    btn.parentNode.removeChild(btn);
</script>
</body>
<?php
unset($_SESSION['content'], $_SESSION['error']);
?>

</html>
