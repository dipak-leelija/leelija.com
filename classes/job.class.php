<?php

 
class Job extends DatabaseConnection{

  //New Job Insert
  public function newJob($post,$postDetails){
    $sql = "INSERT INTO `all_jobs`(`job_name`, `details`,`date`) VALUES ('$post','$postDetails',now())";
    $data = $this->conn->query($sql);
    $count= $this->conn->insert_id();
  }
  
  public function singleJob($id){
    $sql = "SELECT * FROM `all_jobs` WHERE `id`= '$id'";
    $data = $this->conn->query($sql);
    $count = $data->num_rows;
    $myArr = array();
    while($res= $data->fetch_object()){
      $myArr= array(
        $res->job_name,   //0
        $res->details    //1
      );
    }
      return $myArr;
  }
  public function editJob($id,$post,$postDetails){
    $sql = "UPDATE `all_jobs` SET `job_name`='$post',`details`='$postDetails',`date`=now() WHERE `id`= '$id'";
    $data = $this->conn->query($sql);
  }
  public function deletedJob($id){
    $sql = "DELETE FROM `all_jobs` WHERE `id` = '$id'";
    $data = $this->conn->query($sql);
  }

  public function jobStatus($id,$status){
    $sql = "UPDATE `job_applied` SET `action`='$status' WHERE `job_id`='$id'";
    $data = $this->conn->query($sql);
    $count = $this->conn->insert_id;
    return $count;
  }

  public function showAllPosts(){
    $sql = "SELECT * FROM `all_jobs`";
    $query = $this->conn->query($sql);
    while($res= $query->fetch_array()){
      $myArr[] = $res;
    }
    return $myArr;
  }

  public function allApplications(){
    $sql = "SELECT * FROM `job_applied`";
    $data = $this->conn->query($sql);
    $count = $data->num_rows;
    $myArr = array();
    while($res = $data->fetch_assoc()){
      $myArr[] = $res;
    }
    return $myArr;
  }

  public function deletedApplication($id){
    $sql = "DELETE FROM `job_applied` WHERE `job_id` = '$id'";
    $data = $this->conn->query($sql);
  }

  public function apply($post,$fName,$lName,$email,$phone,$cJob,$exprns,$cv){
    $sql = "INSERT INTO `job_applied`(`post`,`fname`, `lname`, `email`,`phone`, `current_status`, `expriences`, `cv`) VALUES ('$post','$fName','$lName','$email','$phone','$cJob','$exprns','$cv')";
    $data = $this->conn->query($sql);
    $insert = $this->conn->insert_id;
    if($data){
      echo "inserted";
    }
    else {
      echo "not inserted";
    }
  }

  public function alreadyApplied($email){
    $myArr = array();
    $sql = "SELECT  `email` FROM `job_applied` WHERE `email` = '$email'" ;
    $data =  $this->conn->query($sql);
    $count = $data->num_rows;
    while($res = $data->fetch_assoc()){
      $myArr[] =$res;
    }
    return $myArr;
  }

  public function applicantDetails($email){
    $sql = "SELECT * FROM `job_applied` WHERE `email` = '$email'" ;
    $data =  $this->conn->query($sql);
    $myArr = array();
    while($res = $data->fetch_object()){
      $myArr = array(
        $res->job_id,         //0
        $res->application_no, //1
        $res->post,           //2
        $res->fname,          //3
        $res->lname,          //4
        $res->email,          //5
        $res->phone,          //6
        $res->current_status, //7
        $res->expriences,     //8
        $res->cv              //9
      );
    }
    return $myArr;
  }

  public function lastID($limit){
    $sql = "SELECT * FROM `job_applied` ORDER BY `job_id` DESC LIMIT $limit";
    $data = $this->conn->query($sql);
    $myArr = array();
    $count = $data->num_rows;
    while($res= $data->fetch_assoc()){
       $myArr[] =$res;
    }
    return $myArr;
  }

  public function insertApplicationNo($email,$applicantNo){
    $sql= "INSERT INTO `job_applied`( `application_no`) VALUES ('$applicantNo')";
    $data = $this->conn->query($sql);
    $insert = $this->conn->insert_id;
  }

  public static function slug($text)
  {
    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, '-');

    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
      return 'n-a';
    }

    return $text;
  }



}
?>
