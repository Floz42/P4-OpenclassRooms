<?php 
namespace Blog\model;

abstract class Manager {

    /**
     * dbConnect --> connexion DB
     *
     * @return --> true or false (with message)
     */
    protected function dbConnect() {
        try {
            $db = new \PDO('mysql:host=localhost;dbname=Blog;charset=utf8', 'root', 'root', array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
         // $db = new \PDO('mysql:host=db5000283097.hosting-data.io;port=3306;dbname=dbs276326;charset=utf8', 'dbu486824', '@Xx6y3p33', array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
            return $db;
        }
        catch (\Exception $e) {
            echo '<div class="alert alert-danger">Une erreur est survenue lors de la connexion à la base de donnée : <br>';
            die('Erreur :' .$e->getMessage());
        }
    }
}


