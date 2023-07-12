<?php 
session_start();
include_once('checkSession.php');
// include_once('../_config/connect.php');
require_once "../_config/dbconnect.php";
require_once "../_config/dbconnect.trait.php";

require_once("../includes/constant.inc.php");
require_once("../includes/user.inc.php");
require_once('../classes/encrypt.inc.php');

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php");  
require_once("../classes/error.class.php");  
require_once("../classes/customer.class.php"); 
require_once("../classes/location.class.php"); 
include_once("../classes/countries.class.php");
require_once("../classes/subscriber.class.php");
require_once("../classes/pagination.class.php");
require_once("../classes/search.class.php");

require_once("../classes/utility.class.php"); 
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityNum.class.php");
require_once("../classes/utilityStr.class.php");

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();
$customer		= new Customer();
$lc		 		= new Location();
$country		= new Countries();
$subscribe		= new EmailSubscriber();
$pages			= new Pagination();
$search_obj		= new Search();

$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
$uStr 			= new StrUtility();

###############################################################################################

//declare vars
$typeM		= $utility->returnGetVar('typeM','');
$numResDisplay	= (int)$utility->returnGetVar('numResDisplay', 10);

/*if($numResDisplay == 0)
{
	$numResDisplay = 10;
}*/

//no of customer
if((isset($_GET['btnSearch'])) &&($_GET['btnSearch'] == 'Search'))
{
	$selStatus		= $utility->returnGetVar('selStatus','');
	$cId			= $utility->returnGetVar('cId',0);
	$loc			= $utility->returnGetVar('loc','');
	$keyword		= $utility->returnGetVar('keyword','');
	$numResDisplay	= $utility->returnGetVar('numResDisplay',10);
	
	$statVar	= "&selStatus=".$selStatus;
	$cntVar		= "&cId=".$cId;
	$numVar		= "&numResDisplay=".$numResDisplay;
	$keyVar		= "&keyword=".$keyword;
	$srchVar	= "&btnSearch=Search";
	$locVar		= "&loc=".$loc;
	
	$link =	$keyVar.$statVar.$cntVar.$numVar.$srchVar.$locVar;
	
	$noOfCus = $search_obj->searchCus($keyword, $selStatus, $loc);
	
}
else
{
	$link = '';
	$noOfCus	= $customer->getAllCustomer('ALL', "added_on", "DESC");
}

$link			= "numResDisplay=".$numResDisplay;

/* pagination*/
$adjacents = 3;

$total_pages = count($noOfCus);
	
/* Setup vars for query. */
$targetpage = $_SERVER['PHP_SELF']."?".$link; 	//your file name  (the name of this file)
$limit = 10; 	
if(isset($_GET['page']))
{							//how many items to show per page
	$page = $_GET['page'];
}
else
{
	$page = 1;
}
//echo $page;exit;
if($page) 
	$start = ($page - 1) * $limit; 			//first item to display on this page
else
	$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
/*	$sql = "SELECT customer_id FROM $tbl_name LIMIT $start, $limit";
	$result = mysql_query($sql);*/
	//echo $sql.mysql_error();exit;
	/* Setup page vars for display. */
					//if no page var is given, default to 1.
$prev = $page - 1;							//previous page is page - 1
$next = $page + 1;							//next page is page + 1
$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
$lpm1 = $lastpage - 1;						//last page minus 1

/* 
	Now we apply our rules and draw the pagination object. 
	We're actually saving the code to a variable in case we want to draw it more than once.
*/
$pagination = "";
//echo $total_pages;exit;
if($lastpage > 1)
{	
	$pagination .= "<div class=\"pagination\">";
	//previous button
	if ($page > 1) 
		$pagination.= "<a href=\"$targetpage&page=$prev\" id='previous-button'>< previous</a>";
	else
		$pagination.= "<span class=\"disabled\">< previous</span>";	
	
	//pages	
	if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
	{	
		for ($counter = 1; $counter <= $lastpage; $counter++)
		{
			if ($counter == $page)
				$pagination.= "<span class=\"current\">$counter</span>";
			else
				$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
		}
	}
	elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
	{
		//close to beginning; only hide later pages
		if($page < 1 + ($adjacents * 2))		
		{
			for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";				
			}
			$pagination.= "...";
			$pagination.= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
			$pagination.= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";		
		}
		//in middle; hide some front and some back
		elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
		{
			$pagination.= "<a href=\"$targetpage&page=1\">1</a>";
			$pagination.= "<a href=\"$targetpage&page=2\">2</a>";
			$pagination.= "...";
			for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
			}
			$pagination.= "...";
			$pagination.= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
			$pagination.= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";		
		}
		//close to end; only hide early pages
		else
		{
			$pagination.= "<a href=\"$targetpage&page=1\">1</a>";
			$pagination.= "<a href=\"$targetpage&page=2\">2</a>";
			$pagination.= "...";
			for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
			}
		}
	}
	
	//next button
	if ($page < $counter - 1) 
		$pagination.= "<a href=\"$targetpage&page=$next\" id='next-button'>next ></a>";
	else
		$pagination.= "<span class=\"disabled\" id='next-button-disabled'>next ></span>";
	$pagination.= "</div>\n";		
}

/* eof pagination*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo COMPANY_S; ?> - User Management</title>

<!-- Style -->
<link rel="stylesheet" type="text/css" href="../style/admin/admin.css" />
<link rel="stylesheet" href="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
</link>
<!-- eof Style -->

<!-- Javascript Libraries -->
<script language="JavaScript" type="text/javascript" src="../js/openwysiwyg/wysiwyg.js"></script> 
<script type="text/javascript" 
src="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112"></script>
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/utility.js"></script>
<script type="text/javascript" src="../js/advertiser.js"></script>
<script type="text/javascript" src="../js/location.js"></script>
<script type="text/javascript" src="../js/checkEmpty.js"></script>
<script type="text/javascript" src="../js/email.js"></script>
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
            	
                <!-- Admin Top -->
                <div id="admin-top">
                	<h1>Customer  Management</h1>
                    
                    <!-- Search -->
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
                                        
                                        <label>First Name</label>
										<input name="txtFName" type="search" class="text_box_large" id="txtFName" placeholder="First Name.."  
                                        results="5" value="<?php $utility->printGet('txtFName');?>">
                                        <div class="cl"></div>  
                                        
                                        <label>Last Name</label>
										<input name="txtLName" type="search" class="text_box_large" id="txtLName" placeholder="Last Name.."  
                                        results="5" value="<?php $utility->printGet('txtLName');?>">
                                        <div class="cl"></div>       
                                        
                                        <label>Address</label>
										<input name="loc" type="search" class="text_box_large" id="loc" placeholder="Address.."  results="5"
                                        value="<?php $utility->printGet('loc');?>">
                                        <div class="cl"></div>         
										
										<label>Select Status</label>
										<?php 
                                           $arr_value	= array('a','d','');
                                           $arr_label	= array('active','inactive',' Status ');
                                        ?>
                                        <select class="textBoxA" name="selStatus" id="selStatus">
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
                                          <div class="cl"></div>
                                          
                                          <label>Result Per Page</label>      
                                          <?php echo  $utility->dispResPerPage($numResDisplay, '');?>	
                                		  <div class="cl"></div>
                                          
                            		</div>
                                </div>
                            </div>
                            <input type="submit" class="search-button" name="btnSearch" id="btnSearch" value="Search" />
                        </form>
                    </div>
                    <!-- eof Search -->
                    <div class="cl"></div>
                </div>
                <!-- eof Admin Top -->
                
                <!-- Options -->
                <div id="options-area">
                	
                	<div class="add-new-option">
                    	<a href="<?php echo "customer_add.php?action=add_client"; ?>">Add New Customer </a>
                    </div>
                </div>
                <!-- eof Options -->
                
                <!-- Display Data -->
                <div id="data-column">
                
                    <!-- First Column-->
                	<div class="first-column">
                    	<?php $uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');?>
                        <!-- Data -->
                        <table cellpadding="0" cellspacing="0">
                        <?php 
                        if(count($noOfCus) == 0)
                        {
                        ?>
                        <tr>
                          <td height="20" colspan="4"> <?php echo ERU100; ?></td>
                         </tr>
                        <?php 
                        }
                        else
                        {
                        ?>  
                         
                        <thead>
                          <th width="9%">No.</th>
                          <th width="14%">Name</th>
						  <th width="14%">Email</th>
						  <th width="14%">UserType</th>
                          <th width="21%">Verified</th>
                          <th width="16%">Added On</th>
                          <th width="22%">Action</th>
                        </thead>
                        <?php 
                            $i	= $pages->getPageSerialNum($numResDisplay);
                            $noOfCus = array_slice($noOfCus, $start, $limit);
                            foreach($noOfCus as $k)
                            {
                                //$k 			= $pageArray[$pageNumber][$j];
                                $cusDetail 	= $customer->getCustomerData($k);
								
                                $bgColor 	= $utility->getRowColor($i);
                                ?>
                            <tr <?php $utility->printRowColor($bgColor);?>>

                              <td><?php echo $i++; ?></td>
                              <?php //print_r($cusDetail) ?>
                              <td><?php echo $cusDetail[0][5]." ".$cusDetail[0][6]; ?> </td>
							  <td><?php echo $cusDetail[0][3];?> </td>
							  <td><?php if($cusDetail[0][0] == 1){ echo "User";} else{ echo "Client";}?> </td>
                              <td>
                                <a href="javascript:void(0)" 
                                 onClick="MM_openBrWindow('customer_acc_info_verify.php?action=edit_user&cus_id=<?php echo $k; ?>','ContractorEdit','scrollbars=yes,width=600,height=450')">
                                <?php 
                                    echo $customer->renderVerifyStr($k, ERUVERF003, $cusDetail[0][16]);
                                ?>
                                </a>
                              </td>
                              <td><?php echo $dateUtil->printDate($cusDetail[0][22]); ?></td>
                              <td>
                              [ 
                              <a href="<?php echo $_SERVER['PHP_SELF']. "?"."action=view&cus_id=".$k.$link  ?>">
                              view</a> ]
                              
                              [
                              <a href="javascript:void(0)" 
                              onClick="MM_openBrWindow('customer-edit.php?action=edit_user&cus_id=<?php echo $k; ?>','CustomerEdit','scrollbars=yes,width=700,height=650')">edit</a>					  
                              ]
                                 
        
                              [ 
                              <a href="javascript:void(0)" onClick="MM_openBrWindow('customer-delete.php?action=delete_client&amp;cus_id=<?php echo $k; ?>','CustomerDelete','scrollbars=yes,width=450,height=350')">
                              del</a> ]
                              <br />
                              
                              </td>
                           </tr>
                      <?php 
                            }
                      }
                      ?>
                      </table>
                	
                    	<!-- Bottom Pagination-->
                        <div class="pagination-bottom">

                            <div class="upper-block">Total  Customer: <?php echo count($noOfCus);?></div>
                            <?php echo $pagination ?>
                        </div>
                        
                    </div>
                    
                    <!-- Gap-->
                    <div class="column-gap">&nbsp;</div>
                    
                    <!-- Second Column -->
                    <div class="second-column">
                    	
                        
                        
                        <!-- Detail Block -->
                        
                        <?php 
						  if(isset($_GET['action']) && ($_GET['action'] == 'view'))
						  {
							if(isset($_GET['cus_id']) && ($_GET['cus_id'] > 0))
							{
								$noEntry = $utility->getNoOfEntry($_GET['cus_id'], 'customer_id', 'customer');
								$cus_id	= $_GET['cus_id'];
								
								if($noEntry > 0)
								{
									$cus_id	= $_GET['cus_id'];
									$cusDtl 	= $customer->getCustomerData($cus_id);
									
						 ?>
                         	<div class="detail-block">
                        		<h4> 
								<?php 
									echo $utility->imgDisplayR('../images/user/', $cusDtl[0][9], 100, 100, 0, 'greyBorder', $cusDtl[0][3], '');
								?>
								<?php echo $cusDtl[0][5]." ".$cusDtl[0][6]; ?>
                                </h4>
                                
                                <h5>General View</h5>
                                <p><label>Created on</label> <?php echo $dateUtil->printDate($cusDtl[0][22]); ?> </p>
                                <p><label>Modified on</label> <?php echo $dateUtil->printDate($cusDtl[0][23]); ?> </p>
                                <p><label>Customer Type</label> <?php echo $cusDtl[0][0]; ?> </p>
                                <p><label>Sort Order</label> <?php echo $cusDtl[0][15]; ?> </p>
                                <p><label>News Letter</label> <?php //echo $utility->getStatusMesg($customer->checkEmailStat($cusDtl[8])); ?> </p>
                                
                                
                                <h5>Personal</h5>
                                <p><label>First Name</label> <?php echo $cusDtl[0][5]; ?> </p>
                                <p><label>Last Name</label> <?php echo $cusDtl[0][6]; ?> </p>
                                <p><label>Email</label> <?php echo $cusDtl[0][3]; ?> </p>
                                <p><label>Current Password</label> <?php echo md5_decrypt($cusDtl[0][4],USER_PASS); ?> </p>
                                <p><label>Change Password</label> 
                                <a href="javascript:void(0)" onClick="MM_openBrWindow('customer_pass_edit.php?action=edit_pass&user_id=<?php echo $cus_id; ?>','EditAdvertiserPass','width=450,height=250')">
				    			Edit Password 
                                </a>
                                 </p>
                                
                                
                                <h5>Professional Info</h5>
                                <p><label>Organization</label> <?php echo $cusDtl[0][12]; ?> </p>
                                <p><label>Profession</label> <?php echo $cusDtl[0][14]; ?> </p>
                                
                                
                                <h5>Address Info</h5>
                                <p><label>Address</label> <?php echo $cusDtl[0][24]; ?> </p>
                                <p><label>Phone</label> <?php echo $cusDtl[0][31]; ?> </p>
                                <p><label>Mobile</label> <?php echo $cusDtl[0][34]; ?> </p>
                                <p><label>Fax</label> <?php echo $cusDtl[0][33]; ?> </p>
                                <p><label>Town/City</label> <?php echo $cusDtl[0][27]; ?> </p>
                                <p><label>Province</label> <?php echo $cusDtl[0][28]; ?> </p>
                                <p><label>Country</label> 
									<?php 
										$countryDtl= $country->showCountry($cusDtl[0][30]);
                                        if ($countryDtl != NULL) {
                                            echo $countryDtl[0];
                                        }
									?> 
                                </p>
                                <p><label>Postal Code</label> <?php echo $cusDtl[0][29]; ?> </p>


                            </div>
                         <?php 
								}
							}
						  }
						 ?>
                        
                        <!-- eof Detail Block -->
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