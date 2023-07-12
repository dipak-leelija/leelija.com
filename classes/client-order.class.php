<?php 

class ClientOrder extends DatabaseConnection{
      public function ClientOrderDetails($clientUserId,$clientName,$clientEmail,$clientOrderedSite,$clientTargetUrl,$clientAnchorText,$clientContent,$clientRequirement,$clientOrderPrice){

         $sql= "INSERT INTO `order_details`( `clientUserId`, `clientName`, `clientEmail`, `clientOrderedSite`, `clientTargetUrl`, `clientAnchorText`, `clientContent`, `clientRequirement`,`clientOrderPrice`) VALUES ('$clientUserId','$clientName','$clientEmail','$clientOrderedSite','$clientTargetUrl','$clientAnchorText','$clientContent','$clientRequirement','$clientOrderPrice')";
        //execute query
        $query     = $this->conn->query($sql);
        $insert_id = $this->conn->insert_id;
            return $insert_id;
      }



      public function ClientOrderDetailsUpdate($id,$tranId,$tranStatus){
            $sql= "UPDATE `order_details` SET `clientTransactionId`='$tranId',`clientOrderStatus`='$tranStatus' WHERE `id`= '$id' ";
            // echo $sql.mysql_error();
              //execute query
            $query= $this->conn->query($sql);
      }



      public function ClientOrderDetails2($clientUserId,$clientName,$clientEmail,$clientOrderedSite,$clientTargetUrl,$clientAnchorText,$clientRequirement,$clientOrderPrice){

            $sql= "INSERT INTO `order-details2`( `clientUserId`, `clientName`, `clientEmail`, `clientOrderedSite`, `clientTargetUrl`, `clientAnchorText`, `clientRequirement`, `clientOrderPrice`) VALUES ('$clientUserId','$clientName','$clientEmail','$clientOrderedSite','$clientTargetUrl','$clientAnchorText','$clientRequirement','$clientOrderPrice')";
           //execute query
           $query= $this->conn->query($sql);
         //   $insert_id= mysql_insert_id();
               return $query;
         }
   
}



?>