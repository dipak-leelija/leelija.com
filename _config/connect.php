<?php

//database connection parameter

$url		= "localhost";						// 
$user		= "root";				// safikul				
$password	= "";					//	safikul#islam12				  	
$db			= "leelija_db";				   //				

//localhost connection

// $link = mysql_connect($url, $user, $password) or die("<h3> Sorry!!! Unable to connect</h3>");

// mysql_select_db($db) or die("<h3>Sorry!!! Couldn't select the database</h3>");



$link = mysqli_connect($url, $user, $password, $db);

if (!$link){

	die("Failed to connect: ". mysqli_connect_error());

}

?>