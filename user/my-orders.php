<?php
session_start();
require_once dirname(__DIR__)."/includes/constant.inc.php";

require_once ROOT_DIR."/_config/dbconnect.php";
require_once ROOT_DIR."/classes/encrypt.inc.php";

require_once ROOT_DIR."/classes/customer.class.php";
require_once ROOT_DIR."/classes/orderStatus.class.php";
require_once ROOT_DIR."/classes/order.class.php";
require_once ROOT_DIR."/classes/domain.class.php";
require_once ROOT_DIR."/classes/blog_mst.class.php";
require_once ROOT_DIR."/classes/utility.class.php";

/* INSTANTIATING CLASSES */
$customer		= new Customer();
$Order          = new Order();
$Domain         = new Domain();
$BlogMst		= new BlogMst();
$OrderStatus    = new OrderStatus();
$utility		= new Utility();
######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);
$cusDtl		= $customer->getCustomerData($cusId);
if($cusId == 0){
    header("Location: index.php");
}

if($cusDtl[0][0] == 2){
    header("Location: seller/dashboard.php");
}
// $gpPackagesOrd  = $Gporder->getOrderDetails($cusId);
$orders         = $Order->getOrdersByCusId($cusId);


?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
    <title>My Order :: <?php echo COMPANY_S; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="icon" href="images/logo/favicon.png" type="image/png">

    <!-- Bootstrap Core CSS -->
    <link href="<?= URL ?>plugins/bootstrap-5.2.0/css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="<?= URL ?>plugins/fontawesome-6.1.1/css/all.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->

    <link href="<?= URL ?>css/style.css" rel='stylesheet' type='text/css' />
    <link href="<?= URL ?>css/leelija.css" rel='stylesheet' type='text/css' />
    <link href="<?= URL ?>css/dashboard.css" rel='stylesheet' type='text/css' />
    <link href="<?= URL ?>css/my-orders.css" rel='stylesheet' type='text/css' />
    <link href="<?= URL ?>css/order-list.css" rel='stylesheet' type='text/css' />

    <!-- font-awesome icons -->
    <!-- <link href="css/fontawesome-all.min.css" rel="stylesheet"> -->

    <!-- Datatable CSS  -->
    <link href="<?= URL ?>plugins/data-table/style.css" rel="stylesheet">


    <!--//webfonts-->
    <link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900" rel="stylesheet">


</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <div id="home">
        <!-- header -->
        <?php  require_once ROOT_DIR."/partials/navbar.php" ?>
        <?php //include 'header-user-profile.php'?>

        <!-- //header -->
        <!-- banner -->
        <div class="edit_profile">
            <div class="container-fluid1">
                <div class=" display-table">
                    <div class="row ">
                        <!--Row start-->
                        <div class="col-md-3 hidden-xs display-table-cell v-align" id="navigation">

                            <div class="client_profile_dashboard_left">
                                <?php include ROOT_DIR."partials/dashboard-inc.php";?>
                                <hr>
                            </div>

                        </div>
                        <div class="col-md-9 mt-4  display-table-cell v-align client_profile_dashboard_right">

                            <!-- Product Order Show Section -->
                            <div class="row justify-content-evenly dashorder_row me-2">
                                <div class="bg-light mt-5">
                                    <h3 class="fw-bold text-center">My Orders:</h3>
                                </div>
                                <?php
                                if (count($orders) > 0 ) {
                                    foreach ($orders as $ordItem) {
                                        // print_r($ordItem);
                                ?>
                                <div class="card activeOrderDetails  item_order_bx">
                                    <?php
                                            $productId = $Order->getOrdDtlsByOrdId($ordItem['orders_id']);
                                            $item      = $Domain->showDomainsById($productId[0]['product_id']);
                                            
                                            $niche = $BlogMst->showBlogNichMst($item[1]);

                                            $ordStatusName = $OrderStatus->getOrdStatName($ordItem['orders_status_id']);

                                            $productQueryString = 'data='.url_enc($ordItem['orders_id']).'&pdata='.url_enc($productId[0]['product_id']);
        
                                    ?>
                                    <a href="my-product-order-view.php?<?php echo $productQueryString; ?>">
                                        <div class="status_bx">
                                            <div class="">
                                                <h4 class="text-dark"><?php echo $item[0];?></4>
                                                    <p class="niche_name"><small><?php echo $niche[0][1];?></small></p>
                                            </div>
                                            <div class="orderStatus <?php echo $ordStatusName; ?>">
                                                <p><?php echo $ordStatusName; ?></p>
                                            </div>
                                        </div>
                                        <div class="order_data">
                                            <table style="width: 100%;">
                                                <tr>
                                                    <td>Transection Id</td>
                                                    <td>:</td>
                                                    <td style="word-break: break-word;">
                                                        <?php echo $ordItem['orders_code'];?></td>
                                                </tr>
                                                <tr>
                                                    <td>Order Status</td>
                                                    <td>:</td>
                                                    <td><?php echo $ordItem['payment_status'];?></td>
                                                </tr>
                                                <tr>
                                                    <td>Date</td>
                                                    <td>:</td>
                                                    <td style="word-break: break-word;">
                                                        <?php echo $ordItem['date_purchased'];?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </a>
                                </div>
                                <?php
                                }
                            }
                            ?>
                            </div>
                            <!-- Product Order Show Section End -->




                        </div>
                        <!--Row end-->
                    </div>
                </div>
                <!-- //end display table-->
            </div>
        </div>
        <script src="<?= URL ?>plugins/bootstrap-5.2.0/js/bootstrap.js" type="text/javascript"></script>
        <script src="<?= URL ?>plugins/sweetalert/sweetalert2.all.min.js" type="text/javascript"></script>
        <script src="<?= URL ?>plugins/data-table/simple-datatables.js"></script>
        <script src="<?= URL ?>plugins/tinymce/tinymce.js"></script>
        <script src="<?= URL ?>plugins/main.js"></script>
        <script src="<?= URL ?>plugins/jquery-3.6.0.min.js"></script>
        <script src="<?= URL ?>js/customerSwitchMode.js"></script>

        <script>
        /* jQuery Pagination */

        (function($) {

            var paginate = {
                startPos: function(pageNumber, perPage) {
                    // determine what array position to start from
                    // based on current page and # per page
                    return pageNumber * perPage;
                },

                getPage: function(items, startPos, perPage) {
                    // declare an empty array to hold our page items
                    var page = [];

                    // only get items after the starting position
                    items = items.slice(startPos, items.length);

                    // loop remaining items until max per page
                    for (var i = 0; i < perPage; i++) {
                        page.push(items[i]);
                    }

                    return page;
                },

                totalPages: function(items, perPage) {
                    // determine total number of pages
                    return Math.ceil(items.length / perPage);
                },

                createBtns: function(totalPages, currentPage) {
                    // create buttons to manipulate current page
                    var pagination = $('<div class="pagination" />');

                    // add a "first" button
                    pagination.append('<span class="pagination-button">&laquo;</span>');

                    // add pages inbetween
                    for (var i = 1; i <= totalPages; i++) {
                        // truncate list when too large
                        if (totalPages > 5 && currentPage !== i) {
                            // if on first two pages
                            if (currentPage === 1 || currentPage === 2) {
                                // show first 5 pages
                                if (i > 5) continue;
                                // if on last two pages
                            } else if (currentPage === totalPages || currentPage === totalPages - 1) {
                                // show last 5 pages
                                if (i < totalPages - 4) continue;
                                // otherwise show 5 pages w/ current in middle
                            } else {
                                if (i < currentPage - 2 || i > currentPage + 2) {
                                    continue;
                                }
                            }
                        }

                        // markup for page button
                        var pageBtn = $('<span class="pagination-button page-num" />');

                        // add active class for current page
                        if (i == currentPage) {
                            pageBtn.addClass('active');
                        }

                        // set text to the page number
                        pageBtn.text(i);

                        // add button to the container
                        pagination.append(pageBtn);
                    }

                    // add a "last" button
                    pagination.append($('<span class="pagination-button">&raquo;</span>'));

                    return pagination;
                },

                createPage: function(items, currentPage, perPage) {
                    // remove pagination from the page
                    $('.pagination').remove();

                    // set context for the items
                    var container = items.parent(),
                        // detach items from the page and cast as array
                        items = items.detach().toArray(),
                        // get start position and select items for page
                        startPos = this.startPos(currentPage - 1, perPage),
                        page = this.getPage(items, startPos, perPage);

                    // loop items and readd to page
                    $.each(page, function() {
                        // prevent empty items that return as Window
                        if (this.window === undefined) {
                            container.append($(this));
                        }
                    });

                    // prep pagination buttons and add to page
                    var totalPages = this.totalPages(items, perPage),
                        pageButtons = this.createBtns(totalPages, currentPage);

                    container.after(pageButtons);
                }
            };

            // stuff it all into a jQuery method!
            $.fn.paginate = function(perPage) {
                var items = $(this);

                // default perPage to 5
                if (isNaN(perPage) || perPage === undefined) {
                    perPage = 5;
                }

                // don't fire if fewer items than perPage
                if (items.length <= perPage) {
                    return true;
                }

                // ensure items stay in the same DOM position
                if (items.length !== items.parent()[0].children.length) {
                    items.wrapAll('<div class="pagination-items" />');
                }

                // paginate the items starting at page 1
                paginate.createPage(items, 1, perPage);

                // handle click events on the buttons
                $(document).on('click', '.pagination-button', function(e) {
                    // get current page from active button
                    var currentPage = parseInt($('.pagination-button.active').text(), 10),
                        newPage = currentPage,
                        totalPages = paginate.totalPages(items, perPage),
                        target = $(e.target);

                    // get numbered page
                    newPage = parseInt(target.text(), 10);
                    var i = currentPage;
                    i <= totalPages;
                    i++;
                    if (target.text() == '»') newPage = i++;
                    i--;
                    if (target.text() == '«') newPage = --i;

                    // ensure newPage is in available range
                    if (newPage > 0 && newPage <= totalPages) {
                        paginate.createPage(items, newPage, perPage);
                    }
                });
            };

        })(jQuery);

        /* This part is just for the demo,
        not actually part of the plugin */
        $('.item_order_bx').paginate(6);
        </script>

</body>

</html>