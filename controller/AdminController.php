<?php 

namespace controller; 

class AdminController {

    function admin_accueil() 
    {
        require_once('view/backend/accueil.php');
    }

    function admin_users() 
    {
        require_once('model/UsersManager.php');

        $usersManager = new \blog\model\UsersManager;
        $users = $usersManager->getUsers();
        if (isset($_GET['id_role'])) {
            $role = ($_GET['role'] === 'USER') ? 'admin' : 'user';
            $change_role = $usersManager->changeRole($_GET['id_role'], $role);
            header('Location: index.php?action=utilisateurs');
            $message = "<div class='alert alert-success'>Le rôle utilisateur a bien été changé.</div>";
        }

        if (isset($_GET['delete'])) {
            $delete_user = $usersManager->delUser($_GET['delete']);
            header('Location: index.php?action=utilisateurs');
            $message = "<div class='alert alert-success'>L'utilisateur a bien été supprimé.</div>";
        }

        require_once('view/backend/utilisateurs.php');

    }

    function admin_comments() 
    {
        require_once('model/CommentsManager.php');

        $commentsManager = new \blog\model\CommentsManager;
        $comments = $commentsManager->getComments();

        if(isset($_GET['delete_comment'])) {
            $delete_comment = $commentsManager->delComment($_GET['delete_comment']);
            header('Location: index.php?action=commentaires');
        }

        if(isset($_GET['set_empty'])) {
            $delete_reports = $commentsManager->delReports($_GET['set_empty']);
            header('Location: index.php?action=commentaires');
        }


        require_once('view/backend/commentaires.php');


    }

}