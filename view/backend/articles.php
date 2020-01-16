<?php
ob_start();
?>
    <div id="container_admin" class="mt-5 container-fluid">
        <div id="head_articles" class="col-lg-10 col-xs-12">
           <h3>Voici la liste des chapitres de votre blog</h3>
           <p>Vous avez ici la possibilité de modifier vos chapitres mais également d'en rédiger de nouveaux. Les chapitres sont affichés par ordre inversé pour que vous ayez un coup d'oeil sur les derniers chapitres rédigés.</p>
           <?= $confirm ?? ''?>
        </div>
        <div class="mt-5 mb-5 col-lg-12 write_article">
            <form class="col-lg-8 mt-5 mb-5" method="post" action="index.php?action=admin_articles&add_article">
                <label for="title_article"><h3>TITRE DU CHAPITRE : </h3></label>
                <input class="form-control" type="text" name="title" value="<?= $title_article ?? ''?>">
                <?= $confirm_title ?? ''?>
                <label class="mt-3" for="mytextarea"><h3>CONTENU DU CHAPITRE : </h3></label>
                <textarea class="form-group" id="mytextarea" name="content"><?= $content_article ?? ''?></textarea>
                <?= $confirm_content ?? ''?>
                <input type="submit" name="<?= $button_confirm ?? 'published' ?>" class="mt-3 btn btn-primary" value="<?= $confirm_article ?? 'PUBLIER' ?>">
                <button type="reset" class="mt-3 btn btn-danger">EFFACER</button>
               
            </form>
        </div>
        <?php foreach($articles as $article) {
            $article_extract = substr($article['content_article'], 0, 255);
            echo <<<HTML
            <table class="table table-bordered mt-5">
                <tbody>
                    <th><i class="fas fa-user"></i> ID</th>
                    <th><i class="fas fa-heading"></i> TITRE CHAPITRE</th>
                    <th><i class="fas fa-clock"></i> DATE DE PUBLICATION</th>
                </tbody>
                <tr>
                    <th scope="col">{$article['id']}</th>
                    <th scope="col">{$article['title_article']}</th>
                    <th scope="col">{$article['date_article']}</th>
                </tr>
                <tr class="border_table">
                    <td colspan="4" class="text-center"><h3>EXTRAIT DU CHAPITRE :</h3></td>
                </tr>
                <tr class="border_table">
                    <td colspan="4">{$article_extract}</td>
                </tr>
                <tr class= border_table>
                    <td colspan="2" class="text-center"><a href="index.php?action=admin_articles&update_post={$article['id']}"><button type="submit" name="update_post" class="btn btn-primary">METTRE À JOUR</button></a></td>
                    <td colspan="2" class="text-center"><a href="index.php?action=admin_articles&delete_post={$article['id']}"><button type="submit" name="delete_post" class="btn btn-danger">SUPPRIMER</button></a></td>
                </tr>
            </table>
HTML;
        }
        ?>
    </div>
<?php 
$content = ob_get_clean();
require_once('view/templateBackend.php');
?>



