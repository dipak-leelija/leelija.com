<?php 

class ContentOrder extends DatabaseConnection{



      function showOrderdContentsByCol($column, $value, $andCol, $andvalue){
            // $data = array();
            if ($andCol == null || $andvalue == null) {
                  $sql  = "SELECT * FROM `order_details` WHERE `$column` = '$value'";
            }else {
                  $sql  = "SELECT * FROM `order_details` WHERE `$column` = '$value' AND `$andCol` = '$andvalue'";
            }
            // echo $sql;
            $res  = $this->conn->query($sql);
            $rows = $res->num_rows;
            if ($rows > 0 ) {
                  while ($result = $res->fetch_array()) {
                        $data[] = $result;
                  }
            }
            return $data;

      }//eof






      function activeOrders(){

            $data = array();
            $sql  = "SELECT * FROM `order_details` WHERE `clientOrderStatus` >=0";
            // echo $sql;
            $res  = $this->conn->query($sql);
            $rows = $res->num_rows;
            if ($rows > 0) {
                  while ($result = $res->fetch_array()) {
                        $data[] = $result;
                  }
            }
            return $data;

      }//eof






      function showAllOrderdContents(){

            $data = array();
            $sql  = "SELECT * FROM `order_details`";
            $res  = $this->conn->query($sql);
            $rows = $res->num_rows;
            if ($rows > 0 ) {
                  while ($result = $res->fetch_array()) {
                        $data[] = $result;
                  }
            }
            return $data;

      }//eof




      /**
       * @param $id = table `id` of tha table
       */
      function clientOrderById($id){

            $data = array();
            $sql  = "SELECT * FROM `order_details` WHERE `id` = '$id'";
            $res  = $this->conn->query($sql);
            $rows = $res->num_rows;
            if ($rows > 0 ) {
                  while ($result = $res->fetch_array()) {
                        $data[] = $result;
                  }
            }
            return $data;

      }//eof




      function clientOrders($userId){

            $data = array();
            $sql  = "SELECT * FROM `order_details` WHERE `clientUserId` = '$userId' ORDER BY `id` DESC";
            $res  = $this->conn->query($sql);
            $rows = $res->num_rows;
            if ($rows > 0 ) {
                  while ($result = $res->fetch_array()) {
                        $data[] = $result;
                  }
            }
            return $data;

      }//eof



 



      /**
       * @param $contentsId    = table `id`
       * @param $tranId        = table `clientTransactionId`
       * @param $pymntStatus   = table `paymentStatus`
       * @param $orderStatus   = table `clientOrderStatus`
       * 
       */
      function contentOrderStatusUpdate($orderId, $tranId, $pymntStatus, $orderStatus){

            $sql= "UPDATE `order_details`
                  SET
                  `clientTransactionId`   = '$tranId',
                  `paymentStatus`         = '$pymntStatus',
                  `clientOrderStatus`     = '$orderStatus'
                  WHERE `id` = '$orderId' ";
            // echo $sql.$this->conn->error;
            $query = $this->conn->query($sql);

            return $query;

      }//eof




      // ========================================================================================================================
      // ========================================================================================================================
      // ========================================================================================================================
      // ========================================================================================================================
      // ========================================================================================================================



      public function contentOrderDetails($clientUserId, $clientName, $clientEmail, $clientOrderedSite, $clientTargetUrl, $clientAnchorText, $clientContent, $clientRequirement, $clientOrderPrice, $orderStatus){

 
            // $clientTargetUrl        = str_replace("<", "&lt", str_replace(">", "&gt;", str_replace("'", "\\", $clientTargetUrl)));
            $clientAnchorText       = str_replace("<", "&lt", str_replace(">", "&gt;", str_replace("'", "\\", $clientAnchorText)));
            $clientContent          = str_replace("<", "&lt", str_replace(">", "&gt;", str_replace("'", "\\", $clientContent)));
            $clientRequirement      = str_replace("<", "&lt", str_replace(">", "&gt;", str_replace("'", "\\", $clientRequirement)));





            $sql = "INSERT INTO `order_details` ( `clientUserId`, `clientName`, `clientEmail`, `clientOrderedSite`, `clientTargetUrl`, `clientAnchorText`, `clientContent`, `clientRequirement`,`clientOrderPrice`, `clientOrderStatus`) VALUES ('$clientUserId','$clientName','$clientEmail','$clientOrderedSite','$clientTargetUrl','$clientAnchorText','$clientContent','$clientRequirement','$clientOrderPrice', '$orderStatus')";
            // echo $sql;
            $query = $this->conn->query($sql);
            $insert_id= $this->conn->insert_id;

            return $insert_id;

      }//eof



      public function ClientOrderDetailsUpdate($id,$tranId,$tranStatus){

            $sql= "UPDATE `order_details`
                                    SET
                                    `clientTransactionId`   ='$tranId',
                                    `clientOrderStatus`     ='$tranStatus'
                                    WHERE
                                    `id`  = '$id' ";
            // echo $sql.$this->conn->error;
            $query = $this->conn->query($sql);

            return $query;

      }//eof



      function ClientOrderContentUpdate($orderId, $clientAnchorText, $clientTargetUrl, $clientContent, $clientRequirement){

            $clientAnchorText       = str_replace("<", "&lt", str_replace(">", "&gt;", str_replace("'", "\\", $clientAnchorText)));
            $clientContent          = str_replace("<", "&lt", str_replace(">", "&gt;", str_replace("'", "\\", $clientContent)));
            $clientRequirement      = str_replace("<", "&lt", str_replace(">", "&gt;", str_replace("'", "\\", $clientRequirement)));

            $sql= "UPDATE `order_details` 
                                    SET 
                                    `clientAnchorText`      ='$clientAnchorText',
                                    `clientTargetUrl`       ='$clientTargetUrl',
                                    `clientContent`         ='$clientContent',
                                    `clientRequirement`     ='$clientRequirement'
                                    WHERE 
                                    `id`= '$orderId'";
            // echo $sql.$this->conn->error;
            $query = $this->conn->query($sql);

            return $query;

      }//eof



      function ClientOrderOrderUpdate($orderId, $orderStatus, $column, $columnData ){

            if ($column == null) {
                  
                  $sql= "UPDATE `order_details` 
                                          SET 
                                          `clientOrderStatus`      ='$orderStatus'
                                          WHERE 
                                          `id`= '$orderId'";
                  $query = $this->conn->query($sql);
                  
                  return $query;
            }else {
                  $sql= "UPDATE `order_details` 
                                          SET 
                                          `clientOrderStatus`      ='$orderStatus',
                                          `$column`                ='$columnData'
                                          WHERE 
                                          `id`= '$orderId'";
                                          // echo $sql;
                  $query = $this->conn->query($sql);
                  
                  return $query;
            }
      }



      public function ClientOrderDetails2($clientUserId,$clientName,$clientEmail,$clientOrderedSite,$clientTargetUrl,$clientAnchorText,$clientRequirement,$clientOrderPrice){

            $sql= "INSERT INTO `order-details2`( `clientUserId`, `clientName`, `clientEmail`, `clientOrderedSite`, `clientTargetUrl`, `clientAnchorText`, `clientRequirement`, `clientOrderPrice`) VALUES ('$clientUserId','$clientName','$clientEmail','$clientOrderedSite','$clientTargetUrl','$clientAnchorText','$clientRequirement','$clientOrderPrice')";
           
            $query= $this->conn->query($sql);
            // $insert_id= $this->conn->insert_id;

               return $query;

         }//eof

   
}



?>