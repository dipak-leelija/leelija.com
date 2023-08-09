

<?php 

session_start();



// require_once("_config/connect.php");
require_once("includes/constant.inc.php");

require_once("_config/dbconnect.php");






// require_once("includes/checkout.inc.php"); 

// require_once("includes/content.inc.php");

require_once("includes/content.inc.php");



// require_once("includes/contact.inc.php");

require_once("includes/contact-us-email.inc.php");

 

require_once("classes/date.class.php");  

require_once("classes/error.class.php");



require_once("classes/category.class.php"); 

require_once("classes/static.class.php"); 

// require_once("classes/navigation.class.php"); 

require_once("classes/contact.class.php");

require_once("classes/login.class.php"); 



require_once("classes/utility.class.php"); 

require_once("classes/utilityMesg.class.php"); 

require_once("classes/utilityImage.class.php");

require_once("classes/utilityStr.class.php");

require_once("classes/utilityNum.class.php");

require_once("classes/utilityCurl.class.php");

require_once("classes/utilityAuth.class.php");





//instantiate classes

$dateUtil      	= new DateUtil();

$error 			= new Error();

$category		= new Cat();

$stat			= new StaticContent();


$userCont		= new Contact();

$login			= new Login();





$utility		= new Utility();

$uMesg 			= new MesgUtility();

$uImg 			= new ImageUtility();

$uStr 			= new StrUtility();

$uNum 			= new NumUtility();

$uCurl 			= new CurlUtility();

$uAuth 			= new AuthUtility();



###############################################################################################



//declare vars

$typeM			= $utility->returnGetVar('typeM','');

$seo_url		= $utility->returnGetVar('seo_url','');



$content_id		= $utility->getValueByKey($seo_url, 'seo_url', 'static_id', 'static');

$contentDtl		= $stat->getStaticData($content_id);

?>

<?php

// Update Canonocal on 12/12/2014

 //$URL=$seo_url;



$pageCanonical = $contentDtl[24] ;

$metaTitle	=	$contentDtl[17] ;

$metaDesc	=	$contentDtl[19] ;

$metaKey	=	$contentDtl[18] ;



?>









<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Welcome to Alcoholies Anonymous Victoria</title>

<!--  importing stylesheet -->

<link rel="stylesheet" type="text/css" href="style/ansysoft.css"/>



<!--Navigation-->

 <link href="style/menu/resmenu.css" rel="stylesheet" type="text/css" />

 <script src="style/menu/resmenu.js" type="text/javascript"></script>



<!--  eof importing stylesheet -->

<?php

// Added on 18th december by Tistasoft

if($pageCanonical)



echo '<link rel="canonical" href="' . $pageCanonical . '">';



?>



<?php



if ($metaTitle)

{

echo '<meta name="title" content="'.$metaTitle.'" />'; 

}

?>



<?php

if($metaDesc)

{

echo '<meta name="description" content="'.$metaDesc.'" />';

}

?>



<?php

if($metaKey)

{

echo '<meta name="keywords" content="'.$metaKey.'"/>';

}

?>

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false"> </script>

<script src="js/jquery.ui.js"></script>

<script>

$(document).ready(function(){

	$('.dropdownBlock').css({

		display: 'none'

	});

	$(document).click(function(e){

		

		// Check if click was triggered on or within .fancyDropDown

		if( $(e.target).closest(".fancyDropDown").length > 0 ) {

			return false;

		}

		else if ($(e.target).closest(".fancyDropDown-medium").length > 0) {

			return false;

		}

		else if ($(e.target).closest(".fancyDropDown-small").length > 0) {

			return false;

		}

		else if ($(e.target).closest(".fancyDropDown-standard").length > 0) {

			return false;

		}

		

		else

		{				

			$(".dropdownList").css({

				display:'none'

			});

			$('.dropdownBlock').css({

				display: 'none'

			});

			$('.text-field-dropdown').attr('disabled', false);

		}

		// Otherwise

		// trigger your click function

	});/**/

	

	



	

	$('.dropdown-show').click(function(){

		$('.text-field-dropdown').attr('disabled', false);

		$('.dropdownBlock').css({

			display: 'none'

		});

		var dropdownId		= $(this).attr('id');

		var dropDownIndex	= dropdownId.slice(14);

		$('.text-field-dropdown-'+dropDownIndex).attr('disabled', true);

		$('#dropdownList-'+dropDownIndex).css({

			display:'block'

		});

		$('#dropdownBlock-' + dropDownIndex).css({

			display: 'block'

		});

		/*$('#dropdownList-'+dropDownIndex).slimScroll({

			width:'290',

			height:'30',

			railVisible: true,

			railColor: '#fff',

			wheelStep: 1

	  	});*/

		

		

		$('#dropdownList-1 li').click(function() {

			var id			= $(this).attr('id');

			//var countryId	= document.getElementById(id).value;

			//alert(document.getElementById(id).value);

			$('#provinceId').val($(this).text());

			//document.getElementById("txtProvinceId").value = document.getElementById(id).value;

			$('.text-field-dropdown').attr('disabled', false);

			$('.dropdownBlock').css({

				display: 'none'

			});

			$(this).parent().fadeOut(10);

			/*$(this).parent().css({

				display:'none'

			});*/

		});

		

		$('#dropdownList-2 li').click(function() {

			

			//var id			= $(this).attr('id');

			$('#day1').val($(this).text());

			//document.getElementById("txtProvinceId").value = document.getElementById(id).value;

			$('.text-field-dropdown').attr('disabled', false);

			$('.dropdownBlock').css({

				display: 'none'

			});

			$(this).parent().fadeOut(10);

			

			/*$(this).parent().css({

				display:'none'

			});*/

		});

		

		$('#dropdownList-3 li').click(function() {

			

			//var id			= $(this).attr('id');

			//var provinceId	= document.getElementById(id).value;

			//alert(document.getElementById(id).value);

			$('#time1').val($(this).text());

			//document.getElementById("txtProvinceId").value = document.getElementById(id).value;

			$('.text-field-dropdown').attr('disabled', false);

			$('.dropdownBlock').css({

				display: 'none'

			});

			$(this).parent().fadeOut(10);

			

			/*$(this).parent().css({

				display:'none'

			});*/

		});

		

		$('#dropdownList-4 li').click(function() {

			

			var id			= $(this).attr('id');

			//var provinceId	= document.getElementById(id).value;

			//alert(document.getElementById(id).value);

			$('#townId').val($(this).text());

			//document.getElementById("txtProvinceId").value = document.getElementById(id).value;

			$('.text-field-dropdown').attr('disabled', false);

			$('.dropdownBlock').css({

				display: 'none'

			});

			$(this).parent().fadeOut(10);

			

			/*$(this).parent().css({

				display:'none'

			});*/

		});

		

		$('#dropdownList-5 li').click(function() {

			

			//var id			= $(this).attr('id');

			//var provinceId	= document.getElementById(id).value;

			//alert(document.getElementById(id).value);

			$('#day2').val($(this).text());

			//document.getElementById("txtProvinceId").value = document.getElementById(id).value;

			$('.text-field-dropdown').attr('disabled', false);

			$('.dropdownBlock').css({

				display: 'none'

			});

			$(this).parent().fadeOut(10);

			

			/*$(this).parent().css({

				display:'none'

			});*/

		});

		

		$('#dropdownList-6 li').click(function() {

			

			//var id			= $(this).attr('id');

			//var provinceId	= document.getElementById(id).value;

			//alert(document.getElementById(id).value);

			$('#time2').val($(this).text());

			//document.getElementById("txtProvinceId").value = document.getElementById(id).value;

			$('.text-field-dropdown').attr('disabled', false);

			$('.dropdownBlock').css({

				display: 'none'

			});

			$(this).parent().fadeOut(10);

			

			/*$(this).parent().css({

				display:'none'

			});*/

		});

		

		$('#dropdownList-7 li').click(function() {

			

			//var id			= $(this).attr('id');

			//var provinceId	= document.getElementById(id).value;

			//alert(document.getElementById(id).value);

			$('#redius').val($(this).text());

			//document.getElementById("txtProvinceId").value = document.getElementById(id).value;

			$('.text-field-dropdown').attr('disabled', false);

			$('.dropdownBlock').css({

				display: 'none'

			});

			$(this).parent().fadeOut(10);

			

			/*$(this).parent().css({

				display:'none'

			});*/

		});

		

		$('#dropdownList-8 li').click(function() {

			

			//var id			= $(this).attr('id');

			//var provinceId	= document.getElementById(id).value;

			//alert(document.getElementById(id).value);

			$('#group1').val($(this).text());

			//document.getElementById("txtProvinceId").value = document.getElementById(id).value;

			$('.text-field-dropdown').attr('disabled', false);

			$('.dropdownBlock').css({

				display: 'none'

			});

			$(this).parent().fadeOut(10);

			

			/*$(this).parent().css({

				display:'none'

			});*/

		});

		

		$('#dropdownList-9 li').click(function() {

			

			//var id			= $(this).attr('id');

			//var provinceId	= document.getElementById(id).value;

			//alert(document.getElementById(id).value);

			$('#group2').val($(this).text());

			//document.getElementById("txtProvinceId").value = document.getElementById(id).value;

			$('.text-field-dropdown').attr('disabled', false);

			$('.dropdownBlock').css({

				display: 'none'

			});

			$(this).parent().fadeOut(10);

			

			/*$(this).parent().css({

				display:'none'

			});*/

		});

		

	});

});



$(document).ready(function(){

	$(".plus").click(function(){

		var id = $(this).attr('id');

		var idIndex = id.slice(13);

		$("#refine-search-sec-"+idIndex).css({

			display: 'block'

		});

		$("#hide-content-"+idIndex).css({

			display: 'none'

		});

		$("#show-content-"+idIndex).css({

			display: 'block'

		});

	});

	

	$(".minus").click(function(){

		var id = $(this).attr('id');

		var idIndex = id.slice(13);

		$("#refine-search-sec-"+idIndex).css({

			display: 'none'

		});

		$("#hide-content-"+idIndex).css({

			display: 'block'

		});

		$("#show-content-"+idIndex).css({

			display: 'none'

		});

	});

});



$(document).ready(function(){

	$(".vhist").click(function(){

		/*var id = $(this).attr('id');

		var idIndex = id.slice(13);

		$("#refine-search-sec-"+idIndex).css({

			display: 'block'

		});

		$("#hide-content-"+idIndex).css({

			display: 'none'

		});*/

		$("#vhist").css({

			display: 'block'

		});

	});

});





</script>



<script type="text/javascript" src="js/jquery.slimscroll.js"></script>

<script type="text/javascript" src="js/jQuery/jquery-1.10.1.js"></script>

<script type="text/javascript">

	$(document).ready(function () {

		$('#dropdownList-1,#dropdownList-4').slimScroll({

			width: '100%',

			height: '100',

			railVisible: true,

			railColor: '#308ebe',

			wheelStep: 1

		});

		

		$('#dropdownList-2, #dropdownList-3, #dropdownList-5, #dropdownList-6, #dropdownList-7').slimScroll({

			width: '100%',

			height: '100',

			railVisible: true,

			railColor: '#308ebe',

			wheelStep: 1

		});

	});

</script>		

<!--  eof scrollbar  -->

<!--  tool tips  -->

<script type="text/javascript" src="js/jquery.tooltipster.js"></script>

<script type="text/javascript">

	$(document).ready(function() {

		 $('.tooltip').tooltipster({

			 position: 'right'

		 });

	});

</script>

<!-- eof tool tips -->

</head>







<body id="home">



    <!-- Header-->

    <?php require_once('header.inc.php'); ?>

    <!-- eof Header-->

    <!-- Banner-->

    <?php require_once('inner-banner.inc.php'); ?>

    <!-- eof Banner-->

    <div class="cl"></div>

    <!-- Container  -->

    <div class="container">

    	

    	<!-- Main Body -->

        <div id="main-body">

        	

            <!-- Content Left -->

            <div id="content-left">

            	<div class="static-content"><!--static-content start -->

                    <h1 class="page-title"><?php echo $contentDtl[1] ?></h1>

                    <div class="cl"></div>

                    

                    <?php 

                    $downloadIds	= $stat->getContentDownloadId($content_id, 'static_id');

                    if(count($downloadIds) > 0)

                    {

                        $downloadDtl	= $stat->getContentDownloadData($downloadIds[0]);

                        if($downloadDtl[2] != 'bottom')

                        {

                            ?>

                            <div class="content-file">

                                <?php 

                                if(($downloadDtl[8] != '') && (file_exists("images/static/download/".$downloadDtl[8])))

                                {

                                    $fileLink		= "images/static/download/".$downloadDtl[8];

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

                                        <img src="images/icon/pdf.png" width="20" />

                                        <?php 

                                    }

                                    elseif(($fileType == 'docx') || ($fileType == 'doc'))

                                    {

                                        ?>

                                        <img src="images/icon/word.png" width="20" />

                                        <?php

                                    }

                                    else

                                    {

                                        ?>

                                        <img src="images/icon/text.png" width="20" />

                                        <?php

                                    }

                                    ?>

                                    <p><?php echo $downloadDtl[1] ?></p>

                                    <div class="cl"></div>

                                </a>

                            </div>

                            <div class="cl"></div>

                            <?php 

                        }

                    }

                    ?>

                    

                    <div class="brief"><?php echo $contentDtl[2] ?></div>

                    

                    <div class="desc">

                        <?php 

                        if($contentDtl[11] == 'left')

                        {

                            if(($contentDtl[4] != '') && (file_exists("images/static/".$contentDtl[4])))

                            {

                                ?>

                                <div class="content-imgL">

                                    <?php 

                                    echo $utility->imageDisplay2("images/static/", $contentDtl[4], 200, 200, 0, '', $contentDtl[1]);

                                    ?>

                                </div>

                                <?php 

                            }

                            echo $contentDtl[3];

                            ?>

                            <div class="cl"></div>

                            <?php 

                        }

                        elseif($contentDtl[11] == 'right')

                        {

                            if(($contentDtl[4] != '') && (file_exists("images/static/".$contentDtl[4])))

                            {

                                ?>

                                <div class="content-imgR">

                                    <?php 

                                    echo $utility->imageDisplay2("images/static/", $contentDtl[4], 200, 200, 0, '', $contentDtl[1]);

                                    ?>

                                </div>

                                <?php 

                            }

                            echo $contentDtl[3];

                            ?>

                            <div class="cl"></div>

                            <?php 

                        }

                        else

                        {

                            if(($contentDtl[4] != '') && (file_exists("images/static/".$contentDtl[4])))

                            {

                                ?>

                                <div class="marB20" align="center">

                                <?php 

                                echo $utility->imageDisplay2("images/static/", $contentDtl[4], 200, 200, 0, '', $contentDtl[1]);

                                ?>

                            </div>

                                <?php 

                            }

                            echo $contentDtl[3];

                            ?>

                            <div class="cl"></div>

                            <?php 

                        }

                        

                        ?>

                    </div>                    

                </div><!--static connect end-->

            </div>

            <!-- eof Content Left -->

                

            

        

            <!-- Content Right -->

            <div id="content-right">

                

                <div id="aa-member">

                    <h2>AA Member</h2>

                    

                    <div class="aa-content">

                        <h3>Find a meeting</h3>

                        <div class="aa-content-links">

                        	<ul>

                                <li><a class="main-links" href="index.php">Meeting search</a></li>

                                <li><a class="main-links" href="search-result.php">Browse meetings</a></li>

                                <li><a class="main-links" href="personal_meeting_view.php">My personal meeting list</a></li>

                                <li><a class="main-links" href="search-result.php">Build a list for printing</a></li>

                                <li><a class="main-links" href="javascript:void()">Online meetings</a></li>

                                <div class="cl"></div>

                            </ul> 

                        </div>

                        <h3>News and events</h3>

                        <div class="aa-content-links">

                        	<ul>

                        		<li><a class="main-links" href="javascript:void()">Latest news</a></li>

                            	<li><a class="main-links" href="javascript:void()">Coming events</a></li>

                                <div class="cl"></div>

                            </ul>    

                        </div>

                        <h3>Reference material</h3>

                        <div class="aa-content-links">

                        	<ul>

                        		<li><a class="main-links" href="/aavictoria/content.php?seo_url=term-conference-approved/">Conference Approved</a></li>

                            	<li><a class="main-links" href="/aavictoria/content.php?seo_url=terms-and-conditions/">Terms and Conditions</a></li>

                                <div class="cl"></div>

                        	</ul>

                        </div>

                        <h3>The AA legacies</h3>

                        <div class="aa-content-links">

                        	<ul>

                        		<li><a class="main-links" href="content.php?seo_url=the-12-steps-of-aa/">The 12 Steps</a></li>

                            	<li><a class="main-links" href="content.php?seo_url=the-twelve-traditions-of-alcoholics-anonymous/">The 12 Traditions</a></li>

                            	<li><a class="main-links" href="content.php?seo_url=12-concepts-for-world-service/">The 12 Concepts</a></li>

                                <div class="cl"></div>

                            </ul>    

                        </div>

                        <h3>Useful information</h3>

                        <div class="aa-content-links">

                        	<ul>

                        		<li><a class="main-links" href="javascript:void()">AA in Australia</a>

                                	<ul>

                                    	<li><a class="sub-links" href="javascript:void()">General Service Office</a></li>

                                        <li><a class="sub-links" href="javascript:void()">Structure</a></li>

                                        <li><a class="sub-links" href="javascript:void()">Membership</a></li>

                                        <li><a class="sub-links" href="javascript:void()">History</a></li>

                                        <li><a class="sub-links" href="javascript:void()">Links</a></li>

                                        <div class="cl"></div>

                                    </ul>

                                </li>

                            	<li><a class="main-links" href="javascript:void()">AA Overseas</a></li>

                            	<li><a class="main-links" href="javascript:void()">Fund-raising policy and contributions</a>

                                </li>

                                <li><a class="main-links" href="javascript:void()">AA Overseas</a></li>

                                <div class="cl"></div>

                            </ul>   

                        </div>

                        

                    </div>

                    

                </div>

               

                

            </div>

            <!-- eof Content Right -->

            

            <div class="cl"></div>

           

        </div>

        <!-- eof Main Body -->

        

        

        <!-- Footer-->

        <?php require_once('footer.inc.php'); ?>

        <!-- eof Footer-->

        

        <div class="cl"></div>

    </div>

    <!-- eof Container-->



</body>



</html>