<?php
require '../database/db.php';
require '../vendor/autoload.php';

/**************************************/
/*  À TOI QUI LIRAS SE CODE           */
/*  SACHE QUE JE N'EN SUIS PAS FIÈRE  */
/**************************************/

session_start();

if ($_SESSION['connected'] != 1) {
    header('Location:index.php');
    exit;
}
if (!isset($_GET['post'])) {
    header('Location:../index.php');
    exit;
}
$id = $_GET["post"];
$_SESSION['post_id'] = $_GET['post'];
$user = $_SESSION['username'];

$user_id = $_SESSION['id'];

$get_post = $db->prepare("SELECT * FROM post_text WHERE post_id='$id'");
$get_post->execute();
$post = $get_post->fetchAll(PDO::FETCH_ASSOC);
if (empty($post)) {
    header('Location:../public/404.php');
    exit;
}

$get_com = $db->prepare("SELECT * FROM comment WHERE post_id='$id' ORDER BY created_at DESC");
$get_com->execute();
$com = $get_com->fetchALL(PDO::FETCH_ASSOC);

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

$is_favorite = $db->prepare("SELECT * FROM favoris WHERE user_id='$user_id' AND post_id='$post_id'");
$is_favorite->execute();
$is_favorite = $is_favorite->fetch();

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
    <link rel="icon" href="../public/image/favicon.ico" />
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
    <script src="../public/js/jquery.min.js"></script>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <title><?= $post[0]['post_name']; ?></title>
</head>

<body>
<nav id="nav" class="navbar">
    <div class="logo row">
        <div class="red_line-nav col"></div>
        <a href="../index.php" class="ml-5 mr-5"><img src="../public/image/Creation_Lab.png" class="logo-creation_lab" alt="logo_creationLab" width="350" height="180"></a>
        <div class="red_line-nav col"></div>
    </div>
    <div class="button-menu d-flex m-2">
        <a href="../users/profil.php"><i class="fas fa-user m-2" data-toggle="tooltip" data-placement="top" title="Profil"></i></a>
        <a href="../public/project.php"><i class="fas fa-bookmark m-2" data-toggle="tooltip" data-placement="top" title="Favoris"></i></a>
        <a href="../public/new_project.php"><i class="fas fa-plus-circle m-2" data-toggle="tooltip" data-placement="top" title="Nouveaux projet"></i></a>
        <a href="../app/deco.php"><i class="fas fa-sign-out-alt m-2" data-toggle="tooltip" data-placement="top" title="Déconnexion"></i></a>
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
                    <li> <a href="../public/project.php"> Mes projets </a></li>
                    <li> <a href="#"> Abonnements </a></li>
                    <li> <a href="#"> Mes projets préféres </a></li>
                    <li> <a href="../app/random.php"> Aléatoire </a></li>
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
                    <button type="button" class="btn btn-light upvote" <?php if ($upvoted) {
                        echo "style='color:green;'";
                    } ?>id="<?= $post[0]['post_id']?> upvote" onclick="upvote(this.id)">
                        <i class="fa fa-arrow-up"></i>
                    </button>
                    <div class="numberVote <?= $post[0]['post_id']?>"><?= $upvote_nb[0] - $downvote_nb[0] ?></div>
                    <button type="button" class="btn btn-light downvote" <?php if ($downvoted) {
                        echo "style='color:red;'";
                    } ?> id="<?= $post[0]['post_id']?> downvote" onclick="downvote(this.id)">
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
            <div class="interaction">
                <?php if ($suite == false) {?>
                    <div class="row">
                        <div class="col-md-1 icon-bar">
                            <i class="fas fa-share ml-3" data-toggle="tooltip" data-placement="top" title="Partager" style="font-size:30px"></i>
                        </div>
                        <div class="col-md-1 icon-bar" style="margin-right: -24px;">
                            <button id="<?= $post[0]['post_id']; ?>" class="fav_btn bg-transparent <?= $post[0]['post_id']; ?>" onclick="favoris(this.id)">
                                <i class="<?php if ($is_favorite != null) {
                                    echo 'fas';
                                } else {
                                    echo 'far';
                                } ?> fa-bookmark" data-toggle="tooltip" data-placement="top" title="Enregistrer" style="font-size:30px">
                                </i>
                            </button>
                        </div>
                        <div class="col-md-1 icon-bar">
                            <a href="../public/<?= $post[0]['post_id']; ?>">
                                <i class="fas fa-sign-in-alt ml-3" data-toggle="tooltip" data-placement="top" title="Continuer l'histoire" style="font-size:30px"></i>
                            </a>
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
    <?php
    if ($suite != false) {
        $id_suite = $suite['post_id'];

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
                        <button type="button" class="btn btn-light upvote" <?php if ($upvoted) {
                            echo "style='color:green;'";
                        } ?>id="<?= $suite['post_id']?>" onclick="upvote(this.id)"><i class="fa fa-arrow-up"></i></button>
                        <div class="numberVote <?= $post[0]['post_id']?>"><?= $upvote_nb[0] - $downvote_nb[0] ?></div>
                        <button type="button" class="btn btn-light downvote" <?php if ($downvoted) {
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
                    <div class="interaction">
                        <div class="row">
                            <div class="col-md-1 icon-bar"><i class="fas fa-share ml-3" data-toggle="tooltip" data-placement="top" title="Partager" style="font-size:30px"></i></div>
                            <div class="col-md-1 icon-bar" style="margin-right: -24px;"><button id="<?= $post[0]['post_id']; ?>" class="fav_btn bg-transparent <?= $post[0]['post_id']; ?>" onclick="favoris(this.id)">
                                    <i class="<?php if ($is_favorite != null) {
                                        echo 'fas';
                                    } else {
                                        echo 'far';
                                    } ?> fa-bookmark"
                                       data-toggle="tooltip" data-placement="top" title="Enregistrer" style="font-size:30px"></i></button></div>
                            <div class="col-md-1 icon-bar"> <a href="../public/<?= $post[0]['post_id']; ?>"><i class="fas fa-sign-in-alt ml-3" data-toggle="tooltip" data-placement="top" title="Continuer l'histoire" style="font-size:30px"></i></a></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <?php
        $_SESSION['post_id'] = $suite['post_id'];
        $nb_part = 2;
        while ($suite_existing != false) {
            $nb_part += 1;
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

            if ($suite != false) {
                $id_suite = $suite['post_id'];
                $get_suite_existing = $db->prepare("SELECT post_id FROM post_text WHERE parent_node='$id_suite'");
                $get_suite_existing->execute();
                $suite_existing = $get_suite_existing->fetch(); ?>
                <div class="row post mt-3 mb-3 shadow">
                    <div class="corps">
                        <div class="info" style="justify-content: space-between">
                            <div class="vote">
                                <button type="button" class="btn btn-light upvote" <?php if ($upvoted) {
                                    echo "style='color:green;'";
                                } ?>
                                        id="<?= $suite['post_id']?>" onclick="upvote(this.id)">
                                    <i class="fa fa-arrow-up"></i>
                                </button>
                                <div class="numberVote <?= $post[0]['post_id']?>"><?= $upvote_nb[0] - $downvote_nb[0] ?></div>
                                <button type="button" class="btn btn-light downvote" <?php if ($downvoted) {
                                    echo "style='color:red;'";
                                } ?>
                                        id="<?= $suite['post_id']?>" onclick="downvote(this.id)">
                                    <i class="fa fa-arrow-down"></i>
                                </button>
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
                            <div class="interaction">
                                <div class="row">
                                    <div class="col-md-1 icon-bar">
                                        <i class="fas fa-share ml-3" data-toggle="tooltip" data-placement="top" title="Partager" style="font-size:30px"></i>
                                    </div>
                                    <div class="col-md-1 icon-bar" style="margin-right: -24px;">
                                        <button id="<?= $post[0]['post_id'];?>" class="fav_btn bg-transparent <?= $post[0]['post_id'];?>" onclick="favoris(this.id)">
                                            <i class="<?php if ($is_favorite != null) {
                                                echo 'fas';
                                            } else {
                                                echo 'far';
                                            } ?> fa-bookmark" data-toggle="tooltip" data-placement="top" title="Enregistrer" style="font-size:30px"></i>
                                        </button>
                                    </div>
                                    <div class="col-md-1 icon-bar">
                                        <a href="../public/<?= $post[0]['post_id']; ?>">
                                            <i class="fas fa-sign-in-alt ml-3" data-toggle="tooltip" data-placement="top" title="Continuer l'histoire" style="font-size:30px"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?php
                $_SESSION['post_id'] = $suite['post_id'];
            }
        }
    }
    ?>
    <div class="commentaire">
        <div class="container add_comment">
            <form action="../app/comment.php" method="POST">
                <textarea class="form-control add_comment mb-1" id="com_content" name="com_content" placeholder="Commentez !!" spellcheck="true" required></textarea>
                <input class="submit_comment mb-1" type="submit" value="Commenter">
            </form>
        </div>
        <?php if (!empty($com)) {
            foreach ($com as $comment) {
                ?>
                <div class="container comment shadow mb-3">
                    <div class="row" style="justify-content: space-between">
                        <?php $date_comments = str_replace('-', '/', date('d-m-Y', strtotime($comment['created_at']))); ?>
                        <p class="p-3"> Crée le <?= $date_comments . " par <span class='font-weight-bold'>" . $comment['author']; ?></span></p>
                        <?php if ($comment['author'] == $_SESSION['username']) { ?>
                            <form method="POST" action="../app/delete_comment.php" class="mt-3 mr-3">
                                <input type="hidden" name="id" value="<?= $comment['id'] ?>">
                                <button class="bg-transparent" data-toggle="tooltip" data-placement="top" title="supprimer"><i class="far fa-trash-alt"></i></button>
                            </form>
                        <?php } ?>
                    </div>
                    <div class="content pr-2">
                        <p><?= $comment['content']; ?></p>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>
<button id="back2Top" class="btn btn-primary btn-lg back-to-top" onclick="window.scroll(0,0);" data-toggle="tooltip" data-placement="top" title="Retour en hauts"><i class="fa fa-arrow-up"></i></button>
<?php include '../includes/footer.php';?>
<script src="../public/js/index.js"></script>
<script src="../public/js/bootstrap.bundle.min.js"></script>
<script src="../public/js/font_awesome.js"></script>
</body>
</html>
