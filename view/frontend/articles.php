<?php
$title = 'Articles - Blog de Jean Forteroche';
$description = 'Retrouvez article par article le nouveau roman de Jean Forteroche "Billet simple pour l\'Alaska';
$keywords = 'blog,jean,forteroche,écrivain,roman,romans,alaska,saint-etienne,livres,billet,simple,articles,chapitres,livre';

ob_start();
?>
    <div id="container_articles" class="mt-5 container mb-5">
        <div class="text-center mb-5">       
            Êtes-vous prêt à plonger dans un rêve ?
            Vous retrouverez ici mon dernier roman "Billet simple pour l'Alaska" et vous plongerez dans un roman incroyable qui, je suis sûr vous donnera envie de me rejoindre dans ce merveilleux pays. 
        </div>
        <div id="list_articles">
            <?php
                foreach ($articles as $article) {   
                    $id = $article['id'];    
                    echo <<<HTML
                    <div class="one_article col-lg-6 text-center">
                        <a href="index.php?action=post?id_post={$id}"><h4> Article :  {$article['title_article']} </h4></a>
                        <hr>
                    </div>
HTML;
                }
            ?>
        </div>
                    

    </div>

<?php 
$content = ob_get_clean();
require_once('view/template.php');
?>



