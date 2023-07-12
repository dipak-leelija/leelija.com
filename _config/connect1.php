<?php

//database connection parameter

$url		= "localhost";						// 192.168.1.101	//localhost

$user		= "root"; 					 			// root	   //ansysoft_continu 

$password	= "analyze";						  	// analyze // anst#2015

$db			= "ansysoft_continuedb";				//	ansysoft_continuedb

 

//localhost connection

$link = mysql_connect($url, $user, $password) or die("<h3> Sorry!!! Unable to connect</h3>");

mysql_select_db($db) or die("<h3>Sorry!!! Couldn't select the database</h3>");

?>