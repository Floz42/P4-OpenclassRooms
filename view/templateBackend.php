<?php 
namespace Blog;
?>
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
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="public/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
        <link rel="stylesheet" href="public/css/breakpoints.css"> 
        <link rel="shortcut icon" href="public/img/logo.ico" />
        <script src="https://cdn.tiny.cloud/1/ewzsiip33a1my2zwspbb5uuxo8dg1o815xvg6xd2ky41dyb2/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>tinymce.init({selector: '#mytextarea'});</script>
        <title> Espace administrateur : Blog de Jean Forteroche </title>
    </head>

    <body>
        <div id="page" class="container-fluid">
            <header>
                <div class="connexion_home">
                    <i class="fas fa-undo"></i> <a href="index.php?action=accueil">RETOUR AU BLOG</a>
                    <i class="fas fa-sign-out-alt"></i> <a href="index.php?action=deconnexion">SE DECONNECTER</a>
                </div>
                <nav id="menu" class="container-fluid mb-3">
                    <div id="site_title" class="col-lg-12">
                        JEAN FORTEROCHE
                    </div>
                    <div id="menu_burger">
                        <div id="burger">
                            <div id="lines">
                                <div class="line first_line"></div>
                                <div class="line second_line"></div>
                                <div class="line third_line"></div>
                            </div>
                        </div>
                    </div>
                    <div id="block_menu">
                        <ul class="menu_burger">
                            <li><a href="index.php?action=admin">ACCUEIL</a></li>
                            <li><a href="index.php?action=admin_articles">ARTICLES</a></li>
                            <li><a href="index.php?action=commentaires&index_comments=1">COMMENTAIRES</a></li>
                            <li><a href="index.php?action=utilisateurs">UTILISATEURS</a></li>
                            <div class="menu_connexion_burger">
                                <div class="link_burger"><i class="fas fa-undo"></i> <a href="index.php?action=accueil">RETOUR AU BLOG</a></li></div>
                                <div class="link_burger"><i class="fas fa-sign-out-alt"></i> <a href="index.php?action=deconnexion">SE DECONNECTER</a><li></div>
                            </div>
                        </ul>
                    </div>      
                    <div class="line_nav"></div> 
                    <ul class="menu_classic col-lg-12">
                        <li><a href="index.php?action=admin">ACCUEIL</a></li>
                        <li><a href="index.php?action=admin_articles">ARTICLES</a></li>
                        <li><a href="index.php?action=commentaires&index_comments=1">COMMENTAIRES</a></li>
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
<script>
$('#burger').on('click', function(){
    if (!$('#burger').hasClass('active')){
        $('#burger').addClass('active');
        $('.first_line').css('animation', 'rotateFirst 0.5s forwards');
        $('.second_line').css('opacity', '0');
        $('.third_line').css('animation', 'rotateThird 0.5s forwards');
        $('#block_menu').css('animation', 'moveRight 0.5s forwards');
        $('.menu_burger li, .menu_connexion_burger').css('display', 'flex');
    } else {
        $('#burger').removeClass('active');
        $('.first_line').css('animation', 'rotateFirstReverse 0.5s forwards');
        $('.second_line').css('opacity', '1');
        $('.third_line').css('animation', 'rotateThirdReverse 0.5s forwards');
        $('#block_menu').css('animation', 'moveLeft 0.5s forwards');
        $('.menu_burger li, .menu_connexion_burger').css('display', 'none');


    }
});
</script>


