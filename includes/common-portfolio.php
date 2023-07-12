<?php

include_once('../_config/connect.php');
require_once("../classes/portfolio.class.php");

$portpolio = new Portfolio();

$showFewPort = $portpolio->showPortfolio(); ?>
<div class="row start-ups-blog common-port-cls">
<?php foreach ($showFewPort as $portValue) { ?>
				<div class="col-sm-3 all-port-single text-center">
					<div class="single-portfolio">
						<a href="<?php echo $portValue['url'];?>">
						<img class="portfolio-img port-img" src="images/portfolio/<?php echo $portValue['image'];?>" alt="">
					<div class="portfolio-single-detls"></a>
						<h3><a href="<?php echo $portValue['url'];?>"> <?php echo $portValue['name']; ?></a></h3>
						<p><?php echo $portValue['description']; ?></p>
					</div>
					</div>
				</div>

<?php } ?>
 </div>
