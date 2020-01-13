<?php

require 'db.php';

session_start();
var_dump($_SESSION['connected']);
if ($_SESSION['connected'] != 1) {
    header('Location:index.php');
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
  <title>Creation Lab</title>
  <script type="text/javascript">
function setForm(value) {
    if(value == 'form_text'){
                document.getElementById('form_text').style='display:block;';
                document.getElementById('form_draw').style='display:none;';
            }
            else {
                document.getElementById('form_draw').style = 'display:block;';
                document.getElementById('form_text').style = 'display:none;';
            }
}
</script>
</head>

<body>
  <nav class="navbar">
    <span class="logo"><a href="index.php"><img src="image/Creation_Lab.png" alt="logo_creationLab" width="149"
          height="71"></a></span>
  </nav>
</div>
<select class="mdb-select md-form" onchange="setForm(this.value)">
  <option value="form_text">Textuel</option>
  <option value="form_draw">Bande dessiner</option>
</select>
  <div class="container" id="form_text">
      <form action="new_post.php" method="post">
        <div class="form-group">
          <label for="title">Titre :</label>
          <input type="text" class="form-control" id="title_post" name="title_post" placeholder="Entrez un titre" spellcheck="true" />
       </div>
       <div class="form-group">
         <label for="description">Description :</label>
          <textarea class="form-control" id="desc_post" name="desc_post" placeholder="Entrez une description" spellcheck="true"></textarea>
      </div>
      <div class="form-group">
        <label for="contenue">Ecrivez votre histoire :</label>
        <textarea class="form-control" name="content" id="content" rows="20" spellcheck="true" role="textbox"></textarea>
      </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
      </form>
  </div>
<div class="container" id="form_draw"  style="display: none">
      <form enctype="multipart/form-data" action="new_post.php" method="post">
        <div class="form-group">
          <label for="title">Titre :</label>
          <input type="text" class="form-control" id="title_post" name="title_post" placeholder="Entrez un titre" spellcheck="true" />
       </div>
       <div class="form-group">
         <label for="description">Description :</label>
          <textarea class="form-control" id="desc_post" name="desc_post" placeholder="Entrez une description" spellcheck="true"></textarea>
      </div>
      <div class="form-group">
      <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
  <!-- Le nom de l'élément input détermine le nom dans le tableau $_FILES -->
  Envoyez ce fichier : <input name="userfile" type="file" /> 
      </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
      </form>
  </div>
</body>
</html>
