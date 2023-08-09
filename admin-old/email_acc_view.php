<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php");
require_once("../includes/constant.inc.php");
require_once("../includes/email.inc.php");
 
require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php");  
require_once("../classes/error.class.php"); 
require_once("../classes/customer.class.php");
require_once("../classes/countries.class.php");
require_once("../classes/search.class.php");
require_once("../classes/email.class.php");
require_once("../classes/subscriber.class.php");
require_once("../classes/utility.class.php");
require_once("../classes/pagination.class.php");

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();
$customer	    = new Customer();
$country		= new Countries();
$search_obj		= new Search();
$email_obj		= new Email();
$subscribe		= new EmailSubscriber();
$utility		= new Utility();
$page			= new Pagination();
////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET['numResDisplay']))
{
	$numResDisplay = $_GET['numResDisplay'];
}
else
{
	$numResDisplay = 20;
}

if((isset($_GET['btnSearch'])) &&($_GET['btnSearch'] == 'Search'))
{
	$varArr	= array('keyword','type','selStatus','selCat');
	$utility->printGetVar($varArr);
	
	//defining variables
	$keyVar		= "&keyword=".$_GET['keyword'];
	$typeVar	= "&type=".$_GET['type'];
	$statVar	= '&selStatus='.$_GET['selStatus'];
	$catVar		= '&selCat='.$_GET['selCat'];
	$resVar		= '&numResDisplay='.$_GET['numResDisplay'];
	
	$mode = '';
	$link = "&btnSearch=Search".$keyVar."&mode=".$typeVar.$statVar.$catVar.$resVar;
	$noOfCus 	= $subscribe->getAllId('', $_GET['selStatus'], $_GET['selCat'], $_GET['keyword']);
	//echo $noOfCus; exit;
}
else
{
	$link = '';
	$noOfCus	= $subscribe->getAllId('', '', 0, '');
}

/*START PAGINATION*/
$total = count($noOfCus);
$pageArray = array_chunk($noOfCus, $numResDisplay);


$newPage = array();
$name = "Page";
$numPages = ceil($total/$numResDisplay);

if(isset($_GET['mypage']))
{
 $myPage = $_GET['mypage'];
}
else
{
	$myPage = 'Array0';
}
//echo "MyPage = ".$myPage;

$arrayNum = explode("Array",$myPage);

$pageNumber = (int)$arrayNum[1];
//echo "Page Number = ".$pageNumber."<br>";

if($total == 0)
{
	$total = (int)$total;
}

?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo COMPANY_S; ?> - List of  Member</title>
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/wysiwyg.js"></script>  

<table width="100%">
<tr align="left" class="maroonError">
	   <td height="20" class="invoiceFont bdrB padB5">
	   <div class="fl w50P"> Email Member </div>
	   <div class="fl w50P">
	   	<div align="right" class="fr">
			<input type="button" class="button-add" name="btnClose" value="close" 
			onclick="self.close()" />
		</div>
	   </div>
	   </td>
	   </tr>
	<tr align="left" class="maroonError">
	  <td height="20"  class="pageHeading">&nbsp;</td>
	  </tr>

<tr>
  <td>
  <table width="100%"  border="0" cellspacing="0" cellpadding="0" class="tblBrd">
	
	
	 <?php 
	if(count($noOfCus) == 0)
	{
	?>
	 
	 <tr align="left" class="orangeLetter">
	  <td height="20" colspan="5"> None of the subscriber found </td>
	 </tr>
	<?php 
	}
	else
	{
	?>  
	 
	<tr align="left" class="tableHead">
	  <td width="28" class="bld lbBack padL5  bdrB bdrR">No.</td>
	  <td width="256" class="bld lbBack padL5  bdrB bdrR"> Email (send now)</td>
	  <td width="208" class="bld lbBack padL5  bdrB bdrR">Name</td>
	  <td width="255" class="bld lbBack padL5  bdrB" align="center">Action</td>
	  <!-- <td width="25%" height="20"><strong>Last Login </strong></td> -->
	  </tr>
	<?php 
		$m	= $page->getSerialNum($numResDisplay);
		
		foreach($pageArray[$pageNumber] as $j => $value)
		{
			$k = $pageArray[$pageNumber][$j];
			
			$cusDetail = $subscribe->getSubsDtl($k);
			$bgColor 	= $utility->getRowColor($m);
	?>
		<tr align="left" class="blackLarge" <?php $utility->printRowColor($bgColor);  ?>>
		
		  <td class="pad5 bdrR bdrB"><?php echo $m++; ?></td>
		  <td class="pad5 bdrR bdrB"><a href="#" title="mail <?php echo $cusDetail[2]; ?>" 
					  onClick="MM_openBrWindow('customer_mail.php?toEmail=<?php echo $cusDetail[2]; ?>&toName=<?php echo $cusDetail[3]." ".$cusDetail[4]; ?>','SendMail','scrollbars=yes,width=650,height=400')"><?php echo $cusDetail[2]; ?></a><a href="#" title="mail <?php echo $cusDetail[0]; ?>" 
		  onClick="MM_openBrWindow('customer_mail.php?toEmail=<?php echo $cusDetail[1]; ?>&toName=<?php echo $cusDetail[1]." ".$cusDetail[2]; ?>','SendMail','scrollbars=yes,width=650,height=400')"></a></td>
		  <td class="pad5 bdrR bdrB">
		  <a href="#" title="mail <?php echo $cusDetail[0]; ?>" 
		  onClick="MM_openBrWindow('customer_mail.php?toEmail=<?php echo $cusDetail[0]; ?>&toName=<?php echo $cusDetail[1]." ".$cusDetail[2]; ?>',
		  'SendMail','scrollbars=yes,width=650,height=400')">		  </a><?php echo $cusDetail[3]." ".$cusDetail[4]; ?></td>
		  <td  class="pad5 bdrB" align="center">
		  [ 
		  <a href="#" onClick="MM_openBrWindow('email_status.php?action=edit_status&email_id=<?php echo $k; ?>','AdminDelete','scrollbars=yes,width=400,height=350')">
		  status</a> 
		  ]
		  
		  [ 
		  <a href="#" onClick="MM_openBrWindow('email_acc_edit.php?action=edit_email&email_id=<?php echo $k; ?>','AdminDelete','scrollbars=yes,width=400,height=350')">
		  edit</a> 
		  ]
		  
		  [ 
		  <a href="#" onClick="MM_openBrWindow('email_acc_del.php?action=delete_email&email_id=<?php echo $k; ?>','AdminDelete','scrollbars=yes,width=400,height=350')">
		  delete</a> 
		  ]		  </td>
	    </tr>
  <?php 
		}
  }
  ?>
  
  </table></td>
</tr>
<tr>
  <td>&nbsp;</td>
</tr>
<tr>
  <td height="25" align="left" class="blackLarge">Total  Member: <?php echo count($noOfCus);?></td>
</tr>
<tr>
<td height="25" align="left" class="bodyText">

<!-- Start Pagination style="border-top:1px solid #C8C8C8; padding-top:7px; "-->
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" >
<div class="bodyText" align="left" style="width:100% ">

<?php 
/* if(isset($_GET['formAction']))
{
if($_GET['formAction'] == 'Search_Now') 
{ */
if($numPages >1)
{
echo "<strong>Go to Page:</strong>";
}
if(isset($_GET['mypage']))
{
$num = explode("Array",$_GET['mypage']);
}
else
{
$num = 1;
}
$currPage = (int)$num[1];
//echo  $numPages;
//echo $currPage;
/* Function for Previous Page */
if($numPages >1)
{
if ($pageNumber == 0) // this is the first page - there is no previous page &nbsp;|&nbsp;&nbsp;&nbsp;<b></b>
echo "<< Previous&nbsp;&nbsp;"; 

else            // not the first page, link to the previous page .$_SERVER['QUERY_STRING']&
 echo "<< <a href=\"".$_SERVER['PHP_SELF']."?"."mypage=Array" . ($pageNumber - 1) .$link. "\">Previous</a>&nbsp;&nbsp;";  //&nbsp;|&nbsp;&nbsp;&nbsp;
}//PREVIOUS PAGE

/* All Other Pages */
foreach($pageArray as $i => $value)
{

if($numPages >1)
{
if($currPage == $i)
{
echo "<span class='blackSmall'><b>".++$i."</b></span>&nbsp;";//&&nbsp;|&nbsp;&nbsp;&nbsp; "Page ".&nbsp;
}
else
{
echo "<a href='".$_SERVER['PHP_SELF']."?"."mypage=".$pageArray[$i].$i.$link."'> ".++$i.
"</a>&nbsp;&nbsp;";//&nbsp;|&nbsp;&nbsp;&nbsp; Page<b></b>&nbsp;.$_SERVER['QUERY_STRING']
}
}
}//ALL OTHER PAGE

/* NEXT PAGES */
if($numPages >1)
{
if ($pageNumber == ($numPages - 1))
{ // this is the last page - there is no next page 
echo "Next >>";
}
else 
{   
// not the last page, link to the next page <b></b>.$_SERVER['QUERY_STRING']&
echo "<a href=\"".$_SERVER['PHP_SELF']."?"."mypage=Array" . ($pageNumber + 1) .$link. "\">Next</a> >>";
}  
}//PREVIOUS PAGE
//}INNER IF
//}OUTER IF
?>
</div>

</td>
</tr>

<tr>
<td align="left" >
<form name="formCusSearch" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <table width="100%"  border="0" cellspacing="0" cellpadding="0" class="bodyText" style="margin-bottom:5px; border-top:1px solid #D3D3D3 ">
        <tr>
          <td height="30" colspan="2"><h4>Email Search </h4></td>
          </tr>
        <tr>
          <td width="19%" height="25" class="menuText">Keyword</td>
          <td width="81%"><input name="keyword" type="text" class="text_box_large" id="keyword" value="<?php if(isset($_GET['keyword'])){echo $_GET['keyword'];}?>" size="40"></td>
        </tr>
        <tr>
          <td height="25" class="menuText">Status</td>
          <td>
		  <?php 
		  $arr_value = array("","a","d");
		  $arr_label = array("-- All --","Active","Deactive");
		  ?>
		  <select name="selStatus" class="text_box_large" id="selStatus">
		  	<?php 
			if(isset($_GET['selStatus']))
			{
				$utility->genDropDown($_GET['selStatus'], $arr_value, $arr_label);
			}
			else
			{
				$utility->genDropDown('', $arr_value, $arr_label);
			}
			?>
          </select>		  
		 </td>
        </tr>
        <tr>
          <td height="25" class="menuText">Category</td>
          <td>
		  <select name="selCat" class="text_box_large" id="selCat">
		  	<option value="0">-- All --</option>
			<?php
			if(isset($_GET['selCat']))
			{ 
				$utility->populateDropDown($_GET['selCat'], 'cat_id', 'title', 'email_categories');								
			}
			else
			{
				$utility->populateDropDown(0, 'cat_id', 'title', 'email_categories');
			}
			?>
		  </select>		  </td>
        </tr>
        <tr>
          <td height="25">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="25" class="menuText">Result Per Page </td>
          <td>
		  <?php 
		  	$utility->dispResPerPage($numResDisplay, 'blackLarge');
		  ?>
		  </td>
        </tr>
        <tr>
          <td height="25">&nbsp;</td>
          <td>
		  <div style="padding-top:10px; ">
		  	<input name="type" type="hidden" value="">
		  	<input name="mode" type="hidden" value="customer">
		    <input name="btnSearch" type="submit" class="button-add" id="btnSearch" value="Search">
		  </div>		  </td>
        </tr>
      </table>
    </form>
	</td>
</tr>
</table>


<!-- End of pagination -->

</td>
</tr>

</table>