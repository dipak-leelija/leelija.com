<?php
session_start();
$page = "Admin_orders";
require_once dirname(__DIR__)."/includes/constant.inc.php";

require_once ROOT_DIR."includes/order-constant.inc.php";
require_once ROOT_DIR."_config/dbconnect.php";
require_once ROOT_DIR."classes/encrypt.inc.php";

require_once ROOT_DIR."classes/date.class.php";
require_once ROOT_DIR."classes/error.class.php";
require_once ROOT_DIR."classes/search.class.php";
require_once ROOT_DIR."classes/customer.class.php";
require_once ROOT_DIR."classes/orderStatus.class.php";
require_once ROOT_DIR."classes/login.class.php";
require_once ROOT_DIR."classes/domain.class.php";
require_once ROOT_DIR."classes/niche.class.php";
require_once ROOT_DIR."classes/order.class.php";
require_once ROOT_DIR."classes/orderStatus.class.php";
require_once ROOT_DIR."classes/utility.class.php";


/* INSTANTIATING CLASSES */
$dateUtil      	= new DateUtil();
$error 			= new Error();
$search_obj		= new Search();
$customer		= new Customer();
$OrderStatus    = new OrderStatus();
$logIn			= new Login();
$Domain			= new Domain();
$Niche          = new Niche();
$OrderStatus    = new OrderStatus();

$utility		= new Utility();
$Order          = new Order();
######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);
$cusDtl		= $customer->getCustomerData($cusId);

// print_r($cusDtl);exit;

if($cusId == 0){
	header("Location: index.php");
}

if($cusDtl[0][0] == 1){
	header("Location: app.client.php");
}
if (!isset($_GET['data']) || !isset($_GET['pdata'])) {
    // header("")
    echo 'Get Request Failed';
    exit; 
}
$ordId  =  url_dec($_GET['data']) ;
$prodId =  url_dec($_GET['pdata']) ;



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">

    <!-- Title -->
    <title><?php echo COMPANY_FULL_NAME; ?>: Orders</title>
    <link rel="shortcut icon" href="<?= FAVCON_PATH ?>" />

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/fontawesome-6.1.1/css/all.min.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/pace/pace.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/highlight/styles/github-gist.css" rel="stylesheet">


    <!-- Theme Styles -->
    <link href="<?= URL ?>assets/portal-assets/css/main.min.css" rel="stylesheet">
    <!-- <link href="<?= URL ?>css/order-table.css" rel="stylesheet"> -->

    <style>
    .client_profile_dashboard_right {
        padding-right: 2rem !important;
    }

    .product_image_sec_right {
        text-align: center;
    }

    .product_image {
        object-fit: cover;
        width: 60%;
        border: 1px solid blue;
        border-radius: 0.4rem;
        /* border-radius: 10rem; */
        image-rendering: pixelated;
    }

    .info-styling-mine {
        background: cornflowerblue;
        font-size: 20px;
        color: white;
        font-weight: 500;
        border: 3px solid white;
        text-align: center;
        padding: 4px 9px;
        border-radius: 0.4rem;
    }

    .info-styling-mine:hover {
        background: #487ad3;
    }

    @media (max-width:767px) {
        .client_profile_dashboard_right {
            padding-right: 3rem !important;
        }

        .product_image {
            width: 60%;
        }

        .product_image_sec_right {
            margin: 2rem;
        }
    }
    </style>
</head>

<body>
    <div class="app align-content-stretch d-flex flex-wrap">
        <?php require_once ROOT_DIR."components/sidebar.php"; ?>
        <!-- sidebar ends -->
        <div class="app-container">
            <!-- navbar header starts -->
            <?php require_once ROOT_DIR."components/navbar.php"; ?>
            <!-- navbar header ends -->
            <div class="app-content">
                <div class="content-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <div class="card page-description">
                                    <h2>Products</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">


                                        <!-- =============================================================== -->


                                        <!-- Products Order Start -->
                                        <section class="my-gp-order">
                                            <div class="p-kage-de-tails">
                                            <?php
                                            $orderedData = $Order->getFullOrderDetailsById($ordId);
                                            if ($prodId == $orderedData['product_id']) {
                                                $OrdrdProduct = $Domain->showDomainsById($prodId);
                                                if ($OrdrdProduct > 0) {

                                                $deliveryDtls = $Order->deliveryDtlsByOrdId($orderedData['orders_id']);
                                                $paymentStatusname = $OrderStatus->getOrdStatName($orderedData['payment_status']);
                                        
                                    ?>
                                                <div class="row">
                                                    <div class="col-md-8">

                                                        <!-- Details section Start  -->
                                                        <div class="">
                                                            <div>
                                                                <p class="niche_name">
                                                                    <?php
                                                        $niche = $Niche->showBlogNichMst($OrdrdProduct['niche']);
                                                        echo $niche[0][1]; // niche name
                                                        ?>
                                                                </p>
                                                            </div>

                                                            <!-- Order Details Start -->
                                                            <h2
                                                                class="align-items-center d-flex justify-content-normal text-capitalize">
                                                                <?php echo $OrdrdProduct['domain']; ?>
                                                                <span
                                                                    class="badge rounded-pill bg-warning text-dark ms-2 fw-normal"
                                                                    style="font-size: .75rem;">
                                                                    <?php echo $OrderStatus->getOrdStatName($orderedData['orders_status_id']) ?>
                                                                </span>
                                                                </h1>


                                                                <table class="ordered-details-table-css "
                                                                    style="width: 100%;">
                                                                    <tr>
                                                                        <td>Order Id</td>
                                                                        <td>:</td>
                                                                        <td style="word-break: break-word;">
                                                                            <?= "#".$orderedData['orders_code']; ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Price</td>
                                                                        <td>:</td>
                                                                        <td><?=  CURRENCY.$orderedData['orders_amount']; ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Payment Status</td>
                                                                        <td>:</td>
                                                                        <td><?= $paymentStatusname; ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Date</td>
                                                                        <td>:</td>
                                                                        <td><?php echo $dateUtil->fullDateTimeText($orderedData['added_on']); ?>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                        </div>
                                                        <!-- Details section End -->

                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="product_image_sec_right">
                                                            <img class="product_image"
                                                                src="<?= URL ?>images/domains/eno_fruit_salt_powder_orange_flavour_5_gm_0-5455PB4.jpg"
                                                                alt="">
                                                            <!-- <img class="product_image"
                                                    src="<?= URL ?>images/domains/<?php echo $OrdrdProduct[10]?>" alt=""> -->
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- actions Section start -->
                                                <?php require_once SELLER_PATH."components/order-process.inc.php" ?>
                                                <!-- actions Section end -->

                                                <?php
                                    }
                                }

                                ?>
                                            </div>
                                        </section>
                                        <!-- Products Order End -->



                                        <!-- ===================================================================================== -->
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="editContent">
                    <!-- Edit Contents Goes Here  -->
                    <div class="mb-3">
                        <label for="editInp" class="form-label">Email address</label>
                        <input type="text" class="form-control" id="editInp">
                        <input type="hidden" class="form-control" id="inpCol">
                    </div>
                    <div class="mb-3 text-center">
                        <button class="btn btn-primary btn-sm" id="updateBtn"
                            onclick="update(<?php echo $orderedData['orders_id']; ?>, 'inpCol', 'editInp')">Update</button>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="tost" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="<?= URL ?>images/icons/tick.png" class="rounded me-2" alt="...">
                <strong id="toast-heading" class="me-auto">Text Copied!</strong>
                <small id="toast-time" class="text-muted toast-time">just now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div id="toast-msg" class="toast-body">
                See? Just like this.
            </div>
        </div>
    </div>


    <script>
    const acceptProductOrder = () => {

        Swal.fire({
            title: 'Are you sure?',
            text: "You want to accept this order!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Accept'
        }).then((result) => {
            if (result.isConfirmed) {

                let urlString = window.location.href;
                let paramString = urlString.split('?')[1];
                let queryString = new URLSearchParams(paramString);
                for (let pair of queryString.entries()) {
                    if (pair[0] = 'data') {
                        orderId = pair[1];
                        break;
                    }
                }

                var action = 'accept-order';
                var orderId = orderId;
                $.ajax({
                    url: "ajax/accept-product-order.ajax.php",
                    method: "POST",
                    data: {
                        action: action,
                        orderId: orderId
                    },
                    success: function(data) {
                        // alert(data);
                        if (data.includes('accepted')) {

                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Order Accepted Succesfully!',
                                showConfirmButton: false,
                                timer: 1500
                            }).then((result) => {
                                location.reload();
                            });

                        }
                    }
                });

            }
        })
    }

    const rejectProductOrder = () => {

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })
    }

    const copyText = (fieldId, btnId) => {

        var text = document.getElementById(fieldId);
        text.select();
        document.execCommand('copy');

        const toastTrigger = document.getElementById(btnId);
        const toastLiveExample = document.getElementById('tost');

        toastLiveExample.classList.add("text-bg-primary");
        document.getElementById("toast-time").innerText = new Date(new Date().getTime()).toLocaleTimeString();
        document.getElementById("toast-heading").innerText = `Text Copied!`;
        document.getElementById("toast-msg").innerHTML = `<b>${text.value}</b><br> Copied to Clipboard`;

        const toast = new bootstrap.Toast(toastLiveExample)

        toast.show()
    }


    const sendData = (ordrId) => {

        sec = document.getElementById('sendDataSection');
        allinp = sec.querySelectorAll('input');
        console.log(allinp);
        allSelect = sec.querySelectorAll('select');


        for (let i = 0; i < allinp.length; i++) {
            const element = allinp[i];
            // alert(element.value)
            if (element.value == '') {
                element.style.border = "2px solid red";
                alert("Data Can Not Be Blank!");
                return false;
                break;
            } else {
                element.style.border = "1px solid #0673BA5c";
                if (element.id == 'drive-url') {
                    // alert('Url Box');
                    let url;
                    try {
                        url = new URL(element.value);
                        element.style.border = "1px solid #0673BA5c";
                    } catch (_) {
                        alert("Invalid Url Provided")
                        element.style.border = "2px solid red";
                        return false;
                    }
                }
            }
        } //end of for loop

        for (let i = 0; i < allSelect.length; i++) {
            const selectElement = allSelect[i];
            // alert(element.value)
            if (selectElement.value == '') {
                selectElement.style.border = "2px solid red";
                alert("Data Can Not Be Blank!");
                return false;
                break;
            } else {
                selectElement.style.border = "1px solid #0673BA5c";
            }
        } //end of for loop


        domainAuthCode = allinp[0].value;
        websiteFile = allinp[1].value;
        dbFile = allinp[2].value;
        // dbName = allinp[3].value;
        // dbUser = allinp[4].value;
        // dbPass = allinp[5].value;

        waitingTime = allSelect[0].value;

        var action = 'sendData';
        $.ajax({
            url: "ajax/send-order-data.php",
            method: "POST",
            data: {
                action: action,
                ordrId: ordrId,
                domainAuthCode: domainAuthCode,
                websiteFile: websiteFile,
                dbFile: dbFile,
                // dbName: dbName,
                // dbUser: dbUser,
                // dbPass: dbPass,
                waitingTime: waitingTime
            },
            success: function(data) {
                console.log(data);
                if (data.includes('updated')) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Details Submited!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {
                        location.reload();
                    });
                } else {

                    const toastTrigger = document.getElementById(data);
                    const toastLiveExample = document.getElementById('tost');

                    toastLiveExample.classList.add("text-bg-danger");
                    document.getElementById("toast-time").innerText = new Date(new Date().getTime())
                        .toLocaleTimeString();
                    document.getElementById("toast-heading").innerText = `Failed to Update!`;
                    document.getElementById("toast-msg").innerHTML =
                        `<b>Something is wrong!</b><br> Details can not updated!`;

                    const toast = new bootstrap.Toast(toastLiveExample)

                    toast.show()

                }
            }
        });

    } // sendData



    const editSingleData = (tagId, columnName) => {

        let columnValue = document.getElementById(tagId).innerText;

        document.getElementById('editInp').value = columnValue.trim();
        document.getElementById('inpCol').value = columnName.trim();

    }


    const update = (orderId, columnNameId, columnValueId) => {

        let colName = document.getElementById(columnNameId).value.trim();
        let colValue = document.getElementById(columnValueId).value.trim();


        if (colName == 'website_file_link') {

            if (colValue == '') {
                alert("File Url Can Not Be Blank!");
                return false;
            } else {
                let url;
                try {
                    url = new URL(colValue);
                } catch (_) {
                    alert("Invalid Url Provided")
                    return false;
                }
            }

        }



        var action = 'updateSingleData';
        $.ajax({
            url: "ajax/update-products-delivery.php",
            method: "POST",
            data: {
                action: action,
                orderId: orderId,
                colName: colName,
                colValue: colValue
            },
            success: function(data) {
                // alert(data);
                if (data.includes('updated')) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Details Updated!',
                        showConfirmButton: false,
                        timer: 1500

                        // const toastTrigger = document.getElementById(data);
                        // const toastLiveExample = document.getElementById('tost');

                        // document.getElementById("toast-time").innerText = new Date(
                        //     new Date().getTime()).toLocaleTimeString();
                        // document.getElementById("toast-heading").innerText = `Success!`;
                        // document.getElementById("toast-msg").innerHTML =
                        //     `<b>Request Data Updated!</b>`;

                        // const toast = new bootstrap.Toast(toastLiveExample)

                        // toast.show();
                    }).then((result) => {
                        location.reload();
                    });
                }
            }
        });


    }
    </script>
    <script src="<?= URL ?>plugins/sweetalert/sweetalert2.all.js"></script>
    <script src="<?= URL ?>plugins/jquery-3.6.0.min.js"></script>
    <!-- Switch Customer Type -->
    <script src="<?= URL ?>js/customerSwitchMode.js"></script>


    <!-- Javascripts -->
    <!-- <script src="<?= URL ?>assets/portal-assets/plugins/jquery/jquery-3.5.1.min.js"></script> -->
    <script src="<?= URL ?>assets/portal-assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/pace/pace.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/highlight/highlight.pack.js"></script>
    <script src="<?= URL ?>assets/portal-assets/js/main.min.js"></script>

    <script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    </script>


</body>

</html>