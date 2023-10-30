<?php 
session_start();
header("Cache-control: private");
require_once("includes/constant.inc.php");


session_destroy(); 

header("Location: ".URL);

?>