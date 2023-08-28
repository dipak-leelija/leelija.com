<?php

class Niche extends DatabaseConnection{
 
	/**
	*	Get the data associated with a Blog Niche master based upon the primary key
	*
	*	@param
	*			$niche_id		Niche id
	*
	*	@return array				
	*/
	function showBlogNichMst($niche_id){

		$data = array();
		$select = "SELECT * FROM niche_master WHERE niche_id = '$niche_id'";

		//execute query
		$query	= $this->conn->query($select) or die($this->conn->error());
		// echo $select.$this->conn->error;exit;
		$rows = $query->num_rows;
		// echo $rows.'<br>';
		//holds the data
		if ($rows>0) {
			while($result = $query->fetch_object()){
				$data[]  = array(
						$result->niche_id,			//0
						$result->niche_name,		//1
						$result->added_on,			//2
						$result->added_by,			//3
						$result->modified_on,		//4
						$result->modified_by		//5
						);
			}//while
		    return $data;
		}//if

	}//eof



	function showBlogNichMstByName($niche_name){

		$data = array();
		$select = "SELECT * FROM niche_master WHERE niche_name = '$niche_name'";

		//execute query
		$query	= $this->conn->query($select);
		// echo $select.$this->conn->error;exit;
		$rows = $query->num_rows;
		// echo $rows.'<br>';
		//holds the data
		if ($rows>0) {

			while($result = $query->fetch_object()){
				$data[]  = array(
						$result->niche_id,			//0
						$result->niche_name,		//1
						$result->added_on,			//2
						$result->added_by,			//3
						$result->modified_on,		//4
						$result->modified_by		//5
						);
			}//while
		    return $data;

		}//if

	}//eof

	

	//  Display Blog Niches Master
	public function ShowBlogNichMast(){
		//  $temp_arr = array();
		$res = "SELECT * FROM niche_master order by niche_name asc";
		//  $count=mysql_num_rows($res);
		$resQuery = $this->conn->query($res);

		// $rows = $res->num_rows;
		while($row = $resQuery->fetch_array()) {
            $temp_arr[] =$row;
        }
        return $temp_arr;

	}



	//  Display Blog Niches Master
	public function getBlogNichMast($niche_id){

        $temp_arr = array();
        $res = $this->conn->query("SELECT * FROM niche_master where niche_id = '$niche_id' ") or die($this->conn->error());        
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $temp_arr =$row;
            }
        }
        return $temp_arr;  
    }



	 	 //  Display Blog Niches Master limited

		  public function ShowLimitedBlog($limit){

			$temp_arr = array();

			$res = mysql_query("SELECT * FROM niche_master order by niche_name DESC LIMIT $limit") or die(mysql_error());

			$count=mysql_num_rows($res);

		   while($row = mysql_fetch_array($res)) {

				$temp_arr[] =$row;

  

			}

			return $temp_arr;

			}

  

}

?>