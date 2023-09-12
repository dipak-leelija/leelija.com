<?php
session_start();
$page = "Admin_my-blogs";
require_once dirname(__DIR__)."/includes/constant.inc.php";
require_once ROOT_DIR."_config/dbconnect.php";
require_once ROOT_DIR."classes/date.class.php";
require_once ROOT_DIR."classes/error.class.php";
require_once ROOT_DIR."classes/search.class.php";
require_once ROOT_DIR."classes/customer.class.php";
require_once ROOT_DIR."classes/login.class.php";

//require_once("../classes/front_photo.class.php");
require_once ROOT_DIR."classes/niche.class.php";
require_once ROOT_DIR."classes/domain.class.php";
require_once ROOT_DIR."classes/utility.class.php";
require_once ROOT_DIR."classes/utilityMesg.class.php";
require_once ROOT_DIR."classes/utilityImage.class.php";
require_once ROOT_DIR."classes/utilityNum.class.php";

/* INSTANTIATING CLASSES */
$dateUtil      	= new DateUtil();
$error 			= new Error();
$search_obj		= new Search();
$customer		= new Customer();
$logIn			= new Login();

//$ff				= new FrontPhoto();
$Niche		    = new Niche();
$domain			= new Domain();
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
$domainDtls		= $domain->ShowUserDomainData($cusDtl[0][2]);
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
    <title><?php echo COMPANY_FULL_NAME; ?>: Web Products Or Blogs</title>
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
    <link href="<?= URL ?>assets/portal-assets/plugins/datatables/datatables.min.css" rel="stylesheet">


    <!-- Theme Styles -->
    <link href="<?= URL ?>assets/portal-assets/css/main.min.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/css/myblogs.css" rel="stylesheet">
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
                                    <h2>Web Products Or Blogs <i class="fa-solid fa-blog fa-shake"></i></h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card  px-3 py-5">
                                    <section class="gallery">
                                        <!-- row start -->
                                        <div class="row gallery-items">
                                            <!-- col start -->
                                            <?php
					                               if ($domainDtls != NULL) {
						                            foreach($domainDtls as $eachRecord){
								                    $nicheDtls	 	= $Niche->showBlogNichMst($eachRecord['niche']);
						                          ?>
                                            <div class="item col-12 col-sm-6 col-md-4">

                                                <div class="wrapping_div-blogcard">
                                                    <div class="product-img">
                                                        <img src="<?= URL?>images/domains/<?= $eachRecord['dimage']?>">
                                                    </div>
                                                    <div class="product-info">
                                                        <div class="product-text">
                                                            <h1><i
                                                                    class="fa fa-angle-double-right"></i><?php echo $nicheDtls[0][1];?>
                                                            </h1>
                                                            <h2><a href="domain/<?php echo $eachRecord['seo_url'];?>">
                                                                    <h2 class="prodName-Sec">
                                                                        <?php echo $eachRecord['durl'];?>
                                                                    </h2>
                                                                </a></h2>
                                                            <div class="py-1">
                                                                <p><i class="fas fa-long-arrow-alt-right"></i>
                                                                    Domain Authority:<span
                                                                        class="float-right"><?php echo $eachRecord['da'];?></span>
                                                                </p>
                                                                <p><i class="fas fa-long-arrow-alt-right"></i>
                                                                    Page Authority: <span
                                                                        class="float-right"><?php echo $eachRecord['pa'];?></span>
                                                                </p>
                                                                <p><i class="fas fa-long-arrow-alt-right"></i>
                                                                    Alexa Traffic:<span
                                                                        class="float-right"><?php echo $eachRecord['alexa_traffic'];?>
                                                                    </span>
                                                                </p>
                                                                <p><i class="fas fa-long-arrow-alt-right"></i>
                                                                    Organic Traffic:<span class="float-right">
                                                                        <?php echo $eachRecord['organic_traffic'];?></span>
                                                                </p>
                                                                <p><i class="fas fa-long-arrow-alt-right"></i> Price
                                                                    <span
                                                                        class="float-right">$<?php echo $eachRecord['price'];?></span>
                                                                </p>
                                                            </div>

                                                        </div>
                                                        <div class="product-price-btn">
                                                            <button type="button">View Details</button>
                                                            <button type="button">Edit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
							                          }
						                             }
						                            ?>
                                        </div>
                                        <!-- row end -->
                                        <div class="d-flex justify-content-end mt-3">
                                            <nav aria-label="Page navigation">
                                                <ul class="pagination">
                                                    <li class="prev page-item"><a class="page-link"
                                                            href="#">Previous</a>
                                                    </li>
                                                    <!-- <div id="pageNums"> -->
                                                    <li class="page page-item">
                                                        <a class="page-link"> <span class="page-num"></a>
                                                    </li>
                                                    <!-- </div> -->
                                                    <li class="next page-item"><a class="page-link" href="#">Next</a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </section>
                                </div>

                            </div>
                        </div>
                        <!-- main row end -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Javascripts -->
        <script src="<?= URL ?>assets/portal-assets/plugins/jquery/jquery-3.5.1.min.js"></script>
        <script src="<?= URL ?>assets/portal-assets/plugins/bootstrap/js/popper.min.js"></script>
        <script src="<?= URL ?>assets/portal-assets/plugins/bootstrap/js/bootstrap.min.js"></script>

        <!-- <script src="<?= URL ?>assets/portal-assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->

        <script src="<?= URL ?>assets/portal-assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
        <script src="<?= URL ?>assets/portal-assets/plugins/pace/pace.min.js"></script>
        <script src="<?= URL ?>assets/portal-assets/plugins/highlight/highlight.pack.js"></script>
        <script src="<?= URL ?>assets/portal-assets/plugins/datatables/datatables.min.js"></script>
        <script src="<?= URL ?>assets/portal-assets/js/main.min.js"></script>
        <script src="<?= URL ?>assets/portal-assets/js/pages/datatables.js"></script>

        <!-- <script>
    /* jQuery Pagination */
    (function($) {

        var paginate = {
            startPos: function(pageNumber, perPage) {

                return pageNumber * perPage;
            },

            getPage: function(items, startPos, perPage) {

                var page = [];


                items = items.slice(startPos, items.length);


                for (var i = 0; i < perPage; i++) {
                    page.push(items[i]);
                }

                return page;
            },

            totalPages: function(items, perPage) {

                return Math.ceil(items.length / perPage);
            },

            createBtns: function(totalPages, currentPage) {

                var pagination = $('<div class="custom_pagination" />');


                pagination.append('<span class="custom_pagination-button">&laquo;</span>');


                for (var i = 1; i <= totalPages; i++) {

                    if (totalPages > 5 && currentPage !== i) {

                        if (currentPage === 1 || currentPage === 2) {

                            if (i > 5) continue;

                        } else if (currentPage === totalPages || currentPage === totalPages - 1) {

                            if (i < totalPages - 4) continue;

                        } else {
                            if (i < currentPage - 2 || i > currentPage + 2) {
                                continue;
                            }
                        }
                    }


                    var pageBtn = $('<span class="custom_pagination-button page-num" />');


                    if (i == currentPage) {
                        pageBtn.addClass('active');
                    }


                    pageBtn.text(i);


                    pagination.append(pageBtn);
                }


                pagination.append($('<span class="custom_pagination-button">&raquo;</span>'));

                return pagination;
            },

            createPage: function(items, currentPage, perPage) {

                $('.custom_pagination').remove();


                var container = items.parent(),

                    items = items.detach().toArray(),

                    startPos = this.startPos(currentPage - 1, perPage),
                    page = this.getPage(items, startPos, perPage);


                $.each(page, function() {

                    if (this.window === undefined) {
                        container.append($(this));
                    }
                });

                var totalPages = this.totalPages(items, perPage),
                    pageButtons = this.createBtns(totalPages, currentPage);

                container.after(pageButtons);
            }
        };

        $.fn.paginate = function(perPage) {
            var items = $(this);

            if (isNaN(perPage) || perPage === undefined) {
                perPage = 5;
            }


            if (items.length <= perPage) {
                return true;
            }

            if (items.length !== items.parent()[0].children.length) {
                items.wrapAll('<div class="custom_pagination-items" />');
            }

            paginate.createPage(items, 1, perPage);


            $(document).on('click', '.custom_pagination-button', function(e) {
                var currentPage = parseInt($('.custom_pagination-button.active').text(), 10),
                    newPage = currentPage,
                    totalPages = paginate.totalPages(items, perPage),
                    target = $(e.target);

                newPage = parseInt(target.text(), 10);
                var i = currentPage;
                i <= totalPages;
                i++;
                if (target.text() == '»') newPage = i++;
                i--;
                if (target.text() == '«') newPage = --i;
                if (newPage > 0 && newPage <= totalPages) {
                    paginate.createPage(items, newPage, perPage);
                }
            });
        };

    })(jQuery);
    $('.wrapping_div-blogcard').paginate(3);
    </script> -->

        <script>
        const galleryItems = document.querySelector(".gallery-items").children;
        const prev = document.querySelector(".prev");
        const next = document.querySelector(".next");
        const page = document.querySelector(".page-num");
        const maxItem = 3;
        let index = 1;

        const pagination = Math.ceil(galleryItems.length / maxItem);

        prev.addEventListener("click", function() {
            index--;
            check();
            showItems();
        })
        next.addEventListener("click", function() {
            index++;
            check();
            showItems();
        })

        function check() {
            if (index == pagination) {
                next.classList.add("disabled");
            } else {
                next.classList.remove("disabled");
            }

            if (index == 1) {
                prev.classList.add("disabled");
            } else {
                prev.classList.remove("disabled");
            }
        }

        function showItems() {
            for (let i = 0; i < galleryItems.length; i++) {
                galleryItems[i].classList.remove("show");
                galleryItems[i].classList.add("hide");


                if (i >= (index * maxItem) - maxItem && i < index * maxItem) {
                    // if i greater than and equal to (index*maxItem)-maxItem;
                    // means  (1*8)-8=0 if index=2 then (2*8)-8=8
                    galleryItems[i].classList.remove("hide");
                    galleryItems[i].classList.add("show");
                }
                page.innerHTML = index;
            }


        }

        window.onload = function() {
            showItems();
            check();
        }
        </script>
</body>

</html>