<?php 
// require_once "_config/dbconnect.php";
/**
*
*	
*
*
*	@author		Safikul Islam
*	@date		Oct 17, 2018
*	@update		
*	@version	3.0
*	@copyright	WebTechHelp
*	@url		https://webtechhelp.org
*	@email		safikulislamwb@gmail.com
* 
*/


class Employee extends DatabaseConnection{



    public function allEmps(){

        $sql = "SELECT * FROM `employees`";
        $res = $this->conn->query($sql);
        $rows = $res->num_rows;
        if ($rows > 0 ) {
            while ($result = $res->fetch_array()) {
                $data[] = $result;
            }
            return $data;
        }
    }


}