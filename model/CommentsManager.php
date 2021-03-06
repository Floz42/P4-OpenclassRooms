<?php
namespace Blog\model;
use Blog\model\Manager;

require_once 'Manager.php';

class CommentsManager extends Manager {

    public function __construct()
    {
        $this->db = $this->dbConnect();
    }

    /**
     * getOneComment
     *
     * @param  mixed $id
     *
     * @return array
     */
    public function getOneComment($id)
    {
        $req = $this->db->prepare('SELECT * FROM Comments WHERE id = :id');
        $req->execute(array('id' => $id));
        $comment = $req->fetch(\PDO::FETCH_ASSOC);
        return $comment;
    }

    /**
     * getCommentsToAPost -> select a post and fetch all comments order by date_comment
     *
     * @param  mixed $id
     *
     * @return array $comments
     */
    public function getCommentsToAPost($id) 
    {
        $comments = [];
        $req = $this->db->prepare('SELECT * , DATE_FORMAT(date_comment, " %d/%m/%Y à %H:%i:%s") as date_comment FROM Comments WHERE id_article = :id ORDER BY date_comment DESC');
        $req->execute(array('id' => $id));
        while ($data = $req->fetch(\PDO::FETCH_ASSOC))
        {
            $comments[] = $data;
        }
        return $comments;
    }

    /**
     * getComments -> got ALL comments order by number of reports
     *
     * @return array $comments
     */
    public function getComments() {
        $comments = [];
        $req = $this->db->query('SELECT * FROM Comments ORDER BY reports DESC, date_comment DESC ');
        while ($data = $req->fetch(\PDO::FETCH_ASSOC))
        {
            $comments[] = $data;
        }
        return $comments;
    }

    /**
     * getPosts_five can return comments 5 by 5 in DB
     *
     * @param  mixed $i
     *
     * @return $comments
     */
    public function getComments_five($i) 
    {   
        $comments = [];
        $req = $this->db->query('SELECT *, DATE_FORMAT(date_comment, "%d/%m/%Y à %H:%i:%s") as date_comment FROM Comments ORDER BY reports DESC, date_comment DESC LIMIT '. (($i - 1) * 5) .', 5');
        while ($data = $req->fetch(\PDO::FETCH_ASSOC)) 
        {
            $comments[] = $data;
        }
        return $comments;
    }

    /**
     * addComment -> add comment in DB
     *
     * @param  mixed $author
     * @param  mixed $comment
     * @param  mixed $id_article
     *
     * @return void
     */
    public function addComment($author, $comment, $id_article)
    {
        $req = $this->db->prepare('INSERT INTO Comments (author_comment, comment, date_comment, id_article) VALUES (:author, :comment, NOW(), :id_article)');
        $req->execute(array(
            'author' => $author,
            'comment' => $comment,
            'id_article' => $id_article
        ));
    }

    /**
     * delComment -> delete a comment in DB
     *
     * @param  mixed $id
     *
     * @return void
     */
    public function delComment($id) 
    {
        $req = $this->db->prepare('DELETE FROM Comments WHERE id = :id');
        $req->execute(array('id' => $id));
    }

    /**
     * updateComment 
     *
     * @param  mixed $id
     * @param  mixed $author
     * @param  mixed $comment
     *
     * @return void
     */
    public function updateComment($id, $author, $comment)
    {
        $req = $this->db->prepare('UPDATE Comments SET author_comment = :author, comment = :comment WHERE ID = :id');
        $req->execute(array(
            'id' => $id,
            'author' => $author,
            'comment' => $comment
        ));
    }

    /**
     * addReport add 1 to "reports" when comment is report
     *
     * @param  mixed $id
     *
     * @return void
     */
    public function addReport($id)
    {   
        $req = $this->db->prepare('UPDATE Comments SET reports = reports + 1 WHERE id = :id');
        $req->execute(array('id' => $id));
    }

    /**
     * delReports put reports to comment at 0 
     *
     * @param  mixed $id
     *
     * @return void
     */
    public function delReports($id)
    {
        $req = $this->db->prepare('UPDATE Comments SET reports = 0 WHERE id = :id');
        $req->execute(array('id' => $id));
    }

    /**
     * countComments 
     *
     * @return total comments in DB
     */
    public function countComments()
    {
        $req = $this->db->query('SELECT COUNT(id) as number_comments FROM Comments');
        $data = $req->fetch(\PDO::FETCH_ASSOC);
        return $data;
    }  
}

