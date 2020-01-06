<?php 
    session_start();
    $auth = 0;
    require("lib/includes.php");
?>
<?= include("partials/header.php");?>
    <nav class="navbar">
        <span class="logo"><a href="index.php"><img src="image/Creation_Lab.png" alt="logo_creationLab" width="149" height="71"></a></span>
    </nav>
    <form class="inscription" action="add_users.php" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Adresse Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="form-group">
            <label>Nom d'utilisateur</label>
            <input type="username" class="form-control" id="username" name="username">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Mot de passe </label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
    <?= include("partials/footer.php");?>