<?php


class OrderStatus extends DatabaseConnection{



    function allStatus(){
        $data   = array();
        $sql    = "SELECT * FROM `orders_status`";
        $res    = $this->conn->query($sql);
        $rows   = $res->num_rows;
        if ($rows > 0 ) {
            while ($result = $res->fetch_array()) {
                $data[] = $result;
            }
        }
        return $data;
    }//eof


	function singleOrderStatus($id){

			$data   = array();
			$sql    = "SELECT * FROM `orders_status` WHERE `orders_status_id` = '$id'";
			$res    = $this->conn->query($sql);
			$rows   = $res->num_rows;
			if ($rows > 0 ) {
				while ($result = $res->fetch_array()) {
					$data[] = $result;
				}
			}
        return $data;
    }//eof



    /**
	*	Order name by order status
	*
	*	@param
	*			$orders_status_id			Orders status id
	*
	*	@return string
	*/
	function getOrdStatName($orders_status_id){

		//statement
		$sql = "SELECT orders_status_name FROM orders_status WHERE orders_status_id ='$orders_status_id'";
		
		$query = $this->conn->query($sql);
		
		//check if data is there
		if($query->num_rows > 0)
		{
			//fetch the data
			$result = $query->fetch_array();
			
			//hold in var
			$data 	= $result['orders_status_name'];
		}
		
		//return the data
		return $data;
		
	}//eof














}

    ?>