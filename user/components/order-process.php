<?php
$orderedData = $Order->getFullOrderDetailsById($ordId);
if ($prodId == $orderedData['product_id']) {
    $OrdrdProduct = $Domain->showDomainsById($prodId);
    if ($OrdrdProduct > 0) {
?>
<!-- Products Order Start -->
<section class="my-gp-order">
    <div class="p-kage-de-tails">

        <?php require_once USER_PATH."components/order-details.inc.php" ?>

        <!-- actions Section start -->
        <section class="d-flex flex-column border-top border-primary pb-3 px-2 bg_ord_footer">
            <?php
            if ($orderedData['orders_status_id'] == PROCESSINGCODE) { // if order status accepted/processesing
                if ($orderedData['delivery_type'] == SELF_INTEGRATION ):

                    // ====== steps and processes after order is accepted by seller ====== 

                    $deliveryDtls = $Order->deliveryDtlsByOrdId($orderedData['orders_id']);
                                                
                    if($deliveryDtls['waiting_time'] == null):    
            ?>

                        <p class="text-center bg-primary text-light fw-bold my-2 py-1">
                            Please Wait for seller integration
                        </p>

                        <p class="text-center fw-normal cursor_pointer" data-bs-toggle="modal" data-bs-target="#detailsModal">
                            Click here to see the details you have shared.
                        </p>

                        <!-- Details Modal Start -->
                        <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Integration
                                            Sharing Details</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                            foreach ($deliveryDtls as $key => $value) {
                                                if ($value != null || $value != '') {
                                                    if ($key != 'id' && $key != 'updated_by' && $key != 'order_status_id' && $key != 'accepted_on') {
                                                        if ($key == 'orders_id') $value = '#'.$value;
                                                        if ($key == 'updated_on') $value = $dateUtil->fullDateTimeText($value);
                                                            echo '<div>
                                                                    <label>'.$key.' :</label><br>
                                                                        <p class="fw-semibold">'.$value.'</p>
                                                                </div>';
                                                    }
                                                }
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Details Modal End -->

                    <?php else: ?>

                    <div class="order_action_bx">
                        <div class="m-auto dtls_bx">
                            <h3 class="text-center">Client Domain Account Details</h3>

                            <label class="fw-bold">Domain Provider</label>
                            <p class="fw-normal">
                                <span id="domain_provider">
                                    <?php echo $deliveryDtls['domain_provider'];?>
                                </span>
                                <small data-bs-toggle="modal" data-bs-target="#editModal"
                                    onclick="editSingleData('domain_provider', 'domain_provider')"
                                    class="ms-2 text-danger cursor_pointer">
                                    <i class="fa-light fa-pen-to-square"></i>
                                    Edit
                                </small>
                            </p>

                            <label class="fw-bold">Domain Email</label>
                            <p class="fw-normal">
                                <span id="domain_email">
                                    <?php echo $deliveryDtls['domain_email'];?>
                                </span>
                                <small data-bs-toggle="modal" data-bs-target="#editModal"
                                    onclick="editSingleData('domain_email', 'domain_email')"
                                    class="ms-2 text-danger cursor_pointer">
                                    <i class="fa-light fa-pen-to-square"></i>
                                    Edit
                                </small>
                            </p>
                        </div>

                        <div class="m-auto mt-4 form_bx">
                            <label class="fw-bold">Domain Authoraization Code <small
                                    class="text-danger text-thin">Wrong?</small>
                            </label>
                            <div class="text-wrap">
                                <input type="text" class="form-control" id="domain_authorizatrion_code"
                                    value="<?php echo $deliveryDtls['domain_authorizatrion_code'];?>" readonly>
                                <div id="domain_authorizatrion_code_copy"
                                    onclick="copyTextBS('domain_authorizatrion_code', this.id)" class="clipboard icon">
                                </div>
                            </div>


                            <label class="fw-bold mt-2">Website File Link <small
                                    class="text-danger text-thin">Wrong?</small></label>
                            <div class="text-wrap">
                                <input type="text" class="form-control" id="website_file_link"
                                    value="<?php echo $deliveryDtls['website_file_link'];?>" readonly>
                                <div id="website_file_link_copy" onclick="copyTextBS('website_file_link', this.id)"
                                    class="clipboard icon">
                                </div>
                            </div>

                            <!-- hosting_provider
                            hosting_email
                            hosting_pass
                            waiting_time
                            updated_by
                            updated_on
                            delivered_on -->

                            <label class="fw-bold mt-2">Database Drive Link <small
                                    class="text-danger text-thin">Wrong?</small></label>
                            <div class="text-wrap">
                                <input type="text" class="form-control" id="db_drive_link"
                                    value="<?php echo $deliveryDtls['db_drive_link'];?>" readonly>
                                <div id="db_drive_link_copy" onclick="copyTextBS('db_drive_link', this.id)"
                                    class="clipboard icon">
                                </div>
                            </div>


                            <!-- <label class="fw-bold mt-2">Database Name <small
                                    class="text-danger text-thin">Wrong?</small></label>
                            <div class="text-wrap">
                                <input type="text" class="form-control" id="db_name"
                                    value="<?php echo $deliveryDtls['db_name'];?>" readonly>
                                <div id="db_name_copy" onclick="copyTextBS('db_name', this.id)" class="clipboard icon">
                                </div>
                            </div>



                            <label class="fw-bold mt-2">Database Username <small
                                    class="text-danger text-thin">Wrong?</small></label>
                            <div class="text-wrap">
                                <input type="text" class="form-control" id="db_user"
                                    value="<?php echo $deliveryDtls['db_user'];?>" readonly>
                                <div id="db_user_copy" onclick="copyTextBS('db_user', this.id)" class="clipboard icon">
                                </div>
                            </div>



                            <label class="fw-bold mt-2">Database Password <small
                                    class="text-danger text-thin">Wrong?</small></label>
                            <div class="text-wrap">
                                <input type="text" class="form-control" id="db_pass"
                                    value="<?php echo $deliveryDtls['db_pass'];?>" readonly>
                                <div id="db_pass_copy" onclick="copyTextBS('db_pass', this.id)" class="clipboard icon">
                                </div>
                            </div> -->

                            <div class="mt-4 text-center">
                                <button type="button" class="btn btn-primary" onclick="VerifyCompleteOrder()">Verified</button>
                            </div>

                        </div>
                    </div>

                    <?php
                    endif;
                                        
            elseif($orderedData['delivery_type'] == LEELIJA_INTEGRATION):
            ?>

            <p class="text-light text-primary"></p>
            
            <!-- //if delivery type not selected yet -->
            <?php else: ?>

            <div class="text-center">
                <p class="bg-primary text-light fw-bold my-2">
                    Your order has been accepted, Please Share required details
                </p>
            </div>

            <!-- Integration Buttons Section Start-->
            <div class="row m-auto butnrowss">
                <div class="col-md-12 removingpadding">
                    <div class="buttonsinfo">
                        <?php
                            $deliveryType = $Order->allDeliveryType();
                            foreach($deliveryType as $delivery){
                        ?>
                        <button class="btn managed-link-btn" data-bs-toggle="modal"
                            data-bs-target="#modal-<?php echo $delivery['integration_id']; ?>">
                            <?php 
                                echo $delivery['integration_name']; 
                                if ($delivery['cost'] > 0) {
                                    echo " ( $".$delivery['cost']." )";
                                }
                            ?>
                        </button>



                        <!-- Modal Start   -->
                        <div class="modal fade" id="modal-<?php echo $delivery['integration_id'] ?>" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                            New Domain Account Details
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="mb-3">
                                            <label for="domainProvider" class="form-label">
                                                Transfer To Which Domain Provider
                                            </label>
                                            <input type="email" class="form-control" id="domainProvider"
                                                placeholder="www.example.com">
                                        </div>

                                        <div class="mb-3">
                                            <label for="emailAddress" class="form-label">
                                                Account Email Address
                                            </label>
                                            <input type="email" class="form-control" id="emailAddress"
                                                placeholder="name@example.com">
                                        </div>

                                        <div class="text-center">
                                            <button type="button" class="btn btn-primary m-auto" name="update"
                                                onclick="selfIntegrate()">
                                                Submit Details
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal End  -->

                        <?php } ?>
                    </div>
                </div>
            </div>
            <!-- Integration Buttons Section End-->

            <?php
            endif; //eof delivery type cheaking conditions

            }elseif($orderedData['orders_status_id'] == PENDINGCODE){
                echo "Order Pending";
            }elseif($orderedData['orders_status_id'] == DELIVEREDCODE){
                echo "delivered";
            }elseif($orderedData['orders_status_id'] == FAILEDCODE){
                echo 'Order Failed';
            }elseif($orderedData['orders_status_id'] == ORDEREDCODE){
                echo '<p class="text-center bg-primary text-light fw-bold my-2 py-1">Please Wait for
                        seller Response.</p>';
            }elseif($orderedData['orders_status_id'] == COMPLETEDCODE){
                echo 'Order Completed';
            }elseif($orderedData['orders_status_id'] == HOLDCODE){
                echo 'Order Hold';
            }else{
                echo "Order Failed or something may wrong!";
            }
            ?>

        </section>

    </div>
</section>
<!-- Products Order End -->

<?php
    }
}
?>