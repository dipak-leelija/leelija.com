<div class="row">
    <div class="col-md-8">
        <!-- Details section Start  -->
        <div class="">
            <!-- Order Details Start -->
            <h2 class="fw-bolder"><?php echo $OrdrdProduct['domain']; ?>
                <span class="badge bg-primary">
                    <?= $ordStatus ?>
                </span>
                </h1>
                <p class="niche_name">
                <?php
                    $niche = $Niche->showBlogNichMst($OrdrdProduct['niche']);
                    echo $niche[0][1]; // niche name
                ?>
                </p>
                <table class="ordered-details-table-css " style="width: 100%;">
                    <!-- <tr>
                        <td> Id</td>
                        <td>:</td>
                        <td><?= $orderedData['orders_id']; ?></td>
                    </tr> -->
                    <tr>
                        <td>Order Id</td>
                        <td>:</td>
                        <td style="word-break: break-word;">
                            <?= $orderedData['orders_code']; ?></td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td>:</td>
                        <td><?= CURRENCY.$orderedData['orders_amount']; ?></td>
                    </tr>
                    <tr>
                        <td>Payment Status</td>
                        <td>:</td>
                        <td><?= $paymentStatus; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td>:</td>
                        <td><?= date('l jS \of F Y h:i:s A', strtotime($orderedData['added_on'])); ?>
                        </td>
                    </tr>
                </table>
        </div>
        <!-- Details section End -->

    </div>
    <div class="col-md-4">
        <div class="product_image_sec_right">
            <img class="product_image" src="<?= URL ?>images/domains/<?php echo $OrdrdProduct[10]?>" alt="">
        </div>
    </div>
</div>