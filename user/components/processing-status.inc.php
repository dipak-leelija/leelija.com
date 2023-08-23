<?php if ($orderedData['delivery_type'] == SELF_INTEGRATION ): ?>

    <?php require_once USER_PATH."components/self-integration.inc.php"; ?>
                    
<?php elseif($orderedData['delivery_type'] == LEELIJA_INTEGRATION): ?>

    <p class="text-light text-primary"></p>

<!-- //if delivery type not selected yet -->
<?php else: ?>

    <div class="text-center">
        <p class="bg-primary text-light rounded fw-bold my-2 py-2">
            Your order has been accepted, Please Choose Integration Method Bellow.
        </p>
    </div>

    <!-- Integration Buttons Section Start-->
    <div class="row m-auto butnrowss">
        <div class="col-md-12 removingpadding">
            <div class="buttonsinfo">
            <?php
            $deliveryType = $Order->allDeliveryType();
            foreach($deliveryType as $delivery){
                $delivery['cost'] > 0 ? $paidIntegration = true : $paidIntegration = false;

            ?>
                <?php if ($paidIntegration): ?>
                <button class="btn managed-link-btn">
                    <?= $delivery['integration_name']." (".CURRENCY.$delivery['cost'].")"; ?>
                </button>

                <?php else: ?>
                <button class="btn managed-link-btn" data-bs-toggle="modal"
                    data-bs-target="#modal-<?= $delivery['integration_id']; ?>">
                    <?= $delivery['integration_name']; ?>
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
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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

                <?php endif; ?>

                <?php } ?>
                <!-- end of loop  -->
            </div>
        </div>
    </div>
    <!-- Integration Buttons Section End-->

    <!-- //eof delivery type cheaking conditions -->
<?php endif; ?>