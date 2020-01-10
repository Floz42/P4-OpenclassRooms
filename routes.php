<?php 
namespace controller;
session_start();
require_once('controller/MainController.php');


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
            }
        }
        catch(\Exception $e) 
        {

        }
    }

}