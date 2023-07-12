<?php
session_start();
//include_once('checkSession.php');
require_once("_config/connect.php"); 
require_once("includes/constant.inc.php");
require_once("classes/date.class.php");  
require_once("classes/error.class.php"); 
require_once("classes/search.class.php");	
require_once("classes/customer.class.php"); 
require_once("classes/login.class.php"); 

//require_once("../classes/front_photo.class.php"); 
require_once("classes/blog_mst.class.php"); 
require_once("classes/domain.class.php"); 
require_once("classes/utility.class.php"); 
require_once("classes/utilityMesg.class.php"); 
require_once("classes/utilityImage.class.php");
require_once("classes/utilityNum.class.php");

/* INSTANTIATING CLASSES */
$dateUtil      	= new DateUtil();
$error 			= new Error();
$search_obj		= new Search();
$customer		= new Customer();
$logIn			= new Login();

//$ff				= new FrontPhoto();
$blogMst		= new BlogMst();
$domain			= new Domain();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
######################################################################################################################

$userId			= $utility->returnSess('userid', 0);

   $txtEmail			= 	$_GET['txtEmail'];
	
	$r=session_id();
	
	
	
?>
<?php
	/*echo $_SESSION["product"];
	exit;*/
	//echo $_SESSION['randomKey'];exit;
	//GET THE POST DATA

/*	$txtEmail			= 	$_GET['txtEmail'];
	$productId		  = 	$_GET['productId'];
	$total		  = 	$_GET['total'];*/

	
	/*echo $productId;
	exit;*/

	$txtMemberId		= 	"M-";//$_POST['txtMemberId']
	
	$_SESSION['txtEmail']= $txtEmail;
	
	//defining error variables
	$action		= 'add_client';
	$url		= $_SERVER['PHP_SELF'];
	$id			= 0;
	$id_var		= '';
	$anchor		= 'addCustomer';
	$typeM		= 'ERROR';
	
	//error check
	$duplicateId	= $error->duplicateUser($txtEmail, 'email', 'customer');
	$dupMemId		= $error->duplicateUser($txtMemberId, 'member_id', 'customer');
	$invalidEmail 	= $error->invalidEmail($txtEmail);
	
	
	//CHECK FIELD VALIDATION 
	/*elseif($selCusType == 0)
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERU301, $typeM, $anchor);
	}*/
	if(preg_match("/^ER/i", $duplicateId))
	{
		echo "Already Registerd Login Please ";
		
		//$error->showErrorTA($action, $id, $id_var, $url, ERU114, $typeM, $anchor);
	}
	else if(preg_match("/^ER/",$invalidEmail))
	{
		echo "Invalid email address";
		
		//$error->showErrorTA($action, $id, $id_var, $url, ERE002, $typeM, $anchor);
	}
	
	else {
?>


	<?php	
		echo "1. Email Id:"; echo"&nbsp;"; echo $txtEmail;
	?>	
    
	<?php echo "~"; ?>		
			 <!--Registration form area-->
             <div id="UpdateDelideryAdd"></div>
             <div id="CustomerRegiForm"><!--end CustomerRegiForm div-->
              <div class="left-col"> <!--start left-col class-->
                <div id="shippingAdd"><p>DELIVERY ADDRESS</p></div>
                <div class="fspace"></div>
                	<div id="ErrorDiv">
                	 <div id="Errormsg">
                    	<!-- show message -->
                   		 <?php $uMesg->dispMessage($typeM, 'images/icon/', 'blackLarge');?>
               		 </div>
                     </div>
                    <form class="form-reg">
                    
                    
                    
                    	<!-- Personal-->
                    	<div class="reg-block">
                        	<div class="reg-head" id="heading-text">Your Personal Information</div>
                            <div class="reg-body">
                            	<!-- First Name-->
                                <div class="reg-field">
                                    <label for="txtFName">First Name <span class="orangeLetter">*</span></label>
                                    <div class="cl"></div>
                                    <input name="txtFName" type="text" id="txtFName" class="text-field"
                                    onBlur="verifyFName('txtFName', 'First Name')" title="first name"
                                    value="<?php $utility->printSess('txtFName'); ?>" />
                                    <span class="form-field-notification" id='fnResult'></span>
                                </div>
                                
                                <!-- Telephone-->
                                <div class="reg-field">
                                    <label>Telephone<span class="orangeLetter">*</span></label>
                                    <div class="cl"></div>
                                    <input name="txtMobile" type="text" id="txtMobile" class="text-field"
                                    value="<?php $utility->printSess('txtMobile'); ?>" />
                                    
                                </div>
                                
                                <!-- Last Name-->
                                <div class="reg-field">
                                    <label>Last Name <span class="orangeLetter">*</span></label>
                                    <div class="cl"></div>
                                    <input name="txtLName" type="text" id="txtLName" class="text-field"
                                    onBlur="verifyLName('txtLName', 'Last Name')" title="last name"
                                    value="<?php $utility->printSess('txtLName'); ?>" />
                                    <span class="form-field-notification" id='lnResult'></span>
                                </div>
                                <div class="cl"></div>
                                
                                <!-- Email-->
                                <div class="reg-field">
                                    <label>Contact Email <span class="orangeLetter">*</span></label>
                                    <input name="txtEmail" type="text" id="txtEmail"
                                    onBlur="verifyCus()" title="email" class="text-field"
                                    value="<?php if(isset($_SESSION['txtEmail'])){echo $_SESSION['txtEmail'];} else{echo $email;} ?>" />
                                    <span class="form-field-notification" id='cusVerify'></span>
                                </div>
                                <div class="cl"></div>
                                
                            </div>
                        </div>
                        
                        <!-- Address-->
                        <div class="reg-block">
                        	<div class="reg-head">Your Address</div>
                            <div class="reg-body">
                            	<!-- Company-->
                                <div class="reg-field">
                                    <label>Company</label>
                                    <div class="cl"></div>
                                    <input name="txtOrg" type="text" id="txtOrg" class="text-field"
                                    value="<?php $utility->printSess('txtOrg'); ?>" />
                                </div>
                                
                                <!-- Post code-->
                                <div class="reg-field">
                                    <label>Post Code<span class="orangeLetter">*</span></label>
                                    <div class="cl"></div>
                                    <input name="txtPostCode" type="text" id="txtPostCode" class="text-field"
                                    value="<?php $utility->printSess('txtPostCode'); ?>" />
                                    
                                </div>
                                
                                <!-- Address 1-->
                                <div class="reg-field">
                                    <label>Address 1 <span class="orangeLetter">*</span></label>
                                    <div class="cl"></div>
                                    <input name="txtAdd1" type="text" id="txtAdd1" class="text-field"
                                    value="<?php $utility->printSess('txtAdd1'); ?>"/>
                                </div>
                                
                                <!-- Country-->
                                <div class="reg-field">
                                 <label>Country <span class="orangeLetter">*</span></label>
                                    <div class="cl"></div>
                                    <input name="countryId" type="text" id="countryId" class="text-field" readonly="readonly"
                                    value="Australia"/>
                                    
									 <?php 
                                       /* if(isset($_SESSION['txtProvinceId']))
                                        {
                                            $utility->populateDropDown($_SESSION['countryId'], 'countries_id', 'countries_name', 'countries');
                                        }
                                        elseif(isset($_GET['countryId']) && ((int)$_GET['countryId'] > 0))
                                        {
                                            $utility->populateDropDown($_GET['countryId'], 'countries_id', 'countries_name', 'countries');
                                        }
                                        else
                                        {
                                            $utility->populateDropDown(0, 'countries_id', 'countries_name', 'countries');
                                        }*/
                                     ?>
                                    </select>
                                </div>
                                <div class="cl"></div>
                                
                                <!-- Address 2-->
                                <div class="reg-field">
                                    <label>Address 2</label>
                                    <div class="cl"></div>
                                    <input name="txtAdd2" type="text" id="txtAdd2" class="text-field"
                                    value="<?php $utility->printSess('txtAdd2'); ?>" />
                                </div>
                                
                                <!-- State-->
                                <div class="reg-field">
                                    <label>Region/ State <span class="orangeLetter">*</span></label>
                                    <div class="cl"></div>
                                    <select name="txtState" type="text" id="txtState" class="text-field">
                                    <option value="0">------ Select an option ------</option>
                                    <option value="ACT" >Australian Capital Territory</option>
                                    <option value="NSW" >New South Wales</option>
                                    <option value="NT" >Northern Territory</option>
                                    <option value="QLD" >Queensland</option>
                                    <option value="SA" >South Australia</option>
                                    <option value="TAS" >Tasmania</option>
                                    <option value="VIC" >Victoria</option>
                                    <option value="WA" >Western Australia</option>
                                    
                                    </select>
                                </div>
                                <div class="cl"></div>
                                
                                <!-- City-->
                                <div class="reg-field">
                                    <label>Suburb <span class="orangeLetter">*</span></label>
                                    <div class="cl"></div>
                                    <input name="txtTown" type="text" id="txtTown" class="text-field"
                                    value="Town/City" />
                                </div>
                                <div class="cl"></div>
                                
                            </div>
                        </div>
                        
                        <!-- Password-->
                        <div class="reg-block">
                        	<div class="reg-head">Your Password</div>
                            <div class="reg-body">
                            	<!-- Password-->
                                <div class="reg-field">
                                    <label>Password <span class="orangeLetter">*</span></label>
                                    <div class="cl"></div>
                                    <input name="txtPassword" type="password" id="txtPassword" class="text-field"
                                    title="password" onblur="passLength()">
                                    <span class="form-field-notification" id="passLen"></span>
                                </div>
                                
                                <div class="reg-field">
                                    <label>Confirm Password <span class="orangeLetter">*</span></label>
                                    <input name="txtCnfPass" type="password"id="txtCnfPass"  class="text-field"
                                    title="confirm password"  onblur="passConfirm()">
                                    <span class="form-field-notification" id="passCnf"></span>
                                </div>
								<div class="cl"></div>
                             <input type="hidden" name="productId" id="productId" value="<?php echo $productId;?>" />
                             <input type="hidden" name="total" id="total" value="<?php echo $total;?>" />


                            </div>
                        </div>
                        
                        <div id="DeliCon">
                        	<input name="submit" type="button" class="button-add" id="btnSubmit" onclick="RegiSubmit()" value="SAVE & CONTINUE" />
                         </div>   
                        <?php /*?><!-- Contact Email-->
                       
                                                 
                      	<input name="btnRegister" type="submit" class="button-add" id="btnRegister" value="Join Now" /><?php */?>
                    </form>
                    <!-- END OF REGISTRATION FORM -->
                
			    </div>
					<!--Registration form area end-->
             </div><!-- End CustomerRegiForm   -->    
             
             <?php echo "~";?>
    
             
             
             
             

<?php
	}
?>
			<?php echo "~";?>

	<!-----------------If invalid option then back -------------------------------------------------->
            
    				
                                
                        
           <div class="form-login" id="login-form">
             <div class="login-heading">  </div>
                <form id="formLogin"  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="frmLogin">
                <div class="marB10">
					<?php 
                   /* if(isset($_GET['msg']))
                    {
                        echo $_GET['msg'];
                    }*/
                    ?>
                </div>
                
                <label id="formRegister" for="txtLogin">E-Mail<span class="orangeLetter">*</span></label>
                <div class="cl"></div>
                <input name="txtLogin" type="text" class="text-field1" id="txtLogin" value="<?php echo $_SESSION['txtEmail'];?>">
                <div class="cl"></div>
                
                <label id="formRegister" for="txtPass">Password<span class="orangeLetter">*</span></label>
                <div class="cl"></div>
                <input style="float:left" name="txtPass" type="password" class="text-field1" id="txtPass">
                <div class="cl"></div>
    			
                <input name="btnLogin" type="submit" class="button right marR10" value="log in" title="login to become member">
                
                <a href="<?php echo 'forget-password.php?action=forget' ?>" 
                title="forget password">Forgot Password? </a>
                
                <div class="cl"></div>
    
            </form>
            </div>
		