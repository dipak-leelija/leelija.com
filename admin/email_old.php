<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../includes/constant.inc.php"); 
require_once("../includes/email.inc.php");
require_once("../includes/email_account.inc.php");
require_once("../includes/subscriber.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/customer.class.php");
require_once("../classes/countries.class.php");
require_once("../classes/search.class.php");
require_once("../classes/email.class.php");
require_once("../classes/subscriber.class.php");

require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/pagination.class.php");
require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$customer	    = new Customer();
$country		= new Countries();
$search_obj		= new Search();
$email_obj		= new Email();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$subscribe		= new EmailSubscriber();
$page			= new Pagination();
$utility		= new Utility();
$uMesg 			= new MesgUtility();

###############################################################################################

//declare vars
$typeM		= $utility->returnGetVar('typeM','');

$getLink = $page->getLink();

if(isset($_GET['numResDisplay']))
{
	$numResDisplay = $_GET['numResDisplay'];
}
else
{
	$numResDisplay = 20;
}



if((isset($_GET['btnSearch'])) &&($_GET['btnSearch'] == 'search'))
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
	$link = "&btnSearch=search".$keyVar."&mode=".$typeVar.$statVar.$catVar.$resVar;
	$noOfCus 	= $subscribe->getAllId('', $_GET['selStatus'], $_GET['selCat'], $_GET['keyword']);
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



////////////////////////////////////////////////////////////////////////////////
/*	Add new email */
if(isset($_POST['btnAddEmail']))
{
	$txtEmail	= addslashes(trim($_POST['txtEmail']));
	$txtFname	= addslashes(trim($_POST['txtFname']));
	$txtSurname	= addslashes(trim($_POST['txtLname']));
	$selCat		= 	(int)$_POST['selCat'];
	$txtPhone	= 	'';
	$txtCompany	= 	'';
	
	//defining error variables
	$action		= 'add_customer';
	$url		= $_SERVER['PHP_SELF']."?".$getLink;
	$id			= 0;
	$id_var		= '';
	$anchor		= 'addCus';
	$typeM		= 'ERROR';
	
	//check for error
	$duplicateId	= $error->duplicateUser($txtEmail, 'email', 'email_subscriber');
	$invalidEmail 	= $error->invalidEmail($txtEmail);
	
	if(ereg('^ER',$invalidEmail))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ER002, $typeM, $anchor);
	}
	elseif(ereg("^ER",$duplicateId))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ER001, $typeM, $anchor);
	}
	else
	{
		//add email id
		$email_id = $subscribe->addSubscriber($txtEmail,$txtFname,$txtSurname, $selCat, $txtCompany, $txtPhone);
		
		if($email_id == 0)
		{
			$error->showErrorTA($action, $id, $id_var, $url, ERSUBSC002, $typeM, $anchor);
		}
		else
		{
			//forward
			$uMesg->showSuccessT('success', 0, '', $url, SUSUBSC001, 'SUCCESS');
		}
		
	}
}
/*	End of adding new email*/

/** 
*	Send Initiative Letter
*/
if(isset($_POST['btnSendMail']))
{
	//$email_list = $_POST['email_list'];
	$txtSubject = trim($_POST['txtSubject']);
	$txtMessage = trim($_POST['txtMessage']);
	
	 // generate a random string to be used as the boundary marker
	$mime_boundary = "==Multipart_Boundary_x".md5(mt_rand())."x";
	
	
	$tmp_name 	= $HTTP_POST_FILES['fileAttachment']['tmp_name'];
	$file_type 	= $HTTP_POST_FILES['fileAttachment']['type'];
	$file_name 	= $HTTP_POST_FILES['fileAttachment']['name'];
	$file_size	= $HTTP_POST_FILES['fileAttachment']['size'];
	
	$from		= EMAIL_FROM_TO_INFO;
	$header		= '';
	$body		= $txtMessage;
	$data		= array();
	$fname		= array();
	$lname		= array();
	
	$emailIds 	= $subscribe->getIdByCatStatus('a', $_POST['selCat']);
	
	if(count($emailIds) > 0)
	{
		
		foreach($emailIds as $k)
		{
			$subsDtl 	= $subscribe->getSubsDtl($k);
			$data[]	 	= $subsDtl[2];
			$fname[] 	= $subsDtl[3];
			$lname[] 	= $subsDtl[4];
		}
		
		//check if file is attached
		if(file_exists($tmp_name))
		{
			// check to make sure that it is an uploaded file and not a system file
			if(is_uploaded_file($tmp_name))
			{
				// open the file for a binary read
				$file = fopen($tmp_name,'rb');

				// read the file content into a variable
				$newdata = fread($file,filesize($tmp_name));

				// close the file
				fclose($file);

				// now we encode it and split it into acceptable length lines
				$newdata = chunk_split(base64_encode($newdata));
			}
			
			$headers =  "From: $from\r\n" .
						"MIME-Version: 1.0\r\n" .
						"Content-Type: multipart/mixed;\r\n" .
						" boundary=\"{$mime_boundary}\"";
			
			$body =  ".\n\n" .
         			 "--{$mime_boundary}\n" .
         			 "Content-Type: text/html; charset=\"iso-8859-1\"\n" .
         			 "Content-Transfer-Encoding: 7bit\n\n" .
         			 "".$body . "\n\n";//Dear Friend, <br /><br />
				
			$body .= "--{$mime_boundary}\n" .
					 "Content-Type: {$file_type};\n" .
					 " name=\"{$file_name}\"\n" .
					 "Content-Transfer-Encoding: base64\n\n" . 
					 $newdata . "\n\n" .
					 "--{$mime_boundary}--\n";
			
			//sending mail
			for($i=0; $i < count($data); $i++)
			{
				@mail($data[$i] ,$txtSubject, $body, $headers);
			}
			
			//echo "Here 1";exit;
		}
		else
		{
			//creating header
			$headers  = "From: ".$from."\n";
			$headers .= "Return-Path: <".INFO_EMAIL.">\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1";
			
			$body	  = $body;
			
			//sending mail
			for($i=0; $i < count($data); $i++)
			{
				@mail($data[$i] ,$txtSubject, "Dear ".$fname[$i].",<br /><br />".$body, $headers);
			}
			
			//echo "Here 2";exit;
		}
		
	}//if
	
	
	//forward
	$uMesg->showSuccessT('success', 0, '', $url, SUSUBSC004, 'SUCCESS');
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo COMPANY_S; ?> - Email Management</title>

<!-- Style -->
<link rel="stylesheet" type="text/css" href="../style/admin/admin.css" />
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
</link>
<!-- eof Style -->

<!-- Javascript Libraries -->
<script language="JavaScript" type="text/javascript" src="../js/openwysiwyg/wysiwyg.js"></script> 
<script type="text/javascript" 
src="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112"></script>

<script type="text/javascript" src="../js/utility.js"></script>
<script type="text/javascript" src="../js/advertiser.js"></script>
<script type="text/javascript" src="../js/location.js"></script>
<script type="text/javascript" src="../js/checkEmpty.js"></script>
<script type="text/javascript" src="../js/email.js"></script>
<!-- eof JS Libraries -->


</head>

<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0" style="
 padding-left:15px; padding-right:15px; padding-top:5px;">
  <tr>
    <td><?php require_once('header.inc.php'); ?></td>
  </tr>
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="160" valign="top"><?php require_once('menu.inc.php'); ?></td>
        <td align="center" valign="top">
		  <table width="98%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td valign="top">
			  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left"  >
			  <div class="padB10">
			  	<div class="fl"><h3>Email Management </h3></div>
				<div class="fr"><?php echo $utility->showBack2("../images/icon/", "back_arrow_red.gif"); ?></div>
				<div class="cl"></div>
			   </div>
			   <div class="menuText padB10">
			  <img src="images/arrows.gif">
			  <a href="email_acc_add.php">Add Member  </a> | 
			  <a href="#" 
              onClick="MM_openBrWindow('email_acc_view.php?type=A','ViewSubscriber','status=yes,width=600,height=600')">
              View Member 
              </a>	  
			  </div>
			  </td>
            </tr>
            <tr>
              <td align="left" class="padT25"><h4>Send Mail</h4> </td>
            </tr>
            <tr>
              <td align="left"  >
			  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="form2">
                <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                      <td colspan="2">
                        <!-- show message -->
                        <?php $uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');?>
                      </td>
                  </tr>
                  <tr>
                    <td width="17%" height="25" class="menuText" style="padding-bottom:10px; ">Group </td>
                    <td width="83%" style="padding-bottom:10px; ">
					<select name="selCat" class=" textBoxA" id="selCat">
                      <option value="0">-- All --</option>
                      <?php
						$utility->populateDropDown(0, 'cat_id', 'title', 'email_categories');						
					  ?>
                    </select>					</td>
                  </tr>
                  <tr>
                    <td height="25" class="menuText" style="padding-bottom:10px; "><span class="menuText">Subject</span></td>
                    <td style="padding-bottom:10px; ">
					<input name="txtSubject" type="text" class="text_box_large" id="txtSubject" size="64" maxlength="128">					</td>
                  </tr>
                  <tr>
                    <td height="25" class="menuText" style="padding-bottom:10px; ">Attachment</td>
                    <td style="padding-bottom:10px; "><input name="fileAttachment" type="file" class="text_box_large" id="fileAttachment"></td>
                  </tr>
                  <tr>
                    <td height="25" valign="top" class="menuText"><span class="menuText">Message</span></td>
                    <td>
					<textarea name="txtMessage" class="textAr" id="txtMessage">
					</textarea>
					<script language="JavaScript">
					  generate_wysiwyg('txtMessage');
					</script>					</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td style="padding-top:8px; ">
					<input name="btnSendMail" type="submit" class="button-add" 
					id="btnSendMail" value="send">					
					</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td style="padding-top:8px; ">&nbsp;</td>
                  </tr>
                </table>
              </form></td>
            </tr>
  <tr>
    <td height="20" align="left" class="bdrT" >	<h4><a name="addCus">Quick Add</a></h4></td>
  </tr>
  
  <tr>
    <td align="left" >
	<form name="formQuickAdd" method="post" action="<?php $_SERVER['PHP_SELF'];?>">
      <table width="100%"  border="0" cellspacing="0" cellpadding="0" class="bodyText">
        <tr>
          <td width="14%" height="20" style="padding-left:10px; ">Group</td>
          <td width="22%" class="pad5"><select name="selCat" id="selCat" class=" textBoxA">
            <?php
			if(isset($_SESSION['selCat']))
			{ 
				$utility->populateDropDown($_SESSION['selCat'], 'cat_id', 'title', 'email_categories');								
			}
			else
			{
				$utility->populateDropDown(0, 'cat_id', 'title', 'email_categories');
			}
			?>
          </select></td>
          <td width="14%" class="padL10">Email:</td>
          <td width="22%" class="pad5"><input name="txtEmail" type="text" class="text_box_large" /></td>
          <td width="5%" class="padL10">&nbsp;</td>
          <td width="23%">&nbsp;</td>
          </tr>
        <tr>
          <td height="20"><span class="padL10">First Name:</span></td>
          <td class="pad5"><input name="txtFname" type="text" class="text_box_large" /></td>
          <td class="padL10">Last Name:</td>
          <td class="pad5"><input name="txtLname" type="text" class="text_box_large" /></td>
          <td  class="padL10">&nbsp;</td>
          <td class="pad5"><span class="padL10">
            <input name="btnAddEmail" type="submit" class="button-add" id="btnAddEmail" value="add" />
          </span></td>
          </tr>
        <tr>
          <td height="20" colspan="6">&nbsp;</td>
          </tr>
      </table>
    </form></td>
  </tr>

            <tr>
              <td align="left"  style="border-bottom:1px solid #D3D3D3; padding-bottom:5px; ">&nbsp;</td>
            </tr>
			
            <tr>
              <td><table width="100%"  border="0" cellspacing="0" cellpadding="0" class="tblBrd">
                
				
				 <?php 
				if(count($noOfCus) == 0)
				{
				?>
				<tr align="left" class="orangeLetter">
                  <td height="20" colspan="6"> None of the subscriber found </td>
                 </tr>
				<?php 
				}
				else
				{
				?>  
				 
                <tr align="left" class="tableHead">
                  <td width="5%" class="bld lbBack padL5  bdrB bdrR">No.</td>
                  <td width="28%" height="20" class="bld lbBack padL5  bdrB bdrR"> Email (send now)</td>
                  <td width="28%" height="20" class="bld lbBack padL5  bdrB bdrR">Name</td>
                  <td width="14%" height="20" class="bld lbBack padL5  bdrB bdrR">Created On </td>
                  <td width="25%" height="20" align="center" class="bld lbBack padL5  bdrB">Action</td>
                  </tr>
				<?php 
					
					$i	= $page->getSerialNum($numResDisplay);
					
					foreach($pageArray[$pageNumber] as $j => $value)
				    {
					    $k = $pageArray[$pageNumber][$j];
						
						$cusDetail 	= $subscribe->getSubsDtl($k);
						$bgColor 	= $utility->getRowColor($i);
				?>
					<tr align="left" class="blackLarge" <?php $utility->printRowColor($bgColor);  ?>>
					  <td class="pad5 bdrR bdrB"><?php echo $i++; ?></td>
					  <td class="pad5 bdrR bdrB"><a href="#" title="mail <?php echo $cusDetail[2]; ?>" 
					  onClick="MM_openBrWindow('customer_mail.php?toEmail=<?php echo $cusDetail[2]; ?>&toName=<?php echo $cusDetail[3]." ".$cusDetail[4]; ?>','SendMail','scrollbars=yes,width=650,height=400')">
					  <?php echo $cusDetail[2]; ?></a></td>
					  <td class="pad5 bdrR bdrB">
					 <?php echo $cusDetail[3]." ".$cusDetail[4]; ?>					  </td>
					  <td class="pad5 bdrR bdrB"><?php echo $dateUtil->printDate($cusDetail[7]); ?></td>
					  
					  <td align="center" class="pad5 bdrR bdrB">
					  [ 
					  <a href="#" onClick="MM_openBrWindow('email_status.php?action=edit_status&email_id=<?php echo $k; ?>','AdminDelete','scrollbars=yes,width=400,height=350')">
					  status					  </a> ]
					  
					  [ 
					  <a href="#" onClick="MM_openBrWindow('email_acc_edit.php?action=edit_email&email_id=<?php echo $k; ?>','AdminDelete','scrollbars=yes,width=400,height=350')">
					  edit					  </a> ]
					  
					  [ 
					  <a href="#" onClick="MM_openBrWindow('email_acc_del.php?action=delete_email&email_id=<?php echo $k; ?>','AdminDelete','scrollbars=yes,width=400,height=350')">
					  delete					  </a> ]					  </td>
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
              <td height="25" align="left" class="blackLarge">Total  Subscriber: <?php echo count($noOfCus);?></td>
            </tr>
            <tr>
              <td height="25" align="left" class="bodyText">
			  
			  <!-- Start Pagination style="border-top:1px solid #C8C8C8; padding-top:7px; "-->
                <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="left" >
                    <!--Pagination-->
                    <div class="blackLarge w100P" align="left">
                        <?php $page->getPage($numPages, $link, $pageNumber, $pageArray);?>
                    </div>
                    <!-- eof Pagination-->
                    
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
                          <td width="81%" class="pad5">
                          <input name="keyword" type="text" class="text_box_large" id="keyword" 
                          value="<?php if(isset($_GET['keyword'])){echo $_GET['keyword'];}?>" size="40" />
                          </td>
                        </tr>
                        <tr>
                          <td height="25" class="menuText">Status</td>
                          <td class="pad5">
                          <?php 
                          $arr_value = array("","a","d");
                          $arr_label = array("-- All --","Active","Deactive");
                          ?>
                          <select name="selStatus" class=" textBoxA" id="selStatus">
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
                          <td height="25" class="menuText">Group</td>
                          <td class="pad5">
                          <select name="selCat" class="textBoxA" id="selCat">
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
                          <td height="20">&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="20" class="menuText">Result Per Page </td>
                          <td class="pad5">
                          <?php 
                            $utility->dispResPerPage($numResDisplay, 'textBoxA');
                          ?>
                          </td>
                        </tr>
                        <tr>
                          <td height="20">&nbsp;</td>
                          <td>
                          <div style="padding-top:10px; ">
                            <input name="type" type="hidden" value="" />
                            <input name="mode" type="hidden" value="customer" />
                            <input name="btnSearch" type="submit" class="button-add" id="btnSearch" value="search" />
                          </div>		  </td>
                        </tr>
                      </table>
                    </form></td>
                  </tr>
                </table>

	
	  <!-- End of pagination -->

			  </td>
            </tr>
			
			
			
          </table>
   			    </td>
              </tr>
          </table>
		</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><?php require_once('footer.inc.php'); ?></td>
  </tr>
</table>
</body>
</html>