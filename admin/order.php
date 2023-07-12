<?php 
session_start();
include_once('checkSession.php');
// include_once('../_config/connect.php');
require_once "../_config/dbconnect.php";
require_once "../_config/dbconnect.trait.php";

require_once("../includes/constant.inc.php");
// require_once("../includes/order.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php"); 
 
require_once("../classes/error.class.php"); 
require_once("../classes/customer.class.php");
require_once("../classes/countries.class.php");
// require_once("../classes/cart.class.php");
require_once("../classes/order.class.php");
// require_once("../classes/product.class.php");
require_once("../classes/search.class.php");
require_once("../classes/pagination.class.php");

require_once("../classes/utility.class.php"); 
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityNum.class.php");


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();
$client		    = new Customer();
$country		= new Countries();
// $cart			= new Cart();
$order			= new Order();
// $product		= new Product();
$search_obj		= new Search();
$page			= new Pagination();


$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();

######################################################################################################################

//declare vars
$typeM			= $utility->returnGetVar('typeM','');
$keyword		= $utility->returnGetVar('keyword','');
$type			= $utility->returnGetVar('type','');
$mode			= $utility->returnGetVar('mode','');
$noOfOrd		= array();

if((isset($_GET['btnSearch'])) &&($_GET['btnSearch'] == 'search')){
	$link    = "&btnSearch=search&keyword=".$_GET['keyword']."&mode=&type=".$_GET['type'];
	$noOfOrd = $search_obj->searchOrder($mode, $keyword, $type);
}else{
	if(isset($_GET['user_id']) && isset($_GET['status'])){
		$user_id	= $_GET['user_id'];
		//echo $user_id ; exit;
		$status		= $_GET['status'];
	}else{
		$user_id	= 'all';
		$status		= 'all';
	}
	//NO OF ORDER
	$link = '';
  // echo $user_id.'----'.$status;exit;
	$noOfOrd	= $order->getOrderCode($user_id, $status);
  // print_r($noOfOrd);
	
}
// print_r($noOfOrd);exit;
/*START PAGINATION*/
$total     = count($noOfOrd);
$pageArray = array_chunk($noOfOrd, 20);
// print_r($pageArray); exit;


$newPage = array();
$name = "Page";
$numPages = ceil($total/20);

if(isset($_GET['mypage'])){
 $myPage = $_GET['mypage'];
}else{
	$myPage = 'Array0';
}
//echo "MyPage = ".$myPage;

$arrayNum = explode("Array",$myPage);
//echo $arrayNum ; exit;

$pageNumber = (int)$arrayNum[1];

if($total == 0)
{
	$total = (int)$total;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo COMPANY_S; ?> - Order Management</title>

<!-- Style -->
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
</link>
<!-- eof Style -->

<!-- Javascript Libraries -->
<script language="JavaScript" type="text/javascript" src="../js/openwysiwyg/wysiwyg.js"></script> 
<script type="text/javascript" 
src="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112"></script>

<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript" src="../js/utility.js"></script>
<script type="text/javascript" src="../js/advertiser.js"></script>
<script type="text/javascript" src="../js/location.js"></script>
<script type="text/javascript" src="../js/checkEmpty.js"></script>
<script type="text/javascript" src="../js/email.js"></script>
<script type="text/javascript" src="../js/static.js"></script>
<!-- eof JS Libraries -->

</head>

<body>
    <!-- Header -->
	<?php require_once('header.inc.php'); ?>
    
    <!-- Container -->
    <div class="container">
        <div class="inner-container">
        	<div id="admin-menu">
				<?php require_once('menu.inc.php'); ?>
            </div>
            
            <!-- Inner  -->
            <div id="admin-body">
            	
                <div id="admin-top">
                	<h1>Order Management</h1>
                
                
          <div id="search-page-back">
                    	<form name="formAdvSearch" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        	<input name="keyword" type="text" class="search-text" id="keyword" placeholder="Keyword.." results="5"
                          	value="<?php $utility->printGet('keyword');?>" />
                            <div class="search-option">
                           		<div id="dropdown-page-options">
                            		<a href="javascript:void(0)" onClick="showHideDiv('dropdown-page-back', '');">
                                    	Options<img src="../images/admin/icon/search-arrow.png" width="5" height="5" alt="search" />
                                    </a>
                                    <div id="dropdown-page-back" style="display:none">
                                        <p class="required">
                                          Note: if you do not use any keyword, you would be able to display listing according to
                                          the selected criteria.
                                        </p>
                                        
                                        <label>By</label>
                                        <?php 
                                          if(isset($_GET['type'])){
                                            $type = $_GET['type']; 
                                          }else{
                                            $type = '';
                                          }
                                        ?>
                                       <select name="type" id="type" class="textBoxA">
                                        <option value="name" <?php echo $utility->selectString('name',$type); ?>>Order Code</option>
                                        <option value="product" <?php echo $utility->selectString('product',$type); ?>>Product Name</option>
                                        <option value="customer" <?php echo $utility->selectString('customer',$type); ?>>Customer</option>
                                       </select>
                                       <div class="cl"></div>  
                                        
                            		</div>
                                </div>
                            </div>
                            <input name="mode" type="hidden" value="" />
                            <input type="submit" class="search-button" name="btnSearch" id="btnSearch" value="search" />
                        </form>
                    </div>
                   <div class="cl"></div>
        </div>
                
                <div class="menuText padB10">
			    <span>
                <img src="images/arrows.gif">
			    View Order :&nbsp;&nbsp;&nbsp;&nbsp; 
                   <a href="<?php echo $_SERVER['PHP_SELF']."?user_id=all&status=all"; ?>">All </a>&nbsp;&nbsp;|&nbsp;&nbsp;
                   <a href="<?php echo $_SERVER['PHP_SELF']."?user_id=all&status=1"; ?>">Incomplete </a>&nbsp;&nbsp;|&nbsp;&nbsp;
                   <a href="<?php echo $_SERVER['PHP_SELF']."?user_id=all&status=2"; ?>">Pending </a>&nbsp;&nbsp;|&nbsp;&nbsp;
                   <a href="<?php echo $_SERVER['PHP_SELF']."?user_id=all&status=3"; ?>">Processing </a>&nbsp;&nbsp;|&nbsp;&nbsp;
                   <a href="<?php echo $_SERVER['PHP_SELF']."?user_id=all&status=4"; ?>">Delivered </a>&nbsp;&nbsp;|&nbsp;&nbsp;
                   <a href="<?php echo $_SERVER['PHP_SELF']."?user_id=all&status=5"; ?>">Cancelled </a>			   
                </span>			  
               </div>
               
              <div class="padT30"><!-- --> </div> 
               
                <!-- Display Data -->
                <div id="data-column">
                	
                	<table class="single-column" cellpadding="0" cellspacing="0">
                
                        <!-- display option -->
                        <?php 
                          if(count($noOfOrd) == 0){
                        ?>
                        <tr align="left" class="orangeLetter">
                          <td height="20" colspan="5"> <?php echo ERSPAN.ERORDER001.ENDSPAN; ?></td>
                         </tr>
                        <?php 
                          }else{
                        ?>  
                        <thead>
                          <th width="7%" >Order Id </th>
                          <th width="18%"  >Customer Full Name </th>
                          <th width="13%"  >Order Date </th>
                          <th width="10%" >Status</th>
                          <th width="18%" >Order Code</th>
                          <th width="34%"  align="center">Action</th>
                        </thead>
                      <?php 
                        $i = 1;
                        // print_r($pageArray[$pageNumber]);exit;
                        foreach($pageArray[$pageNumber] as $j => $value){
                          // print_r($value);
                          $k = $pageArray[$pageNumber][$j];
                          
                          // echo $k.'<br/>';
                          $ordDetail = $order->getOrderDetail($k, 0);
                          // echo $ordDetail[31].'<br>';
                          
                          //$cusId		= $ordDetail[1];
                          //$cusDetail = $client->getCustomerData($cusId);
                          
                          //get row color
                          $bgColor 	= $utility->getRowColor($i);
                      ?>
                      <tr align="left" class="blackLarge" <?php $utility->printRowColor($bgColor);?>>
                        <td   align="left"><?php echo $i++; ?></td>
                          <td ><?php echo $ordDetail[3]; ?></td>
                          <td ><?php echo $dateUtil->printDate($ordDetail[31]); ?></td>
                          <td ><?php echo $ordDetail[23]; ?></td>
                          <td ><?php echo $k; ?></td>
                          <!-- <td><?php //if($cusDetail[1] == '0000-00-00 00:00:00') {echo 'no login';} else {echo $cusDetail[4];} ?></td> -->
                          <td  align="center">
                          [ 
                          <a href="<?php echo "order_detail.php?"."action=view&id=0&code=".$k.$link  ?>">
                          view</a> ]
                         
                         [ 
                          <a href="#" onClick="MM_openBrWindow('order_status.php?action=change_status&id=0&code=<?php echo $k; ?>','AdminDelete','scrollbars=yes,width=500,height=350')">
                          change status					  </a> ]
                         
                          [ 
                          <a href="#" onClick="MM_openBrWindow('order_delete.php?action=delete_order&id=<?php echo $ordDetail[0]; ?>&code=','AdminDelete','scrollbars=yes,width=400,height=350')">
                          delete					  </a> ]					 
                         </td>
				              </tr>
                      <?php 
                            }
                      }
                      ?>
                  </table>
                          
                    <div class="first-column">
                 
                    	<!-- Bottom Pagination-->
                        <div class="pagination-bottom">
                            <div class="upper-block">Total Product Option: <?php echo count($noOfOrd);?></div>
                            <div class="lower-block"><?php $page->getPage($numPages, $link, $pageNumber, $pageArray);?>
                            </div>
                        </div>
                  </div>
                  
                </div>
                <!-- eof Display Data -->
                
                <div class="cl"></div>
                
            </div>
            <!-- eof Inner  -->
             
            <div class="cl"></div>
        </div>  
    </div>
    <!-- eof Container -->
    
    <!-- Footer -->
	<?php require_once('footer.inc.php'); ?>
     
</body>
</html>