<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php"); 
require_once("../includes/constant.inc.php"); 
require_once("../classes/error.class.php");  
require_once("../classes/location.class.php"); 

require_once("../classes/utility.class.php"); 
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();

$lc		 		= new Location();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();

###############################################################################################

//declare vars
$typeM		= $utility->returnGetVar('typeM','');
$t_Id		= $utility->returnGetVar('id','');


if(isset($_POST['btnEditTown']))
{
	$txtName 		= $_POST['txtName'];
	$txtDesc 		= $_POST['txtDesc'];
	$txtCountriesId = (int)$_POST['txtCountriesId'];
	$txtProvinceId 	= (int)$_POST['txtProvinceId'];
	$txtCountyId 	= (int)$_POST['txtCountyId'];
	
	
	if($txtProvinceId == -1)
	{
		$txtProvinceId = 0;
	}
	if($txtCountyId == -1)
	{
		$txtCountyId = 0;
	}
	
	//hold in session
	$sess_arr = array('txtName', 'txtDesc','txtProvinceId','txtCountyId');
	$utility->addPostSessArr($sess_arr);
	
	//check duplicate town
	$duplicate = $error->duplicateChild($txtProvinceId, 'province_id', $txtName, 'town_name', 'town');
	
	
	if($txtCountriesId == 0)
	{
		$msg = "&msg=Error: country is empty#addt";
		header("Location:".$_SERVER['PHP_SELF']."?action=add_town&msg=".$msg);
	}
	/*if($txtProvinceId == 0)
	{
		$msg = "&msg=Error: province is empty#addt";
		header("Location:".$_SERVER['PHP_SELF']."?action=add_town".$page->getLink().$msg);
	}
	else if($txtCountyId == 0)
	{
		$msg = "&msg=Error: county is empty#addt";
		header("Location:".$_SERVER['PHP_SELF']."?action=add_town".$page->getLink().$msg);
	}*/
	
	else if($txtName == '')
	{
		$msg = "&msg=Error: town name is empty#addt";
		header("Location:".$_SERVER['PHP_SELF']."?action=add_town&msg=".$msg);
	}
	else if(($txtProvinceId > 0) && (preg_match("^ER^",$duplicate)))
	{
		$msg = "&msg=Error: town already exist#addt";
		header("Location:".$_SERVER['PHP_SELF']."?action=add_town&msg=".$msg);
	}
	else
	{
		//edit town
		$t_Edit = $lc->updateTown($t_Id, $txtCountyId, $txtProvinceId, $txtCountriesId, $txtName, $txtDesc);
									//($tid, $province_id, $name, $desc)
		
		//edit image
		/*if($_FILES['fileImg']['name'] != '')
		{
			//echo "in image if";exit;
			$utility->deleteFile($t_Id, 'town_id' ,'../images/location/', 'town_image', 'town');
			$fName = $utility->fileUpload($_FILES['fileImg'], 'T' ,'../images/location/', $t_Id, 'town_image', 'town_id', 'town');
		}*/

		header("Location:".$_SERVER['PHP_SELF']."?action=success&msg=town is edited&typeM=SUCCESS");
	}
	
}
?>

<title>Town Edit</title>
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/wysiwyg.js"></script> 

<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript" src="../js/utility.js"></script>
<script type="text/javascript" src="../js/location.js"></script> 

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

<div class="popup-form">
	<?php 
	//display message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>
	<?php 
	//edit faq
	if(isset($_GET['action']))
	{
		if($_GET['action'] == 'town_edit')
		{
			
			$tDetail = $lc->getTownDataByTownId($t_Id);	
	?>
      <h3>Edit Town</h3>

      <form action="<?php $_SERVER['PHP_SELF']?>?id=<?php echo $t_Id; ?>" method="post" enctype="multipart/form-data">

            <?php 
			$arr_val		= array(10, 13, 18, 25,  30, 44, 54, 73, 81, 99, 100, 103, 107, 110, 138, 149, 153, 162, 168, 193, 
									196, 209, 222, 223);
									
			$arr_label		= array('Argentina',  'Australia', 'Bangladesh',  'Bhutan', 'Brazil', 'China', 'Cuba', 'France', 
									'Germany', 'India', 'Indonesia', 'Ireland', 'Japan', 'Kenya', 'Mexico', 'Nepal', 'New Zealand', 
									'Pakistan', 'Philippines', 'South Africa', 'Srilanka', 'Thiland',  'UK',  'USA');
									  
			?>
			
			<label>Country<span class="orangeLetter"> *</span></label>
			<select name="txtCountriesId" id="txtCountriesId" class="text_box_large" onchange="getProvinceList()">
				<option value="0">-- Select One --</option>
                    
                    <?php 
                    if(isset($_SESSION['txtCountriesId']))
                    {
                        $utility->genDropDown($_SESSION['txtCountriesId'], $arr_val, $arr_label);
                    }
                    elseif(isset($_GET['txtCountriesId']) && ((int)$_GET['txtCountriesId'] > 0))
                    {
                        $utility->genDropDown($_GET['txtCountriesId'], $arr_val, $arr_label);
                    }
                    else
                    {
                        $utility->genDropDown($tDetail[0], $arr_val, $arr_label);
                    }
                    
                    ?>
                    </select>
				
			<div class="cl"></div>
			
								   
			<label> Province<span class="orangeLetter"> *</span></label>
			<select name="txtProvinceId" id="txtProvinceId" class="text_box_large" onchange="getCountyList()">
			<option value="0">-- Not Found --</option>
            <?php 
				if($tDetail[0] > 0)
				{
					if(isset($_SESSION['txtProvinceId']) && ((int)$_SESSION['txtProvinceId'] > 0))
					{
						
						$utility->populateDropDown2($_SESSION['txtProvinceId'], 'province_id', 'province_name', 
													'countries_id', $tDetail[0], 'province');
					}
					else
					{
						$utility->populateDropDown2($tDetail[1], 'province_id', 'province_name', 
													'countries_id', $tDetail[0], 'province');
					}
				}
			 ?>
			</select>
			<div class="cl"></div>
			
			
			<label> County <span class="orangeLetter">*</span></label>
			<select name="txtCountyId" id="txtCountyId" onChange="getTownList()" class="text_box_large">
				<option value="0">-- Not Found --</option>
                <?php 
				if($tDetail[1] > 0)
				{
					if(isset($_SESSION['txtCountyId']) && ((int)$_SESSION['txtCountyId'] > 0))
					{
						
						$utility->populateDropDown2($_SESSION['txtCountyId'], 'county_id', 'county_name', 
													'province_id', $tDetail[1], 'county');
					}
					else
					{
						$utility->populateDropDown2($tDetail[2], 'county_id', 'county_name', 
													'province_id', $tDetail[1], 'county');
					}
				}
			 ?>
			 </select>
			<div class="cl"></div>
            
            
            <label>Town Name<span class="maroonErrorLarge">*</span> </label>
              <input name="txtName" type="text" id="txtName" 
              value="<?php echo $tDetail[3];?>" size="50">
            </span>					

            <?php 
            if(($tDetail[7] != '') && (file_exists("../images/location/".$tDetail[7])))
            {
                echo $utility->imageDisplay("../images/location/", $tDetail[7], 100, 100, 0, 'lightBorder', $tDetail[3]);
            }
            ?>
			<div class="cl"></div>
            <label>Description</label>
            <textarea  name="txtDesc" id="txtDesc">
            <?php echo $tDetail[6];?></textarea>

              <div id="options"></div>
			<div class="cl"></div>
          
          <!--<tr>
            <td align="left" class="menuText">Image</td>
            <td align="left" class="menuText"><input name="fileImg" type="file" id="fileImg" /></td>
          </tr>
          <tr>-->

            <input name="btnEditTown" type="submit" class="button-add" id="btnEditTown" value="edit">
            <input name="btnCancel" type="button" class="button-add" id="btnCancel" onClick="self.close()" value="cancel">


      </form>

    <?php }
    }
    ?>
    
    </div>
