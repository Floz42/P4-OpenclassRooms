<?php
namespace Blog\view\backend;

ob_start();
?>
    <div id="container_admin" class="mt-5 container-fluid">
        <div id="comments_admin" class="row col-lg-10">
           <h3>Voici la liste des commentaires sur vos articles.</h3>
           <p> Ceux qui ont le plus de signalements sont affichés en premiers. Vous pouvez remettre les signalements à 0 si vous estimez que ceux-ci sont infondés ou supprimer le commentaire</p>
        </div>
        <div> <?= $message ?? ''; ?></div>
        <?php foreach($comments as $comment) {
            $report = ($comment['reports'] == 0) ? 'Aucun' : $comment['reports'];
            $disabled = ($comment['reports'] == 0) ? 'disabled' : '';
            $article = $articlesManager->getOnePost($comment['id_article']);

            echo <<<HTML
            <table class="container table table-bordered mt-5">
                <tbody>
                    <th><i class="fas fa-user"></i> PSEUDO</th>
                    <th><i class="fas fa-clock"></i> DATE COMMENTAIRE</th>
                    <th><i class="fas fa-lightbulb"></i> CHAPITRE : </th>
                    <th><i class="fas fa-exclamation-triangle"></i> SIGNALEMENT(S)</th>
                </tbody>
                <tr>
                    <th scope="col">{$comment['author_comment']}</th>
                    <th scope="col">{$comment['date_comment']}</th>
                    <th scope="col">{$article['title_article']}</th>
                    <th scope="col">{$report}</th>
                </tr>
                <tr class="border_table">
                    <td colspan="4" class="text-center"><h3>COMMENTAIRE :</h3></td>
                </tr>
                <tr class="border_table">
                    <td colspan="4">{$comment['comment']}</td>
                </tr>
                <td colspan="4" class="text-center">
                    <a href="index.php?action=commentaires&index_comments=2&set_empty={$comment['id']}"><button class="btn btn-primary" {$disabled}>METTRE A 0</button></a>
                    <a href="index.php?action=commentaires&index_comments=2&delete_comment={$comment['id']}"><button class="btn btn-danger">SUPPRIMER</button></a>
                </td>
            </table>
HTML;
        }
        ?>
        <div class="pagination text-center mb-5 mt-3">
            <i class="fa fa-chevron-left mr-1" aria-hidden="true"></i>
            <?php 
                for ($i=1; $i<=$total_pages; $i++) {
                    $active = ($i == $_GET['index_comments'] ? 'pagination_active' : '' );
                    if ($i != 1) {
                        echo " <span> - </span><a class='ml-1 mr-1 $active' href=index.php?action=commentaires&index_comments=$i> PAGE $i </a>";
                    } else {
                        echo " <a class='mr-1 ml-1 $active' href=index.php?action=commentaires&index_comments=$i> PAGE $i </a>";
                    }
                }
            ?>
            <i class="fa fa-chevron-right ml-1" aria-hidden="true"></i>
    </div>
    </div>
<?php 
$content = ob_get_clean();
require_once('view/templateBackend.php');
?>



