<?php
ob_start();
?>
    <div id="container_admin" class="mt-5 container-fluid">
        <div id="comments_admin" class="row col-lg-10">
           <h3>Voici la liste des commentaires sur vos articles.</h3>
           <p> Ceux qui ont le plus de signalements sont affichés en premiers. Vous pouvez remettre les signalements à 0 si vous estimez que ceux-ci sont infondés ou supprimer le commentaire</p>
        </div>
        
                
                <?php foreach($comments as $comment) {
                    $report = ($comment['reports'] == 0) ? 'Aucun' : $comment['reports'];
                    echo <<<HTML
                    <table class="table table-bordered mt-5">
                        <tbody>
                            <th>PSEUDO</th>
                            <th>DATE COMMENTAIRE</th>
                            <th>ID ARTICLE</th>
                            <th>SINGALEMENT(S)</th>
                        </tbody>
                        <tr>
                            <th scope="col">{$comment['author_comment']}</th>
                            <th scope="col">{$comment['date_comment']}</th>
                            <th scope="col">{$comment['id_article']}</th>
                            <th scope="col">{$report}</th>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-center"><h3>COMMENTAIRE :</h3></td>
                        </tr>
                        <tr>
                            <td colspan="4">{$comment['comment']}</td>
                        </tr>
                        <td colspan="4" class="text-center">
                            <a href="index.php?action=commentaires&set_empty={$comment['id']}"><button class="btn btn-primary">METTRE A 0</button></a>
                            <a href="index.php?action=commentaires&delete_comment={$comment['id']}"><button class="btn btn-danger">SUPPRIMER</button></a>
                        </td>

                    
                    </table>
HTML;
                }
                ?>

            

        
    </div>
<?php 
$content = ob_get_clean();
require_once('view/templateBackend.php');
?>



