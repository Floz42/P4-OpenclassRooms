<?php 
namespace Blog\controller;
session_start();
if (!isset($_COOKIE['expiration'])) {
    session_destroy();
}

require_once('controller/MainController.php');
require_once('controller/AdminController.php');

class Routes {

    public function __construct()
    {
        $controller = new MainController();
        $controller_admin = new AdminController();

        try 
        {
            switch($_GET['action']) 
            {
                case 'accueil' : 
                    $controller->accueil();
                break;
                case 'biographie' : 
                    $controller->biographie();
                break;
                case 'contact' : 
                    $controller->contact();
                break;
                case 'articles' : 
                    $controller->articles();
                break;
                case 'one_post' : 
                    $controller->one_post();
                break;
                case 'connexion' : 
                    $controller->connexion();
                break;
                case 'deconnexion' : 
                    $controller->deconnexion();
                break;
                case 'admin' : 
                    $controller_admin->verif_role();
                    $controller_admin->admin_accueil();
                break;
                case 'utilisateurs' : 
                    $controller_admin->verif_role();
                    $controller_admin->admin_users();
                break;
                case 'commentaires' : 
                    $controller_admin->verif_role();
                    $controller_admin->admin_comments();
                break;
                case 'admin_articles' : 
                    $controller_admin->verif_role();
                    $controller_admin->admin_articles();
                break;
                default:
                    $controller->error();
            }
        }
        catch(\Exception $e) 
        {
            $controller->error();

        }
    }

}