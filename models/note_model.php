<?php

class Note_Model extends Model
{

    function __construct()
    {
        parent::__construct();


    }

    /**
     * @return mixed
     */
    public function noteList()
    {

        return $this->db->select('SELECT * FROM note WHERE user_id = :user_id ORDER BY note_id DESC ',
            array('user_id' => $_SESSION['user_id']));

//        $stm = $this->db->prepare('SELECT id, login, role FROM users');
//        $stm->execute();
//        return $stm->fetchAll();

    }

    public function singleNoteList($note_id)
    {
        echo $_SESSION['user_id'];
        echo '<br/>';
        $STH = $this->db->prepare('SELECT * FROM note WHERE
                                  user_id = :user_id AND note_id = :note_id');
        $STH->execute(array(':user_id' => $_SESSION['user_id'], ':note_id' => $note_id));
        //$STH->fetch();
        //var_dump($STH);
        return $STH->fetch();


    }


    public function insertNote($data)
    {


        $this->db->insert('note', array(
                'title' => $data['title'],
                'user_id' => $_SESSION['user_id'],
                'content' => $data['content'],
                'date' => date('Y-m-d H:i:s') //use GMT aka UTC 0:00
        ));

//        $stm = $this->db->prepare("INSERT INTO users
//          (login, password, role)
//          VALUES (:username, :password, :role)
//          ");
//        $stm->execute(array(
//            ':login' => $data['login'],
//            ':password' => Hash::create_hash('md5', $data['password'], HASH_KEY),
//            ':role' => $data['role'],
//        ));


    }

    public function editNote($data)
    {
        //echo $data['role']; die;
        $postData = array(
            'title' => $data['title'],
            'content' => $data['content'],
            'date' => date('Y-m-d H:i:s')
        );

        $this->db->update('note', $postData, "`note_id` = {$data['note_id']}
                    AND user_id = '{$_SESSION['user_id']}'");

//        $stm = $this->db->prepare("UPDATE users
//            SET login = :login,
//             password = :password,
//              role = :role
//            WHERE id = :id");
//
//        //var_dump($stm);die;
//        $stm->execute(array(
//            ':id'       => $data['id'],
//            ':login' => $data['login'],
//            ':password' => $data['password'],
//            ':role'     => $data['role']
//        ));
    }

    public function deleteNote($noteid)
    {
        $this->db->delete('note', "`note_id` = $noteid
                    AND user_id = '{$_SESSION['user_id']}'");

    }


}
