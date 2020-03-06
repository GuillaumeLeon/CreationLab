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
$get_post = $db->prepare("SELECT * FROM post_text WHERE post_id='$post_id'");
$get_post->execute();
$post = $get_post->fetchAll();
$_SESSION['post_id'] = $post_id;
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
  <nav class="navbar">
    <span class="logo" style="left:-187px;"><a href="index.php"><img src="image/Creation_Lab.png" alt="logo_creationLab" width="298"
                                                height="142"></a></span>
          <span><a href="../deco.php"><button type="button" class="btn btn-light">Déconnexion</button></a></span>
  </nav>
<?php include '../includes/menu.php';?>

  <div class="container row post mt-3 mb-3">
      <div class="corps">
          <div class="info">
              <?= "Crée par " . $post[0]['author'] . " le " . $post[0]['date_post']; ?>
          </div>
          <div class="title">
              <?= $post[0]['post_name'] ?>
          </div>
          <div class="contenue">
              <?= $post[0]['contenue'] ?>
          </div>
          <div class="interaction">
              <button type="button" class="btn btn-light">Partager</button>
          </div>
      </div>
  </div>
<div class="main">
  <div class="container" id="form_text">
      <form action="../add_suite.php" method="post">
      <div class="form-group">
        <label for="contenue">Ecrivez votre histoire :</label>
        <textarea class="form-control" name="content" id="content" rows="20" spellcheck="true" role="textbox" maxlength='280'></textarea>
      </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
      </form>
  </div>

  <?php include '../includes/footer.php';?>
    <script src="https://kit.fontawesome.com/f6b4bd03ce.js" crossorigin="anonymous"></script>
</body>
</html>


