<?php


class ORM {
    private static $hostname;
    private static $username;
    private static $password;
    private static $dbname;
    private static $conn = null;

    static function getInstance(){
        $config_file = "akaino.config";
        $file = file_get_contents($config_file);
        $lines = explode("\n", $file);
        foreach ($lines as $line){
            if($lines != ""){
                $property = explode('=', $line);
                switch ($property[0]){
                    case 'hostname': ORM::$hostname = trim($property[1]); break;
                    case 'username': ORM::$username = trim($property[1]); break;
                    case 'password': ORM::$password = trim($property[1]); break;
                    case 'dbname': ORM::$dbname = trim($property[1]); break;
                }
            }
        }
        if(ORM::$conn == null) {
            ORM::$conn = new mysqli(ORM::$hostname, ORM::$username, ORM::$password, ORM::$dbname);
        }
        return ORM::$conn;
    }

    /**
     * @return mixed
     */
    public function getHostname()
    {
        return ORM::$hostname;
    }

    /**
     * @param mixed $hostname
     */
    public function setHostname($hostname)
    {
        ORM::$hostname = $hostname;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return ORM::$username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        ORM::$username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return ORM::$password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        ORM::$password = $password;
    }

    /**
     * @return mixed
     */
    public function getDbname()
    {
        return ORM::$dbname;
    }

    /**
     * @param mixed $dbname
     */
    public function setDbname($dbname)
    {
        ORM::$dbname = $dbname;
    }



}