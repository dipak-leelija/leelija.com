<?php
session_start();
//include_once('checkSession.php');
// require_once("_config/dbconnect.php");
require_once("_config/dbconnect.php");
require_once "_config/dbconnect.trait.php";

require_once("includes/constant.inc.php");
require_once("classes/date.class.php");
require_once("classes/error.class.php");
require_once("classes/search.class.php");
require_once("classes/customer.class.php");
require_once("classes/login.class.php");
require_once("classes/blog_mst.class.php");

//require_once("../classes/front_photo.class.php");
require_once("classes/blog_mst.class.php");
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
$blogMst		= new BlogMst();

//$ff				= new FrontPhoto();
$blogMst		= new BlogMst();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);
$cusDtl		= $customer->getCustomerData($cusId);
if($cusId == 0)
	{
		header("Location: index.php");
	}
if($cusDtl[0] == 1){ 
	header("Location: dashboard.php");
}
	
//echo $cusId;exit;
$blogDtls		= $blogMst->ShowBlogApprData();

?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
	<title> Guest posting Blogs List|  :: <?php echo COMPANY_S; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<meta name="keywords" content="Best guest post sites list, Blogs list, Paid posting sites list, Guest Posting services, best guest post services, best health guest posting sites, best fashion blog" />
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>

	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<!-- Custom CSS -->
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link href="css/form.css" rel='stylesheet' type='text/css' />
	<link href="css/custom.css" rel='stylesheet' type='text/css' />
	<link href="css/dashboard.css" rel='stylesheet' type='text/css' />
	<!-- font-awesome icons -->
	<link href="css/fontawesome-all.min.css" rel="stylesheet">
	<!-- //Custom Theme files -->
	<link href = "css/jquery-ui.css" rel = "stylesheet">
	<!-- //Custom Theme files -->
	<!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> 6/9/2019-->
	<link href="style/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
	<!--webfonts-->
	<!--//webfonts-->
	<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
	
	<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> 6/9/2019-->
	<script src="js/jquery.min.js" type="text/javascript"></script>
	<script src="js/ajax.js" type="text/javascript"></script>
	<script src='js/multifilter.js'></script>
	<script src="js/jquery.dataTables.columnFilter.js" type="text/javascript"></script>
	<script src="js/jquery.dataTables.yadcf.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>

	<link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Nunito+Sans:400,700,900" rel="stylesheet">
	<script src="js/blog-fav-list.js" type="text/javascript"></script>
	
	<script>
	$(document).ready(function(){
		$(".add-icon").click(function(){
			var id = $(this).attr('id');
			var idIndex = id.slice(10);
			//alert(idIndex);
			/*$("#refine-search-sec-"+idIndex).css({
				display: 'block'
			});*/
			
			$("#hideImage-"+idIndex).css({
				display: 'none'
			});
			$("#showImage-"+idIndex).css({
				display: 'block'
			});
		});
	
		$(".close-icon").click(function(){
			var id = $(this).attr('id');
			var idIndex = id.slice(10);
			/*$("#refine-search-sec-"+idIndex).css({
				display: 'none'
			});*/
			$("#hideImage-"+idIndex).css({
				display: 'block'
			});
			$("#showImage-"+idIndex).css({
				display: 'none'
			});
		});
	});




	$(document).ready(function(){
		$(".close-icon1").click(function(){
			var id = $(this).attr('id');
			var idIndex = id.slice(11);
			//alert(idIndex);
			/*$("#refine-search-sec-"+idIndex).css({
				display: 'block'
			});*/
			
			$("#hideImage1-"+idIndex).css({
				display: 'none'
			});
			$("#showImage1-"+idIndex).css({
				display: 'block'
			});
		});
	
		$(".add-icon1").click(function(){
			var id = $(this).attr('id');
			var idIndex = id.slice(11);
			//alert(idIndex);
			/*$("#refine-search-sec-"+idIndex).css({
				display: 'none'
			});*/
			$("#hideImage1-"+idIndex).css({
				display: 'block'
			});
			$("#showImage1-"+idIndex).css({
				display: 'none'
			});
		});
	});
	</script>	
	
</head>

<script>
 $(document).ready(function(){
     $('#examplew').dataTable()
		  .columnFilter({ 	sPlaceHolder: "head:before",
					aoColumns: [ 	


						]

		});
});
</script>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
	<div id="home">
		<!-- header -->
		<?php include('header.inc.php') ?>
		<!-- //header -->
		<!-- banner -->
		<div class="lists_of_blogs  montserrat-font py-4">
		<div class="container-fluid">
			<?php include('breadcrumb.inc.php') ?>
		</div>
		<div class="container-fluid">
		<div class="container-fluid display-table">
			<div class="row "><!--Row start-->
				<!--Sort and Search section start-->
				<div class="col-lg-3">
					<div class="list-group">
						<h3>DA</h3>
						<input type="hidden" id="hidden_minimum_da" value="0" />
						<input type="hidden" id="hidden_maximum_da" value="100" />
						<p id="da_show">1 - 100</p>
						<div id="da_range"></div>
					</div>
					<div class="list-group">
						<h3>TF</h3>
						<input type="hidden" id="hidden_minimum_tf" value="0" />
						<input type="hidden" id="hidden_maximum_tf" value="100" />
						<p id="tf_show">1 - 100</p>
						<div id="tf_range"></div>
					</div>
					<div class="list-group">
						<h3>Niches</h3>
						<div style="height: 380px; overflow-y: auto; overflow-x: hidden;">
							<?php
								$BlogMst  = $blogMst->ShowBlogNichMast();
								foreach($BlogMst as $row)
								{
								?>
								<div class="list-group-item checkbox">
									<label><input type="checkbox" class="common_selector niche" value="<?php echo $row['niche_name']; ?>"  > <?php echo $row['niche_name']; ?></label>
								</div>
								<?php
								}
							?>
						</div>
					</div>
				</div>
					<!--Sort and Search section end-->
					
				<div class="col-lg-9"><!--Content sec start-->
					<div id="AddRemoveMessage"></div>
					<br />
					<div id="boardsTable">
						<table id="examplew" class="table">
							<thead>
								<tr>
									<!--  <th>Sl. No.</th> -->
									<th>Domain</th>
									<th >Niche</th>
									<th class="dataTable_numeric">DA</th>
									<th class="dataTable_numeric">TF</th>
									<th>Link Type</th>
									<th>Prices($)</th>
									<th>Action</th>
								</tr>
							</thead>

							<tbody class="filter_data">
								<?php
									if(count($blogDtls) !=0){
									$sl = 1;
										foreach($blogDtls as $eachRecord)
											{
												//	$date=date_create($eachRecord['updated_on']);
												//	$moddate 	= date_format($date,"m/d/Y");
												$BlogFavDtls 	= $blogMst->showBlogFavList($cusId, $eachRecord['blog_id']);
												
								?>
												<tr align="left">
													<td style="width: 100px;font-weight:500;"><?php echo $eachRecord['domain'];?></td>
													<td><?php echo $eachRecord['niche'];?></td>
													<td class="text-center"><?php echo round($eachRecord['da']);?></td>
													<td class="text-center"><?php echo round($eachRecord['tf']);?></td>
													<td> <?php echo $eachRecord['follow'];?></td>
													<td >
														<?php echo $eachRecord['cost'];?>
													</td>
													<?php $_SESSION['blog_id']= $eachRecord['blog_id'];?>
													<td>
														<?php
														if(isset($_SESSION["PersonalList"]))
														{
															//echo $_SESSION['blog_id'];exit;
															$Add_Fav = 0;
															foreach ($_SESSION["PersonalList"] as $Add_Fav)
															{
																
																//exit;
															  if($eachRecord['blog_id'] == $Add_Fav["blog_id"])
																{
																		//echo $Add_Fav["blog_id"];
														?>
						
																	<a href="javascript:void()"  class="close-icon1 fa fa-times" style="color:blue"
																	  id="hideImage1-<?php  echo $_SESSION['blog_id'];?>"
																	 title="Remove this Blog to my Personal list"
																	 onclick="RemovePersonalList(<?php echo $eachRecord['blog_id']; ?>)"
																	  >
																	 </a>
																	 
																	 <a href="javascript:void()"  class="add-icon1 fa fa-plus" 
																	 id="showImage1-<?php  echo $_SESSION['blog_id'];?>"
																	 title="Add this Blog to my personal list"
																	 onclick="PersonalList(<?php echo $eachRecord['blog_id']; ?>)"
																	  >
																	 </a>
														<?php	
																}
															}	
																if($eachRecord['blog_id'] != $Add_Fav["blog_id"])
																{
														?>
																	<a href="javascript:void()"  class="add-icon fa fa-plus" 
																	 id="hideImage-<?php  echo $_SESSION['blog_id'];?>"
																	 title="Add this Blog to my personal list"
																	 onclick="PersonalList(<?php echo $eachRecord['blog_id']; ?>)"
																	  >
																	 </a>
																	 
																	<a href="javascript:void()"  class="close-icon fa fa-times" style="color:red"
																	  id="showImage-<?php  echo $_SESSION['blog_id'];?>"
																	 title="Remove this Blog to my Personal list"
																	 onclick="RemovePersonalList(<?php echo $eachRecord['blog_id']; ?>)"
																	  >
																	 </a>
																	 
														<?php	
																}	
															
														}else{	
														?>
														
																	<a href="javascript:void()"  class="add-icon fa fa-plus" 
																	 id="hideImage-<?php  echo $_SESSION['blog_id'];?>"
																	 title="Add this Blog to my personal list"
																	 onclick="PersonalList(<?php echo $eachRecord['blog_id']; ?>)"
																	  >
																	 </a>
																	 
																	<a href="javascript:void()"  class="close-icon fa fa-times" style="color:black"
																	  id="showImage-<?php  echo $_SESSION['blog_id'];?>"
																	 title="Remove this Blog to my Personal list"
																	 onclick="RemovePersonalList(<?php echo $eachRecord['blog_id']; ?>)"
																	  >
																	 </a>
														
														<?php
														}
														?>
													</td>
													
												</tr>

								<?php

												$sl++;
												}
									}
									else{

										}
								?>
							</tbody>
							<tfoot>
								<tr>
									<!--  <th>Sl. No.</th> -->
									<th>Domain</th>
									<th >Niche</th>
									<th class="dataTable_numeric">DA</th>
									<th class="dataTable_numeric">TF</th>
									<th>Link Type</th>
									<th>Prices($)</th>
									<th>Action</th>
								</tr>
							</tfoot> 

						</table>
					</div>

				</div><!--Content end start-->
			</div><!--Row end-->
		</div>



    <!-- Modal -->
    <div id="add_project" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header login-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Add Project</h4>
                </div>
                <div class="modal-body">
                            <input type="text" placeholder="Project Title" name="name">
                            <input type="text" placeholder="Post of Post" name="mail">
                            <input type="text" placeholder="Author" name="passsword">
                            <textarea placeholder="Desicrption"></textarea>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Close</button>
                    <button type="button" class="add-project" data-dismiss="modal">Save</button>
                </div>
            </div>

        </div>
    </div>
			</div>
		</div>
			<!-- //end container sec -->

		<!-- Footer -->
		<?php include('footer.inc.php') ?>
		<!-- /Footer -->
	</div>
	<!-- js-->
	<script src="js/jquery-2.2.3.min.js"></script>
	<!-- js-->
	<script src="js/jquery-ui.js"></script>
	<script src="js/cart.js"></script>
	<!--Start fetching DATA-->
	<script>
		$(document).ready(function(){

		filter_data();

		function filter_data()
		{
			$('.filter_data').html('<div id="loading" style="" ></div>');
			var action = 'fetch_data';
			var minimum_da = $('#hidden_minimum_da').val();
			var maximum_da = $('#hidden_maximum_da').val();
			var minimum_tf = $('#hidden_minimum_tf').val();
			var maximum_tf = $('#hidden_maximum_tf').val();
			var niche = get_filter('niche');
			$.ajax({
				url:"blog-list.inc.php",
				method:"POST",
				data:{action:action, minimum_da:minimum_da, maximum_da:maximum_da, minimum_tf:minimum_tf, maximum_tf:maximum_tf, niche:niche},
				success:function(data){
					
					$('.filter_data').html(data);
				}
			});
		}

		function get_filter(class_name)
		{
			var filter = [];
			$('.'+class_name+':checked').each(function(){
				filter.push($(this).val());
			});
			return filter;
		}

		$('.common_selector').click(function(){
			filter_data();
		});

		$('#da_range').slider({
			range:true,
			min:0,
			max:100,
			values:[1, 100],
			step:2,
			stop:function(event, ui)
			{
				$('#da_show').html(ui.values[0] + ' - ' + ui.values[1]);
				$('#hidden_minimum_da').val(ui.values[0]);
				$('#hidden_maximum_da').val(ui.values[1]);
				filter_data();
			}
		});
		$('#tf_range').slider({
			range:true,
			min:0,
			max:100,
			values:[1, 100],
			step:2,
			stop:function(event, ui)
			{
				$('#tf_show').html(ui.values[0] + ' - ' + ui.values[1]);
				$('#hidden_minimum_tf').val(ui.values[0]);
				$('#hidden_maximum_tf').val(ui.values[1]);
				filter_data();
			}
		});

		});
	</script>
	<!--end fetching DATA-->

	<!-- Scrolling Nav JavaScript -->
	<script src="js/scrolling-nav.js"></script>
	<!-- //fixed-scroll-nav-js -->
	<script>
		$(window).scroll(function () {
			if ($(document).scrollTop() > 70) {
				$('nav.pagescrollfix,nav.RWDpagescrollfix').addClass('shrink');
			} else {
				$('nav.pagescrollfix,nav.RWDpagescrollfix').removeClass('shrink');
			}
		});
	</script>

	<!-- Banner text Responsiveslides -->
	<script src="js/responsiveslides.min.js"></script>
	<script>
		// You can also use"$(window).load(function() {"
		$(function () {
			// Slideshow 4
			$("#slider3").responsiveSlides({
				auto: true,
				pager: true,
				nav: false,
				speed: 500,
				namespace: "callbacks",
				before: function () {
					$('.events').append("<li>before event fired.</li>");
				},
				after: function () {
					$('.events').append("<li>after event fired.</li>");
				}
			});

		});
	</script>
	<!-- //Banner text  Responsiveslides -->
	<!-- start-smooth-scrolling -->
	<script src="js/move-top.js"></script>
	<script src="js/easing.js"></script>
	<script>
		jQuery(document).ready(function ($) {
			$(".scroll").click(function (event) {
				event.preventDefault();

				$('html,body').animate({
					scrollTop: $(this.hash).offset().top
				}, 1000);
			});
		});
	</script>
	<!-- //end-smooth-scrolling -->
	<!-- smooth-scrolling-of-move-up -->
	<script>
		$(document).ready(function () {
			/*
			 var defaults = {
				 containerID: 'toTop', // fading element id
				 containerHoverID: 'toTopHover', // fading element hover id
				 scrollSpeed: 1200,
				 easingType: 'linear'
			 };
			 */

			$().UItoTop({
				easingType: 'easeOutQuart'
			});

		});
	</script>
	<!--Accordion setting*/	-->

	<script>
		var acc = document.getElementsByClassName("accordion");
		var i;

		for (i = 0; i < acc.length; i++) {
			acc[i].addEventListener("click", function() {
				this.classList.toggle("active");
				var panel = this.nextElementSibling;
				if (panel.style.display === "block") {
					panel.style.display = "none";
				} else {
					panel.style.display = "block";
				}
			});
		}
	</script>
	
	  <!-- DataTables -->
	<!--<script src="bootstrap/js/bootstrap.min.js"></script> 6/9/2019 -->
	<script src="plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

	<script>
	  $(function () {
		$("#examplew").DataTable();
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

	<!--<script src="bootstrap/js/bootstrap-editable.js" type="text/javascript"></script>-->
	<script src="js/SmoothScroll.min.js"></script>
	<!-- //smooth-scrolling-of-move-up -->
	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.js">
	</script>
	<!-- //Bootstrap Core JavaScript -->
	

</body>

</html>
