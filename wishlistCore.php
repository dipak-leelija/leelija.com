<?php
   session_start();
   $userId = $_SESSION['userid'];
//    echo $userId;
// require_once("_config/connect.php"); 
require_once("_config/dbconnect.php");
require_once "_config/dbconnect.trait.php";
//    require_once("classes/wishList.class.php");
require_once("classes/blog_mst.class.php");

$blogMst		= new BlogMst();


if(isset($_GET['type'])){
    $type= $_GET['type'];
} 


if(isset($_GET['id'])){
    $blog_id = $_GET['id'];

    $existChecker = $blogMst->wishAgainCheck($userId,$blog_id);
    $existChecker= (int)$existChecker;
    $insertId = 0;
    if($existChecker){
        $blogMst->removeWish($userId,$blog_id);
    }
    else{
        $insertId = $blogMst->newWish($userId,$blog_id);
    }

    echo $insertId;

}



  
  



?>