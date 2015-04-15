<?php

class Database extends PDO {

    public function __construct($DB_TYPE,$DB_HOST,$DB_NAME,$DB_USER,$DB_PASS) {
        parent::__construct($DB_TYPE . ':host=' . $DB_HOST . ';dbname=' . $DB_NAME, $DB_USER, $DB_PASS);
        //parent::__construct('mysql:host=localhost;dbname=mvc', 'root', 'secret')
    }

    /**
     * @param string $sql an sql string
     * @param $array parameters to bind
     * @param constant $fetchMode a PDO fetch mode
     * @return mixed
     */

    public function select($sql, $array = [], $fetchMode = PDO::FETCH_ASSOC){
        $sth = $this->prepare($sql);
        foreach ($array as $key => $value){
            $sth->bindValue(":$key", $value);
        }

        $sth->execute();

        return $sth->fetchAll();
    }

    /**
     * insert
     * @param string $table A name of table to insert into
     * @param string $data An associative array
     */
    public function insert($table, $data)
    {
        ksort($data);

        $fieldNames = implode('`, `', array_keys($data));
        $fieldValues = ':' . implode(', :', array_keys($data));

//        echo "INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)";
//        die();

        $sth = $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");

        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }

        $sth->execute();
    }

    /**
     * update
     * @param string $table A name of table to insert into
     * @param string $data An associative array
     * @param string $where the WHERE query part
     */
    public function update($table, $data, $where)
    {
        ksort($data);

        $fieldDetails = NULL;
        foreach($data as $key=> $value) {
            $fieldDetails .= "`$key`=:$key,";
        }
        $fieldDetails = rtrim($fieldDetails, ',');

        $sth = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");

        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }

        $sth->execute();
    }

    public function delete($table, $where, $limit = 1)
    {
        return $this->exec("DELETE FROM $table WHERE $where LIMIT $limit");
        //returns number of affected rows
    }


}