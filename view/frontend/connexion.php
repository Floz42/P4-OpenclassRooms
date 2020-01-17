<?php
$title = "Blog de Jean Forteroche - Espace de connexion / inscription";
$keywords = "blog,jean,forteroche,alaska,billet,simple,inscription,connexion,membres,commentaires,articles,chapitres";
ob_start();
?>
    <div id="container_connexion" class="mt-5 container-fluid">
        <div class="row title_connexion col-lg-12 mb-3">Connexion / Inscription</div>
        <div class="container_block">
        <?php if (isset($_SESSION['pseudo'])) {
                echo <<<HTML
                <div class="col-lg-10">
                    <div class="text-center mt-5 mb-5 alert alert-success"><h4>Vous êtes connecté en tant que {$_SESSION['pseudo']}</h4></div>
                    <div class="mb-5"><a href="index.php?action=deconnexion"><button type="button" class="btn btn-primary">Se déconnecter</button></a></div>
HTML;
            } else {?>
            <div class="connexion col-lg-5 col-xs-12">
                <div class="mt-2 head_connexion">
                    <h3>Déjà membre ? </h3>
                </div>
                <form name="" method="post" action="index.php?action=connexion" class="col-lg-8">
                    <label class="m-0 mt-5" for="pseudo">Pseudo :</label>
                    <input type="text" name="pseudo_connexion" class="form-control" required>
                    <label class="m-0 mt-2" for="password">Mot de passe :</label>
                    <input type="password" name="password_connexion" class="form-control" required>
                    <input type="submit" name="connexion" class="btn btn-outline-secondary btn-sm mt-3 mb-3" value="Envoyer">
                    <?= $message_connexion ?? '' ?>
                </form>
            </div>

            <div class="inscription col-lg-5 col-xs-12">
                <div class="head_inscription mt-5">
                    <h3>Pas encore inscrit ? </h3>
                    Remplissez le formulaire ci-dessous :
                </div>
                <form method="post" action="#" class="col-lg-8">
                    <label class="m-0 mt-2" for="pseudo_subscribe">Pseudo :</label>
                    <input type="text" name="pseudo_subscribe" class="form-control" required>
                    <?= $pseudo_subscribe ?? '' ?>
                    <?= $pseudo2_subscribe ?? '' ?>
                    <label class="m-0 mt-2" for="password_subscribe">Mot de passe :</label>
                    <input type="password" name="password_subscribe" class="form-control" required>
                    <?= $password_subscribe ?? '' ?>
                    <label class="m-0 mt-2" for="confirm_password_subscribe">Confirmation mot de passe :</label>
                    <input type="password" name="confirm_password_subscribe" class="form-control" required>
                    <?= $password_subscribe ?? '' ?>
                    <label class="m-0 mt-2" for="email_subscribe">E-mail :</label>
                    <input type="text" name="email_subscribe" class="form-control" required>
                    <?= $email_subscribe ?? '' ?>
                    <input type="submit" name="submit_subscribe" class="btn btn-outline-secondary btn-sm mt-3 mb-3" value="S'inscrire">
                    <?= $message_subscribe ?? '' ?>
                </form>
            </div>
                    <?php } ?>
        </div>
    </div>
<?php 

$content = ob_get_clean();
require_once('view/template.php');
?>



