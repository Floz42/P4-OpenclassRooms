<?php 

namespace controller;

use Blog\model\CommentsManager;

class MainController {

    public function accueil()
    {
        require_once('view/frontend/accueil.php');
    }

    public function biographie()
    {
        require_once('view/frontend/biographie.php');
    }

    /**
     * contact use to contact page and verify if all inputs aren't empty
     *
     * @return void
     */
    public function contact()
    {        
        $confirm = false;

        if (isset($_POST['submit'])) {
            if (empty($_POST['name']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['message']) ) {
                if (empty($_POST['name'])) {
                    $name = '<div class="alert alert-danger mt-3">Vous devez indiquer votre nom.</div>';
                }
                if (empty($_POST['lastname'])) {
                    $lastname = '<div class="alert alert-danger mt-1">Vous devez indiquer votre prénom.</div>';
                }
                if (empty($_POST['subject'])) {
                    $subject = '<div class="alert alert-danger mt-1">Merci d\'entrer le sujet de votre message.</div>';
                }
                if (empty($_POST['email'])) {
                    $email = '<div class="alert alert-danger mt-1">Vous devez indiquer votre email.</div>';
                }
                if (empty($_POST['message'])) {
                    $message = '<div class="alert alert-danger mt-1">Vous devez rédiger un message.</div>';
                }
            } else {
                $confirm = '<div class="alert alert-success mt-3">Merci. Votre message a bien été envoyé.</div>';
                $to = 'flo.carreclub@gmail.com';
                $form_name = htmlentities($_POST['name']);
                $form_lastname = htmlentities($_POST['lastname']);
                $form_subject = htmlentities($_POST['subject']);
                $form_email = htmlentities($_POST['email']);
                $form_message = wordwrap(htmlentities($_POST['message']), 100, "\r\n");
                $headers = 'From : ' . $form_name . ' ' . $form_lastname . ' E-mail : ' . $form_email;
                mail($to, $form_subject, $form_message, $headers);
            }
        }
        require_once('view/frontend/contact.php');
    }

    /**
     * articles use to articles page 
     *
     * @return void
     */
    public function articles()
    {
        require_once('model/ArticlesManager.php');

        $i = (int)htmlspecialchars($_GET['index_page']);
        $error = "<div class='alert alert-danger'> Une erreur est survenue, il est impossible d'afficher la liste des articles</div>";
       
        $articlesManager = new \blog\model\ArticlesManager;
        $articles = $articlesManager->getPosts_five($i);
        $count_articles = $articlesManager->countArticles();
        $total_articles = (int)$count_articles["number_articles"];
        $total_pages = ceil($total_articles / 5);   
        $success = ($_GET['index_page'] > $total_pages || !(int)$_GET['index_page']|| $_GET['index_page'] < 0) ? false : true;

        require_once('view/frontend/articles.php');
    }

    /**
     * one_post -> get post selected with it inforomations and comments associate
     *
     * @return void
     */
    public function one_post()
    {
        require_once('model/ArticlesManager.php');
        require_once('model/CommentsManager.php');

        $articlesManager = new \blog\model\ArticlesManager;
        $article = $articlesManager->getOnePost($_GET['id']);
        $title_article = $article['title_article'];
        $content_article = $article['content_article'];
        $intro_article = substr($content_article, 0, 190);
        $date_article = $article['date_article'];

        $commentManager = new \blog\model\CommentsManager;
        $comments = $commentManager->getCommentsToAPost($_GET['id']);
        $confirm = "<div class='alert alert-success'> Le commentaire à bien été signalé à l'administrateur </div>";

        if ((!isset($_GET['reporting'])) || ($_GET['reporting'] !== 'on')) {
            $has_report = '&reporting=on';
        } else {
            $has_report = '';
        } 
        if (isset($_GET['report'])) {
            if ($_GET['report'] === 'one_report') {
                $commentManager->addReport($_GET['id_comment']);
                header('Location:' . $_SERVER["HTTP_REFERER"] . $has_report ?? '');
            } 
        }
        $validation_comment = false;
        if (!empty($_POST)) {
            if (empty($_POST['post_comment'])) {
                $validation_comment = false;
                $message_comment = "<div class='alert alert-danger'> Le champ \"Votre commentaire ici :\" doit être rempli. </div>";
            } else {
            $validation_comment = true;
            }
        }
        if ($validation_comment) {
            $comment_author = $_SESSION['pseudo'];
            $comment_content = nl2br(htmlentities($_POST['post_comment']));
            $id_post = $_GET['id'];
            $commentManager->addComment($comment_author,$comment_content,$id_post);
            header('Location: index.php?action=one_post&id=' . $_GET['id'] . '&com=true');
        }
        if (isset($_GET['com'])) {
            $message_comment = "<div class='alert alert-success'> Merci ! Votre commentaire a bien été posté. </div>"; 
        }

        require_once('view/frontend/one_post.php');
    }

    public function connexion()
    {
        require_once('model/UsersManager.php');
        $UsersManager = new \blog\model\UsersManager;    

        if (isset($_POST['connexion'])) {
            $connexion = true; 
            $pseudo_exist = $UsersManager->pseudoExist($_POST['pseudo_connexion']); 
            if ($pseudo_exist == 0) {
                $connexion = false; 
                $message_connexion = '<div class="alert alert-danger mt-1">Erreur : Ce pseudo n\'existe pas. </div>';
            } else {
                $get_user = $UsersManager->getOneUser($_POST['pseudo_connexion']);
                $password_connexion = htmlentities($_POST['password_connexion']);
                $password_hash = $get_user['password'];
                $password_verify = password_verify($password_connexion, $password_hash);
                if (!$password_verify) {
                    $connexion = false; 
                    $message_connexion = '<div class="alert alert-danger mt-1">Vos informations de connexion ne sont pas les bonnes. </div>';
                }
            }
            if ($connexion) {
                $user_role = $get_user['user_role'];
                $message_connexion = '<div class="alert alert-success mt-1">Vous êtes maintenant connecté. </div>';
                $_SESSION['pseudo'] = $_POST['pseudo_connexion'];
                $_SESSION['connected'] = true;
                $_SESSION['user_role'] = $user_role;
                setcookie('expiration', 'date', time() + 60 * 60 * 12, null, null, false, true);
            }
        }

        if (isset($_POST['submit_subscribe'])) {
            $validation = true;
            $user_exist = $UsersManager->pseudoExist($_POST['pseudo_subscribe']);
            if (empty($_POST['pseudo_subscribe']) || empty($_POST['password_subscribe']) || empty($_POST['confirm_password_subscribe']) || empty($_POST['email_subscribe'])) {
                $message_subscribe = '<div class="alert alert-danger mt-3">Tous les champs doivent être remplis</div>';
                $validation = false;
            }
            if (strlen($_POST['pseudo_subscribe']) < 6 ) {
                $pseudo_subscribe = '<div class="alert alert-danger mt-3">Votre pseudo doit comporter au moins 6 caractères.</div>';
                $validation = false;
            }
            if ($user_exist == 1) {
                $pseudo2_subscribe = '<div class="alert alert-danger mt-3">Ce pseudo est déjà pris.</div>';
                $validation = false;
            }
            if ((strlen($_POST['password_subscribe']) < 6) || ($_POST['password_subscribe'] != $_POST['confirm_password_subscribe'])) {
                $password_subscribe = '<div class="alert alert-danger mt-1">Les deux mots de passe doivent être identiques et comporter au moins 6 caractères.</div>';
                $validation = false;
            }
            if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email_subscribe'])) {
                $email_subscribe = '<div class="alert alert-danger mt-1">L\'adresse e-mail est invalide.</div>';
                $validation = false;
            }
        
            if ($validation) {
                $message_subscribe = '<div class="alert alert-success mt-3">Votre inscription est bien prise en compte, vous pouvez maintenant vous connecter.</div>';
                $pseudo_register = htmlentities($_POST['pseudo_subscribe']);
                $password_register = htmlentities(password_hash($_POST['password_subscribe'], PASSWORD_DEFAULT));
                $mail_register = htmlentities($_POST['email_subscribe']);
                $UsersManager->addUser($pseudo_register, $password_register, $mail_register);
            }
        } 
        require_once('view/frontend/connexion.php');
    }

    public function deconnexion()
    {
        session_destroy();
        setcookie('expiration', 'date', -360);
        header('Location: index.php?action=accueil');
    }
}
