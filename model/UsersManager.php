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
        $req = $this->db->query('SELECT * FROM Users ORDER BY id ASC');
        while ($data = $req->fetch(\PDO::FETCH_ASSOC))
        {
            $users[] = $data;
        }
        var_dump($users);
        return $users;
    }

    /**
     * getOneUser -> select an user with his ID
     *
     * @param  mixed $id
     *
     * @return array
     */
    public function getOneUser($id)
    {
        $req = $this->db->prepare('SELECT * FROM Users WHERE id = :id');
        $req->execute(array('id' => $id));
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
     * addAdmin -> change user_role to "admin"
     *
     * @param  mixed $id
     *
     * @return void
     */
    public function addAdmin($id)
    {
        $req = $this->db->prepare('UPDATE Users SET user_role = :adminRole WHERE id = :id');
        $req->execute(array(
            'adminRole' => 'admin',
            'id' => $id
        ));
    }

    /**
     * delAdmin -> change user_role to "user"
     *
     * @param  mixed $id
     *
     * @return void
     */
    public function delAdmin($id)
    {
        $req = $this->db->prepare('UPDATE Users SET user_role = :adminRole WHERE id = :id');
        $req->execute(array(
            'adminRole' => 'user',
            'id' => $id
        ));
    }

}

$test = new UsersManager();
$test->getUsers();


