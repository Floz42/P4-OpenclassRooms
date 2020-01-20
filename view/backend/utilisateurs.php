<?php
namespace Blog\view\backend;

ob_start();
?>
    <div id="container_admin" class="mt-5 container-fluid">
        <div id="utilisateurs_admin" class="row col-lg-10">
           <h3>Voici la liste des utilisateurs de votre site, leur e-mail ainsi que leur rôle.</h3>
           <p> D'un simple clic sur leur rôle actuel, vous pouvez changer leur rôle sur le site ou supprimer un utilisateur. A savoir qu'un utilisateur administrateur devra également avoir les codes d'accès à la page sécurisé (.htaccess)</p>
        </div>
        <!-- $message -> confirm message after change role or delete user -->
        <div> <?= $message ?? ''; ?></div>
        
            <table class="container table table-bordered mt-5">
                <tbody>
                    <th><i class="fas fa-lightbulb"></i> ID</th>
                    <th><i class="fas fa-user"></i> PSEUDO</th>
                    <th><i class="fas fa-envelope"></i> E-MAIL</th>
                    <th><i class="fas fa-cogs"></i> RÔLE</th>
                </tbody>
                <?php foreach($users as $user) {
                    // $disabled -> security : nobody can DELETE the principal admin (Jean Forteroche)
                    $disabled = ($user['pseudo'] === 'JeanForteroche') ? 'disabled' : '';
                    echo <<<HTML
                    <tr>
                        <th scope="col">{$user['id']}</th>
                        <th scope="col">{$user['pseudo']}</th>
                        <th scope="col">{$user['mail']}</th>
                        <th scope="col"><a href="index.php?action=utilisateurs&id_role={$user['id']}&role={$user['user_role']}"><button class="btn btn-primary" {$disabled}>{$user['user_role']}</button></a></th>
                        <th scope="col"><a href="index.php?action=utilisateurs&id_role={$user['id']}&delete={$user['id']}"><button class="btn btn-danger" {$disabled} name="{$user['id']}">SUPPRIMER</button></a></th>
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



