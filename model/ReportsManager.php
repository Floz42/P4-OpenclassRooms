<?php 
namespace Blog\model;
use Blog\model\Manager;

require_once 'Manager.php';

class ReportsManager extends Manager
{

    public function __construct()
    {
        $this->db = $this->dbConnect();
    }

    public function addReport($id_comment, $pseudo) 
    {
        $req = $this->db->prepare('INSERT INTO Reports (id_comment, pseudo) VALUES (:id_comment, :pseudo)');
        $req->execute(array(
            'id_comment' => $id_comment,
            'pseudo' => $pseudo
        ));
    }

    public function delReports($id_comment) 
    {
        $req = $this->db->prepare('DELETE FROM Reports WHERE id_comment = :id');
        $req->execute(array('id' => $id_comment));

    }

    public function countIfUserHasReport($pseudo, $id_comment)
    {
        $req = $this->db->prepare('SELECT COUNT(*) as pseudo_exist FROM Reports WHERE pseudo = :pseudo AND id_comment = :id_comment'); 
        $req->execute(array(
            'pseudo' => $pseudo,
            'id_comment' => $id_comment
        ));
        $users = $req->fetch(\PDO::FETCH_COLUMN);
        return $users;
    }
}