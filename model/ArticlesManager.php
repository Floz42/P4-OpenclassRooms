<?php
namespace Blog\model;
use Blog\model\Manager;


require 'Manager.php';
class ArticlesManager extends Manager 
{

    public function __construct()
    {
        $this->db = $this->dbConnect();
    }

    public function getPosts() 
    {
        $articles = [];
        $req = $this->db->query('SELECT * FROM Articles ORDER BY date_article DESC');
        while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
            $articles[] = $data;
        }
        return $articles;
    }

    public function getOnePost($id)
    {
        $req = $this->db->prepare('SELECT * FROM Articles WHERE id = :id');
        $req->execute(array('id' => $id));
        $article = $req->fetch(\PDO::FETCH_ASSOC);
        return $article; 
    }

    public function createPost($title, $content)
    {
        $req = $this->db->prepare('INSERT INTO Articles (title_article, content_article, date_article) VALUES(:title, :content, NOW())');
        $req->execute(array(
            'title' => $title,
            'content' => $content
        ));
    }

    public function deletePost($id) 
    {
        $req = $this->db->prepare('DELETE FROM Articles WHERE id = :id');
        $req->execute(array('id' => $id));
    }

    public function updatePost($id, $title, $content)
    {
        $req = $this->db->prepare('UPDATE Articles SET title_article = :title, content_article = :content WHERE id = :id'); 
        $req->execute(array(
            'id' => $id,
            'title' => $title,
            'content' => $content
        ));
    }


}

$test = new ArticlesManager();

$test->getOnePost(1);
// $test->deletePost(2);
$test->updatePost(1, 'Modified second time', 'Je suis vraiment trop un boss');