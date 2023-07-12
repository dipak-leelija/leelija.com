<?php



class DatabaseConnection{







    private $host;

    private $user;

    private $pass;

    private $db;



    public $conn;





    public function __construct() {



        $this->db_connect();



      }





    function db_connect(){



        $this->host = 'localhost';

        $this->user = 'root';

        $this->pass = '';

        $this->db = 'i5876163_wp1';



        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);



        return $this->conn;



    }







}// DatabaseConnection end







?>