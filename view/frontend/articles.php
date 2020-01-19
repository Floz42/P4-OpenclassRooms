<?php
namespace Blog\view\frontend;

$title = 'Chapitres - Blog de Jean Forteroche';
$description = 'Retrouvez chapitre par chapitre le nouveau roman de Jean Forteroche "Billet simple pour l\'Alaska';
$keywords = 'blog,jean,forteroche,écrivain,roman,romans,alaska,saint-etienne,livres,billet,simple,articles,chapitres,livre';

ob_start();
?>
    <div id="container_articles" class="mt-5 container mb-5">
        <div id="scroll"></div>
        <div class="text-center mb-5">       
            Êtes-vous prêt à plonger dans un rêve ?
            Vous retrouverez ici mon dernier roman "Billet simple pour l'Alaska" et vous découvrirez dans un roman incroyable qui, je suis sûr vous donnera envie de me rejoindre dans ce merveilleux pays. 
        </div>
        <div id="list_articles">
            <?php
                if (!$success) {
                    echo $error;
                } else {
                    foreach ($articles as $article) {  
                        $id = $article['id'];    
                        echo <<<HTML
                        <div data-aos="fade-up" class="one_article col-lg-6 col-xs-12 text-center">
                            <a href="index.php?action=one_post&id={$id}"><h4> CHAPITRE {$article['number_article']} :</h4><h5>  {$article['title_article']} </h5></a>
                            <hr>
                        </div>
HTML;
                    }
                ?>
            </div>
            <div class="pagination text-center mt-3">
                <i class="fa fa-chevron-left mr-1" aria-hidden="true"></i>
                <?php 
                    for ($i=1; $i<=$total_pages; $i++) {
                        $active = ($i == $_GET['index_page'] ? 'pagination_active' : '' );
                        if ($i != 1) {
                        echo " <span> - </span><a class='ml-1 mr-1 $active' href=index.php?action=articles&index_page=$i> PAGE $i </a>";
                        } else {
                            echo " <a class='mr-1 ml-1 $active' href=index.php?action=articles&index_page=$i> PAGE $i </a>";
                        }
                    }
                ?>
                <i class="fa fa-chevron-right ml-1" aria-hidden="true"></i>
            </div>
                <?php } ?>
    </div>

<?php 
$content = ob_get_clean();
require_once('view/template.php');
?>



