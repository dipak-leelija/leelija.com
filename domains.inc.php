<?php
require_once("includes/constant.inc.php");

//fetch_data.php
// require_once("_config/db_connect.php");
require_once("_config/dbconnect.php");
// require_once "_config/db_connect.php";

require_once("classes/niche.class.php");

/* INSTANTIATING CLASSES */
$Niche		= new Niche();

if(isset($_POST["action"])){

	$query = " SELECT * FROM domains WHERE selling_status = '1' ";
	if(isset($_POST["minimum_da"], $_POST["maximum_da"]) && !empty($_POST["minimum_da"]) && !empty($_POST["maximum_da"])){
		$query .= " AND da BETWEEN '".$_POST["minimum_da"]."' AND '".$_POST["maximum_da"]."' ";
	}

	if(isset($_POST["niche"])){

		$niche_filter = implode("','", $_POST["niche"]);
		$query .= " AND niche IN('".$niche_filter."') ";
	}

	$statement  = mysqli_query($conn, $query);
	$total_row  = mysqli_num_rows($statement);
	while ($data = mysqli_fetch_assoc($statement)) {
		$result[] = $data;
	}


	
	$output = '';
	if($total_row > 0){
		
		foreach($result as $row){
			
			// print_r($row['niche']);
			$nicheDtls	 	= $Niche->showBlogNichMst($row['niche']);
			foreach ($nicheDtls as $rowNicheDtls) {
			$output .= '
				<div class=" col-lg-3 col-md-6 col-sm-6 my-2">
					<div class="card prod-sec text-left">
						<div class="prod-dtls">
							<div class="prod-img">
								<a href="">
									<img src="images/domains/'. $row['dimage'] .'" alt="'. $row['dimage'] .'" class="img-fluid">
								</a>
								<div class="team-content">
								</div>
								<div class="overlay">
									<div class="text text-center">
										<p class="text-white">
											'. $row['dimage'] .'
										</p>
									</div>
								</div>
							</div>
							<div class="prod-content-sec">
								<h3><i class="fa fa-angle-double-right"></i>'. $rowNicheDtls[1] .'</h3>
								<a href="domain.php?seo_url='.$row['seo_url'].'"><h2 class="prodName-Sec">'. $row['durl'] .'</h2></a>
								<p><i class="fas fa-long-arrow-alt-right"></i> DA:'. $row['da'] .'</p>'.'<p><i class="fas fa-long-arrow-alt-right"></i> PA: '. $row['pa'] .'</p>
								<p><i class="fas fa-long-arrow-alt-right"></i> Alexa Traffic: '. $row['alexa_traffic'] .'</p>
								<p><i class="fas fa-long-arrow-alt-right"></i> Organic Traffic: '. $row['organic_traffic'] .'</p>
								<h3><i class="fas fa-long-arrow-alt-right"></i> Price $'. $row['price'] .'</h3>
							</div>
						</div>
						<div class="buy-sec d-flex justify-content-evenly">
							<a class="btn btn-sm btn-success" href="domain.php?seo_url='. $row['seo_url'] .'"><i class="far fa-eye"></i> View</a>
							<span class="btn btn-sm btn-danger" onclick="AddToCart('.$row['id'].', this)"><i class="far fa-heart"></i> Add Cart</span>
						</div>
					</div>
				</div>
				
			';
			}
		}
	}else{
		$output = '<h3>No Data Found</h3>';
	}
	echo $output;
}

?>