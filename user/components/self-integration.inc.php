<!-- // ====== steps and processes after order is accepted by seller ======                            -->
<?php if($deliveryDtls['waiting_time'] == null): ?>

<p class="text-center bg-primary text-light fw-bold rounded my-2 py-2">
    Please Wait for seller integration
</p>

<p class="text-center fw-normal rounded border py-2 cursor-pointer" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Click here to see the details you have shared.
</p>


<!-- Details Modal Start -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                $key == 'orders_id' ?  $value = '#'.$value: '';
                                $key == 'updated_on' ? $value = $DateUtil->fullDateTimeText($value): '';
                                $key == 'domain_provider' ? $value = url_dec($value): '';

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

<?php require_once USER_PATH."components/shared-details.inc.php"; ?>

<?php endif; ?>