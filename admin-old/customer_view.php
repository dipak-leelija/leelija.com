<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php"); 
require_once("../includes/constant.inc.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/utility.class.php"); 
require_once("../classes/registration.class.php"); 
require_once("../classes/customer.class.php");
require_once("../classes/contractor.class.php");

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$reg			= new Registration();
$customer		= new Customer();
$cont			= new Contractor();


if(isset($_GET['cus_id']))
{
	$cus_id = $_GET['cus_id'];
}
$cusDetail = $cont->showRegInfo($cus_id);


?>

<title>Admin Control Panel :: View Contractor Registration Detail</title>
<link href="../style/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../js/openwysiwyg/wysiwyg.js"></script> 
<link rel="stylesheet" href="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
</LINK>
<SCRIPT type="text/javascript" 
src="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112">
</script>
<table class="tblBrd" align="center" width="100%">
	<?php 
	//CREATING NEW USER FORM
	if(isset($_GET['action']) && ($_GET['action'] == 'view_customer'))
	{
			
	?>  
	<tr>
	  <td height="25" align='left' bgcolor="#EEEEEE">
	  	<h3>View Contractor Detail - <?php echo $cusDetail[0]." ".$cusDetail[1]; ?></h3>
	  </td>
	</tr>
	<tr>
	  <td>
	  <div class="menuText">
	
		
		<!-- PERSONAL DETAIL -->
		<div class="bdrB ha w100P backLBlue" >
		 <div class="pad5"><h4>Personal Detail</h4></div>
		</div>
		<div style="height:5px "></div>
	
		
		<div class="blackLarge w100P ha pad5">
		  <div class="menuText fl padT5 w125">FORENAME </div>
		  <div class="fl">
			<?php echo $cusDetail[0];?>
		  </div>
		  <div class="cl"></div>
		</div>
		<div class="blackLarge w100P ha pad5">
		  <div class="menuText fl padT5 w125">SURNAME</div>
		  <div class="fl">
			<?php echo $cusDetail[1];?>
		  </div>
		  <div class="cl"></div>
		</div>
		
		<div class="blackLarge w100P ha pad5">
		  <div class="menuText fl padT5 w125">TRADE </div>
		  <div class="fl">
			<?php echo $cusDetail[4];?>
	      </div>
		  <div class="cl"></div>
		</div>
		<div class="blackLarge w100P ha pad5">
		  <div class="menuText fl padT5 w125">DAY RATE<br>
		  (if applicable)
		  </div>
		  <div class="fl">
			<?php echo $cusDetail[5];?>
		  </div>
		  <div class="cl"></div>
	    </div>
		  
		
		<div class="cl padT15"></div>
		<!-- ADDRESS AND CONTACT INFORMATION -->
		<div class="bdrB ha w100P backLBlue" >
		 <div class="pad5">
		 <h4>Address + Contact</h4>
		 </div>
		</div>
		<div style="height:5px "></div>
		 <div style="width:100%; padding:2px; height:25px; " class="menuText">
		  <div style="width:100px; float:left;padding-top:3px; ">PHONE NUMBER</div>
		  <div class="fl">
			<?php echo $cusDetail[3];?>
		  </div>
		  <div class="cl"></div>
		 </div>
		  <div style="width:100%; padding:2px; height:25px; " class="menuText">
		  <div style="width:100px; float:left;padding-top:3px; ">EMAIL</div>
		  <div class="fl">
			<?php echo $cusDetail[2];?>
		  </div>
		  <div class="cl"></div>
		 </div>
		 <div style="width:100%; padding:2px; height:25px; " class="menuText">
		  <div style="width:100px; float:left;padding-top:3px; ">BUILDING NAME/NO.</div>
		  <div class="fl">
			<?php echo $cusDetail[6];?>
		  </div>
		  <div class="cl"></div>
		 </div>
		 <div style="width:100%; padding:2px; height:25px; " class="menuText">
		  <div style="width:100px; float:left;padding-top:3px; ">STREET</div>
		  <div class="fl">
			<?php echo $cusDetail[7];?>
		  </div>
		  <div class="cl"></div>
		 </div>
		  <div style="width:100%; padding:2px; height:25px; " class="menuText">
		  <div style="width:100px; float:left;padding-top:3px; ">ADDRESS</div>
		  <div class="fl">
			<?php echo $cusDetail[8];?>
		  </div>
		  <div class="cl"></div>
		 </div>
		 
		 <div style="width:100%; padding:2px; height:25px; " class="menuText">
		  <div style="width:100px; float:left;padding-top:3px; ">POSTAL CODE </div>
		  <div class="fl">
			<?php echo $cusDetail[9];?>
		  </div>
		  <div class="cl"></div>
		 </div>
		 
		 <div style="height:5px "></div>
		<div class="cl padT15"></div>
		<!-- OPTIONS -->
		<div class="bdrB ha w100P backLBlue" >
		 <div class="pad5">
		 <h4>Account Detail</h4>
		 </div>
		 
		</div>
		<div style="height:5px "></div>
		 <div class="blackLarge w100P ha pad5">
		  <div class="menuText fl padT5 w125">UNIQUE TAX REFERENCE</div>
		  <div class="fl">
			<?php echo $cusDetail[10];?>
		  </div>
		  <div class="cl"></div>
		</div>
		<div class="blackLarge w100P ha pad5">
		  <div class="menuText fl padT5 w125">CIS</div>
		  <div class="fl">
			<?php echo $cusDetail[11];?>
		  </div>
		  <div class="cl"></div>
		</div>
		<div class="blackLarge w100P ha pad5">
		  <div class="menuText fl padT5 w125">BANK NAME</div>
		  <div class="fl">
			<?php echo $cusDetail[12];?>
		  </div>
		  <div class="cl"></div>
		</div>
		<div class="blackLarge w100P ha pad5">
		  <div class="menuText fl padT5 w125">NI NUMBER</div>
		  <div class="fl">
			<?php echo $cusDetail[13];?>
		  </div>
		  <div class="cl"></div>
		</div>
		<div class="blackLarge w100P ha pad5">
		  <div class="menuText fl padT5 w125">ACCOUNT NUMBER</div>
		  <div class="fl">
			<?php echo $cusDetail[14];?>
		  </div>
		  <div class="cl"></div>
		</div>
		<div class="blackLarge w100P ha pad5">
		  <div class="menuText fl padT5 w125">SORT CODE</div>
		  <div class="fl">
			<?php echo $cusDetail[15];?>
		  </div>
		  <div class="cl"></div>
		</div>
		 <div style="height:5px "></div>
		<div class="cl padT15"></div>
		<!-- OPTIONS -->
		<div  class="bdrB ha w100P backLBlue" >
		 <div class="pad5">
		 <h4>Contractor Notes</h4>
		 </div>
		</div>
		<div style="height:5px "></div>
		 <div class="blackLarge w100P ha pad5">
		  <div class="menuText fl padT5 w125">NOTE</div>
		  <div class="fl">
			<?php echo $cusDetail[16];?>
		  </div>
		  <div class="cl"></div>
		</div>
		<!--  -->
		<div style="height:5px "></div>
		 
	
	<!-- END OF REGISTRATION FORM -->
	</div>
	  </td>
	</tr>
	<?php 
	}
	?>
</table>