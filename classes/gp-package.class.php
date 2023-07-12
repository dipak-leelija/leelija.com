<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



class GuestPostpackage extends DatabaseConnection{


    ######################################################################################################
    #                                                                                                    #
    #                                           gp_pagkage                                               #
    #                                                                                                    #
    ######################################################################################################
    
    function insertNewPackage($pack,$price,$num,$quyality,$linkType,$words,$da,$tf,$cf){
        $sql="INSERT INTO `gp_package`( `package_type`, `price`, `gp_number`, `blog_quality`, `link_type`, `words_count`, `DA`, `TF`, `CF`) VALUES ('$pack','$price','$num','$quyality','$linkType','$words','$da','$tf','$cf')";
        $data= $this->conn->query($sql);
        $count = $this->conn->insert_id();
        //echo $sql.mysql_error();
      }
  

   
    public function allPackages(){
        $res = "SELECT * FROM `gp_package` ORDER BY `id`";
        $query = $this->conn->query($res);
        while($row = $query->fetch_array()) {
            $myArr[] =$row;
  
        }
        return $myArr;
    }
    
  
    function packDetailsById($id){
        $sql = "SELECT * FROM `gp_package`  where `id`= '$id'";
        $data = $this->conn->query($sql);
        $myArr = array();
        while($res = $data->fetch_object()){
          $myArr = array(
            $res->id,               //0
            $res->package_type,     //1
            $res->price,            //2
            $res->blog_post,        //3
          );
        }
        return $myArr;
    }
  
  
  
  
  
  
      function updatePack($id,$pack,$price,$num,$quyality,$linkType,$words,$da,$tf,$cf){
        $sql = "UPDATE `gp_package` SET `package_type`='$pack',`price`='$price',`gp_number`='$num',`blog_quality`='$quyality',`link_type`='$linkType',`words_count`='$words',`DA`='$da',`TF`='$tf',`CF`='$cf' WHERE `id`= '$id'";
        $data = $this->conn->query($sql);
      }
  
     
      function singlePackageDetails($package){

          $myArr = array();
          $sql = "SELECT * FROM `gp_package`  where `package_type`= '$package'";
          $res = $this->conn->query($sql);
          while($result = $res->fetch_array()){
            $myArr = $result;
          }
        return $myArr;
      }



    function delPack($id){
        $sql = "DELETE FROM `gp_package` WHERE `id`='$id'";
        $data = $this->conn->query($sql);
    }
  









    ######################################################################################################
    #                                                                                                    #
    #                                           gp_package_features                                      #
    #                                                                                                    #
    ######################################################################################################
     




    // function addPackageFeature($pack,$price,$num,$quyality,$linkType,$words,$da,$tf,$cf){
    //     $sql="INSERT INTO `gp_package_features`( `package_type`, `price`, `gp_number`, `blog_quality`, `link_type`, `words_count`, `DA`, `TF`, `CF`) VALUES ('$pack','$price','$num','$quyality','$linkType','$words','$da','$tf','$cf')";
    //     $data= $this->conn->query($sql);
    //     $count = $this->conn->insert_id();
    //     //echo $sql.mysql_error();
    //   }
  

   
    function featureById($gppackageId){
        $res = "SELECT * FROM `gp_package_features` WHERE `id` = '$gppackageId' ORDER BY `id`";
        $query = $this->conn->query($res);
        while($row = $query->fetch_array()) {
            $myArr[] =$row;
  
        }
        return $myArr;
    }
    
  
  
    function featureByPackageId($gppackagetype){
        $res = "SELECT * FROM `gp_package_features` WHERE `gp_package_id` = '$gppackagetype' ORDER BY `id`";
        $query = $this->conn->query($res);
        while($row = $query->fetch_array()) {
            $myArr[] =$row;
        }
        return $myArr;
    }

  //   function featureByPackageType($gppackagetype){
  //     $res = "SELECT * FROM `gp_package_features` WHERE `gp_package_id` = '$gppackagetype' ORDER BY `id`";
  //     $query = $this->conn->query($res);
  //     while($row = $query->fetch_array()) {
  //         $myArr[] =$row;
  //     }
  //     return $myArr;
  // }
  
  
    //   function updateFeature($id,$pack,$price,$num,$quyality,$linkType,$words,$da,$tf,$cf){
    //     $sql = "UPDATE `gp_package_features` SET `package_type`='$pack',`price`='$price',`gp_number`='$num',`blog_quality`='$quyality',`link_type`='$linkType',`words_count`='$words',`DA`='$da',`TF`='$tf',`CF`='$cf' WHERE `id`= '$id'";
    //     $data = $this->conn->query($sql);
    //   }
  
     


    // function delFeature($id){
    //     $sql = "DELETE FROM `gp_package_features` WHERE `id`='$id'";
    //     $data = $this->conn->query($sql);
    // }
  




}

 ?>