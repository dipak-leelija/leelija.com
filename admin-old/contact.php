<?php 

session_start();

include_once('checkSession.php');
require_once("../includes/constant.inc.php");

// include_once('../_config/connect.php');

require_once "../_config/dbconnect.php";







require_once("../classes/adminLogin.class.php"); 

require_once("../classes/contact.class.php");

require_once("../classes/search.class.php");



require_once("../classes/date.class.php");  

require_once("../classes/error.class.php"); 

require_once("../classes/utility.class.php");

require_once("../classes/utilityMesg.class.php");

require_once("../classes/pagination.class.php");





/* INSTANTIATING CLASSES */

$adminLogin 	= new adminLogin();

$cont			= new Contact();

$search_obj		= new Search();





$dateUtil      	= new DateUtil();

$error 			= new Error();

$utility		= new Utility();

$uMesg			= new MesgUtility();

$pages			= new Pagination();







#############################################################################################



//declare vars

$typeM			= $utility->returnGetVar('typeM','');

$numResDisplay	= (int)$utility->returnGetVar('numResDisplay',10);

$numVar			= "&numResDisplay=".$numResDisplay;



if((isset($_GET['btnSearch'])) &&($_GET['btnSearch'] == 'Search')){

	//get the variables
	$keyword		= $utility->returnGetVar('keyword','');
	$type			= $utility->returnGetVar('type','');
	$mode			= $utility->returnGetVar('mode','');

	//defining vars
	$keyVar			= "&keyword=".$keyword;
	$typeVar		= "&type=".$type;
	$modeVar		= "&mode=".$mode;
	$btnVar			= "&btnSearch=Search";

	$link =	$btnVar.$keyVar.$typeVar.$modeVar.$numVar;
	$noOfCus 	= $search_obj->searchContact($keyword);

}else{

	$link = $numVar;
	$noOfCus	= $cont->getAllContact('ALL');

}



/*START PAGINATION*/
//$total = count($noOfCus);
$link			= "numResDisplay=".$numResDisplay;

/* pagination*/

$adjacents = 3;
$total_pages = count($noOfCus);

/* Setup vars for query. */
$targetpage = $_SERVER['PHP_SELF']."?".$link; 	//your file name  (the name of this file)
$limit = 10;

if(isset($_GET['page'])){

	//how many items to show per page
	$page = $_GET['page'];

}else{
	$page = 1;

}

//echo $page;exit;

if($page){
	$start = ($page - 1) * $limit; 			//first item to display on this page
}else{
	$start = 0;								//if no page var is given, set start to 0
}	

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
if($lastpage > 1){	

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

	}elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
{

		//close to beginning; only hide later pages
		if($page < 1 + ($adjacents * 2)){

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

		elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)){

			$pagination.= "<a href=\"$targetpage&page=1\">1</a>";
			$pagination.= "<a href=\"$targetpage&page=2\">2</a>";
			$pagination.= "...";

			for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++){

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
		else{

			$pagination.= "<a href=\"$targetpage&page=1\">1</a>";
			$pagination.= "<a href=\"$targetpage&page=2\">2</a>";
			$pagination.= "...";

			for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++){

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



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<title><?php echo COMPANY_S; ?> - Contact Management</title>



<!-- Style -->

<link rel="stylesheet" type="text/css" href="../style/admin/admin.css" />

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

                	<h1>Contact Management</h1>

                    

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

                                

                                                              	

                                

                                		<div class="cl"></div>

                            		</div>

                                </div>

                            </div>

                            <input name="btnSearch" type="submit" class="search-btn" id="btnSearch" value="Search" />

                        </form>

                    </div>

                </div>

                

               

                <!-- Display Data -->

                <div id="data-column">

                <div class="first-column">

                 	<table class="single-column" cellpadding="0" cellspacing="0">

                         <?php 

                        if(count($noOfCus) == 0)

                        {

                        ?>

                        <tr align="left" class="orangeLetter">

                          <td height="20" colspan="6"> None of the contact found </td>

                         </tr>

                        <?php 

                        }else{
                        ?>  
                        <thead>

                          <th width="4%">No.</th>

                          <th width="33%"> Full Name </th>

                          <th width="23%">E-Mail (send now) </th>

						  <th width="19%">Message </th>

                          <th width="19%">Created On </th>

                          <th width="21%">Action</th>

                         </thead>

                        <?php 

                            $x = $pages->getPageSerialNum($numResDisplay);

                            $noOfCus = array_slice($noOfCus, $start, $limit);

							

                            foreach($noOfCus as $k)

                            {

                                //$k 			= $pageArray[$pageNumber][$j];

                                $cusDetail 	= $cont->showContactInfo($k);

								// print_r($cusDetail);

                                $bgColor 	= $utility->getRowColor($x);

                        ?>

                            <tr align="left" <?php $utility->printRowColor($bgColor);?>>
                              <td ><?php echo $x++; ?></td>
                              <td > <?php echo $cusDetail[1]; ?></td>
                              <td >
                              <?php echo $utility->displayEmail($cusDetail[2], $cusDetail[1], "YES", "customer_mail.php"); ?>
                              </td>
							  <td > <?php echo $cusDetail[4]; ?></td>
                              <td ><?php echo $dateUtil->printDate($cusDetail[5])." ".substr($cusDetail[5],11,18); ?></td>
                              <td >
                              [ <a href="javascript:void(0)" onClick="MM_openBrWindow('contact_view.php?action=view_contact&cus_id=<?php echo $k; ?>', 'ContactView','scrollbars=yes,width=650,height=550')">
                              view
                              </a> ]

                              [ <a href="javascript:void(0)" onClick="MM_openBrWindow('contact_delete.php?action=delete_contact&cus_id=<?php echo $k; ?>', 'ContactDelete','scrollbars=yes,width=450,height=350')">
                              delete
                              </a> ]
                              </td>
                           </tr>
                      <?php 
                            }
                      }
                      ?>
                      </table>

                    <div class="pagination-bottom">

                            <div class="upper-block">Total  Contact: <?php echo count($noOfCus);?></div>

                            <?php echo $pagination ?>

                      </div>

                	

                </div>

                

                <!-- Gap-->

                <div class="column-gap">&nbsp;</div>



                <div class="second-column">

                 

                </div>

                <div class="cl"></div>

                <!-- eof Form -->

                

                

            </div>

            <!-- eof Inner  -->

             

            <div class="cl"></div>

        </div>  

        </div>

    </div>

    <!-- eof Container -->

    

    <!-- Footer -->

	<?php require_once('footer.inc.php'); ?>



</body>

</html>