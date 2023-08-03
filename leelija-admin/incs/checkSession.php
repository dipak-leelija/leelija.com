<?php 

if(!$_SESSION[ADM_SESS]){
	header("Location: login.php");
	exit;
}

?>