<?php 
namespace controller;
session_start();
if (!isset($_COOKIE['expiration'])) {
    session_destroy();
}

require_once('controller/MainController.php');
require_once('controller/AdminController.php');


class Routes {

    public function __construct()
    {
        try 
        {
            switch($_GET['action']) 
            {
                case 'accueil' : 
                    $controller = new MainController();
                    $controller->accueil();
                break;
                case 'biographie' : 
                    $controller = new MainController();
                    $controller->biographie();
                break;
                case 'contact' : 
                    $controller = new MainController();
                    $controller->contact();
                break;
                case 'articles' : 
                    $controller = new MainController();
                    $controller->articles();
                break;
                case 'one_post' : 
                    $controller = new MainController();
                    $controller->one_post();
                break;
                case 'connexion' : 
                    $controller = new MainController();
                    $controller->connexion();
                break;
                case 'deconnexion' : 
                    $controller = new MainController();
                    $controller->deconnexion();
                break;
                case 'admin' : 
                    $controller = new AdminController();
                    $controller->verif_role();
                    $controller->admin_accueil();
                break;
                case 'utilisateurs' : 
                    $controller = new AdminController();
                    $controller->verif_role();
                    $controller->admin_users();
                break;
                case 'commentaires' : 
                    $controller = new AdminController();
                    $controller->verif_role();
                    $controller->admin_comments();
                break;
                case 'admin_articles' : 
                    $controller = new AdminController();
                    $controller->verif_role();
                    $controller->admin_articles();
                break;
            }
        }
        catch(\Exception $e) 
        {

        }
    }

}