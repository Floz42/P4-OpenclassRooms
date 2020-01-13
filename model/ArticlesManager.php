<?php
namespace Blog\model;
use Blog\model\Manager;

require 'Manager.php';

class ArticlesManager extends Manager 
{

    /**
     * __construct --> Initialise DB when class is instanciate
     *
     * @return void
     */
    public function __construct()
    {
        $this->db = $this->dbConnect();
    }

    /**
     * getPosts -> get all posts in DB
     *
     * @return array
     */
    public function getPosts() 
    {
        $articles = [];
        $req = $this->db->query('SELECT *, DATE_FORMAT(date_article, "%d/%m/%Y") as date_article FROM Articles ORDER BY date_article DESC');
        while ($data = $req->fetch(\PDO::FETCH_ASSOC)) 
        {
            $articles[] = $data;
        }
        return $articles;
    }

    /**
     * getOnePost -> select a post in DB
     *
     * @param  mixed $id
     *
     * @return array
     */
    public function getOnePost($id)
    {
        $req = $this->db->prepare('SELECT * FROM Articles WHERE id = :id');
        $req->execute(array('id' => $id));
        $article = $req->fetch(\PDO::FETCH_ASSOC);
        return $article; 
    }

    /**
     * createPost
     *
     * @param  mixed $title
     * @param  mixed $content
     *
     * @return void
     */
    public function createPost($title, $content)
    {
        $req = $this->db->prepare('INSERT INTO Articles (title_article, content_article, date_article) VALUES(:title, :content, NOW())');
        $req->execute(array(
            'title' => $title,
            'content' => $content
        ));
    }

    /**
     * deletePost
     *
     * @param  mixed $id
     *
     * @return void
     */
    public function deletePost($id) 
    {
        $req = $this->db->prepare('DELETE FROM Articles WHERE id = :id');
        $req->execute(array('id' => $id));
    }

    /**
     * updatePost
     *
     * @param  mixed $id
     * @param  mixed $title
     * @param  mixed $content
     *
     * @return void
     */
    public function updatePost($id, $title, $content)
    {
        $req = $this->db->prepare('UPDATE Articles SET title_article = :title, content_article = :content WHERE id = :id'); 
        $req->execute(array(
            'id' => $id,
            'title' => $title,
            'content' => $content
        ));
    }

    public function getCommentsByArticle($id_article) 
    {
        // $article_comments = [];
        $success = false;

        $req = $this->db->query(
        'SELECT * 
        FROM Comments
        RIGHT JOIN Articles
        ON Comments.id_article = Articles.id
        ORDER BY date_comment
        ');

        /* while ($data = $req->fetch(\PDO::FETCH_ASSOC))
        {
            $article_comments[] = $data;
        }
        return $article_comments; */

        if ($id_article != null) {
            $success = true;
        };
        var_dump($success);
    }
}


