<?php 



//database_connection.php

        $host = 'localhost';

        $user = 'root';

        $pass = '';

        $db = 'i5876163_wp1';



        $conn = new mysqli($host, $user, $pass, $db);



if (!$conn) {

    die("Connection failed: " . mysqli_connect_error());

}

// else {

//     echo "Connected";

// }



// try {

//     $conn = new PDO("mysql:host=$server;dbname=lija", $user, $pass);

//     // $connect = new PDO("mysql:host=localhost;dbname=i5876163_wp1", $user, $pass);



//     // set the PDO error mode to exception

//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     echo "Connected successfully";

//   } catch(PDOException $e) {

//     echo "Sorry!! Connection failed: " . $e->getMessage();

//   }





?>