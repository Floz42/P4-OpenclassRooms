<?php
namespace Blog\view\backend;

ob_start();
?>
    <div id="container_admin" class="mt-5 container-fluid">
        <div id="accueil_admin" class="row col-lg-10">
           <h1 class="text-center">Bienvenue dans l'espace d'administration.</h1>
           <p> C'est ici que pourrez gérer vos articles, les commentaires qui y sont associés mais aussi la liste des utilisateurs enregistrés. Si vous êtes tombé sur cette page par erreur merci de quitter cette page.</p>
           <p><strong> ARTICLES :</strong> c'est ici que vous éditez de nouveaux chapitres de votre roman. Il vous sera aussi possible de modifier un article. </p> 
           <p><strong> COMMENTAIRES :</strong> dans cette section il vous sera possible de voir tous les commentaires laissés sur vos articles. Ils sont classés pas nombre de signalement afin de faciliter leur modération. Vous pourrez ainsi supprimer un commentaire où remettre à 0 le nombre de signalements.</p>
           <p><strong> UTILISATEURS :</strong> vous aurez ici une liste de tous les utilisateurs de votre site ainsi que de leur "rôle". Vous pouvez supprimer un utilisateur ou éditer les rôles utilisateurs (admin/user).</p>
    </div>
<?php 
$content = ob_get_clean();
require_once('view/templateBackend.php');
?>



