<?php
$page = "Admin_Contact-details";
require_once dirname(__DIR__) ."/includes/constant.inc.php";
require_once ADM_DIR . "incs/global-inc.php";

require_once ROOT_DIR . "classes/encrypt.inc.php";

require_once ROOT_DIR . "classes/contact.class.php";
require_once ROOT_DIR . "classes/utility.class.php";

$Contact	= new Contact();
$Utility    = new Utility();

$Utility->setCurrentPageSession();

// ===================================================================== 

$numResDisplay	= (int)$Utility->returnGetVar('numResDisplay',10);

// $numVar			= "&numResDisplay=".$numResDisplay;
$noOfContacts	= $Contact->getAllContact('ALL');


/*START PAGINATION*/
//$total = count($noOfContacts);
$link			= "numResDisplay=".$numResDisplay;

/* pagination*/

$adjacents = 3;
$total_pages = count($noOfContacts);

/* Setup vars for query. */
$targetpage = $_SERVER['PHP_SELF']."?".$link; 	//your file name  (the name of this file)
$limit = 10;

if(isset($_GET['page'])){

	//how many items to show per page
	$page = $_GET['page'];

}else{
	$page = 1;

}

//echo $page;exit;

if($page){
	$start = ($page - 1) * $limit; 			//first item to display on this page
}else{
	$start = 0;								//if no page var is given, set start to 0
}	

	/* Get data. */

/*	$sql = "SELECT customer_id FROM $tbl_name LIMIT $start, $limit";

	$result = mysql_query($sql);*/

	//echo $sql.mysql_error();exit;

	/* Setup page vars for display. */

					//if no page var is given, default to 1.

$prev = $page - 1;							//previous page is page - 1
$next = $page + 1;							//next page is page + 1
$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
$lpm1 = $lastpage - 1;						//last page minus 1

/* 
	Now we apply our rules and draw the pagination object. 
	We're actually saving the code to a variable in case we want to draw it more than once.

*/

$pagination = "";
//echo $total_pages;exit;
if($lastpage > 1){	

	$pagination .= "<div class=\"pagination\">";

	//previous button

	if ($page > 1) 

		$pagination.= "<a href=\"$targetpage&page=$prev\" id='previous-button'>< previous</a>";

	else

		$pagination.= "<span class=\"disabled\">< previous</span>";	

	

	//pages	

	if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up

	{	

		for ($counter = 1; $counter <= $lastpage; $counter++)

		{

			if ($counter == $page)

				$pagination.= "<span class=\"current\">$counter</span>";

			else

				$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					

		}

	}elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
{

		//close to beginning; only hide later pages
		if($page < 1 + ($adjacents * 2)){

			for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)

			{

				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";				

			}

			$pagination.= "...";
			$pagination.= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
			$pagination.= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";		

		}

		//in middle; hide some front and some back

		elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)){

			$pagination.= "<a href=\"$targetpage&page=1\">1</a>";
			$pagination.= "<a href=\"$targetpage&page=2\">2</a>";
			$pagination.= "...";

			for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++){

				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					

			}

			$pagination.= "...";
			$pagination.= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
			$pagination.= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";		

		}
		//close to end; only hide early pages
		else{

			$pagination.= "<a href=\"$targetpage&page=1\">1</a>";
			$pagination.= "<a href=\"$targetpage&page=2\">2</a>";
			$pagination.= "...";

			for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++){

				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
			}
		}
	}

	//next button
	if ($page < $counter - 1) 
		$pagination.= "<a href=\"$targetpage&page=$next\" id='next-button'>next ></a>";
	else
		$pagination.= "<span class=\"disabled\" id='next-button-disabled'>next ></span>";
	$pagination.= "</div>\n";

}
/* eof pagination*/

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../images/logo/favicon.png" type="image/png">
    <title> Leelija - Contact Details </title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <link href="assets/css/soft-ui-dashboard.css.map" rel="stylesheet" />
    <link id="pagestyle" href="assets/css/soft-ui-dashboard.css" rel="stylesheet" />
    <link rel="stylesheet" href="../plugins/data-table/style.css">
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="g-sidenav-show  bg-gray-100">
    <?php require_once "partials/sidebar.php"; ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <?php require_once "partials/navbar.php"; ?>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Contact Details</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0 datatable">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder">
                                                SL.</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder">
                                                Name</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder ps-2">
                                                Email</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">
                                                Phone</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">
                                                Date</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($noOfContacts as $eachId) {
                                            $contDetail 	= $Contact->showContactInfo($eachId);
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm"><?= $contDetail->id ?></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm"><?= $contDetail->contact_name ?></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">
                                                    <?= $contDetail->contact_email ?></p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <?= $contDetail->contact_phone ?>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold"><?= $contDetail->added_on ?></span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span onclick="showContact(this)"
                                                    data-id="<?= url_enc($contDetail->id) ?>"
                                                    class="text-secondary font-weight-bold text-xs cursor-pointer"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-custom-class="custom-tooltip"
                                                    data-bs-title="This top tooltip is themed via CSS variables.">
                                                    <i class="fa-solid fa-eye pe-4"></i>
                                                </span>
                                                <span onclick="deleteRow(this, event)"
                                                    data-id="<?= url_enc($contDetail->id) ?>"
                                                    id="<?= url_enc($contDetail->id) ?>"
                                                    class="text-secondary font-weight-bold text-xs cursor-pointer"
                                                    data-toggle="tooltip" data-original-title="Delete Message">
                                                    <i class="fa-solid fa-trash"></i>
                                                </span>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php require_once ADM_DIR .'partials/bar-setting.php'; ?>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" style="line-height: 1;"><span id="modalLabel">...</span></h1>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    <span id="modalDate">...</span>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <p class="font-weight-bolder ">Email: <span class="text-sm" id="modalMail">...</span></p>
                        <p class="font-weight-bolder ">Phone: <span id="modalPhone">...</span></p>
                    </div>
                    <div class="border rounded p-2 m-2 " id="modalMessage">
                        ...
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Reply</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!--   Core JS Files   -->
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../plugins/data-table/simple-datatables.js"></script>
    <script src="../plugins/tinymce/tinymce.js"></script>
    <script src="<?= URL ?>plugins/main.js"></script>
    <script src="<?= URL ?>plugins/jquery-3.6.0.min.js"></script>
    <script src="<?= URL ?>js/ajax.js"></script>
    <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

    const deleteRow = (t, event) => {

        event.preventDefault();
        let encContactId = t.getAttribute('data-id');
        let fadeTarget = t.getAttribute('id');

        if (confirm('Do you want to delete?') == true) {

            $.ajax({
                url: "ajax/delete.ajax.php",
                type: "POST",
                data: {
                    contactMsgId: encContactId,
                },
                success: function(response) {
                    // console.log(response);
                    if (response.trim() == 'SU103') {
                        $(`#${fadeTarget}`).closest("tr").fadeOut();
                    } else {
                        alert(response)
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("Status: " + textStatus);
                    alert("Error: " + errorThrown);
                }
            });
        }

    }

    const showContact = (t) => {

        let encContactId = t.getAttribute('data-id');

        $.ajax({
            url: "ajax/contact-message-show.ajax.php",
            type: "POST",
            data: {
                contactMsgShowId: encContactId,
            },
            success: function(response) {
                response = JSON.parse(response);

                // response.id
                document.getElementById('modalLabel').innerText = response.contact_name;
                document.getElementById('modalMail').innerText = response.contact_email;
                document.getElementById('modalDate').innerText = response.added_on;
                document.getElementById('modalMessage').innerText = response.message;
                document.getElementById('modalPhone').innerText = response.contact_phone;

            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus);
                alert("Error: " + errorThrown);
            }
        });
    }
    </script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
</body>

</html>