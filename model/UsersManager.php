<?php 
namespace Blog\model;
use Blog\model\Manager;

require_once 'Manager.php';

class UsersManager extends Manager 
{

    /**
     * __construc -> call DB when class is Instanciate
     *
     * @return void
     */
    public function __construct()
    {
        $this->db = $this->dbConnect();
    }

    /**
     * getUsers -> list of all users
     *
     * @return array 
     */
    public function getUsers()
    { 
        $users = [];
        $req = $this->db->query('SELECT *, UPPER(user_role) as user_role FROM Users ORDER BY id ASC');
        while ($data = $req->fetch(\PDO::FETCH_ASSOC))
        {
            $users[] = $data;
        }
        return $users;
    }

    public function pseudoExist($pseudo) 
    {
        $req = $this->db->prepare('SELECT COUNT(*) as pseudo_exist FROM Users WHERE pseudo = :pseudo'); 
        $req->execute(array('pseudo' => $pseudo));
        $users = $req->fetch(\PDO::FETCH_COLUMN);
        return $users;
    }

    /**
     * getOneUser -> select an user with his ID
     *
     * @param  mixed $id
     *
     * @return array
     */
    public function getOneUser($pseudo)
    {
        $req = $this->db->prepare('SELECT * FROM Users WHERE pseudo = :pseudo');
        $req->execute(array('pseudo' => $pseudo));
        $user = $req->fetch(\PDO::FETCH_ASSOC);
        return $user; 
    }

    /**
     * addUser -> add an user in the DB
     *
     * @param  mixed $pseudo
     * @param  mixed $password
     * @param  mixed $mail
     * @param  mixed $user_role
     *
     * @return void
     */
    public function addUser($pseudo, $password, $mail)
    {
        $req = $this->db->prepare('INSERT INTO Users (pseudo, password, mail) VALUES (:pseudo, :password, :mail)');
        $req->execute(array(
            'pseudo' => $pseudo,
            'password' => $password, 
            'mail' => $mail
        ));
    }

    /**
     * updateUser -> update user informations 
     *
     * @param  mixed $id
     * @param  mixed $pseudo
     * @param  mixed $password
     * @param  mixed $mail
     *
     * @return void
     */
    public function updateUser($id, $pseudo, $password, $mail) 
    {
        $req = $this->db->prepare('UPDATE Users SET pseudo = :pseudo, password = :password, mail = :mail WHERE id = :id'); 
        $req->execute(array(
            'id' => $id,
            'pseudo' => $pseudo,
            'password' => $password,
            'mail' => $mail
        ));
    }

    /**
     * delUser -> delete user with his ID
     *
     * @param  mixed $id
     *
     * @return void
     */
    public function delUser($id)
    {
        $req = $this->db->prepare('DELETE FROM Users WHERE id = :id');
        $req->execute(array('id' => $id));
    }


    /**
     * addAdmin -> change user_role 
     *
     * @param  mixed $id
     *
     * @return void
     */
    public function changeRole($id, $user_role)
    {
        $req = $this->db->prepare('UPDATE Users SET user_role = :user_role WHERE id = :id');
        $req->execute(array(
            'user_role' => $user_role,
            'id' => $id
        ));
    }

}



