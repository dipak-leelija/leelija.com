<?php

class WishList extends DatabaseConnection{

    public function newWish($userId, $item){
        try {
        $sql = "INSERT INTO `wishlist`( `userid`,`item_id`) VALUES ('$userId','$item')";
        $query	= $this->conn->query($sql);
        if ($query == 1) {
            return true;
        }
        return false;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
  
    }//eof



	

    public function showUserWishes($user){
        $temp_arr = array();
        $sql 		= "SELECT * FROM `wishlist` INNER JOIN blog_mst ON wishlist.item_id = blog_mst.blog_id WHERE 				`userId`='$user'";
        $query	= $this->conn->query($sql);
        $rows		= $query->num_rows;
        
        while($row = $query->fetch_array()) {
                 $temp_arr[] =$row;
        }
        return $temp_arr;
    }//eof



    

    public function checkWish($userId, $blogId){
        $sql = "SELECT * FROM `wishlist` WHERE `userId`='$userId' AND `item_id` ='$blogId'";
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
        $sql = "SELECT * FROM `wishlist` WHERE `userId` = '$userId'";
        // echo $sql;
        $res = $this->conn->query($sql);
        $row = $res->num_rows;
        if ($row > 0) {
            while($result = $res->fetch_assoc()) {
                $temp_arr[] = json_encode($result);
            }
        }
        return $temp_arr;
      
    }//eof



    

    public function removeWish($user, $blog){

        $sql = "DELETE FROM `wishlist` WHERE `userId`='$user' AND `item_id` ='$blog'";
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