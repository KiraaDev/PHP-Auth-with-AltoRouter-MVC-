<?php 

class Database {

    // add your mysql account
    private $host = 'localhost';
    private $user = 'nono';
    private $password = '';
    private $dbname = 'TestDB';
    private $db;

    public function __construct(){
        
        try{

            $this->db = new mysqli($this->host, $this->user, $this->password, $this->dbname);

            if ($this->db->connect_error) {
                die('Connection failed: ' . $this->db->connect_error);
                exit();
            }

        } catch(Exception $error){
            echo $error;
            include './views/500.php';
            exit();
        }

        
    }

        public function connectDB(){
        return $this->db;
    }

}
