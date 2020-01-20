<?php
namespace Blog\view\frontend;

$title = "Chapitre : $title_article";
$description = htmlspecialchars($intro_article);
$keywords = 'blog,jean,forteroche,écrivain,roman,romans,alaska,saint-etienne,livres,billet,simple,articles,chapitres,livre';

ob_start();
?>
    <!-- $confirm -> message for user who confirm that his report has been add to DB -->
    <?php if (isset($_GET['reporting']) && ($_GET['reporting'] === 'on')) : echo $confirm; endif ?>
    <div class="ml-5 mt-1 mb-5">
        <div id="scroll"></div>
        <a href="index.php?action=articles&index_page=1" class="mt-1 mb-5 back">Retour à la liste des chapitres</a>
    </div>
    <div id="container_article" class="mt-1 container col-lg-10 col-xs-12">
        <div class="head_article col-lg-10 col-xs-12">
            <div class="title_article"><h2>Chapitre <?= $article['number_article'] ?> : <?= $title_article; ?></h2></div>
            <div class="date_article"><i><?= $date_article; ?></i></div>
        </div>
        <div class="content_article mt-3 mb-5 text-justify">
            <?= $content_article ?>
        </div>  
            <?php 
            foreach ($comments as $comment) {
               echo <<<HTML
                <div class="container_comment col-lg-8 mb-4">
                    <div class="head_comment">
                        <div class="author_comment"> {$comment["author_comment"]} </div>
                        <div class="date_comment">{$comment['date_comment']}<a class="report_link ml-3" href="index.php?action=one_post&id=1&report=one_report&id_comment={$comment['id']}" title="Signaler le commentaire"><i class="fas fa-flag"></i></a></div>
                    </div>
                    <div class="body_comment">{$comment['comment']}</div>
                </div>
HTML;
            }
            ?>
        <div id="container_user" class="mt-3 mb-3 col-lg-6 col-xs-12">
            <div class="head_user">POSTER UN COMMENTAIRE : </div>
            <!-- if user isn't connected, he can't post a comment and we invite him to connect or subscribe -->
            <?php if (!isset($_SESSION['pseudo'])) {
                echo <<<HTML
                <div class="col-lg-10 mx-auto">
                    <div class="text-center mt-5 mb-5 alert alert-danger"><h4>Vous devez être connecté pour poster un commentaire.</h4></div>
                    <div class="text-center mb-5"><a href="index.php?action=connexion"><button type="button" class="btn btn-primary">SE CONNECTER / S'INSCRIRE</button></a></div>
HTML;
            } else {?>
            <form action="index.php?action=one_post&id=<?= $_GET['id']?>" method="POST">
                <textarea class="form-control" name="post_comment" placeholder="Votre commentaire ici :"></textarea>
                <input name="submit" type="submit" id="inputGroup-sizing-sm" value="Envoyer" class="btn btn-outline-secondary btn-sm mt-2 mb-2 ml-2">
            </form>
            <?php } ?>
        </div>
        <?= $message_comment ?? '' ?>

    </div>

<?php 
$content = ob_get_clean();
require_once('view/template.php');
?>



