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
$pid			= $utility->returnGetVar('pid','0');


if(isset($_POST['btnEditProd']))
{

	$txtProdName 	= $_POST['txtProdName'];
	$txtSeoUrl	 	= $_POST['txtSeoUrl'];
	$txtProdDesc 	= $_POST['txtProdDesc'];
	$txtRemarks 	= $_POST['txtRemarks'];	
	$txtParentId 	= $_POST['txtParentId'];
	$txtPageTitle 	= $_POST['txtPageTitle'];	
	
	
	//registering the post session variables
	$sess_arr	= array('txtParentId', 'txtRemarks','txtProdName', 'txtSeoUrl',
						'txtPageTitle','txtProdDesc');
	$utility->addPostSessArr($sess_arr);
	

	
	//defining error variables
	$action		= 'edit_prod';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $pid;
	$id_var		= 'pid';
	$anchor		= 'editProd';
	$typeM		= 'ERROR';
	
	
	$msg = '';


	
	if($txtProdName == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERPROD003, $typeM, $anchor);
	}
	else
	{
		//edit product
		$product->editProd($pid, $txtParentId, $txtProdName, $txtPageTitle, $txtSeoUrl, $txtProdDesc, $txtRemarks);
				
		
		//forward
		$uMesg->showSuccessT('success', $id, 'id', $_SERVER['PHP_SELF'], SUPROD002, 'SUCCESS');
	}
	$utility->delSessArr($sess_arr);
}
?>

<title><?php echo COMPANY_S; ?> -  - Edit Product</title>

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
	//display message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>
	<div class="popup-form">
    <div class="webform-area">		
		<?php 
        //form
        if( (isset($_GET['action'])) && ($_GET['action'] == 'edit_prod') )
        {
             
            $prodDetail = $product->showProduct($pid);
        ?>
    
          <h3><a name="editProd">Edit Product</a></h3>
    
          <form action="<?php $_SERVER['PHP_SELF']?>?action=edit_prod&pid=<?php echo $pid; ?>" method="post" enctype="multipart/form-data">
<?php 
			$catIds						= $category->getAllParentCat('added_on', 'ASC');
			if(count($catIds) > 0)
			{
				foreach($catIds as $c)
				{
					$catDtl				= $category->categoryData($c, 'categories');
					?>
					<h3><?php echo $catDtl[0]; ?></h3>
					
					<?php 
					$catPIds			= $product->getAllProdIdByCatId($c);
					if(count($catPIds) > 0)
					{
						foreach($catPIds as $cp)
						{
							$cpDtl		= $product->showProduct($cp);
							?>
							<div class="fl">
							<?php echo $cpDtl[1] ?>
							<br>
							<?php 
							$imgId		= $product->getDefaultProdImg($cp);
							if($imgId > 0)
							{
								$imgDtl		= $product->showProdImg($imgId);
								if(($imgDtl[2] != '') && ( file_exists("../images/product/".$imgDtl[2])) )
								{
									echo $utility->imageDisplay2('../images/product/', $imgDtl[2], 50, 50, 0, '', $imgDtl[0]);
			
								}
							}
							?>
							</div>
							<div class="prod-check">
							<input type="checkbox" name="prodCheck[]" value="<?php echo $cp ?>" class="checkbox"   >
							</div>
			
							<?php 
						}
					}
					?><div class="cl"></div><?php 
				}
			}
			?>
			
			<?php /*?><label>Category </label>
			<select name="txtParentId" id="txtParentId" class="textBoxA" onChange="showProduct()">
			<option value="0">Top Level</option>  	  
			<?php
			if(isset($_SESSION['cat_id']))
			{
				$category->catProductDropDown(0,0,$_SESSION['txtParentId'],'add',0);
			}
			else
			{
				$category->catProductDropDown(0,0,0,'add',0);
			}
			?>
			</select>	
			<div class="cl"></div>
			
			<div id="detail">
			</div><?php */?>
			<div class="cl"></div>  
                                            
                                                                    
                <input name="btnEditProd" type="submit" class="button-add"  value="edit" />
               
                <input name="btnCancel" type="submit" class="button-cancel" value="cancel" />
        	</form>
    
        <?php 
        }
        ?>
    </div>
    </div>
