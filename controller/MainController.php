<?php 

namespace controller;

class MainController {

    public function accueil()
    {
        require_once('view/frontend/accueil.php');
    }
    public function biographie()
    {
        require_once('view/frontend/biographie.php');
    }
}
