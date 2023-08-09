<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../includes/constant.inc.php");
require_once("../includes/product_brand.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/product_brand.class.php");  

require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php"); 


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$brand			= new ProductBrand();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();


###############################################################################################

//declare vars
$typeM		= $utility->returnGetVar('typeM','');
$id			= $utility->returnGetVar('id','');



if(isset($_POST['btnEdit']))
{
	$txtName	= $_POST['txtName'];
	$txtDesc 	= $_POST['txtDesc'];
	$txtURL		= $_POST['txtURL'];
	
	
	//defining error variables
	$action		= 'edit';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $id;
	$id_var		= 'id';
	$anchor		= 'addProductBrand';
	$typeM		= 'ERROR';
		
	if($txtName == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERBRANDCFA002, $typeM, $anchor);
	}
	else
	{
		//update brand
		$brand->updateProductBrand($id, $txtName, $txtDesc, $txtURL);
		
	
		//update the brand
		if(isset($_POST['delImg']) && ($_POST['delImg'] == 1))
		{
			$utility->deleteFile($id, 'product_brand_id' ,'../images/brands/', 'logo', 'product_brand');
		}
			
		if($_FILES['fileImage']['name'] != '')
		{
			$utility->deleteFile($id, 'product_brand_id' ,'../images/brands/', 'logo', 'product_brand');
			
								
			//rename the image
			$newName  = $utility->getNewName4($_FILES['fileImage'], '',  $id);
			
								
			//crop and resize
			$uImg-> fileUpload2($_FILES['fileImage'], '' , $newName, '../images/brands/', $id, 'logo', 'product_brand_id', 'product_brand');
		}
		
		//forward
		$uMesg->showSuccessT('success', $id, 'id', $_SERVER['PHP_SELF'], SUBRANDCFA002, 'SUCCESS');
	}
	
}
?>

<title><?php echo COMPANY_S; ?>-Brand Edit</title>
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">


<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/wysiwyg.js"></script> 

<table class="tblBrd" align="center" width="98%">
	<?php 
	//display message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>
	<?php 
    //CREATING NEW USER FORM
    if(isset($_GET['action']) && ($_GET['action'] == 'edit'))
    {
        $brandDtl 		= $brand->getProductBrandData($id);
    ?>
    <tr>
      <td height="25" align='left' bgcolor="#EEEEEE"><h3>Edit Brand </h3></td>
    </tr>
    <tr>
      <td>
      <form action="<?php $_SERVER['PHP_SELF']?>?id=<?php echo $id; ?>" method="post" 
      enctype="multipart/form-data">
        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" class="menuText padT5">Title <span class="orangeLetter">*</span></td>
            <td height="20" colspan="2" align="left" class="pad5">
            <input name="txtName" type="text" id="txtName" class="text_box_large"
            value="<?php echo stripslashes($brandDtl[0]); ?>" />
            </td>
          </tr>
        
          <tr>
            <td width="96" align="left" class="menuText padT5">Description</td>
            <td height="20" colspan="2" align="left" class="pad5">
            <textarea name="txtDesc" cols="60" rows="9" id="txtDesc" class="textAr">
            <?php echo str_replace("<br />","",stripslashes(stripslashes($brandDtl[1])));?>
            </textarea>	
            </td>
          </tr>
          <tr>
            <td align="left" class="menuText padT5">URL</td>
            <td height="20" align="left" class="pad5">
              <input name="txtURL" type="text" id="txtURL" class="text_box_large"
              value="<?php echo $brandDtl[2]; ?>" />
            </td>
            <td width="230" rowspan="6" align="center"><span class="menuText">
               <?php /*?><?php 
                $utility->imgDisplay('../images/brands/', $brandDtl[3], 
                          150, 60, 0, 'greyBorder', $brandDtl[0], " ");
                ?><?php */?>
               <?php 
						$utility->imgDisplay('../images/brands/', $brandDtl[3],  150, 60, 0, 'greyBorder', $brandDtl[0], " ");
						?>   
            </span></td>
          </tr>
          <tr>
            <td width="96" align="left" class="menuText padT5">Brand Image</td>
            <td width="266" height="20" align="left" class="pad5">
                <input type="file" name="fileImage" id="fileImage" class="text_box_large" />					
            </td>
          </tr>
         
          <tr>
            <td align="left" class="menuText"></td>
            <td align="left" class="blackLarge">
            					
            </td>
          </tr>
          <tr>
            <td align="left" class="menuText">&nbsp;</td>
            <td align="left">&nbsp;</td>
          </tr>
          
          
            <tr>
              <td colspan="2" align="left" class="orangeLetter">
                
             </td>
            </tr>
            <tr>
              <td colspan="2" align="left" class="menuText">					  </td>
              </tr>
            <tr>
              <td align="left" class="menuText">&nbsp;</td>
              <td align="left">&nbsp;</td>
            </tr>
          <tr>
            <td width="96" class="menuText">&nbsp;</td>
            <td height="25" align="left">
            <input name="btnEdit" type="submit" class="button-add" id="btnEdit" value="update" />
            <input name="btnCancel" type="button" class="button-cancel" id="btnCancel" 
            onClick="self.close()" value="cancel" />
            </td>
          </tr>
          <tr>
            <td width="96">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>

      </form>
      </td>
    </tr>
    <?php 
    }
    ?>
</table>