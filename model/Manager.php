<?php 

class Manager {

    /**
     * dbConnect --> connexion DB
     *
     * @return --> true or false (with message)
     */
    protected function dbConnect() {
        try {
            $db = new \PDO('mysql:host=localhost;dbname=Blog;charset=utf8', 'root', 'root');
            echo '<div class="alert alert-success"> Connexion à la base de données réussie !</div>';
            return $db;
        }
        catch (\Exception $e) {
            echo '<div class="alert alert-danger">Une erreur est survenue lors de la connexion à la base de donnée : <br>';
            die('Erreur :' .$e->getMessage());
        }
    }
}

