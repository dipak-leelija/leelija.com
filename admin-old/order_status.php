<?php 
session_start();
include_once('checkSession.php');
include_once('../_config/connect.php');

require_once("../includes/constant.inc.php");
require_once("../includes/order.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php"); 
 
require_once("../classes/error.class.php"); 
require_once("../classes/customer.class.php");
require_once("../classes/countries.class.php");
require_once("../classes/cart.class.php");
require_once("../classes/order.class.php");
require_once("../classes/product.class.php");
require_once("../classes/search.class.php");
require_once("../classes/pagination.class.php");
require_once("../classes/tax.class.php");
require_once("../classes/shipping.class.php");

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
$cart			= new Cart();
$order			= new Order();
$product		= new Product();
$search_obj		= new Search();
$page			= new Pagination();
$tax			= new Tax();
$shipping		= new Shipping();


$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();

######################################################################################################################

//declare vars
$typeM			= $utility->returnGetVar('typeM','');

if(!isset($_GET['code']) || !isset($_GET['id']))
{
	exit;
}
else
{
	$code = $_GET['code'];
	$id   = $_GET['id'];
}
//NO OF CUSTOMER



//post and update notification data
if(isset($_POST['btnNotify']))
{
	
	$orders_id				= $_POST['orders_id']; 
	$customer_notify		= $_POST['customer_notify'];
	$orders_status_id		= $_POST['orders_status_id'];
	$comments				= $_POST['comments'];
	$date_commented			= '';
	
	if(($orders_id == '') || ($orders_status_id == ''))
	{
		header("Location: ".$_SERVER['PHP_SELF']."?action=view&code=".$_GET['code']."&id=".$_GET['id']."&msg=you have missed some important fields");
	}
	else
	{
		$order->insertNotify($orders_id, $customer_notify, $orders_status_id, $date_commented, $comments);
		header("Location: ".$_SERVER['PHP_SELF']."?action=success&code=".$_GET['code']."&id=".$_GET['id']."&msg=you have changed the status of this order.");
	}
}
?>

<title><?php echo COMPANY_S; ?> - Change Order Status</title>
<link href="../style/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">
<table class="tblBrd" align="center" width="98%">
	<?php 
	//display message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>
			
	<?php 
    //CREATING NEW USER FORM
    if(isset($_GET['action']))
    {
        if($_GET['action'] == 'change_status')
        {
            
            $orderDtl  = $order->getOrderDetail($code,$id);
    ?>
    <tr>
      <td height="25" align='left' bgcolor="#EEEEEE"><h3>Change Status </h3></td>
    </tr>
    <tr>
      <td height="25" align="left" class="menuText" colspan="2">
      <form name="formNotify" method="post" action="<?php echo $_SERVER['PHP_SELF']."?action=view&code=".$_GET['code']."&id=".$_GET['id']; ?>">
        <table width="100%"  border="0" cellspacing="0" cellpadding="0" class="menuText">
          <tr>
            <td width="48%" class="padT20">
            	<div class="fl w100">
                Status :      
                </div>           
                <div class="fl">
            	<select name="orders_status_id" class="textBoxA">
           		  <?php $utility->populateDropDown($orderDtl[21], 'orders_status_id', 'orders_status_name', 'orders_status');?>
              	</select>
                </div>
                <div class="cl"></div>
            </td>
            <td width="52%" class="padT20">
            <div class="fl w100">
            	Notify Customer: 
            </div>
            <div class="fl padL15">
            <input type="checkbox" name="customer_notify" value="1" checked />
            </div>
            <div class="cl"></div>
            </td>
          </tr>
          <tr>
            <td colspan="2" class="padT15">
              <div class="fl w100">
              Comments:
              </div>
              <div class="fl">
              <textarea name="comments" cols="35" rows="5" class="textArA"></textarea>
              </div>
              <div class="cl"></div>
              </td>
            </tr>
          <tr>
            <td height="20" class="padT20">
              <div class="fl w100"> &nbsp;<!----></div>
              
              
              <div class="fl">
              	<input name="orders_id" type="hidden" value="<?php echo $orderDtl[0]; ?>" />
                <input name="btnNotify" type="submit" class=" button-add" id="btnNotify" value="update" />
                <input name="btnCancel" type="button" class=" button-cancel" id="btnCancel" onClick="self.close()" value="cancel" />
			   </div>		
               <div class="cl"></div>
			</td>
            <td height="20">&nbsp;</td>
          </tr>
        </table>
      </form></td>
    </tr>
    <?php }
    }
    ?>
</table>