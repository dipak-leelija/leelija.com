<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php");
require_once("../includes/constant.inc.php"); 
require_once("../includes/content.inc.php"); 
require_once("../includes/url.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/category.class.php");
require_once("../classes/static.class.php");
require_once("../classes/pagination.class.php");

require_once("../classes/error.class.php");  
require_once("../classes/date.class.php"); 

require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityCurl.class.php");
require_once("../classes/utilityNum.class.php"); 
require_once("../classes/utilityStr.class.php"); 


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$category		= new Cat();
$stat			= new StaticContent();
$pages			= new Pagination();

$dateUtil      	= new DateUtil();
$error 			= new Error();

$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uCurl 			= new CurlUtility();
$uNum 			= new NumUtility();
$uStr 			= new StrUtility();


###############################################################################################

//declare vars
$typeM		= $utility->returnGetVar('typeM','');
$numResDisplay	= (int)$utility->returnGetVar('numResDisplay', 10);
$static_id		= $utility->returnGetVar('static_id','');

$noOfStatic		= $stat->getContentDownloadId($static_id, 'static_id');



$link			= "numResDisplay=".$numResDisplay;

/* pagination*/
$adjacents = 3;

$total_pages = count($noOfStatic);
	
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
<title><?php echo COMPANY_S; ?> - Files</title>

<!-- Style -->
<link rel="stylesheet" type="text/css" href="../style/admin/admin.css" />
<link rel="stylesheet" type="text/css" href="../style/style.css" />
<link rel="stylesheet" type="text/css" href="../style/jQuery/colorbox.css" />
<link rel="stylesheet" href="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
</link>
<!-- eof Style -->

<!-- Javascript Libraries -->
<script type="text/javascript" src="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112"></script>
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg.js"></script> 
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg-settings.js"></script> 



<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript" src="../js/utility.js"></script>
<script type="text/javascript" src="../js/advertiser.js"></script>
<script type="text/javascript" src="../js/location.js"></script>
<script type="text/javascript" src="../js/checkEmpty.js"></script>
<script type="text/javascript" src="../js/email.js"></script>
<script type="text/javascript" src="../js/static.js"></script>
<script type="text/javascript" src="../js/category.js"></script>
<script type="text/javascript" src="../js/jQuery/jquery.js"></script>

<script type="text/javascript" src="../js/jQuery/jquery-1.7.2.min.js"></script>

<script type="text/javascript" src="../js/jQuery/jquery.colorbox.js"></script>
<script type="text/javascript" src="../js/jQuery/jquery.colorbox-min.js"></script>



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
                	<h1>Files</h1>
                    
                </div>
                
                <!-- Options -->
                <div id="options-area">
                	<div class="add-new-option">
                    	<a href="javascript:void(0)" onClick="MM_openBrWindow('static_add_file.php?action=add_file&id=<?php echo $static_id; ?>','StaticAddFile','scrollbars=yes,width=800,height=600')">
				  		Add New File 
				  		</a> 

                    </div>
                </div>
                <!-- eof Options -->
                
                
                <!-- Display Data -->
                <div id="data-column">
                	<table class="single-column" cellpadding="0" cellspacing="0">
                
                        <!-- SHOWING ALL CONTENT -->
                         <?php 
                         
                         //check number of rows
                         if(count($noOfStatic) == 0)
                         {
                         ?>
                         <tr align="left">
                           <td height="20" colspan="7"> <?php echo "No file has been added for this content.";?> </td>
                         </tr>
                        <?php 
                        }
                        else
                        {
                        ?>  
                        <thead>
                          <th width="4%">id</th>
                          <th width="28%">Title</th>
                          <th width="13%">File</th>
                          <th width="23%">Page Position</th>
                          <th width="12%">Added On </th>
                          <th width="20%">Action</th>
                          </thead>
                          
                        <?php 
                           $i	= $pages->getPageSerialNum($numResDisplay);
                           $noOfStatic = array_slice($noOfStatic, $start, $limit);
							foreach($noOfStatic as $k)
							{
								//echo $value;
                                //$k 			= $pageArray[$pageNumber][$j];
							
                                $downloadDtl 	= $stat->getContentDownloadData($k);
								
                                $bgColor 	= $utility->getRowColor($i);	
					    ?>
							
                            <tr align="left" class="blackLarge" <?php $utility->printRowColor($bgColor);?>>
                              <td><?php echo $i++; ?></td>
                              <td>
                                <?php echo $downloadDtl[1]; ?>
                              </td>
                              <td align="center">
                              	<?php 
								if(($downloadDtl[8] != '') && (file_exists("../images/static/download/".$downloadDtl[8])))
								{
									$fileLink		= "../images/static/download/".$downloadDtl[8];
								}
								else
								{
									$fileLink		= "javascript:void(0)";
								}
								?>
                                
                                <a href="<?php echo $fileLink ?>" target="_blank">
                              	<?php 
								$fileType		= $utility->getFileExtension($downloadDtl[8]);
								if($fileType == 'pdf')
								{
									?>
                                    <img src="../images/icon/pdf.png" width="20" />
									<?php 
								}
								elseif(($fileType == 'docx') || ($fileType == 'doc'))
								{
									?>
                                    <img src="../images/icon/word.png" width="20" />
									<?php
								}
								else
								{
									?>
                                    <img src="../images/icon/text.png" width="20" />
									<?php
								}
								?>
                                </a>
                              </td>
                              <td><?php echo $downloadDtl[2] ?></td>
                              <td>
                                <?php echo $dateUtil->printDate($downloadDtl[6]); ?> </td>
                              <td>


                              
                              [ 
                                <a href="javascript:void(0)" 
                              onClick="MM_openBrWindow('static_edit_file.php?action=static_edit_file&id=<?php echo $k; ?>','StaticDelete','scrollbars=yes,width=800,height=600')">
                              edit					  </a> ]
                              
                                [ 
                                <a href="javascript:void(0)" 
                              onClick="MM_openBrWindow('static_file_delete.php?action=delete&id=<?php echo $k; ?>','StaticDelete','scrollbars=yes,width=400,height=300')">
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
                        <div class="upper-block">Total  File(s): <?php echo count($noOfStatic);?></div>
                        <?php echo $pagination ?>
                    </div>
                  <div class="cl"></div>
                  
              </div>
                </div>
               
                <!-- eof Display Data -->
               
                <!-- Form -->
                <div class="webform-area">
                    <!-- show message -->
                    <?php $uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');?>
                    
					<?php 
                    //add content form 
                    if( (isset($_GET['action'])) && ($_GET['action'] == 'add_static') )
                    {
                    ?>                   
                        <h2><a name="addStatic">Add Content</a></h2>
                        <span>Please note that all the <span class="required">*</span> marked fileds are required</span>
                        <form action="<?php $_SERVER['PHP_SELF'];?>" method="post" 
                        enctype="multipart/form-data">
                        
                        <div class="form-section" id="title">
                            <div class="form-heading" id="title-heading">
                                <!--<img id="title-plus" class="hide-dtl" src="../images/admin/icon/plus-sign.png" />
                                <img id="title-minus" class="form-img" src="../images/admin/icon/minus-sign.png" />-->
                                <h2>Title + Category</h2>
                                <div class="cl"></div>
                            </div>
                            <div id="title-body">
                                <label>Category</label>
                                <select name="cat_id" id="cat_id" class="textBoxA">
                                  <?php
                                      if(isset($_GET['parent_id']))
                                      {
                                        $category->categoryDropDown(0,0,$_GET['parent_id'],'ADD',0,'static_categories');
                                      }
                                      elseif(isset($_SESSION['parent_id']))
                                      {
                                        $category->categoryDropDown(0,0,$_SESSION['parent_id'],'ADD',0,'static_categories');
                                      }
                                      else
                                      {
                                        $category->categoryDropDown(0,0,0,'ADD',0,'static_categories');
                                      }
                                      ?>
                                </select>
                                <div class="cl"></div>
                                
                                <label>Parent Content</label>
                                <select name="selPSId" class="textBoxA" id="selPSId">
                                <option value="0">--Select One--</option>
                                <?php
                                if(isset($_SESSION['selPSId']))
                                {
                                   $stat->populateContentList(0, 0, $_SESSION['selPSId'], 'ADD', 0);
                                                               
                                }
                                elseif(isset($_GET['selPSId']) && ((int)$_GET['selPSId'] > 0))
                                {
                                    $stat->populateContentList(0, 0,$_GET['selPSId'], 'ADD', 0);
                                                               
                                }
                                else
                                {
                                   $stat->populateContentList(0, 0, '', 'ADD', 0);
                                }
                                ?>
                                </select>
                                <div class="cl"></div>
                             
                                <label>Title<span class="orangeLetter">*</span></label>
                                <input name="txtTitle" type="text" class="text_box_large" id="txtTitle"
                                onblur="makeContentSEOURL()" onkeyup="contentTitleCopy()"
                                 value="<?php $utility->printSess('txtTitle'); ?>" size="50" />				
                                <div class="cl"></div>
                              
                                <label>Brief</label>
                                 <textarea  name="txtBrief" class="textAr padB20" id="txtBrief"
                                 wrap="physical"><?php $utility->printSess2('txtBrief',''); ?></textarea>
                                 <div class="cl"></div>
                             
                                <label>Description<span class="orangeLetter">*</span></label>
                                <textarea  name="txtDesc" class="textAr marT15" id="txtDesc">
                                <?php $utility->printSess('txtDesc'); ?>
                                </textarea>
                                
                                <div class="cl"></div>
                            </div>
                        
                        </div>                        
                        <!--<label><a id="add-media"  href="javascript:void()">Add media</a></label>
                        <div class="cl"></div>-->
                        
                        <div class="form-section" id="media">
                            <div class="form-heading" id="media-heading">
                                <img id="media-plus" class="form-img" src="../images/admin/icon/plus-sign.png" />
                                <img id="media-minus" class="hide-dtl" src="../images/admin/icon/minus-sign.png" />
                                <h2>Add Media</h2>
                                <div class="cl"></div>
                            </div>
                            <div id="media-body" class="hide-dtl">
                                <label>Image Title</label>
                                <input name="txtImgTitle" type="text" class="text_box_large" id="txtImgTitle" 
                                value="<?php $utility->printSess('txtImgTitle'); ?>" />
                                <div class="cl"></div>
                              
                                <label>Image Position</label>
                                <input name="radioImgPosition" type="radio" value="left" title="ImgPosition Left" class="radio" id="radioImgPosition"
                                <?php echo $utility->checkSessStr('radioImgPosition','left', '');?>>
                                <label class="radio">Left</label>
                                
                                <input name="radioImgPosition" type="radio" value="center" title="ImgPosition Centre" class="radio" 
                                id="radioImgPosition"
                                <?php echo $utility->checkSessStr('radioImgPosition','center', '');?>>
                                <label class="radio">Centre</label>
                                
                                 <input name="radioImgPosition" type="radio" value="right" title="ImgPosition Right" class="radio" 
                                 id="radioImgPosition"
                                <?php echo $utility->checkSessStr('radioImgPosition','right', '');?>>
                                <label class="radio">Right</label>
                                <div class="cl"></div>
                              
                                <label>Image/Photo</label>
                                <input name="fileImg" type="file" class="text_box_large" id="fileImg">
                                <span class="blackLarge">(Best Size 800 X 800 pixels in width by height)</span>	
                                <div class="cl"></div>
                                                                  
                                <label><span>Display Width</span></label>
                                 <input name="intDispWidth" type="text" class="text_box_large" id="intDispWidth" maxlength="4" size="6" 
                                 value="<?php $utility->printSess2('intDispWidth', 200); ?>" />
                                 <div class="cl"></div>
                                 
                                 <label><span>Display Height</span></label>
                                 <input name="intDispHeight" type="text" class="text_box_large" id="intDispHeight" maxlength="4" size="6"
                                 value="<?php $utility->printSess2('intDispHeight', 200); ?>" />
                                 <div class="cl"></div>
                                 
                                 <label>Link to Youtube Video</label>
                                <input name="txtVideo" type="text" class="text_box_large" id="txtVideo" 
                                value="<?php $utility->printSess('txtVideo'); ?>" size="25" />
                                <div class="cl"></div>
                                
                              
                                <label>Video</label>
                                <input name="fileVideo" type="file" class="text_box_large" id="fileVideo" />
                                <div class="cl"></div>
                            
                            </div>
                        </div>
                        
                        <div class="form-section" id="filter">
                            <div class="form-heading" id="filter-heading">
                                <img id="filter-plus" class="form-img" src="../images/admin/icon/plus-sign.png" />
                                <img id="filter-minus" class="hide-dtl" src="../images/admin/icon/minus-sign.png" />
                                <h2>Additional Filter</h2>
                                <div class="cl"></div>
                            </div>
                        
                            <div id="filter-body" class="hide-dtl">
                                              
                                <label>Meta Title</label>
                                <input name="txtMetaTitle" type="text" class="text_box_large" id="txtMetaTitle" 
                                value="<?php $utility->printSess2('txtMetaTitle',''); ?>" size="40" maxlength="128" />
                                <div class="cl"></div>
                             
                                <label>Meta Keywords/Tags</label>
                                <input name="txtMetaKey" type="text" class="text_box_large" id="txtMetaKey" 
                                value="<?php $utility->printSess2('txtMetaKey',''); ?>" size="40" maxlength="255" />
                                <div class="cl"></div>
                                
                                <label>Meta Description</label>
                                <input name="txtMetaDesc" type="text" class="text_box_large" id="txtMetaDesc" 
                                value="<?php $utility->printSess2('txtMetaDesc',''); ?>" size="40"  maxlength="255"/>
                                
                                <div class="cl"></div>  
                                
                                <!-- added on 5th Jan,2012 -->
                                <label>Display Banner</label>
                                <input name="radioDisBanner" type="radio" value="Y" title="Display Banner Yes" class="radio" id="radioDisBanner"
                                <?php echo $utility->checkSessStr('radioDisBanner','Y', '');?>>
                                <label class="radio">Yes</label>
                                
                                <input name="radioDisBanner" type="radio" value="N" title="Display Banner No" class="radio" id="radioDisBanner"
                                <?php echo $utility->checkSessStr('radioDisBanner','N', '');?>>
                                <label class="radio">No</label>
                                
                                <div class="cl"></div>
                        
                             
                                <label>Display Slide Show</label>
                                <input name="radioDisSlideShow" type="radio" value="Y" title="Slide Show Yes" class="radio" id="radioDisSlideShow"
                                <?php echo $utility->checkSessStr('radioDisSlideShow','Y', '');?>>
                                <label class="radio">Yes</label>
                                
                                <input name="radioDisSlideShow" type="radio" value="N" title="Slide Show No" class="radio" id="radioDisSlideShow"
                                <?php echo $utility->checkSessStr('radioDisSlideShow','N', '');?>>
                                <label class="radio">No</label>
                                <div class="cl"></div>
                            
                            </div>
                            
                        </div>
                        
                        <div class="form-section" id="seo">
                            <div class="form-heading" id="seo-heading">
                                <img id="seo-plus" class="form-img" src="../images/admin/icon/plus-sign.png" />
                                <img id="seo-minus" class="hide-dtl" src="../images/admin/icon/minus-sign.png" />
                                <h2>Custom Seo</h2>
                                <div class="cl"></div>
                            </div>
                        
                        
                            <div id="seo-body" class="hide-dtl">
                                              
                                <label>Web Page Title (h1 Tag)</label>
                                <input name="txtPageTitle" type="text" class="text_box_large" id="txtPageTitle"
                                value="<?php $utility->printSess('txtPageTitle'); ?>" size="50" />
                                (leave empty it is same as title)
                                <div class="cl"></div>
                                
                             
                                <label>SEO URL</label>
                                 <input name="txtSEOURL" type="text" class="text_box_large" id="txtSEOURL"
                                 value="<?php $utility->printSess('txtSEOURL'); ?>" size="50" maxlength="128" />
                                <div class="cl"></div>
                              
                                <label>External/Internal URL</label>
                                 <input name="txtURL" type="text" class="text_box_large" id="txtURL"
                                 value="<?php $utility->printSess('txtURL'); ?>" size="50" maxlength="128" />
                                <div class="cl"></div>
                        
                              
                               <label>Sort Order</label>
                               <input name="intSort" type="text" class="text_box_large" id="intSort"
                               value="<?php $utility->printSess2('intSort', $numOrder); ?>" size="5" maxlength="3" />
                               <div class="cl"></div>
                              
                                                        
                            </div>
                        
                        </div>
                        
                        
                        <div class="form-section" id="advance">
                            <div class="form-heading" id="advance-heading">
                                <img id="advance-plus" class="form-img" src="../images/admin/icon/plus-sign.png" />
                                <img id="advance-minus" class="hide-dtl" src="../images/admin/icon/minus-sign.png" />
                                <h2>Advance Features</h2>
                                <div class="cl"></div>
                            </div>
                            
                            <div id="advance-body" class="hide-dtl">
                                <label>Select No. of Sub Desc.</label>
                                <?php 
                                //gen number array
                                $arr_value	= range(1,3);
                                $arr_label	= range(1,3);
                                ?>
                                  <select name="selNum" id="selNum" onchange="return getNumDesc();"
                                   class="textBoxA">
                                    <option value="0">--Select--</option>
                                    <?php 
                                    if(isset($_SESSION['selNum']))
                                    {
                                        $utility->genDropDown($_SESSION['selNum'], $arr_value, $arr_label);
                                    }
                                    else if(isset($_GET['selNum']))
                                    {
                                        $utility->genDropDown($_GET['selNum'], $arr_value, $arr_label);
                                    }
                                    else
                                    {
                                        $utility->genDropDown(0, $arr_value, $arr_label);
                                    }
                                    ?>
                                  </select>	
                                  <div class="cl"></div>
                                
                                <div id="showDescMsg">
                                    <?php 
                                    if(isset($_SESSION['selNum']))
                                    {
                                        echo $stat->genDesc($_SESSION['selNum']);
                                    }
                                    ?>					
                                </div>
                            </div>
                        </div>
                        
                        <div class="cl"></div>
                        
                        <label>&nbsp;</label>
                        
                        <input name="btnAddStatic" type="submit" class="button-add" value="add">
                        <input name="btnCancel" type="submit" class="button-cancel" value="cancel">
                        <div class="cl"></div>
                        
                        <label>&nbsp;</label>
                        <label>&nbsp;</label>
                        <div class="cl"></div>
                        
                        </form>
                        
                   
                    <?php 
					}
					?>
                    
                     
                </div>
                <div class="cl"></div>
                <!-- eof Form -->
                
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