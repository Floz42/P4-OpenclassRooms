<?php
$title = "Blog de Jean Forteroche - Espace de connexion / inscription";
$keywords = "blog,jean,forteroche,alaska,billet,simple,inscription,connexion,membres,commentaires,articles,chapitres";
ob_start();
?>
    <div id="container_connexion" class="mt-5 container-fluid">
        <div class="row title_connexion col-lg-12 mb-3">Connexion / Inscription</div>
        <div class="container_block">
            <div class="connexion col-lg-5 col-xs-12">
                <div class="mt-2 head_connexion">
                    <h3>Déjà membre ? </h3>
                </div>
                <form method="post" action="#" class="col-lg-8">
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
                    <label class="m-0 mt-2" for="pseudo">Pseudo :</label>
                    <input type="text" name="pseudo" class="form-control" required>
                    <?= $pseudo ?? '' ?>
                    <?= $pseudo2 ?? '' ?>
                    <label class="m-0 mt-2" for="password">Mot de passe :</label>
                    <input type="password" name="password" class="form-control" required>
                    <?= $password ?? '' ?>
                    <label class="m-0 mt-2" for="confirm_password">Confirmation mot de passe :</label>
                    <input type="password" name="confirm_password" class="form-control" required>
                    <?= $password ?? '' ?>
                    <label class="m-0" for="email">E-mail :</label>
                    <input type="text" name="email" class="form-control" required>
                    <?= $email ?? '' ?>
                    <input type="submit" name="submit" class="btn btn-outline-secondary btn-sm mt-3 mb-3" value="S'inscrire">
                    <?= $message_error ?? '' ?>
                </form>
            </div>
        </div>
    </div>
<?php 

$content = ob_get_clean();
require_once('view/template.php');
?>



