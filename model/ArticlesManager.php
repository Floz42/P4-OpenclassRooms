<?php
namespace Blog\model;
use Blog\model\Manager;

require_once 'Manager.php';

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
     * getPosts -> get all posts 4 by 4 in DB
     * Use for paging on website 
     *
     * @return array
     */
    public function getPosts_five($i) 
    {   
        $articles = [];
        $req = $this->db->query('SELECT *, DATE_FORMAT(date_article, "%d/%m/%Y") as date_article FROM Articles ORDER BY number_article DESC LIMIT '. (($i - 1) * 5) .', 5');
        while ($data = $req->fetch(\PDO::FETCH_ASSOC)) 
        {
            $articles[] = $data;
        }
        return $articles;
    }

    /**
     * getPosts -> get all posts in DB
     *
     * @return void
     */
    public function getPosts() 
    {
        $articles = [];
        $req = $this->db->query('SELECT *, DATE_FORMAT(date_article, "%d/%m/%Y") as date_article FROM Articles ORDER BY number_article DESC');
        while ($data = $req->fetch(\PDO::FETCH_ASSOC)) 
        {
            $articles[] = $data;
        }
        return $articles;
    }
    
    /**
     * getPosts -> get all posts in DB
     *
     * @return void
     */
    public function getPosts_reverse() 
    {
        $articles = [];
        $req = $this->db->query('SELECT *, DATE_FORMAT(date_article, "%d/%m/%Y") as date_article FROM Articles ORDER BY number_article DESC');
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
        $req = $this->db->prepare('SELECT *, DATE_FORMAT(date_article, " %d/%m/%Y à %H:%i:%s") as date_article FROM Articles WHERE id = :id');
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
    public function createPost($title, $number_article, $content)
    {
        $req = $this->db->prepare('INSERT INTO Articles (number_article, title_article, content_article, date_article) VALUES(:number_article, :title, :content, NOW())');
        $req->execute(array(
            'title' => $title,
            'number_article' => $number_article,
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
    public function updatePost($id, $number_article, $title, $content)
    {
        $req = $this->db->prepare('UPDATE Articles SET number_article = :number_article, title_article = :title, content_article = :content WHERE id = :id'); 
        $req->execute(array(
            'id' => $id,
            'title' => $title,
            'content' => $content,
            'number_article' => $number_article
        ));
    }

    /**
     * countArticles 
     *
     * @return total articles in DB
     */
    public function countArticles()
    {
        $req = $this->db->query('SELECT COUNT(id) as number_articles FROM Articles');
        $data = $req->fetch(\PDO::FETCH_ASSOC);
        return $data;
    }

    /**
     * lastNumberArticle return the last number_article (not id)
     *
     * @return int
     */
    public function lastNumberArticle()
    {
        $req = $this->db->query('SELECT * FROM Articles ORDER BY number_article DESC LIMIT 0,1');
        $data = $req->fetch(\PDO::FETCH_ASSOC);
        return $data;
    }

}


