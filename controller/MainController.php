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

        if (isset($_GET['report'])) {
            if ($_GET['report'] === 'one_report') {
                $commentManager->addReport($_GET['id_comment']);
                header('Location:' . $_SERVER["HTTP_REFERER"] . '&report=on');
        } 
    }
        require('view/frontend/one_post.php');
    }
}
