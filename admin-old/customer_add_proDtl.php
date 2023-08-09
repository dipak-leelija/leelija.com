<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 

require_once("../includes/constant.inc.php");
require_once("../includes/product.inc.php");
require_once("../includes/product_attribute.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php");  
require_once("../classes/error.class.php"); 
require_once("../classes/category.class.php"); 
require_once("../classes/product.class.php"); 
require_once("../classes/search.class.php");
require_once("../classes/pagination.class.php");
require_once("../classes/tax.class.php");
require_once("../classes/product_attribute.class.php");

require_once("../classes/utility.class.php"); 
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityNum.class.php");

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();
$category		= new Cat();
$product		= new Product();
$search_obj		= new Search();
$page			= new Pagination();
$tax			= new Tax();
$prodAttr		= new ProductAttribute();

$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();

######################################################################################################################

//declare vars
$typeM			= $utility->returnGetVar('typeM','');
$pCusId			= $utility->returnGetVar('pCusId','0');
$pid			= $utility->returnGetVar('pid','0');
$cusId			= $utility->returnGetVar('cusId','0');


if(isset($_POST['btnEditProd']))
{

	$select_day 		= $_POST['select_day'];
	$select_month		= $_POST['select_month'];
	$select_year 		= $_POST['select_year'];
	$select_end_day 	= $_POST['select_end_day'];	
	$select_end_month 	= $_POST['select_end_month'];
	$select_end_year 	= $_POST['select_end_year'];
	$farming_year 		= $_POST['farming_year'];
	$unit_id 			= $_POST['unit_id'];	
	$farmingYield 		= $_POST['farmingYield'];
	$pid 				= $_POST['pid'];
	$cusId 				= $_POST['cusId'];
	
	$startDate			= $select_year."-".$select_month."-".$select_day;
	$endDate			= $select_end_year."-".$select_end_month."-".$select_end_day;

	
	//registering the post session variables
	$sess_arr	= array('select_day', 'select_month','select_year', 'select_end_day',
						'select_end_month','select_end_year','farming_year' ,'unit_id' ,'farmingYield');
	$utility->addPostSessArr($sess_arr);
	

	
	//defining error variables
	$action		= 'add_dtl';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $pCusId;
	$id_var		= 'pCusId';
	$anchor		= 'editProd';
	$typeM		= 'ERROR';
	
	
	$msg = '';


	
	if($farmingYield == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, "Enter a production amount", $typeM, $anchor);
	}
	else
	{
		//edit product
		$product->editProdToCust($id, $pid, $cusId, 1, $startDate, $endDate, $farming_year, $farmingYield, $unit_id);
				
		
		//forward
		$uMesg->showSuccessT('success', $id, 'id', $_SERVER['PHP_SELF'], SUPROD002, 'SUCCESS');
	}
	$utility->delSessArr($sess_arr);
}
?>

<title><?php echo COMPANY_S; ?> -  - Add More</title>

<!-- Style -->
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

<!-- TinyMCE --> 
 <script type="text/javascript" src="../js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
 <script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "image,fontsizeselect,forecolor,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,link,unlink,|,bullist,numlist,|,outdent,indent",
		theme_advanced_buttons2 :
"undo,redo,|,emotions,|,pasteword,code",
		theme_advanced_buttons3 : "",
		theme_advanced_buttons4 : "",
		
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		formats : {
			alignleft : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'left'},
			aligncenter : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'center'},
			alignright : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'right'},
			alignfull : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'full'},
			bold : {inline : 'span', 'classes' : 'bold'},
			italic : {inline : 'span', 'classes' : 'italic'},
			underline : {inline : 'span', 'classes' : 'underline', exact : true},
			strikethrough : {inline : 'del'}
		},

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->


</head>


	<?php 
	
	
	//close button
	echo $utility->showCloseButton();
	?>
	
    <div class="webform-area">	
    	<?php //display message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');	?>
		<?php 
        //form
        if( (isset($_GET['action'])) && ($_GET['action'] == 'add_dtl') )
        {
            
            $cusPDtl			= $product->showProdToCust($pCusId);
			$select_day			= date('d',strtotime($cusPDtl[3]));
			$select_month		= date('m',strtotime($cusPDtl[3]));
			$select_year		= date('Y',strtotime($cusPDtl[3]));
			
			$select_end_day		= date('d',strtotime($cusPDtl[4]));
			$select_end_month	= date('m',strtotime($cusPDtl[4]));
			$select_end_year	= date('Y',strtotime($cusPDtl[4]));
			
			
			//echo $select_year;exit;
        ?>
    
          <h3><a name="editProd">Edit Product</a></h3>
    
          <form action="<?php $_SERVER['PHP_SELF']?>?action=edit_prod&pCusId=<?php echo $pCusId; ?>" method="post" enctype="multipart/form-data">
          
          		<!-- Farming start day-->
                <label>Farming Start Date<span class="orangeLetter">*</span></label>
                <!--<input type="text" class="text-field" name="bookingDate" id="bookingDate" value="" />-->
                <select name="select_day" class="textAr" id="select_day">
                    <?php 
                    for($i=1; $i<= 31; $i++){ ?>
                    <option value="<?php if($i< 10){ echo '0'.$i; } else {echo $i;}?>" <?php if($select_day == $i) echo 'selected';?>>
                    <?php if($i< 10){ echo '0'.$i; } else {echo $i;} ?></option>
                    <?php } ?>
                </select>
                
                <?php 
				$months = array();
				for ($i = 12; $i >00; $i--) {
				$timestamp = mktime(0, 0, 0, date('n') - $i, 1);
				$months[date('n', $timestamp)] = date('F', $timestamp);
				}
				?>
				<select name="select_month"  class="textAr" id="select_month">
				<?php
				foreach ($months as $num => $name) {
				?>	
				<option value="<?php echo $num ?>" <?php if($select_month == $num) echo 'selected';?>><?php echo $name ?></option>
				<?php 
				}
				?>
				</select>
                
                <select name="select_year" class="textAr" id="select_year">
                    <?php 
                    $curYear = date('Y');
                    
                    for($i=0; $i<= 3; $i++)
                    { 
                        ?>
                        <option value="<?php echo $curYear; ?>" <?php if($select_year== $i) echo 'selected';?>>
                        <?php echo $curYear; ?>
                        </option>
                        <?php
                        $curYear++;
                     } 
                     ?>
                </select>
                <div class="cl"></div> 
                
                <!-- Farming end day-->
                <label>Farming End Date<span class="orangeLetter">*</span></label>
                <!--<input type="text" class="text-field" name="bookingDate" id="bookingDate" value="" />-->
                <select name="select_end_day" class="textAr" id="select_end_day">
                    <?php 
                    for($i=1; $i<= 31; $i++){ ?>
                    <option value="<?php if($i< 10){ echo '0'.$i; } else {echo $i;}?>" <?php if($select_end_day == $i) echo 'selected';?>>
                    <?php if($i< 10){ echo '0'.$i; } else {echo $i;} ?></option>
                    <?php } ?>
                </select>
                
                <?php 
				$months = array();
				for ($i = 12; $i >00; $i--) {
				$timestamp = mktime(0, 0, 0, date('n') - $i, 1);
				$months[date('n', $timestamp)] = date('F', $timestamp);
				}
				?>
				<select name="select_end_month"  class="textAr" id="select_end_month">
				<?php
				foreach ($months as $num => $name) {
				?>	
				<option value="<?php echo $num ?>" <?php if($select_end_month == $num) echo 'selected';?>><?php echo $name ?></option>
				<?php 
				}
				?>
				</select>
                
                <select name="select_end_year" class="textAr" id="select_end_year">
                    <?php 
                    $curYear = date('Y');
                    
                    for($i=0; $i<= 3; $i++)
                    { 
                        ?>
                        <option value="<?php echo $curYear; ?>" <?php if($select_end_year == $i) echo 'selected';?>>
                        <?php echo $curYear; ?>
                        </option>
                        <?php
                        $curYear++;
                     } 
                     ?>
                </select>
                <div class="cl"></div> 
                
                <!-- farming year-->
                <label>farming Year</label>
                <select name="farming_year" class="text_box_large" id="farming_year">
                    <?php 
                    $curYear = date('Y');
                    
                    for($i=0; $i<= 3; $i++)
                    { 
                        ?>
                        <option value="<?php echo $curYear; ?>" <?php if(isset($_GET['farming_year']) == $i) echo 'selected';?>>
                        <?php echo $curYear; ?>
                        </option>
                        <?php
                        $curYear++;
                     } 
                     ?>
                </select>
                <div class="cl"></div> 
                
                <!-- Production unit-->
                <label>Production unit</label>
                <select name="unit_id" class="text_box_large" id="unit_id">
                	<?php 
					$utility->populateDropDown($cusPDtl[7], 'yield_unit_id', 'unit_title', 'yield_unit');
					?>
                </select>
                <div class="cl"></div> 
                
                <!-- Production amount-->
                <div class="cl"></div>                      
                <label>Production Amount <span class="orangeLetter">*</span></label>
                <input name="farmingYield" type="text" class="text_box_large" id="farmingYield" value="<?php echo $cusPDtl[6] ?>" />
                <div class="cl"></div>
                
                <input name="pid" type="hidden" value="<?php echo $pid ?>">
                <input name="cusId" type="hidden" value="<?php echo $cusId ?>">
                                           
                                                                    
                <input name="btnEditProd" type="submit" class="button-add"  value="edit" />
               
                <input name="btnCancel" type="submit" class="button-cancel" value="cancel" />
        	</form>
    
        <?php 
        }
        ?>
    </div>
