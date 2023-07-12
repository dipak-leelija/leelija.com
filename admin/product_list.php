<?php
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php"); 
require_once("../includes/constant.inc.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/utility.class.php"); 
require_once("../classes/product.class.php"); 
require_once("../classes/category.class.php"); 

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$product		= new Product();
$category		= new Cat();


if(isset($_GET['txtParentId']) && ((int)$_GET['txtParentId'] > 0))
{
	$p_Id = $_GET['txtParentId'];
	$product->genProductList($p_Id);
	//echo "<option>Hi</option>";
}
else
{
	echo "<select name='txtProdId'><option value=''></option></select>";
}

 ?>
