<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
session_start();

// var_dump($_SESSION);
require_once("../_config/dbconnect.php");
require_once "../_config/dbconnect.trait.php";


require_once "../classes/customer.class.php";
require_once "../classes/gp-order.class.php";
require_once "../classes/orderStatus.class.php";
require_once "../classes/order.class.php";
require_once "../classes/domain.class.php";
require_once "../classes/blog_mst.class.php";
require_once "../classes/utility.class.php";

/* INSTANTIATING CLASSES */
$customer		= new Customer();
$Gporder        = new Gporder();
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
    header("Location: ../index.php");
}

if($cusDtl[0] == 1){
    header("Location: ../dashboard.php");
}
$gpPackagesOrd  = $Gporder->getOrderDetails($cusId);
$orders         = $Order->getOrdersByCusId($cusId);


?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
    <!-- Bootstrap Core CSS -->
    <link href="../plugins/bootstrap-5.2.0/css/bootstrap.css" rel='stylesheet' type='text/css' />

    <link href="../css/style.css" rel='stylesheet' type='text/css' />
    <link href="../css/dashboard.css" rel='stylesheet' type='text/css' />
    <link href="../css/my-orders.css" rel='stylesheet' type='text/css' />
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">


    <!-- Product Order Show Section -->
    <div class="row justify-content-evenly dashorder_row me-2">
        <!-- <div class="bg-light mt-5">
            <h3 class="fw-bold text-center">Item Orders:</h3>
        </div> -->
        <?php
                                if (count($orders) > 0 ) {
                                    foreach ($orders as $ordItem) {
                                        // print_r($ordItem);
                                ?>
        <div class="card activeOrderDetails item_order_bx">
            <div class="status_bx">
                <div class="">
                    <?php
                                            $productId = $Order->getOrdDtlsByOrdId($ordItem['orders_id']);
                                            $item      = $Domain->showDomains($productId[0]['product_id']);
                                            
                                            $niche = $BlogMst->showBlogNichMst($item[1]);
        
                                            ?>
                    <h4><?php echo $item[0];?></4>
                        <p class="niche_name"><small><?php echo $niche[0][1];?></small></p>
                </div>
                <div class="orderStatus">
                    <p><?php echo $ordItem['payment_status']; ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <p><span class="indivisualDetails">Transection Id </span></p>
                    <p><span class="indivisualDetails">Order Status </span></p>
                    <p><span class="indivisualDetails">Date </span></p>
                </div>
                <div class="col-1">
                    <p>:</p>
                    <p>:</p>
                    <p>:</p>
                </div>

                <div class="col-sm-6">
                    <p><span class="indivisualRes"> <?php echo $ordItem['orders_code'];?></span>
                    </p>
                    <p><span class="indivisualRes">
                            <?php echo $ordItem['orders_status_id'];?></span></p>
                    <p><span class="indivisualRes">
                            <?php echo $ordItem['date_purchased'];?></span></p>
                </div>
            </div>
        </div>
        <?php
                                }
                            }
                            ?>
    </div>
    <!-- Product Order Show Section End -->
    <script src="../plugins/jquery-3.6.0.min.js"></script>
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
                if (target.text() == '«') newPage = 1;
                if (target.text() == '»') newPage = totalPages;

                // ensure newPage is in available range
                if (newPage > 0 && newPage <= totalPages) {
                    paginate.createPage(items, newPage, perPage);
                }
            });
        };

    })(jQuery);

    /* This part is just for the demo,
    not actually part of the plugin */
    $('.item_order_bx').paginate(2);
    </script>

</body>

</html>