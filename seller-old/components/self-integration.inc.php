<div class="w-100">

    <div class="">
        <div class="m-auto dtls_bx">
            <h3 class="text-center">Client Domain Account Details</h3>
            <p class="text-primary fw-bold" id="headingTxt">Domain Provider</p>
            <div class="text-wrap">
                <input type="text" class="form-control" id="domain-provider"
                    value="<?php echo url_dec($deliveryDtls['domain_provider']);?>">
                <div id="domain-provider-copy" onclick="copyText('domain-provider', this.id)" class="clipboard icon">
                </div>
            </div>

            <p class="text-primary fw-bold">Domain Email</p>
            <div class="text-wrap">
                <input type="text" class="form-control" id="domain-email"
                    value="<?php echo $deliveryDtls['domain_email'];?>">
                <div id="domain-email-copy" onclick="copyText('domain-email', this.id)" class="clipboard icon">
                </div>
            </div>
        </div>
    </div>

    <?php if($deliveryDtls['domain_authorizatrion_code'] != null){ ?>
        
        <?php require_once SELLER_PATH."components/shared-data-view.inc.php";?>

    <?php }else{ ?>

    <div class="" id="sendDataSection">
        <div class="m-auto mt-3 form_bx">
            <h3 class="text-center">Send Required Details</h3>

            <label class="fw-bold">Domain Authorization Code
                <span>
                    <a href="#">
                        <i class="far fw-light fa-exclamation-circle text-danger" data-bs-toggle="tooltip"
                            title="Collect From Your Domain Account, Click to Know More">
                        </i>
                    </a>
                </span>
            </label>

            <div class="text-wrap">
                <input type="text" class="form-control" id="domain-code" autocomplete="off">
            </div>

            <label class="fw-bold mt-2">Complete Website Zip Drive Link
                <span>
                    <a href="#">

                        <i class="far fw-light fa-exclamation-circle text-danger" data-bs-toggle="tooltip"
                            title="Upload your website and database to Google drive and share the link, Click to Know More">
                        </i>
                    </a>
                </span>
            </label>
            <div class="text-wrap">
                <input type="text" class="form-control" id="drive-url" autocomplete="off">
            </div>

            <label class="fw-bold mt-2">Database Drive Link
                <span>
                    <a href="#">
                        <i class="far fw-light fa-exclamation-circle text-danger" data-bs-toggle="tooltip"
                            title="Upload your website and database to Google drive and share the link.">
                        </i>
                    </a>
                </span>
            </label>
            <div class="text-wrap">
                <input type="text" class="form-control" id="drive-url" autocomplete="off">
            </div>

            <label class="fw-bold mt-2">Waiting Time
                <span>
                    <a href="#">
                        <i class="far fw-light fa-exclamation-circle text-danger" data-bs-toggle="tooltip"
                            title="Waiting Time Required By Domain Provider, Click to Know More">
                        </i>
                    </a>
                </span>
            </label>
            <select class="form-select" aria-label="Select Waiting Time" id="waiting-time">
                <option selected disabled value="">Completation Time</option>
                <option value="12Hr">12Hr</option>
                <option value="24Hrs">24Hrs</option>
                <option value="48Hrs">48Hrs</option>
                <option value="3 Days">3 Days</option>
                <option value="4 Days">4 Days</option>
                <option value="5 Days">5 Days</option>
                <option value="6 Days">6 Days</option>
                <option value="7 Days">7 Days</option>
                <option value="8 Days">8 Days</option>
                <option value="9 Days">9 Days</option>
                <option value="10 Days">10 Days</option>
            </select>


            <div class="m-autom-auto text-center pt-3">
                <button class="btn btn-sm btn-primary m-auto"
                    onclick="sendData(<?php echo $orderedData['orders_id']?>)">Submit</button>
            </div>
        </div>

    </div>
    <?php } ?>
</div>