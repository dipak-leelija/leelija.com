<section class="new_section text-center mt-5 pb-5">


    <h1 class="fs-1 fw-bolder my-2">Established <span class="aegean-blue-color"> Blog</span> For <span
            class="aegean-blue-color">Sale</span></h1>
    <div class="row my-2 justify-content-evenly">
        <?php
                    $limitedDomain = $domain->ShowlimitedData(4);
                    foreach ($limitedDomain as $row) { 
                ?>

        <div class="text-center card-width">
            <div class="box1">
                <div class="conten contenbox">
                    <img class="img-fluid myimg" src="images/domains/<?php echo $row['dimage']?>"
                        alt="<?php echo $row['dimage']?>">
                </div>
                <div class="box_container">
                    <h3 class="tittle"><a class="aegean-blue-color"
                            href="domain.php?seo_url=<?php echo $row['seo_url'];?>">
                            <?php echo $row['domain'];?></a></h3>
                    <span class="post">DA: <?php echo $row['da'];?> PA: <?php echo $row['pa'];?></span><br>
                    <span class="post">Price: <?php echo '$'.$row['price'];?></span>
                    <div class="d-flex justify-content-between">
                        <!-- <button type="button" class="btn view-btn btn-sm"> -->
                        <a class="btn view-btn btn-sm" href="domain.php?seo_url=<?php echo $row['seo_url'];?>">View</a>
                        <!-- </button> -->
                        <!-- <button type="button" class="btn buy-btn btn-sm "> -->
                        <a class="btn buy-btn btn-sm ml-auto" class="aegean-blue-color"
                            href="domain.php?seo_url=<?php echo $row['seo_url'];?>">Buy Now</a>
                        <!-- </button> -->
                    </div>
                </div>
            </div>
        </div>

        <?php	
                    }
                ?>
    </div>
    <button class="btn mt-5 explore_btn"><a href="domains.php" class="text-decoration-none aegean-blue-color">More
            Established
            Blogs</a></button>

</section>