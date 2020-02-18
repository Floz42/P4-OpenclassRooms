<?php 
namespace Blog;
?>
<!DOCTYPE html>

<html lang="fr">
    <!-- TO ME - VARIABLES LIST : 
$description = '';
$keywords = '';
$title = '';
-->
    <head>
        <meta name="author" content="Florian THIEBAUD" />
        <meta name="copyright" content="©2019 Jean Forteroche " />
        <meta name="description" content="<?= $description ?? 'Blog de l\'écrivain Jean Forteroche, vous retrouverez ici son dernier roman "Billet simple pour l\'Alaska.' ?>"/>
        <meta name="keywords" content="<?= $keywords ?? 'blog,jean,forteroche,roman,écrivain,livre,articles,contact,billet,simple,alaska' ?>" />
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta property="og:title" content="<?= $title ?? 'Blog de Jean Forteroche' ?>" />
        <meta property="og:type" content="website" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="public/css/style.css">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
        <link rel="stylesheet" href="public/css/breakpoints.css"> 
        <link rel="shortcut icon" href="public/img/icon.ico" />
        <title> <?= $title ?? 'Blog de Jean Forteroche' ?> </title>
    </head>

    <body>
        <div id="page" class="container-fluid">
            <header>
                <div class="connexion_home">
                    <?php
                     if (!isset($_SESSION['connected'])) { ?>
                        <i class="mr-1 fas fa-user"></i> <a class="scroll" href="index.php?action=connexion">SE CONNECTER</a>
                        <i class="mr-1 fas fa-pen"></i> <a href="index.php?action=connexion">S'INSCRIRE</a>
                    <?php } else { ?>
                        <i class="fas fa-sign-out-alt"></i> <a href="index.php?action=deconnexion">SE DECONNECTER</a>
                    <?php if ($_SESSION['user_role'] == 'admin') { ?>
                        <i class="fas fa-unlock-alt"></i> <strong><a href="index.php?action=admin">ESPACE ADMINISTRATION</a></strong>
                    <?php } } ?>
                </div>
                <nav id="menu" class="container-fluid mb-3">
                    <div id="site_title" class="col-lg-12">
                        JEAN FORTEROCHE
                    </div>
                    <!-- Burger menu if device has a max-width to 768 px -->
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
                            <li><a href="index.php?action=accueil">ACCUEIL</a></li>
                            <li><a href="index.php?action=biographie">BIOGRAPHIE</a></li>
                            <li><a href="index.php?action=articles&index_page=1">CHAPITRES</a></li>
                            <li><a href="index.php?action=contact">CONTACT</a></li>
                            <div class="menu_connexion_burger">
                                <?php
                                    if (!isset($_SESSION['connected'])) { ?>
                                            <div class="link_burger"><i class="mr-1 fas fa-user"></i> <a href="index.php?action=connexion">SE CONNECTER</a></div>
                                            <div class="link_burger"><i class="mr-1 fas fa-pen"></i> <a href="index.php?action=connexion">S'INSCRIRE</a></div>
                                        <?php } else { ?>
                                            <div class="link_burger"><i class="fas fa-sign-out-alt"></i> <a href="index.php?action=deconnexion">SE DECONNECTER</a></div>
                                        <?php if ($_SESSION['user_role'] == 'admin') { ?>
                                            <div class="link_burger"><i class="fas fa-unlock-alt"></i> <strong><a href="index.php?action=admin">ESPACE ADMINISTRATION</a></strong></div>     
                                <?php } } ?>
                            </div>
                        </ul>
                    </div>     
                    <div class="line_nav"></div> 
                    <!-- Menu for desktop (> 768px) and large devices --> 
                    <ul class="menu_classic col-lg-12">
                        <li><a href="index.php?action=accueil">ACCUEIL</a></li>
                        <li><a href="index.php?action=biographie">BIOGRAPHIE</a></li>
                        <li><a href="index.php?action=articles&index_page=1">CHAPITRES</a></li>
                        <li><a href="index.php?action=contact">CONTACT</a></li>
                    </ul>
                </nav>
            </header>
            <!-- BOOTSTRAP CAROUSEL -->
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="public/img/alaska0.png" class="d-block w-100" alt="Billet simple Alaska">
                        <div class="blog_slider carousel-caption">
                            <h2 class="h_slider mb-2">"BILLET SIMPLE POUR L ' ALASKA"</h2>
                            <p class="p_slider">Le nouveau roman de Jean Forteroche.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="public/img/alaska1.png" class="d-block w-100" alt="Billet simple Alaska">
                        <div class="blog_slider carousel-caption d-none d-md-block">
                            <h2 class="h_slider mb-2">"BILLET SIMPLE POUR L ' ALASKA"</h2>
                            <p class="p_slider">Préparez-vous à une expérience unique.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="public/img/alaska2.png" class="d-block w-100" alt="Billet simple Alaska">
                        <div class="blog_slider carousel-caption d-none d-md-block">
                            <h2 class="h_slider mb-2">"BILLET SIMPLE POUR L ' ALASKA"</h2>
                            <p class="p_slider">Jean vous fait découvrir l'Alaska comme vous ne l'avez jamais vu.</p>
                        </div>
                    </div>
                </div>
            </div>

                <?= $content ?> 

            <footer class="container-fluid">
                ©2019 - Florian THIEBAUD - Projet OpenClassRooms
            </footer>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="public/js/main.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="public/js/Burger.js"></script>
</html>


