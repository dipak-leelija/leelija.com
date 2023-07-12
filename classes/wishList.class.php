<?php

class WishList extends DatabaseConnection{




      //  public function addToWish($domainName,$blog_id,$niche,$da,$tf,$linktype,$price){
	  // 	$sql = "INSERT INTO `wishlist_buyer`( `domain_name`,`blog_id`,`siteNiche`, `siteDa`, `siteTf`, `siteLinkType`, `sitePrice`) VALUES ('$domainName','$blog_id','$niche','$da','$tf','$linktype','$price')";
	  // 	//execute query
	  // 	$query	= mysql_query($sql);
	 
	  // 	$insert_id = mysql_insert_id();
	  // 	return $insert_id;
		
	  //  }
  



    public function newWish($userId, $blogId){

        $sql = "INSERT INTO `wishlist_buyer`( `userid`,`blog_id`) VALUES ('$userId','$blogId')";
        $query	= $this->conn->query($sql);
        
        return $query;
  
    }//eof



	

    public function showUserWishes($user){
        $temp_arr = array();
        $sql 		= "SELECT * FROM `wishlist_buyer` INNER JOIN blog_mst ON wishlist_buyer.blog_id = blog_mst.blog_id WHERE 				`userId`='$user'";
        $query	= $this->conn->query($sql);
        $rows		= $query->num_rows;
        
        while($row = $query->fetch_array()) {
                 $temp_arr[] =$row;
        }
        return $temp_arr;
    }//eof



    

    public function checkWish($userId, $blogId){
        $sql = "SELECT * FROM `wishlist_buyer` WHERE `userId`='$userId' AND `blog_id` ='$blogId'";
        $query	= $this->conn->query($sql);
        $count = $query->num_rows;

        if($count > 0){
            while($row = $query->fetch_array()) {
                $temp_arr[] = $row;
            }
            return $temp_arr;
        }else{
            return false;
        }
    }//eof




    public function wishListAllData($userId){

        $temp_arr = array();
        $sql = "SELECT * FROM `wishlist_buyer` WHERE `userId` = '$userId'";
        // echo $sql;
        $res = $this->conn->query($sql);
        $row = $res->num_rows;
        if ($row > 0) {
            while($result = $res->fetch_array()) {
                $temp_arr[] = $result;
            }
        }
        return $temp_arr;
      
    }//eof



    

    public function removeWish($user, $blog){

        $sql = "DELETE FROM `wishlist_buyer` WHERE `userId`='$user' AND `blog_id` ='$blog'";
        $query	= $this->conn->query($sql);
        // echo($query);
        if($query){
            return true;
        }else{
            return false;
        }

    }//eof




    public function wishLisSingleDataShow($id){
        //declare vars
        $data = array();
        $sql = "SELECT * FROM `wishlist_buyer` WHERE `id` = '$id'";
        //execute query
        $query = mysql_query($sql);
        while( $result = mysql_fetch_object($query)) {

            $data = array(

                $result->domain_name,       //0
                $result->siteNiche,         //1
                $result->siteDa,            //2
                $result->siteTf,            //3
                $result->siteLinkType,      //4
                $result->sitePrice,         //5
            );
        }

        return   $data;

    }//eof




    public function wishLiSingleData($id){
        $temp_arr = array();
        $res = mysql_query("SELECT * FROM `wishlist_buyer` INNER JOIN blog_mst ON wishlist_buyer.blog_id=blog_mst.blog_id   WHERE `id`='$id' ") or die(mysql_error());
        $count=mysql_num_rows($res);
        while($row = mysql_fetch_array($res)) {
            $temp_arr[] =$row;
        }
        return $temp_arr;
    

    }//eof
}
?>