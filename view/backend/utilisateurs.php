<?php
ob_start();
?>
    <div id="container_admin" class="mt-5 container-fluid">
        <div id="utilisateurs_admin" class="row col-lg-10">
           <h3>Voici la liste des utilisateurs de votre site, leur e-mail ainsi que leur rôle.</h3>
           <p> D'un simple clic sur leur rôle actuel, vous pouvez changer leur rôle sur le site ou supprimer un utilisateur. A savoir qu'un utilisateur administrateur devra également avoir les codes d'accès à la page sécurisé (.htaccess)</p>
        </div>
        <div <?= $message ?? ''; ?></div>
        
            <table class="table table-striped mt-5">
                <tbody>
                    <th>ID</th>
                    <th>PSEUDO</th>
                    <th>E-MAIL</th>
                    <th>RÔLE</th>
                </tbody>
                <?php foreach($users as $user) {
                    $class = ($user['pseudo'] === 'JeanForteroche') ? 'disabled' : '';
                    echo <<<HTML
                    <tr>
                        <th scope="col">{$user['id']}</th>
                        <th scope="col">{$user['pseudo']}</th>
                        <th scope="col">{$user['mail']}</th>
                        <th scope="col"><a href="index.php?action=utilisateurs&id_role={$user['id']}&role={$user['user_role']}"><button class="btn btn-primary" {$class}>{$user['user_role']}</button></a></th>
                        <th scope="col"><a href="index.php?action=utilisateurs&id_role={$user['id']}&delete={$user['id']}"><button class="btn btn-danger" {$class} name="{$user['id']}">SUPPRIMER</button></a></th>
                    </tr>
HTML;
                }
                ?>

            </table>

        
    </div>
<?php 
$content = ob_get_clean();
require_once('view/templateBackend.php');
?>



