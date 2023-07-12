<?php 
ob_start();
session_start();
//include_once('checkSession.php');
// require_once("../_config/connect.php");
require_once ("../_config/dbconnect.php");
require_once "../_config/dbconnect.trait.php";


require_once("../includes/constant.inc.php");
require_once("../classes/date.class.php");
require_once("../classes/error.class.php");
require_once("../classes/search.class.php");
require_once("../classes/customer.class.php");
require_once("../classes/login.class.php");
require_once("../classes/adminLogin.class.php"); 
require_once("../classes/pagination.class.php");


//require_once("../classes/front_photo.class.php");
require_once("../classes/blog_mst.class.php");
require_once("../classes/domain.class.php");
require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php");
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityNum.class.php");

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();
$search_obj		= new Search();
$customer		= new Customer();
$logIn			= new Login();
$pages			= new Pagination();

//$ff				= new FrontPhoto();
$blogMst		= new BlogMst();
$domain			= new Domain();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
######################################################################################################################
$typeM			= $utility->returnGetVar('typeM','');

//admin detail
$userData 		=  $adminLogin->getUserDetail($_SESSION[ADM_SESS]);

$blogsDtls		= $blogMst->ShowBlogData();

$numResDisplay	= (int)$utility->returnGetVar('numResDisplay', 20);
$userId			= $utility->returnSess('userid', 0);


?>

<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title><?php echo COMPANY_S; ?> - Niche wise Blogs Maintenance</title>

    <!-- Style -->
    <link href="../style/admin/style.css" rel="stylesheet" type="text/css">
    <link href="../style/admin/admin.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112"
        media="screen">
    </link>
    <!-- DataTables -->

    <link href="../style/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../style/bootstrap/js/bootstrap.min.js"></script>
    <!--<link href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">-->

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

    <!--   multi filter -->
    <script src='../js/multifilter.js'></script>
    <script src="../js/jquery.dataTables.columnFilter.js" type="text/javascript"></script>
    <script src="../js/jquery.dataTables.yadcf.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
    <!-- eof JS Libraries -->

</head>


<script type='text/javascript'>
//<![CDATA[
$(document).ready(function() {
    $('.filter').multifilter()
})
//]]>
</script>

<script>
$(document).ready(function() {
    $('#example').dataTable().yadcf([{
            column_number: 11,
            filter_type: "range_date",
            filter_container_id: "filterDate"
        }

    ]);
});
</script>

<script>
$(document).ready(function() {
    $('#example').dataTable()
        .columnFilter({
            sPlaceHolder: "head:before",
            aoColumns: [{
                    type: "number_format"
                },
                {
                    type: "text"
                },
                {
                    type: "text"
                },
                {
                    type: "number_format"
                },
                {
                    type: "number_format"
                },
                {
                    type: "number_format"
                },
                {
                    type: "number_format"
                }

                //{ type: "date-range" }

            ]

        });
});
</script>

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
                    <h1>Niche wise Blogs Maintenance</h1>
                    <div class="cl"></div>
                </div>

                <!-- Options --><br><br><br><br>
                <div id="options-area">
                    <div class="add-new-option">
                        <a href="#" onClick="MM_openBrWindow('sample_add.php?action=sample_add#addSam','','scrollbars=yes,width=750,height=600')"> Add New Record </a>
                    </div>
                </div>

                <div class="padT30">
                    <!-- -->
                </div>
                <div id="PrintForm">

                    <!-- Display Data -->
                    <div id="data-column" style="position:relative; bottom: 9px;">
                        <table id="example" class="single-column" cellpadding="0" cellspacing="0">
                            <!-- display option -->
                            <?php 
                        if(count($blogsDtls) == 0){
                        ?>
                            <tr style="align: left;" class="orangeLetter">
                                <td height="20" colspan="5"> <?php echo "Table is empty"; ?></td>
                            </tr>
                            <?php 
                        }else{
                        ?>
                            <thead>
                                <tr>
                                    <th width="1%" height="25" align="center">Id.</th>
                                    <th width="10%">Sites</th>
                                    <th width="10%">Niches</th>
                                    <th width="2%">DA</th>
                                    <th width="2%">PA</th>
                                    <th width="2%">TF</th>
                                    <th width="2%">Org.Traffic</th>
                                    <th width="2%">Link Type</th>
                                    <th width="2%">AdminPrices</th>
                                    <th width="2%"> Prices</th>
                                    <th width="2%"> Approved</th>
                                    <th width="3%" align="center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                              $sl=1;
	                            $k = $pages->getPageSerialNum($numResDisplay);
						                  //	$sid = array_slice($sid, $start, $limit);     
                              foreach($blogsDtls as $eachRecord){
							
							                $bgColor 	= $utility->getRowColor($k);	
                            ?>
                                <tr align="left" <?php $utility->printRowColor($bgColor);?>>
                                    <td align="left"><?php echo $sl; ?></td>
                                    <td align="center"><?php echo $eachRecord['domain']; ?></td>
                                    <td align="center"><?php echo $eachRecord['niche']; ?></td>
                                    <td align="center"><?php echo $eachRecord['da']; ?></td>
                                    <td align="center"><?php echo $eachRecord['pa']; ?></td>
                                    <td align="center"><?php echo $eachRecord['tf']; ?></td>
                                    <td align="center"><?php echo $eachRecord['organic_trafic']; ?></td>
                                    <td align="center"><?php echo $eachRecord['follow']; ?></td>
                                    <td align="center"><?php echo $eachRecord['ext_cost']; ?></td>

                                    <td align="center"><?php echo $eachRecord['cost']; ?></td>
                                    <td align="center"><?php echo $eachRecord['approved']; ?></td>

                                    <td align="center">
                                        <a href="#"
                                            onClick="MM_openBrWindow('blog-approved.php?action=BlogAppr&bid=<?php echo $eachRecord['blog_id']; ?>','BlogAppr','scrollbars=yes,width=750,height=600')">
                                            Approval
                                        </a> |
                                        <a href="#"
                                            onClick="MM_openBrWindow('sample_edit.php?action=Add_emp&sid=<?php echo $eachRecord['blog_id']; ?>','stockEdit','scrollbars=yes,width=750,height=600')">
                                            Edit
                                        </a> |
                                        [
                                        <a href="javascript:void(0)"
                                            onClick="MM_openBrWindow('customer-delete.php?action=delete_client&amp;cus_id=<?php echo $eachRecord['blog_id']; ?>','CustomerDelete','scrollbars=yes,width=450,height=350')">
                                            del</a> ]

                                    </td>


                                </tr>
                                <?php 
						$sl++;
                            }
                      }
                      ?>
                            </tbody>
                        </table>

                        <div class="first-column">
                        </div>

                    </div>
                    <!-- eof Display Data -->
                </div>
                <div class="cl"></div>

            </div>
            <!-- eof Inner  -->

            <div class="cl"></div>
        </div>
    </div>
    <!-- eof Container -->

    <!-- Footer -->
    <?php //require_once('footer.inc.php'); ?>

    <!--Used for print-->
    <script type="text/javascript">
    function PrintDiv() {
        var PrintForm = document.getElementById('PrintForm');
        var popupWin = window.open('', '_blank', 'width=800,height=800');
        popupWin.document.open();
        popupWin.document.write('<html><body onload="window.print()">' + PrintForm.innerHTML + '</html>');
        popupWin.document.close();
    }
    </script>

    <!--end print process-->

    <!-- DataTables -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!--<script type="text/javascript" src="//code.jquery.com/jquery-1.12.0.min.js"></script>

-->
    <script>
    $(function() {
        $("#example").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
    </script>


</body>

</html>