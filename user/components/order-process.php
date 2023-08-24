<?php
$orderedData      = $Order->getFullOrderDetailsById($ordId);
$orderStatusId    = $orderedData['orders_status_id'];
if ($prodId == $orderedData['product_id']) {
    $OrdrdProduct = $Domain->showDomainsById($prodId);
    if ($OrdrdProduct > 0) {
        $deliveryDtls   = $Order->deliveryDtlsByOrdId($orderedData['orders_id']);
        $ordStatus      = $OrderStatus->getOrdStatName($orderStatusId);
        $paymentStatus  = $OrderStatus->getOrdStatName($orderedData['payment_status']);


?>
<!-- Products Order Start -->
<section class="my-gp-order">
    <div class="p-kage-de-tails">

        <?php require_once USER_PATH."components/order-details.inc.php" ?>

        <!-- actions Section start -->
        <section class="d-flex flex-column border-top border-primary pb-3 px-2 bg_ord_footer">

            <?php if ($orderStatusId == PROCESSINGCODE):?>
            <?php require_once USER_PATH.'components/processing-status.inc.php'; ?>

            <?php elseif($orderStatusId == PENDINGCODE): ?>
            echo "Order Pending";

            <?php elseif($orderStatusId == DELIVEREDCODE):?>
            <div class="bg-primary rounded text-center text-light text-bold w-100 py-4 mb-2 mt-2">
                Order Has Been Delivered!
            </div>
            <div class="rounded w-100">
                <?php require_once USER_PATH."components/shared-details.inc.php";?>
            </div>

            <?php elseif($orderStatusId == FAILEDCODE):?>
            echo 'Order Failed';
            <?php elseif($orderStatusId == ORDEREDCODE):?>
            <p class="text-center bg-primary text-light fw-bold my-2 py-1">
                Please wait for response.
            </p>
            <?php elseif($orderStatusId == COMPLETEDCODE):?>
            <div class="bg-primary rounded text-center text-light text-bold w-100 py-4 mb-2 mt-2">
                Order Has Been Completed Successfully!
            </div>
            <div class="rounded w-100">
                <?php require_once USER_PATH."components/shared-details.inc.php";?>
            </div>
            <?php elseif($orderStatusId == HOLDCODE):?>
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