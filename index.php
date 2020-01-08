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
        <header>

        </header>

        <?= $content ?>

        <footer>

        </footer>
    
    </body>
</html>