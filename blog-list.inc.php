<?php

session_start();
//fetch_data.php
require_once("_config/db_connect.php"); 
require_once("_config/dbconnect.php");
require_once "_config/dbconnect.trait.php";

require_once "includes/constant.inc.php";


require_once("classes/customer.class.php");
require_once("classes/blog_mst.class.php");
require_once("classes/utility.class.php");
require_once "classes/wishList.class.php";

/* INSTANTIATING CLASSES */
$blogMst		= new BlogMst();
$customer		= new Customer();
$utility		= new Utility();

$WishList       = new WishList();
//user id

$cusId		= $utility->returnSess('userid', 0);
// echo "This is".$cusId; exit;
$cusDtl		= $customer->getCustomerData($cusId);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="plugins/bootstrap-5.2.0/css/bootstrap.css"> -->
    <link rel="stylesheet" href="plugins/data-table/style.css">

</head>

<body>

    <?php
if(isset($_POST["action"])){
	
	$query = "SELECT * FROM blog_mst WHERE approved = 'yes'";

	if(isset($_POST["minimum_da"], $_POST["maximum_da"]) && !empty($_POST["minimum_da"]) && !empty($_POST["maximum_da"])){
		$query .= "AND da BETWEEN '".$_POST["minimum_da"]."' AND '".$_POST["maximum_da"]."'";
	}

	if(isset($_POST["minimum_tf"], $_POST["maximum_tf"]) && !empty($_POST["minimum_tf"]) && !empty($_POST["maximum_tf"])){
		$query .= "AND tf BETWEEN '".$_POST["minimum_tf"]."' AND '".$_POST["maximum_tf"]."'";
	}

	// echo $query; exit;
	if(isset($_POST["niche"])){
		$niche_filter = implode("','", $_POST["niche"]);
		$query .= "AND niche IN('".$niche_filter."')"; 
	}

	$statement  = mysqli_query($conn, $query);
	$total_row  = mysqli_num_rows($statement);
	while ($data = mysqli_fetch_assoc($statement)) {
		$result[] = $data;
	}
	
	?>
    <table id="examplew" class="table table-hover datatable">
        <thead>
            <tr>
                <!--  <th>Sl. No.</th> -->
                <th>Domain</th>
                <th>Niche</th>
                <th class="dataTable_numeric">DA</th>
                <th class="dataTable_numeric">TF</th>
                <th>Link Type</th>
                <th>Prices($)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
	if($total_row > 0){
		foreach($result as $row){
			$getNiche          = $blogMst->showBlogNichMstByName($row['niche']);
			// echo $getNiche[0][0];
			// $nicheDtls	 	   = $blogMst->showBlogNichMst($getNiche[0][0]);
			
			$nicheDtls	 	= $blogMst->showBlogNichMst($row['niche']);
			// echo $cusId; exit;
			// $BlogFavDtls 	= $blogMst->showBlogFavList($cusId, $row['blog_id']);
			$wishDtls 	= $WishList->checkWish($cusId, $row['blog_id']);
			// print_r($BlogFavDtls);exit;

		?>

            <tr>
                <td style="width: 100px;font-weight:500;"><?php echo $row['domain'] ;?></td>
                <td><?php echo $row['niche']; ?></td>
                <td class="text-center"><?php echo round($row['da']);?></td>
                <td class="text-center"><?php echo round($row['tf']);?></td>
                <td>
                    <?php echo $row['follow'] ;?>
                </td>
                <td>
                    <?php echo $row['cost'] ;?>
                </td>
                <td>
                <div class="d-flex justify-content-evenly" id="action-<?php echo $row['blog_id']?>">

                    <?php if($wishDtls == NULL || $wishDtls == 0){ ?>
                        
                    <a href="javascript:void()" id="<?php echo $row['blog_id']; ?>" class="far fa-heart text-danger"
                        title="Add this Blog to Wishlist" onclick="addWishlist(<?php echo $row['blog_id']; ?>, this)">
                    </a>
                    <?php } else{ ?>
 
                    <a href="javascript:void()" class="fas fa-heart text-danger" style="color:red"
                        title="Remove this Blog from Wishlist"
                        onclick="RemoveWishlist(<?php echo $row['blog_id']; ?>, this)">
                    </a>
                    <?php }?>
                    <a href="order-now.php?id=<?php echo $row['blog_id'] ?>" class="badge text-bg-success">
                        <span><i class="fas fa-shopping-bag"></i></span>
                        Buy
                    </a>
                </div>

                </td>
            </tr>
            <?php
		}
	}

	?>
        </tbody>
    </table>
    <?php
}

?>
 
    <script src="plugins/data-table/simple-datatables.js"></script>
    <script src="plugins/tinymce/tinymce.js"></script>
    <script src="plugins/main.js"></script>

</body>

</html>