<?php 
session_start();
include_once('checkSession.php');
// include_once('../_config/connect.php');
require_once "../_config/dbconnect.php";
require_once "../_config/dbconnect.trait.php";


require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php"); 
 
require_once("../classes/error.class.php"); 
require_once("../classes/customer.class.php"); 
require_once("../classes/countries.class.php");
require_once("../classes/category.class.php");
require_once("../classes/search.class.php");
require_once("../classes/pagination.class.php");
include_once('../classes/hits.class.php');
include_once('../classes/static.class.php');

require_once("../classes/utility.class.php"); 
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityNum.class.php");


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();
$country		= new Countries();
$cat			= new Cat();
$search_obj		= new Search();
$page			= new Pagination();
$hits			= new Hits();
$customer		= new Customer();
$static			= new StaticContent();


$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();

#########################################################################################################################

$thisMonth		=  (int)date("m");
$thisYear		=  (int)date("Y");

if($thisMonth == 1)
{
	$month2		= 12;
	$year2		= $thisYear - 1;
}
else
{
	$month2		= $thisMonth - 1;
	$year2		= $thisYear;
}


if($month2 == 1)
{
	$month3		= 12;
	$year3		= $year2 - 1;
}
else
{
	$month3		= $month2 - 1;
	$year3		= $year2;
}


if($month3 == 1)
{
	$month4		= 12;
	$year4		= $year3 - 1;
}
else
{
	$month4		= $month3 - 1;
	$year4		= $year3;
}

$hits1			= $hits->getHitsByMonthYear($thisMonth, $thisYear);
$hits2			= $hits->getHitsByMonthYear($month2, $year2);
$hits3			= $hits->getHitsByMonthYear($month3, $year3);
$hits4			= $hits->getHitsByMonthYear($month4, $year4);

$user1			= $customer->getCustomerByMonthYear($thisMonth, $thisYear);
$user2			= $customer->getCustomerByMonthYear($month2, $year2);
$user3			= $customer->getCustomerByMonthYear($month3, $year3);
$user4			= $customer->getCustomerByMonthYear($month4, $year4);

$months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to Admin Control Panel</title>
    
<link rel="stylesheet" type="text/css" href="../style/admin/admin.css" />

<script type="text/javascript" src="../js/jQuery/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="../js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="../js/jquery-1.10.1.js"></script>
<script type="text/javascript" src="../js/jQuery/jquery.min.js"></script>
<script type="text/javascript" src="../js/jQuery/jquery.slimscroll.js"></script>
<script type="text/javascript" src="../js/jQuery/jquery.slimscroll.min.js"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function()
 {
	$('.option-block').hover(function()
	{
		
		var id		= $(this).attr('id');
		var dId		= id+"-dropdown";
		/*$("#"+dId).slideDown();*/
		$("#"+dId).css({display:'block'});
		
	},function()
	{
		var id		= $(this).attr('id');
		var dId		= id+"-dropdown";
		/*$("#"+dId).slideUp();*/
		$("#"+dId).css({display:'none'});
	});
 });
</script>

<!-- Hits Counter-->
<script type="text/javascript">
	$(function () {
        $('#hits').highcharts({
			
            chart: {
                type: 'bar',
				backgroundColor: 'transparent',
				height:'220'
            },

			title: {
                text: 'Hits Counter',
                x: -20 //center
            },
			
            xAxis: {
				categories: ['<?php echo $months[$thisMonth - 1] ?>', '<?php echo $months[$month2 - 1] ?>',
				 '<?php echo $months[$month3 - 1] ?>', '<?php echo $months[$month4 - 1] ?>'],
                
                title: {
                    text: 'Months'
                }
            },
            yAxis: {
				title: {
					text: 'Total Hits'
				},
                min: 0,

                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ' '
            },

            legend: {
				enabled:false
            },
            credits: {
                enabled: false
            },
			
            series: [{
                data: [
				  {y: <?php echo $hits1 ?>, color: '#ff8a00'},
				  <?php echo $hits2 ?>,                        // default blue
				  {y: <?php echo $hits3 ?>, color: '#01ad19'}, 
				  {y: <?php echo $hits4 ?>, color: '#00ccff'}]  
            }, ],
			
			colors: [
   '#2f7ed8', 
   '#0d233a', 
   '#8bbc21', 
   '#910000'
]
        });
    });
    

</script>
<!-- eof Hits Counter-->

<!-- Monthly registered user-->
<script type="text/javascript">
	$(function () {
        $('#user').highcharts({
			
            chart: {
                type: 'bar',
				backgroundColor: 'transparent',
				height:'220'
            },

			title: {
                text: 'Monthly Registered User',
                x: -20 //center
            },
			
            xAxis: {
				categories: ['<?php echo $months[$thisMonth - 1] ?>', '<?php echo $months[$month2 - 1] ?>',
				 '<?php echo $months[$month3 - 1] ?>', '<?php echo $months[$month4 - 1] ?>'],
                
                title: {
                    text: 'Months'
                }
            },
            yAxis: {
				title: {
					text: 'Registered User'
				},
                min: 0,

                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ' '
            },

            legend: {
				enabled:false
            },
            credits: {
                enabled: false
            },
			
            series: [{
                data: [
				  {y: <?php echo count($user1) ?>, color: '#ff8a00'},
				  <?php echo count($user2) ?>,                        // default blue
				  {y: <?php echo count($user3) ?>, color: '#01ad19'}, 
				  {y: <?php echo count($user4) ?>, color: '#00ccff'}]  
            }, ],
			
			colors: [
   '#2f7ed8', 
   '#0d233a', 
   '#8bbc21', 
   '#910000'
]
        });
    });
    

</script>
<!-- eof Monthly registered user-->


<script type="text/javascript">
function startTime()
{
	var today=new Date();
	d=today.toString('dddd, MMMM ,yyyy');
	//document.getElementById('server-date').innerHTML= d;
	t=setTimeout('startTime()',500);
}

function checkTime(i)
{
	if (i<10)
  	{
  		i="0" + i;
 	}
	return i;
}
</script>

</head>

<body onload="startTime()">
<script src="../js/highcharts.js"></script>	
    <!-- Header -->
	<?php require_once('header.inc.php'); ?>
    
    <!-- Container -->
    <div class="container">
        <div class="inner-container">
        	<!-- Left content-->
        	<div id="left-content">
            	<div id="logo">
                	<img src="../<?php echo LOGO_ADMIN_PATH; ?>" width="<?php echo LOGO_ADMIN_WIDTH; ?>" 
   					 height="<?php echo LOGO_ADMIN_HEIGHT; ?>" alt="<?php echo LOGO_ALT; ?>" />
                </div>
                <!-- Statistics-->
                <div id="statistics">
                    <div id="hits">
                    </div>
                    <div id="user" class="marT20">
                    </div>
                    <div id="org" class="marT20">
                    </div>
                </div>
                <!-- eof Statistics-->
            </div>
            <!-- eof Left content-->
            
            <!-- Main section-->
            <div id="main-section">
            	<h1>Welcome to <?php echo COMPANY_S; ?> Admin Dashboard</h1>
                <div class="cl"></div>
                <div class="option">
                
                
                
               
                    <div id="static" class="option-block">
                    	<div id="static-dropdown" class="option-dropdown">
                        	<ul>
                                <li><a href="cat_static.php" title="Static Categories">Web Categories</a></li>
                                <li><a href="static.php" title="Web Pages">Web Pages</a></li>
                                <li><a href="notice.php" title="Web Pages">eBox-136 Newsletters</a></li>
								
                            </ul>
                        </div>
                    	<img src="../images/admin/icon/content.jpg" width="99.9%" >
                        <div class="option-title">Content Management</div>
                    </div>
                    
                    <div id="marketing" class="option-block">
                    	<div id="marketing-dropdown" class="option-dropdown">
                        	<ul>
                                <li><a href="email_cat.php" title="Email Group">E-mail Group </a></li>
                                <li><a href="email.php" title="Send Email">E-mail Management </a></li>
                                <li><a href="email_export.php" title="E-mail Export">E-mail Export </a></li>
                                <li><a href="auto_responder.php" title="Auto Responder">Auto Responder</a></li>
                                <li><a href="email_autores_setup.php" title="Auto Responder setup">Auto Responder Setup</a></li>
                            </ul>
                        </div>
                    	<img src="../images/admin/icon/marketing.jpg" width="99.9%" >
                        <div class="option-title">Marketing Tools</div>
                    </div>
                    <div id="setup" class="option-block">
                    	<div id="setup-dropdown" class="option-dropdown">
                        	<ul>
                            	<li><a href="admin_user.php" title="Admin Users" >Admin Users</a></li>
                                <li><a href="back_up.php" title="Database Backup" >Database Backup</a></li>
                            </ul>
                        </div>
                    	<img src="../images/admin/icon/set-up.jpg" width="99.9%" >
                        <div class="option-title">Setup Tools</div>
                    </div>
                    
                    
                     <div id="order" class="option-block">
                    	<div id="order-dropdown" class="option-dropdown">
                        	<ul>
                                <li><a href="order.php" title="Static Categories">Orders Management</a></li>
                               
								
                            </ul>
                        </div>
                    	<img src="../images/admin/icon/team.jpg" width="99.9%" >
                        <div class="option-title">Orders Management</div>
                    </div>
                
                    <div id="product" class="option-block">
                    	<div id="product-dropdown" class="option-dropdown">
                        	<ul>
                                <li><a href="product-type.php" title="Static Categories">Products Categories</a></li>
                               <li><a href="product.php" title="Static Categories">Products Management</a></li>
								
                            </ul>
                        </div>
                    	<img src="../images/admin/icon/team.jpg" width="99.9%" >
                        <div class="option-title">Products Management</div>
                    </div>
                    
                    
                    <div class="cl"></div>
                </div>
                <div class="miscellaneous">
                	
					
                </div>
                
            </div>
            <!-- eof Main section-->
            <div class="cl"></div>
		
        </div>  
    </div>
    <!-- eof Container -->
    
    <!-- Footer -->
	<?php require_once('footer.inc.php'); ?>
</body>
</html>