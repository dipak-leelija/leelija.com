<?php

//localhost connection
// $link = mysql_connect($url, $user, $password) or die("<h3> Sorry!!! Unable to connect</h3>");
// mysql_select_db($db) or die("<h3>Sorry!!! Couldn't select the database</h3>");



// $link = mysqli_connect($url, $user, $password, $db);

// if (!$link){

// 	die("Failed to connect: ". mysqli_connect_error());

// }



$conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


// $link = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
// if (!$link){
// 	die("Failed to connect: ". mysqli_connect_error());
// }



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

        $this->host = DBHOST;
        $this->user = DBUSER;
        $this->pass = DBPASS;
        $this->db   = DBNAME;

        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);

        return $this->conn;

    }

}// DatabaseConnection end



trait  DBConnection{

    private $host;
    private $user;
    private $pass;
    private $db;

    public $conn;

    public function __construct() {

        $this->db_connect();

      }

    function db_connect(){

        $this->host = DBHOST;
        $this->user = DBUSER;
        $this->pass = DBPASS;
        $this->db   = DBNAME;

        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
        return $this->conn;

    }

}// DatabaseConnection end

?>