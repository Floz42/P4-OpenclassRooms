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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
        <link rel="stylesheet" href="public/css/breakpoints.css"> 
        <link rel="shortcut icon" href="public/img/logo.ico" />
        <title> <?= $title ?? 'Blog de Jean Forteroche' ?> </title>
    </head>

    <body>
        <div id="page" class="container-fluid">
            <header>
                <nav id="menu" class="container-fluid mb-3">
                    <div id="site_title" class="col-lg-12">
                        JEAN FORTEROCHE
                    </div>   
                    <div class="line_nav"></div> 
                    <ul class="col-lg-12">
                        <li><a href="#">ACCUEIL</a></li>
                        <li><a href="#">BIOGRAPHIE</a></li>
                        <li><a href="#">CHAPITRES</a></li>
                        <li><a href="#">CONTACT</a></li>
                    </ul>
                </nav>
            </header>
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
                            <h2 class="h_slider">"BILLET SIMPLE POUR L ' ALASKA"</h2>
                            <p class="p_slider">Préparez-vous à une expérience unique.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="public/img/alaska2.png" class="d-block w-100" alt="Billet simple Alaska">
                        <div class="blog_slider carousel-caption d-none d-md-block">
                            <h2 class="h_slider">"BILLET SIMPLE POUR L ' ALASKA"</h2>
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
</html>

