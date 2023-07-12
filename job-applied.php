<?php
session_start();

require_once("_config/dbconnect.php");
require_once("classes/job.class.php");

$newApply = new Job();

/* Getting file name */
$filename = $_FILES['cvUpload']['name'];
$file = time().basename($filename);
/* Location */
$location = "./uploaded_cv/".$file;
$uploadOk = 1;

if($uploadOk == 0){
   echo 0;
}else{
   /* Upload file */
   $uploadLocation = move_uploaded_file($_FILES['cvUpload']['tmp_name'], $location);
   if($uploadLocation){
      echo 1;
   }else{
      echo 0;
   }
}

if(isset($_GET['fname']) && isset($_GET['lname'])    && isset($_GET['email'])    &&
isset($_GET['phone'])    &&  isset($_GET['job'])      && isset($_GET['exprience'])&&
isset($_GET['post']) ){
  $fName  = $_GET['fname'];
  $lName  = $_GET['lname'];
  $email  = $_GET['email'];
  $phone  = $_GET['phone'];
  $job    = $_GET['job'];
  $exprns = $_GET['exprience'] ;
  $cv     = $_GET['cv'] ;
  $post   = $_GET['post'];
}

if(empty($alreadyApllied) == $email){
  $jobInsert =  $newApply->apply($post,$fName,$lName,$email,$phone,$job,$exprns,$file);


$applicantUniqueNo = "Leelija-012020000".print_r($jobInsert);

   $to = $email;
   $subject = "Application for the post of ".$post;
   $txt = "Thank You for your application for the role ".$post.". Please Keep Your Application No. <b>: ".$applicantUniqueNo."</b> for further Process. We will be back to you very soon";

 // Always set content-type when sending HTML email
 $headers = "MIME-Version: 1.0" . "\r\n";
 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

 // More headers
 $headers .= 'From: Leelija Web  Solutions Pvt. Ltd.<webmaster@example.com>' . "\r\n";
 $headers .= 'Cc: myboss@example.com' . "\r\n";

 $sendMail = mail($to,$subject,$txt,$headers);

}
else{
  echo "existed";
}
