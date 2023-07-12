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
	$txtPageTitle	 	= $_POST['txtPageTitle'];
	$txtProdCode	 	= $_POST['txtProdCode'];
	$intQuant	 		= $_POST['intQuant'];
	$txtProdPrice	 	= $_POST['txtProdPrice'];
	$txtBrief	 	= $_POST['txtBrief'];
	$txtProdDesc	 	= $_POST['txtProdDesc'];
	$txtSeoUrl	 	= $_POST['txtSeoUrl'];
	$txtCanonical	 	= $_POST['txtCanonical'];
	$txtMetaTag	 	= $_POST['txtMetaTag'];
	$txtMetaDesc 	= $_POST['txtMetaDesc'];
	$txtMetaKey 	= $_POST['txtMetaKey'];	
	$txtParentId 	= $_POST['txtParentId'];
		
	
	//registering the post session variables
	$sess_arr	= array('txtParentId','txtProdName', 'txtPageTitle', 'txtProdCode', 'intQuant', 'txtProdPrice', 'txtBrief',
		'txtProdDesc','txtSeoUrl','txtCanonical','txtMetaTag','txtMetaDesc','txtMetaKey');
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
	elseif($txtProdPrice=='')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERPROD00111, $typeM, $anchor);
	}
	else
	{
		//edit product
		$product->editProd($pid, $intQuant,$txtProdPrice, $txtParentId, $txtProdCode, $txtProdName, $txtPageTitle, $txtSeoUrl,
		$txtBrief,$txtProdDesc,$txtCanonical,$txtMetaTag,$txtMetaDesc,$txtMetaKey);
				
		
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
<script type="text/javascript" src="../js/product.js"></script>
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
	
    <div class="webform-area">		
		<?php 
        //form
        if( (isset($_GET['action'])) && ($_GET['action'] == 'edit_prod') )
        {
             
            $prodDetail = $product->showProduct($pid);
        ?>
		
<h3><a name="editProd">Edit Product</a></h3>
    
          <form action="<?php $_SERVER['PHP_SELF']?>?action=edit_prod&pid=<?php echo $pid; ?>" method="post" enctype="multipart/form-data">
             <label>Category </label>
                
           <select name="txtParentId" id="txtParentId" class="textBoxA">
		  <option value="0">Top Level</option>
		  <?php
                if(isset($_SESSION['txtParentId']))
                {
                    $category->catProductDropDown(0,0,$_SESSION['txtParentId'],'edit',0);
                }
                else
                {
                    $category->catProductDropDown(0,0,$prodDetail[0],'edit',0);
                }
                ?>
	  </select>
        <div class="cl"></div>
                
                <div class="cl"></div>                      
                <label>Product Name <span class="orangeLetter">*</span></label>
                <input name="txtProdName" type="text" class="text_box_large" id="txtProdName" 
                 onBlur="makeProdSeoUrl()"  onkeyup="contentTitleCopy2()" value="<?php echo $prodDetail[1] ?>"
                  size="25" />
                <div class="cl"></div>
                
                <label>Page Title (h1 Tag)</label>
                <input name="txtPageTitle" type="text" class="text_box_large" id="txtPageTitle"
                value="<?php echo $prodDetail[2] ?>" size="50" />
                (leave empty it is same as title)
                <div class="cl"></div>
                
                 <label>Product Code</label>
                  <input name="txtProdCode" type="text" class="text_box_large" id="txtProdCode" 
				 value="<?php echo $prodDetail[10] ?>" size="25" />
                  <div class="cl"></div>
               				 <label>Product Quantity</label>
                            <input name="intQuant" type="text" class="text_box_large" id="intQuant" 
					        value="<?php echo $prodDetail[15] ?>" size="10" />
                            <span class="menuText">(enter 0, if the product is out of stock)</span> 
                            <div class="cl"></div>
                            
                            <label>Price <span class="orangeLetter">*</span></label>
                            <input name="txtProdPrice" type="text" class="text_box_large" id="txtProdPrice" 
					        value="<?php echo $prodDetail[14] ?>" size="15" />
                            <span class="menuText">(in USD) </span>
                            <div class="cl"></div>
                            
                             <label>brief</label>
                            <input name="txtBrief" type="text" class="text_box_large" id="txtBrief" 
					        value="<?php echo $prodDetail[4] ?>" size="25" />
                            <div class="cl"></div>
                            
                              <label>Product Description</label>
                               <textarea  name="txtProdDesc" id="txtProdDesc"
                              value=' <?php echo $prodDetail[5] ?>'>
                               </textarea>
                            
                            <label>Seo Url</label>
                            <input name="txtSeoUrl" type="text" class="text_box_large" id="txtSeoUrl" 
					        value="<?php echo $prodDetail[3] ?>" size="25" />
                            <div class="cl"></div>
                            
                             <label>Canonical</label>
                            <input name="txtCanonical" type="text" class="text_box_large" id="txtCanonical" 
					        value="<?php echo $prodDetail[9] ?>" size="25" />
                            <div class="cl"></div>
                            
                             <label>Meta Tag</label>
                            <input name="txtMetaTag" type="text" class="text_box_large" id="txtMetaTag" 
					        value="<?php echo $prodDetail[6] ?>" size="25" />
                            <div class="cl"></div>
                            
                             <label>Meta Description</label>
                            <input name="txtMetaDesc" type="text" class="text_box_large" id="txtMetaDesc" 
					        value="<?php echo $prodDetail[7] ?>" size="25" />
                            <div class="cl"></div>
                            
                             <label>Meta Key</label>
                            <input name="txtMetaKey" type="text" class="text_box_large" id="txtMetaKey" 
					        value="<?php echo $prodDetail[8] ?>" size="25" />
                            <div class="cl"></div>
<?php /*?>                            <label>Tax</label>
                <select name="txtTaxId" id="txtTaxId" class="textBoxA">
                  <?php
                  if(isset($_SESSION['txtTaxId']))
                  {
                    $tax->taxDropDown($_SESSION['txtTaxId']);
                  }
                  else
                  {
                    $tax->taxDropDown(0);
                  } 
                  ?>
                </select>	
                <div class="cl"></div><?php */?>
                
                
                <div class="cl"></div>
                
             <!--   <span class="menuTxt"><a href="#AddDesc" onClick="showAdditionalDesc('divId')"> Add additional Remarks</a></span>
                <div class="cl"></div>
                
                <a name="AddDesc">
                    <div id="divId" class="hideDesc">
                        <label>Additional Remarks</label>
                        <textarea  name="txtRemarks" id="txtRemarks">
                        <?php //echo $prodDetail[4] ?>
                        </textarea>
                    </div>
                </a>-->
                <div class="cl"></div>
                                            
                                                                    
                <input name="btnEditProd" type="submit" class="button-add"  value="edit" />
               
                <input name="btnCancel" type="submit" class="button-cancel" value="cancel" onClick="self.close()" />
        	</form>
    
        <?php 
        }
        ?>
    </div>
