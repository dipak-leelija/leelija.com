<?php
$orderedData = $Order->getFullOrderDetailsById($ordId);
if ($prodId == $orderedData['product_id']) {
    $OrdrdProduct = $Domain->showDomainsById($prodId);
    if ($OrdrdProduct > 0) {
        $deliveryDtls = $Order->deliveryDtlsByOrdId($orderedData['orders_id']);

?>
<!-- Products Order Start -->
<section class="my-gp-order">
    <div class="p-kage-de-tails">

        <?php require_once USER_PATH."components/order-details.inc.php" ?>

        <!-- actions Section start -->
        <section class="d-flex flex-column border-top border-primary pb-3 px-2 bg_ord_footer">
            <?php
            if ($orderedData['orders_status_id'] == PROCESSINGCODE): // if order status accepted/processesing
                if ($orderedData['delivery_type'] == SELF_INTEGRATION ):

                    // ====== steps and processes after order is accepted by seller ====== 

                                                
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

            <?php require_once USER_PATH."components/shared-details.inc.php" ?>

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

            <!-- //eof delivery type cheaking conditions -->
            <?php endif; ?>

            <?php elseif($orderedData['orders_status_id'] == PENDINGCODE): ?>
            echo "Order Pending";

            <?php elseif($orderedData['orders_status_id'] == DELIVEREDCODE):?>
            <div class="bg-primary rounded text-center text-light text-bold w-100 py-4 mb-2">
                Order Has Been Delivered!
            </div>
            <div class="border border-success rounded text-primary text-bold w-100">
                <?php require_once USER_PATH."components/shared-details.inc.php";?>
            </div>

            <?php elseif($orderedData['orders_status_id'] == FAILEDCODE):?>
            echo 'Order Failed';
            <?php elseif($orderedData['orders_status_id'] == ORDEREDCODE):?>
            echo '<p class="text-center bg-primary text-light fw-bold my-2 py-1">Please Wait for
                seller Response.</p>';
            <?php elseif($orderedData['orders_status_id'] == COMPLETEDCODE):?>
            echo 'Order Completed';
            <?php elseif($orderedData['orders_status_id'] == HOLDCODE):?>
            echo 'Order Hold';
            <?php else:?>
            echo "Order Failed or something may wrong!";
            <?php endif; ?>

        </section>

    </div>
</section>
<!-- Products Order End -->

<?php
    }
}
?>