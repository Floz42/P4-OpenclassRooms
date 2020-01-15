<!DOCTYPE html>
<?php
if (empty($_SESSION['id'])) {
    $connected = false;
} else {
    $connected = true;
}
?>
<html lang="fr">
    <!-- TO ME - VARIABLES LIST : 
$description = '';
$keywords = '';
$title = '';
-->
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="public/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
        <link rel="stylesheet" href="public/css/breakpoints.css"> 
        <link rel="shortcut icon" href="public/img/logo.ico" />
        <title> Espace administrateur : Blog de Jean Forteroche </title>
    </head>

    <body>
        <div id="page" class="container-fluid">
            <header>
                <div class="connexion_home">
                    <?php
                     if (isset($_SESSION['connected'])) { ?>
                        <i class="fas fa-sign-out-alt"></i> <a href="index.php?action=deconnexion">SE DECONNECTER</a>
                    <?php } ?>
                </div>
                <nav id="menu" class="container-fluid mb-3">
                    <div id="site_title" class="col-lg-12">
                        JEAN FORTEROCHE
                    </div>   
                    <div class="line_nav"></div> 
                    <ul class="col-lg-12">
                        <li><a href="index.php?action=admin">ACCUEIL</a></li>
                        <li><a href="index.php?action=articles">ARTICLES</a></li>
                        <li><a href="index.php?action=commentaires">COMMENTAIRES</a></li>
                        <li><a href="index.php?action=utilisateurs">UTILISATEURS</a></li>
                    </ul>
                </nav>
            </header>

                <?= $content ?> 


        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</html>


