<?php
require '../database/db.php';

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
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/bootstrap-tokenfield.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/editor/0.1.0/editor.css">
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
        <a href="../users/profil.php"><i class="fas fa-user m-2" data-toggle="tooltip" data-placement="top" title="Profil" style="font-size:40px"></i></a>
        <a href="project.php"><i class="fas fa-bookmark m-2" data-toggle="tooltip" data-placement="top" title="Favoris" style="font-size:40px"></i></a>
        <a href="../deco.php"><i class="fas fa-sign-out-alt m-2" data-toggle="tooltip" data-placement="top" title="Déconnexion" style="font-size:40px"></i></a>
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
<div class="main">
    <div class="container" id="form_text">
        <form action="../add_post.php" method="post">
            <div class="form-group mt-2">
                <label for="title">Titre :</label>
                <input type="text" class="form-control" id="title_post" name="title_post" placeholder="Entrez un titre" spellcheck="true" required/>
            </div>
            <div class="form-group mt-2">
                <label for="description">Description :</label>
                <input  type="text" class="form-control" id="desc_post" name="desc_post" placeholder="Entrez une description" spellcheck="true" maxlength='280'required/>
            </div>
            <div class="tag mt-2">
                <label for="tag">Tag :</label>
                <input type="text" class="form-control" id="tokenfield" name="tag" row="5" />
            </div>
            <div class="form-group mt-2">
                <label for="contenue">Ecrivez votre histoire :</label>
                <textarea class="form-control" name="content" id="content" rows="20" spellcheck="true" role="textbox" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>

    <script type="text/javascript">
        $('#tokenfield').tokenfield({
            autocomplete:{
                source: [<?php
                    for ($i = 0; $i < count($result); $i++) {
                        if(isset($result[$i+1])){
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
    <script src="//cdn.jsdelivr.net/editor/0.1.0/editor.js"></script>
    <script src="//cdn.jsdelivr.net/editor/0.1.0/marked.js"></script>
    <!-- <script type="text/javascript">
    const editor = new Editor();
    editor.render();
    </script> -->
</body>
</html>
