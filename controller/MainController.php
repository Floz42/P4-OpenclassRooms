<?php 

namespace controller;

use Blog\model\CommentsManager;

class MainController {

    public function accueil()
    {
        require('view/frontend/accueil.php');
    }

    public function biographie()
    {
        require('view/frontend/biographie.php');
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
        require('view/frontend/contact.php');
    }

    /**
     * articles use to artciles page 
     *
     * @return void
     */
    public function articles()
    {
        require('model/ArticlesManager.php');

        $i = (int)htmlspecialchars($_GET['index_page']);
        $error = "<div class='alert alert-danger'> Une erreur est survenue, il est impossible d'afficher la liste des articles</div>";
       
        $articlesManager = new \blog\model\ArticlesManager;
        $articles = $articlesManager->getPosts_five($i);
        $count_articles = $articlesManager->countArticles();
        $total_articles = (int)$count_articles["number_articles"];
        $total_pages = ceil($total_articles / 4);   
        $success = ($_GET['index_page'] > $total_pages || !(int)$_GET['index_page']|| $_GET['index_page'] < 0) ? false : true;

        require('view/frontend/articles.php');
    }

    /**
     * one_post -> get post selected with it inforomations and comments associate
     *
     * @return void
     */
    public function one_post()
    {
        require('model/ArticlesManager.php');
        require('model/CommentsManager.php');

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
            $comment_author = 'Flo';
            $comment_content = nl2br(htmlentities($_POST['post_comment']));
            $id_post = $_GET['id'];
            $commentManager->addComment($comment_author,$comment_content,$id_post);
            header('Location: index.php?action=one_post&id=' . $_GET['id'] . '&com=true');
        }

        if (isset($_GET['com'])) {
            $message_comment = "<div class='alert alert-success'> Merci ! Votre commentaire a bien été posté. </div>"; 
        }

        require('view/frontend/one_post.php');
    }

    public function connexion()
    {
        require('model/UsersManager.php');
        $UsersManager = new \blog\model\UsersManager;
        //$addUser = $UsersManager->addUser($pseudo,$password,$email);

        if (isset($_POST['submit'])) {
            $user_exist = $UsersManager->pseudoExist($_POST['pseudo']);
            $validation = true;
            if (empty($_POST['pseudo']) || empty($_POST['password']) || empty($_POST['confirm_password']) || empty($_POST['email'])) {
                $message_error = '<div class="alert alert-danger mt-3">Tous les champs doivent être remplis</div>';
                $validation = false;
            }
            if (strlen($_POST['pseudo']) < 6 ) {
                $pseudo = '<div class="alert alert-danger mt-3">Votre pseudo doit comporter au moins 6 caractères.</div>';
                $validation = false;
            }
            if ($user_exist == 1) {
                $pseudo2 = '<div class="alert alert-danger mt-3">Ce pseudo est déjà pris.</div>';
                $validation = false;
            }
            if ((strlen($_POST['password']) < 6) || ($_POST['password'] != $_POST['confirm_password'])) {
                $password = '<div class="alert alert-danger mt-1">Les deux mots de passe doivent être identiques et comporter au moins 6 caractères.</div>';
                $validation = false;
            }
            if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])) {
                $email = '<div class="alert alert-danger mt-1">L\'adresse e-mail est invalide.</div>';
                $validation = false;
            }
        
            if ($validation) {
                $pseudo_register = htmlentities($_POST['pseudo']);
                $password_register = htmlentities(password_hash($_POST['password'], PASSWORD_DEFAULT));
                $mail_register = htmlentities($_POST['email']);
                $UsersManager->addUser($pseudo_register, $password_register, $mail_register);
            }
        } 




        require('view/frontend/connexion.php');
    }
}
