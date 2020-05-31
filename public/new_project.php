<?php
require '../database/db.php';
require '../vendor/autoload.php';

session_start();
if ($_SESSION['connected'] != 1) {
    header('Location:index.php');
}

$get_tag = $db->prepare("SELECT tag_name FROM tag");
$get_tag->execute();
$result = $get_tag->fetchAll(PDO::FETCH_COLUMN);

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
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-tokenfield.min.css">
    <link rel="stylesheet" href="css/trumbowyg.min.css" media="all">

    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/bootstrap-tokenfield.min.js"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <title>Creation Lab</title>
</head>

<body>
<nav id="nav" class="navbar">
    <div class="logo row">
        <div class="red_line-nav col"></div>
        <a href="index.php" class="ml-5 mr-5" ><img src="image/Creation_Lab.png" class="logo-creation_lab" alt="logo_creationLab" width="350" height="180"></a>
        <div class="red_line-nav col"></div>
    </div>
    <div class="button-menu d-flex m-2">
        <a href="../users/profil.php"><i class="fas fa-user m-2" data-toggle="tooltip" data-placement="top" title="Profil"></i></a>
        <a href=fav_post.php><i class="fas fa-bookmark m-2" data-toggle="tooltip" data-placement="top" title="Favoris"></i></a>
        <a href="../app/deco.php"><i class="fas fa-sign-out-alt m-2" data-toggle="tooltip" data-placement="top" title="Déconnexion"></i></a>
    </div>
    <div class="search_bar">
        <form class="" action="search.php" method="GET">
            <div class="md-form mt-0">
                <input class="form-control search-field" type="text" placeholder="recherche" aria-label="" required>
                <button class="submit-button" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>
</nav>

<?php include '../includes/menu.php';?>
<?php
if (isset($_SESSION['error'])) {
    ?>
    <div class="alert alert-danger alert-dismissible text-center" role="alert">
        <div class="alert-icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
        <b>La Limite est de 280 charactères</b>
    </div>
    <?php
}
?>
<div class="main">
    <div class="container" id="form_text">
        <form action="../app/add_post.php" method="post">
            <div class="form-group mt-2">
                <label for="title_post">Titre :</label>
                <input type="text" class="form-control" id="title_post" name="title_post" placeholder="Entrez un titre" spellcheck="true" <?= isset($_SESSION['title']) ? 'value="'.$_SESSION['title'].'"': '' ?> required/>
            </div>
            <div class="form-group mt-2">
                <label for="desc_post">Description :</label>
                <textarea  type="text" class="form-control" id="desc_post" name="desc_post" placeholder="Entrez une description" spellcheck="true" maxlength='140' required>
 <?= isset($_SESSION['desc']) ? $_SESSION['desc'] : '' ?> 
</textarea>
            </div>
            <div class="tag mt-2">
                <label for="tokenfield">Tag :</label>
                <input type="text" class="form-control" id="tokenfield" name="tag" style="width: 45%"/>
            </div>
            <div class="form-group mt-2">
                <label for="content">Ecrivez votre histoire :</label>
                <textarea id="content" name="content" required>
                    <?= isset($_SESSION['content']) ? $_SESSION['content'] : '' ?>
                </textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>

    <script type="text/javascript">
        $('#tokenfield').tokenfield({
            autocomplete:{
                source: [<?php
                    for ($i = 0; $i < count($result); $i++) {
                        if (isset($result[$i+1])) {
                            echo "'".$result[$i]."',";
                        } else {
                            echo "'".$result[$i]."'";
                        }
                    }
                    ?>],
                delay: 100
            },
            showAutocompleteOnFocus: true
        });

    </script>
    <?php include '../includes/footer.php';?>
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
    <?php
    // Suppression des variables de session
    unset($_SESSION['desc'],$_SESSION['title'], $_SESSION['content'], $_SESSION['error']);
    ?>
</body>
</html>
