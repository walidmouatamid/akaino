<?php


class Akaino {
    private $conn;
    private $tableName;
    private $fields;
    private $data;

    public function __construct($tableName=null)
    {
        if ($tableName == null) (new Logger())->shout("Please specify the table name");
        else {
            $this->conn = ORM::getInstance();
            $this->tableName = $tableName;
        }
    }

    /**
     * @return null
     */
    public function getConn()
    {
        return $this->conn;
    }

    /**
     * @param null $conn
     */
    public function setConn($conn)
    {
        $this->conn = $conn;
    }

    /**
     * @return null
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * @param null $tableName
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }

    /**
     * @return mixed
     */
    public function getFields()
    {
        return $this->fields;
    }

}