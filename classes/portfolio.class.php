<?php
require_once "_config/dbconnect.php";

class Portfolio extends DatabaseConnection{
  function showPortfolio(){
    $sql = "SELECT * FROM `portfolio`";
    $data = $this->conn->query($sql);
    $rows = $data->num_rows;
    while($res = $data->fetch_array()){
      $myArr[] = $res;
    }
    return $myArr;
  }

  function showLimitedPortfolio($limit){
    $sql = "SELECT * FROM `portfolio` ORDER BY `id` DESC LIMIT $limit ";
    $data = $this->conn->query($sql);
    $count = mysql_num_rows($data);
    $myArr = array();
    while($res = mysql_fetch_array($data)){
      $myArr[] = $res;
    }
    return $myArr;
  }

  function showPortfolioById($id){
    $sql = "SELECT * FROM `portfolio` WHERE `id` = '$id'";
    $data = $this->conn->query($sql);
    $count = $data->num_rows;
    $myArr = array();
    while($res = $data->fetch_array()){
      $myArr[] = $res;
    }
    return $myArr;
  }

  function showSinglePortfolio($id){
    $sql = "SELECT * FROM `portfolio` WHERE `id`= '$id'";
    $data = $this->conn->query($sql);
    $count = $data->num_rows;
    $myArr = array();
    while($res = $data->fetch_object()){
      $myArr= array(
        $res->id,             //0
        $res->portfolio_type, //1
        $res->name,           //2
        $res->url,          //3
        $res->image,    //4
        $res->title,    //5
        $res->description,           //6
        $res->date,      //7
        $res->niche     //8
      );
    }
    return $myArr;
  }

  function showSinglePortfolioType($type){
    $sql = "SELECT * FROM `portfolio` WHERE `portfolio_type`= '$type'";
    $data = $this->conn->query($sql);
    $count = $data->num_rows;
    $myArr = array();
    while($res = $data->fetch_object()){
      $myArr= array(
        $res->id,             //0
        $res->portfolio_type, //1
        $res->name,           //2
        $res->url,          //3
        $res->image,    //4
        $res->title,    //5
        $res->description,           //6
        $res->date,      //7
        $res->niche
      );
    }
    return $myArr;
  }

  public function showSinglePortfolioTypeId($type){
    $sql = "SELECT * FROM `portfolio` WHERE `portfolio_type`= '$type'";
    $data = $this->conn->query($sql);
    $count = $data->num_rows;
    $myArr = array();
    while($res = $data->fetch_array()){
      $myArr[]=$res;
    }
    return $myArr;
  }



  public function addPortfolio($type,$niche,$name,$image,$url,$title,$desc){
    $sql = "INSERT INTO `portfolio`(`portfolio_type`,`niche`, `name`,`url`,`image`, `title`, `description`,`date`) VALUES ('$type','$niche','$name','$image','$url','$title','$desc',now())";
    $data = $this->conn->query($sql);
    $count = $this->conn->insert_id;
  }

  public function updatePortfolio($id,$type,$niche,$name,$url,$image,$title,$desc){
    $sql = "UPDATE `portfolio` SET`portfolio_type`='$type',`niche`='$niche',`name`='$name',`url`='$url',`image`='$image',`title`='$title',`description`='$desc' WHERE `id` = '$id'";
    $data = $this->conn->query($sql);
  }

  public function delPortfolio($id){
    $sql = "DELETE FROM `portfolio` WHERE `id` = '$id'";
    $data = $this->conn->query($sql);
  }

  public function portSingleDetailsInsert($portType,$details){
    $sql = "INSERT INTO `portfolio_details`( `portfolio_type`, `details`) VALUES ('$portType','$details')";
    $data = $this->conn->query($sql);
    $count = $data->insert_id;
  }

  public function showPortDetails(){
    $sql = "SELECT * FROM `portfolio_details`";
    $data= $this->conn->query($sql);
    $count = $data->num_rows;
    $myArr = array();
    while($res = mysql_fetch_assoc($data)){
      $myArr[] = $res;
    }
    return $myArr;
  }
  public function showDtlsPortById($type){
    $sql = "SELECT * FROM `portfolio_details` WHERE `portfolio_type` = '$type'";
    $data = $this->conn->query($sql);
    $count = $data->num_rows;
    $myArr = array();
    while($res = $data->fetch_object()){
      $myArr= array(
        $res->id,   //0
        $res->details         //1
      );
    }
    return $myArr;
  }

  public function showDtlsPortByOnlyId($id){
    $sql = "SELECT * FROM `portfolio_details` WHERE `id` = '$id'";
    $data = $this->conn->query($sql);
    $count = $data->num_rows;
    $myArr = array();
    while($res = $data->fetch_object()){
      $myArr= array(
        $res->portfolio_type,   //0
        $res->details         //1
      );
    }
    return $myArr;
  }


  public function updateSinglePortDetails($id,$portfolio_id,$details){
    $sql = "UPDATE `portfolio_details` SET `portfolio_type`='$portfolio_id',`details`='$details' WHERE `id` = '$id'";
    $data = $this->conn->query($sql);
  }

  public function deleteSinglePortDtls($id){
    $sql = "DELETE FROM `portfolio_details` WHERE `id` = '$id'";
    $data = $this->conn->query($sql);
  }
  function showPortfolioDetailsById($portId){
    $sql = "SELECT * FROM `portfolio_details` WHERE `portfolio_type` = '$portId'";
    $data = $this->conn->query($sql);
    $count = $data->num_rows;
    $myArr = array();
    while($res = $data->fetch_array()){
      $myArr[] = $res;
    }
    return $myArr;
  }

}

 ?>
