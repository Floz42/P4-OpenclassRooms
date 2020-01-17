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
        $last_number_article = $articlesManager->lastNumberArticle();
        $number_article = (int)$last_number_article['number_article'] + 1;
        $display = 'display: none;';

        $publication_article = false; 
        if (!empty($_POST['published'])) {
            if (empty($_POST['title']) || empty($_POST['content']) || empty($_POST['number_article'])) {
                if (empty($_POST['title'])) {
                    $publication = false; 
                    $confirm_title = "<div class='alert alert-danger'>Article non publié : vous devez rentrer un titre pour votre chapitre.</div>";
                }
                if (empty($_POST['content'])) {
                    $publication_article = false; 
                    $confirm_content = "<div class='alert alert-danger'>Article non publié : vous devez rentrer un contenu pour votre chapitre.</div>";
                }  
                if (empty($_POST['number_article'])) {
                    $publication_article = false; 
                    $confirm_number_article = "<div class='alert alert-danger'>Article non publié : vous devez rentrer un numéro pour votre chapitre.</div>";
                }  
                elseif (!(int)($_POST['number_article'])) {
                    $publication_article = false; 
                    $confirm_number_article = "<div class='alert alert-danger'>Vous devez rentrez un chiffre en numéro de chapitre.</div>";
                } 
            } else {
                $publication_article = true; 
            }
        }

        if ($publication_article) {
            $articlesManager->createPost($_POST['title'], $_POST['number_article'], $_POST['content']);
            header('Location: index.php?action=admin_articles&article_published=true');            
        }

        if (isset($_GET['article_published'])) {
            $confirm = "<div class='alert alert-success'>Félicitations ! Votre chapitre a bien été publié.</div>";
        }

        if (isset($_GET['update_post'])) {
            $article = $articlesManager->getOnePost($_GET['update_post']);
            $title_article = $article['title_article']; 
            $content_article = $article['content_article'];
            $id_article = $article['id'];
            $display = 'initial';
            $number_article = $article['number_article'];
            $confirm_article = 'METTRE A JOUR';
            $button_confirm = 'updates';
            $title_write_article = 'MODIFIER UN CHAPITRE DE VOTRE ROMAN :';
        }

        $update_article = false;
        if (!empty($_POST['updates'])) {
            if (empty($_POST['title']) || empty($_POST['content']) || empty($_POST['number_article'])) {
                if (empty($_POST['title'])) {
                    $update_article= false; 
                    $confirm_title = "<div class='alert alert-danger'>Article non publié : vous devez rentrer un titre pour votre chapitre.</div>";
                }
                if (empty($_POST['content'])) {
                    $update_article = false; 
                    $confirm_content = "<div class='alert alert-danger'>Article non publié : vous devez rentrer un contenu pour votre chapitre.</div>";
                }  
                if (empty($_POST['number_article'])) {
                    $update_article = false; 
                    $confirm_number_article = "<div class='alert alert-danger'>Article non publié : vous devez rentrer un numéro pour votre chapitre.</div>";
                }  
                elseif (!(int)($_POST['number_article'])) {
                    $update_article = false; 
                    $confirm_number_article = "<div class='alert alert-danger'>Vous devez rentrez un chiffre en numéro de chapitre.</div>";
                } 
            } else {
                $update_article = true; 
            }
        }

        if ($update_article) {
            $confirm_article = 'PUBLIER';
            $update = $articlesManager->updatePost($id_article, $_POST['number_article'], $_POST['title'], $_POST['content']); 
            header('Location: index.php?action=admin_articles&updated=true');
        }

        if(isset($_GET['updated'])) {
            $confirm = "<div class='alert alert-success'>Votre chapitre a bien été mis à jour.</div>";
        }

        if (isset($_GET['delete_post'])) {
            $delete = $articlesManager->deletePost($_GET['delete_post']); 
            header('Location: index.php?action=admin_articles&delete_success');
        }

        if(isset($_GET['delete_success'])) {
            $confirm = "<div class='alert alert-success'>Votre chapitre a bien été supprimé.</div>";
        }

        require_once('view/backend/articles.php');
    }
}