<div class="accordion m-auto" id="accordionExample">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button d-block text-center shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Click to view shared details
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">

                <div class="m-auto my-3 form_bx">
                    <h3 class="text-center">Send Required Details</h3>

                    <label class="fw-bold">Domain Authorozation Code
                        <span>
                            <i class="far fa-exclamation-circle text-danger" data-bs-toggle="tooltip"
                                title="Collect From Your Domain Account."></i>
                        </span>
                    </label>

                    <p class="fw-normal">
                        <span id="domainAuthCodeEdit">
                            <?php echo $deliveryDtls['domain_authorizatrion_code']; ?>
                        </span>
                        <small data-bs-toggle="modal" data-bs-target="#editModal"
                            onclick="editSingleData('domainAuthCodeEdit', 'domain_authorizatrion_code')"
                            class="ms-2 text-danger cursor_pointer">
                            <i class="fa-light fa-pen-to-square"></i>
                            Edit
                        </small>
                    </p>

                    <label class="fw-bold mt-2">Complete Website Zip Drive Link
                        <span>
                            <i class="far fa-exclamation-circle text-danger" data-bs-toggle="tooltip"
                                title="Upload your website and database to Google drive and share the link."></i>
                        </span>
                    </label>
                    <p class="fw-normal">
                        <span id="decodedLinkEdit">
                            <?php echo $deliveryDtls['website_file_link']; ?>
                        </span>
                        <small onclick="editSingleData('decodedLinkEdit', 'website_file_link')" data-bs-toggle="modal"
                            data-bs-target="#editModal" class="ms-2 text-danger cursor_pointer">
                            <i class="fa-light fa-pen-to-square"></i>
                            Edit
                        </small>
                    </p>

                    <label class="fw-bold mt-2">Database drive Link
                        <span>
                            <i class="far fa-exclamation-circle text-danger" data-bs-toggle="tooltip"
                                title="Upload your website and database to Google drive and share the link."></i>
                        </span>
                    </label>
                    <p class="fw-normal">
                        <span id="dbLlinkEdit">
                            <?php echo $deliveryDtls['db_drive_link']; ?>
                        </span>
                        <small data-bs-toggle="modal" data-bs-target="#editModal"
                            onclick="editSingleData('dbLlinkEdit', 'db_drive_link')"
                            class="ms-2 text-danger cursor_pointer">
                            <i class="fa-light fa-pen-to-square"></i>
                            Edit
                        </small>
                    </p>

                    <!-- <label class="fw-bold mt-2">Database Name
                        <span>
                            <i class="far fa-exclamation-circle text-danger" data-bs-toggle="tooltip"
                                title="Upload your website and database to Google drive and share the link."></i>
                        </span>
                    </label>
                    <p class="fw-normal">
                        <span id="dbName">
                            <?php echo $deliveryDtls['db_name']; ?>
                        </span>
                        <small data-bs-toggle="modal" data-bs-target="#editModal" onclick="editSingleData('dbName', 'db_name')"
                            class="ms-2 text-danger cursor_pointer">
                            <i class="fa-light fa-pen-to-square"></i>
                            Edit
                        </small>
                    </p>

                    <label class="fw-bold mt-2">Database Username
                        <span>
                            <i class="far fa-exclamation-circle text-danger" data-bs-toggle="tooltip"
                                title="Upload your website and database to Google drive and share the link."></i>
                        </span>
                    </label>
                    <p class="fw-normal">
                        <span id="dbUser">
                            <?php echo $deliveryDtls['db_user']; ?>
                        </span>
                        <small data-bs-toggle="modal" data-bs-target="#editModal" onclick="editSingleData('dbUser', 'db_user')"
                            class="ms-2 text-danger cursor_pointer">
                            <i class="fa-light fa-pen-to-square"></i>
                            Edit
                        </small>
                    </p>

                    <label class="fw-bold mt-2">Database Password
                        <span>
                            <i class="far fa-exclamation-circle text-danger" data-bs-toggle="tooltip"
                                title="Upload your website and database to Google drive and share the link."></i>
                        </span>
                    </label>
                    <p class="fw-normal">
                        <span id="dbPass">
                            <?php echo $deliveryDtls['db_pass']; ?>
                        </span>
                        <small data-bs-toggle="modal" data-bs-target="#editModal" onclick="editSingleData('dbPass', 'db_pass')"
                            class="ms-2 text-danger cursor_pointer">
                            <i class="fa-light fa-pen-to-square"></i>
                            Edit
                        </small>
                    </p> -->



                    <label class="fw-bold mt-2">Waiting Time
                        <span>
                            <i class="far fa-exclamation-circle text-danger" data-bs-toggle="tooltip"
                                title="Waiting Time Required By Domain Provider."></i>
                        </span>
                    </label>
                    <p class="fw-normal">
                        <span id="waitingTimeEdit"><?php echo $deliveryDtls['waiting_time']; ?>
                        </span>
                        <small onclick="editSingleData('waitingTimeEdit', 'waiting_time')" data-bs-toggle="modal"
                            data-bs-target="#editModal" class="ms-2 text-danger cursor_pointer">
                            <i class="fa-light fa-pen-to-square"></i>
                            Edit
                        </small>
                    </p>


                    <label class="fw-bold mt-2">Last Update </label>
                    <p class="fw-normal">
                        <span
                            id="waitingTimeEdit"><?php echo $dateUtil->fullDateTimeText($deliveryDtls['updated_on']); ?>
                        </span>
                    </p>

                </div>


            </div>
        </div>
    </div>
</div>