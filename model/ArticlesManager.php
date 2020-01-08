<?php
require 'Manager.php';
class ArticlesManager extends Manager 
{
    $
    public function __construct()
    {
        $this->db = $this->dbConnect();
    }

    public function getPosts() 
        $reponse = this->db->query('SELECT * FROM Articles');
        while ($donnees = $reponse->fetch()) 
        { ?>
            <p> Voici l'article n° : <?= $donnees['id'] ?> </p>
            <p> Son titre : <?= $donnees['title_article'] ?> </p>
            <p> Son contenu : <?= $donnees['content_article'] ?> </p>
            <p> Sa date de création : <?= $donnees['date_article'] ?> </p>
        <?php 
        }
    }
}

$test = new ArticlesManager();

// $test->getPosts();
var_dump($test->dbconnect());
