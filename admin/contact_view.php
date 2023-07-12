<?php 
session_start();
include_once('checkSession.php');
// require_once("../_config/connect.php");
require_once "../_config/dbconnect.php";
require_once "../_config/dbconnect.trait.php";

require_once("../includes/constant.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/contact.class.php");
require_once "../classes/customer.class.php";

require_once("../classes/date.class.php");  
require_once("../classes/error.class.php"); 
require_once("../classes/utility.class.php"); 


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$cont			  = new Contact();

$dateUtil   = new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$Customer   = new Customer();

if(isset($_GET['cus_id'])){
	$cus_id = $_GET['cus_id'];
}
$cusDetail = $cont->showContactInfo($cus_id);
echo $cus_id;
print_r($cusDetail);

// $cusData = $Customer->getCustomerData($cus_id);
// print_r($cusData);
// exit;


?>

<title><?php echo COMPANY_S; ?> - Contact View</title>
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">

<script language="JavaScript" type="text/javascript" src="../js/openwysiwyg/wysiwyg.js"></script>
<link rel="stylesheet" href="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112"
    media="screen">
</LINK>
<SCRIPT type="text/javascript" src="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112">
</script>
<script language="JavaScript" type="text/JavaScript">
    <!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>

<table class="tblBrd" align="center" width="98%">

    <?php 
    if(isset($_GET['action']) && ($_GET['action'] == 'view_contact'))
    {
    ?>
    <tr class=''>
        <td height="25" align='left' bgcolor="#EEEEEE">
            <h3>View Contact</h3>
        </td>
    </tr>
    <tr>
        <td>
            <div class="menuText padT20">


                <!-- PERSONAL DETAIL -->
                <div class="blackLarge bdrB h25 w100P marB10">
                    <strong>PERSONAL DETAIL</strong>
                </div>



                <div class="w100P pad2 ha">
                    <div class="menuText fl padT3 w100">Full Name </div>
                    <div class="menuText fl padT3">
                        <?php echo $cusDetail[0];?>
                    </div>
                    <div class="cl"></div>
                </div>

                <div class="w100P pad2 ha">
                    <div class="menuText fl padT3 w100">Email</div>
                    <div class="menuText fl padT3">
                        <a href="#" title="mail <?php echo $cusDetail[1]; ?>" onClick="MM_openBrWindow('customer_mail.php?toEmail=<?php echo $cusDetail[1]; ?>&toName=<?php echo $cusDetail[0]; ?>',
              'SendMail','scrollbars=yes,width=650,height=400')"> <a href="#" title="mail <?php echo $cusDetail[1]; ?>"
                                onClick="MM_openBrWindow('customer_mail.php?toEmail=<?php echo $cusDetail[1]; ?>&toName=<?php echo $cusDetail[0]; ?>',
              'SendMail','scrollbars=yes,width=650,height=400')">
                                <?php echo $cusDetail[1];?>
                            </a>
                    </div>
                    <div class="cl"></div>
                </div>

                <div class="w100P pad2 ha">
                    <div class="fl padT3 w100">Company </div>
                    <div class="fl padT3">
                        <?php echo $cusDetail[2];?>
                    </div>
                    <div class="cl"></div>
                </div>




                <!-- ADDRESS AND CONTACT INFORMATION -->
                <div class="blackLarge bdrB h25 w100P marT15">
                    <strong>ADDRESS + CONTACT</strong>
                    <?php
                      
                    ?>
                </div>

                <div class="w100P pad2 ha">
                    <div class="fl padT3 w100">Address</div>
                    <div class="fl padT3">
                        <?php echo $cusDetail[12];?>
                    </div>
                    <div class="cl"></div>
                </div>

                <?php /*?> <div class="w100P pad2 ha">
                    <div class="fl padT3 w100"></div>
                    <div class="fl padT3">
                        <?php echo $cusDetail[1];?>
                    </div>
                    <div class="cl"></div>
                </div><?php */?>


                <div class="w100P pad2 ha">
                    <div class="fl padT3 w100">City</div>
                    <div class="fl padT3">
                        <?php echo $cusDetail[4];?>
                    </div>
                    <div class="cl"></div>
                </div>

                <div class="w100P pad2 ha">
                    <div class="fl padT3 w100">State</div>
                    <div class="fl padT3">
                        <?php echo $cusDetail[5];?>
                    </div>
                    <div class="cl"></div>
                </div>

                <div class="w100P pad2 ha">
                    <div class="fl padT3 w100">Country</div>
                    <div class="fl padT3">
                        <?php echo $cusDetail[6];?>
                    </div>
                    <div class="cl"></div>
                </div>

                <div class="w100P pad2 ha">
                    <div class="fl padT3 w100">Phone</div>
                    <div class="fl padT3">
                        <?php echo $cusDetail[7];?>
                    </div>
                    <div class="cl"></div>
                </div>

                <div class="w100P pad2 ha">
                    <div class="fl padT3 w100">Fax</div>
                    <div class="fl padT3">
                        <?php echo $cusDetail[8];?>
                    </div>
                    <div class="cl"></div>
                </div>



                <!-- OPTIONS -->
                <div class="blackLarge bdrB h25 w100P marT15">
                    <strong>MISCELLANEOUS</strong>
                </div>

                <div>
                    <div class="fl padT3 padB10 w100P blackLarge">REMARKS</div>
                    <div class="fl padT3 w100P">
                        <?php echo $cusDetail[9];?>
                    </div>
                    <div class="cl"></div>
                </div>
                <!--  -->

                <div align="center" class="padT10 padB10 marT10">
                    <input name="btnCancel" type="button" class="button-cancel" id="btnCancel" onClick="self.close()"
                        value="close" />
                </div>


                <!-- END OF REGISTRATION FORM -->
            </div>
        </td>
    </tr>
    <?php 
    }//if
    ?>
</table>