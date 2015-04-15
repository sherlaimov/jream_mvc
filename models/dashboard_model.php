<?php

class Dashboard_Model extends Model {

    public function xhrInsert()
    {
        echo $_POST['text'];
        $text = $_POST['text'];
        $stm = $this->db->prepare('INSERT INTO data (text) VALUES (:text)');
        //var_dump($stm); die;

        $stm->execute(array(':text' => $text));

        $data = array('text' => $text, 'id' => $this->db->lastInsertId());
        echo json_encode($data);
    }

    public function xhrGetListings(){
        $stm = $this->db->prepare('SELECT * FROM data');
        $stm->setFetchMode(PDO::FETCH_ASSOC);
        $stm->execute();
        $data = $stm->fetchAll();
        echo json_encode($data);
    }

    public function xhrDeleteListing(){
        $id = $_POST['id'];
        $stm = $this->db->prepare('DELETE FROM data WHERE id = "' . $id . '"');
        $stm->execute();

    }

}