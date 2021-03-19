<?php

class Database{

    private $servername = 'localhost';
    private $username = 'root';
    private $password = '';
    private $db_name = 'library_am';

    public $conn;

    public function __construct() //functon construct automatically  runs if the file application is execute/run
    //you dont need a function call for this pre_function __construct
    {
        $this->conn = new mysqli($this->servername,$this->username,$this->password,$this->db_name);
        
        if($this->conn->connect_error){
            echo "ERROR: connecting todatabase failed";
        }else {
            return $this->conn;
        }
    }

}

?>