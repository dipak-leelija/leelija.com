<section class="order_action_bx">

    <?php if($orderedData['orders_status_id'] == ORDEREDCODE): ?>
    <div class="d-flex justify-content-evenly">
        <button class="btn btn-primary" onclick="acceptProductOrder()">Accept</button>
        <button class="btn btn-danger" onclick="rejectProductOrder()">Cancel</button>
    </div>

    <?php elseif($orderedData['orders_status_id'] == PROCESSINGCODE):
            if ($orderedData['delivery_type'] == SELF_INTEGRATION) {

                require_once SELLER_PATH."components/self-integration.inc.php";

            }elseif($orderedData['delivery_type'] == LEELIJA_INTEGRATION) {
                echo '<p class="info-styling-mine">Please Contact To leelija.</p>';
            }else {
                echo '<p class="info-styling-mine">Please Wait For Customer Response.</p>';
            }
    ?>

    <?php elseif ($orderedData['orders_status_id'] == PENDINGCODE): ?>
    <p>Order Pending</p>
    <?php elseif ($orderedData['orders_status_id'] == DELIVEREDCODE): ?>
    <div class="bg-primary rounded text-center text-light text-bold w-100 py-4 mb-2">
        Order Has Been Delivered!
    </div>
    <div class="border border-success rounded text-primary text-bold w-100">
        <?php require_once SELLER_PATH."components/shared-data-view.inc.php";?>
    </div>
    <?php require_once SELLER_PATH."components/shared-data-view.inc.php";?>
    <?php else:?>
    <p>Something error!</p>
    <?php endif; ?>

</section>