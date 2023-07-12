<?php 

class GpOfferList extends DatabaseConnection{


    public function getGpOfferList(){
      $res = "SELECT * FROM `gp_offer_list` ORDER BY `id`";
      $query = $this->conn->query($res);
      while($row = $query->fetch_array()) {
          $myArr[] =$row;

      }
      return $myArr;
    }


    public function offerGPById($id){
        $res = "SELECT * FROM `gp_offer_list` WHERE `id` = '$id'";
        $query = $this->conn->query($res);
        while($row = $query->fetch_array()) {
            $myArr[] =$row;
  
        }
        return $myArr;
      }
  

    // public function packDetailsById($id){
    //   $sql = "SELECT * FROM `gp_package`  where `id`= '$id'";
    //   $data = $this->conn->query($sql);
    //   $myArr = array();
    //   while($res = $data->fetch_object()){
    //     $myArr = array(
    //       $res->package_type,        //0
    //       $res->price,    //1
    //       $res->gp_number, //2
    //       $res->blog_quality,    //3
    //       $res->link_type,  //4
    //       $res->words_count,           //5
    //       $res->DA,           //6
    //       $res->TF,           //7
    //       $res->CF, //8
    //     );
    //   }
    //     return $myArr;
    // }




    // public function insertNewPackage($pack,$price,$num,$quyality,$linkType,$words,$da,$tf,$cf){
    //   $sql="INSERT INTO `gp_package`( `package_type`, `price`, `gp_number`, `blog_quality`, `link_type`, `words_count`, `DA`, `TF`, `CF`) VALUES ('$pack','$price','$num','$quyality','$linkType','$words','$da','$tf','$cf')";
    //   $data= mysql_query($sql);
    //   $count = mysql_insert_id();
    //   //echo $sql.mysql_error();
    // }



    // public function updatePack($id,$pack,$price,$num,$quyality,$linkType,$words,$da,$tf,$cf){
    //   $sql = "UPDATE `gp_package` SET `package_type`='$pack',`price`='$price',`gp_number`='$num',`blog_quality`='$quyality',`link_type`='$linkType',`words_count`='$words',`DA`='$da',`TF`='$tf',`CF`='$cf' WHERE `id`= '$id'";
    //   $data = mysql_query($sql);
    // }

    // public function delPack($id){
    //   $sql = "DELETE FROM `gp_package` WHERE `id`='$id'";
    //   $data = mysql_query($sql);
    // }

    // public function singlePackageDetails($package){
    //     $sql = "SELECT * FROM `gp_package`  where `package_type`= '$package'";
    //     // $data = mysql_query($sql);
    //     $data = $this->conn->query($sql);
    //     // $myArr = array();
    //     while($res = $data->fetch_object()){
    //       $myArr = array(
    //         $res->price,        //0
    //         $res->gp_number,    //1
    //         $res->blog_quality, //2
    //         $res->link_type,    //3
    //         $res->words_count,  //4
    //         $res->DA,           //5
    //         $res->TF,           //6
    //         $res->CF,           //7
    //         $res->package_type, //8
    //         $res->id            //9
    //       );
    //     }
    //       return $myArr;
    // }

    // public function insertOrder($package,$niche,$customerID,$name,$email,$addrs,$zip,$cuntry,$notes,$paymentType,$status){
    //     $sql   = "INSERT INTO `gp_package_order`(`package_id`, `niche`,`customer_id`, `name`, `email`, `address`, `zipCode`, `countries_id`, `notes`,`date`,`payment_type`, `status`) VALUES ('$package','$niche','$customerID','$name','$email','$addrs','$zip','$cuntry','$notes',now(), '$paymentType''$status')";
    //     $data  = mysql_query($sql);
    //     $count = mysql_insert_id();
    //     // if($data){
    //     //   echo 'Success';
    //     //   $_SESSION['order-id'] = $count;
    //     // }
    //     // else{
    //     //   echo 'failed';
    //     // }
    // }

    // public function insertPackageOrder($packageId,$niche,$customerID,$name,$email,$addrs,$zip,$cuntry,$notes,$paymentType,$transection_id,$cc_ordered_key,$status){
    //     $sql ="INSERT INTO `gp_package_order`(`package_id`, `niche`, `customer_id`, `name`, `email`, `address`, `zipCode`, `countries_id`, `notes`, `date`, `payment_type`,`transection_id`,`cc_ordered_key`,`order_status`) VALUES ('$packageId','$niche','$customerID','$name','$email','$addrs','$zip','$cuntry','$notes',now(),'$paymentType','$transection_id','$cc_ordered_key','$status')";
    //     // echo $sql.mysql_error();exit;
    //     $data  = $this->conn->query($sql);
    //     $count = $this->conn->insert_id;
    //     return $count;
    //     // ini_set('display_errors', 1);
    //     // ini_set('display_startup_errors', 1);
    //     // error_reporting(E_ALL);
    // }



    // function gpOrderById($orderId){
    //   $sql = "SELECT * FROM `gp_package_order` WHERE `order_id`= '$orderId'";
    //   $res = $this->conn->query($sql);
    //   if ($res->num_rows > 0) {
    //     while ($data = $res->fetch_array()) {
    //       $order[] = $data;
    //     }
    //     return $order;
    //   }
    // }


    // function successPayment($order_id, $transectionId, $paymentMode, $paymentStatus, $order_status){
    //   $sql = "UPDATE `gp_package_order` 
    //           SET 
    //           `transection_id` = '$transectionId',
    //           `payment_type`   = '$paymentMode',
    //           `order_status`   = '$order_status',
    //           `status`         = '$paymentStatus'
    //           WHERE 
    //           `order_id`= '$order_id'";

    //   $data = $this->conn->query($sql);
    //   if($data){
    //     return 1;
    //   }else {
    //     return 0;
    //   }
    //   //echo $sql.mysql_error();
    // }





  // public function ccavnuDonePay($orderId,$packageId,$orderStatus){
  //   $sql   = "INSERT INTO `gp_package_order`(`package_id`, `niche`,`customer_id`, `name`, `email`, `address`, `zipCode`, `countries_id`, `notes`,`date`,`payment_type`, `status`) VALUES ('$package','$niche','$customerID','$name','$email','$addrs','$zip','$cuntry','$notes',now(), '$paymentType''$status')";
  //   $data  = mysql_query($sql);
  //   $count = mysql_insert_id();
  //   if($data){
  //     echo 'Success';
  //     $_SESSION['order-id'] = $count;
  //   }
  //   else{
  //     echo 'failed';
  //   }
  // }







  // public function successCcAvnPayment($orderId,$key,$status){
  //   $sql = "UPDATE `gp_package_order` SET `cc_ordered_key`= '$key',`status`='$status' WHERE `order_id`= '$orderId'";
  //   $data = mysql_query($sql);
  //   if($data){
  //     return 1;
  //   }
  //   else {
  //     return 0;
  //   }
  //   //echo $sql.mysql_error();
  // }


//   public function getAllOrderDetails(){
//     $sql = "SELECT * FROM `gp_package_order`";
//     $data = mysql_query($sql);
//     $myArr = array();

//     while($res = mysql_fetch_assoc($data)){
//       $myArr[]= $res;
//     }
//     return $myArr;

//   }

//   public function getOrderDetails($userId){
//     $sql = "SELECT * FROM `gp_package_order` WHERE `customer_id`='$userId'";
//     $data = $this->conn->query($sql);
//     $myArr = array();
//     while($res = $data->fetch_object()){
//         $myArr = array(
//         $res->package_id, //0
//         $res->niche,      //1
//         $res->name,       //2
//         $res->email,      //3
//         $res->address,    //4
//         $res->zipCode,    //5
//         $res->countries_id,//6
//         $res->notes,      //7
//         $res->date,       //8
//         $res->transection_id,//9
//         $res->status,      //10
//         $res->order_status //11
//       );
//     }
//     return $myArr;
//   }

//   public function insertPackOrder($orderId,$key,$link,$text){
//       $sql ="INSERT INTO `gp_package_order_details`(`pack_order_id`, `anchor_text`, `anchor_link`, `comment`, `added_on`, `modified_on`) VALUES ('$orderId','$key','$link','$text',now(),now())";
//       $data = mysql_query($sql);
//       $count = mysql_insert_id();
//   }

  // public function updatePaymentDetails($orderId, $paymentMode, $trackId,$status,$orderStatus){

  //   $sql = "UPDATE 
  //         `gp_package_order` 
  //         SET 
  //         `payment_type`,   = '$paymentMode',
  //         `cc_ordered_key`  = '$trackId',
  //         `status`          = '$status',
  //         `order_status`    = '$orderStatus'
  //         WHERE 
  //         `order_id` = '$orderId'";

  //   $data = mysql_query($sql);
  // }



//   function ccavTrackingInsert($orderId, $trackId){
//     $sql = "UPDATE  `gp_package_order` SET `cc_ordered_key` = '$trackId' WHERE `order_id` = '$orderId'";
//     $res = $this->conn->query($sql);
//     return $res;
//   }

}

 ?>
