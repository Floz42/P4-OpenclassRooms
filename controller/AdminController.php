<?php 

namespace controller; 

class AdminController {
    
    function verif_role() 
    {
        if ($_SESSION['user_role'] != 'admin') {            
         header('Location: index.php?action=accueil');
        }
    }

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
        require_once('model/ArticlesManager.php');

        $commentsManager = new \blog\model\CommentsManager;
        $articlesManager = new \blog\model\ArticlesManager;

        $i = (int)htmlspecialchars($_GET['index_comments']);
        $error = "<div class='alert alert-danger'> Une erreur est survenue, il est impossible d'afficher la liste des articles</div>";
        
        $comments = $commentsManager->getComments_five($i);
  
        $count_comments = $commentsManager->countComments();
        $total_comments = (int)$count_comments["number_comments"];
        $total_pages = ceil($total_comments / 5);   
        $success = ($_GET['index_comments'] > $total_pages || !(int)$_GET['index_comments']|| $_GET['index_comments'] < 0) ? false : true;

        if(isset($_GET['delete_comment'])) {
            $delete_comment = $commentsManager->delComment($_GET['delete_comment']);
            header('Location: index.php?action=commentaires&index_comments=1');
        }

        if(isset($_GET['set_empty'])) {
            $delete_reports = $commentsManager->delReports($_GET['set_empty']);
            header('Location: index.php?action=commentaires&index_comments=1');
        }

        require_once('view/backend/commentaires.php');
    }


    public function admin_articles() 
    {
        require_once('model/ArticlesManager.php');

        $articlesManager = new \blog\model\ArticlesManager;
        $articles = $articlesManager->getPosts_reverse();

        $publication = false; 
        if (!empty($_POST['published'])) {
            if (empty($_POST['title']) || empty($_POST['content'])) {
                if (empty($_POST['title'])) {
                    $publication = false; 
                    $confirm_title = "<div class='alert alert-danger'>Article non publié : vous devez rentrer un titre pour votre chapitre.</div>";
                }
                if (empty($_POST['content'])) {
                    $publication = false; 
                    $confirm_content = "<div class='alert alert-danger'>Article non publié : vous devez rentrer un contenu pour votre chapitre.</div>";
                }  
            } else {
                $publication = true; 
            }
        }
    
        if ($publication) {
            $published = $articlesManager->createPost($_POST['title'], $_POST['content']);
            header('Location: index.php?action=admin_articles&published');
        }

        if (isset($_GET['published'])) {
            $confirm = "<div class='alert alert-success'>Félicitations ! Votre chapitre a bien été publié.</div>";
        }

        if (isset($_GET['update_post'])) {
            $article = $articlesManager->getOnePost($_GET['update_post']);
            $title_article = $article['title_article']; 
            $content_article = $article['content_article'];
            $confirm_article = 'METTRE A JOUR';
            $button_confirm = 'updates';
            $getid = $_GET['update_post'];
        }

        if (!empty($_POST['update_post'])) {
            $confirm_article = 'PUBLIER';
            $update = $articlesManager->updatePost($getid, $_POST['title'], $_POST['content']); 
            $confirm = "<div class='alert alert-success'>Félicitations ! Votre chapitre a bien été mise à jour.</div>";
        }

        if (isset($_GET['delete_post'])) {
            $update = $articlesManager->deletePost($_GET['delete_post']); 
            $confirm = "<div class='alert alert-success'>Félicitations ! Votre chapitre a bien été poupou.</div>";
            header('Location: index.php?action=admin_articles&delete_success');

        }
        if(isset($_GET['delete_success'])) {
            $confirm = "<div class='alert alert-success'>Félicitations ! Votre chapitre a bien été publié.</div>";
        }

        require_once('view/backend/articles.php');
    }
}