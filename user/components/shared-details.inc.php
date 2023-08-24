<div class="accordion" id="accordionExample">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button d-block text-center shadow-none <?= $orderedData['orders_status_id'] == COMPLETEDCODE ? '' : 'bg-warning'; ?>" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Click to view shared details
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">


                <div class="order_action_bx">
                    <div class="m-auto dtls_bx">
                        <h3 class="text-center">Client Domain Account Details</h3>

                        <label class="fw-bold">Domain Provider</label>
                        <p class="fw-normal">
                            <span id="domain_provider">
                                <?= url_dec($deliveryDtls['domain_provider']);?>
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

                        <div class="mt-4 text-center">
                            <button type="button" class="btn btn-primary"
                                onclick="VerifyCompleteOrder()">Verified</button>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>
</div>