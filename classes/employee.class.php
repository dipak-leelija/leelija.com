<?php

class Employee extends DatabaseConnection{

    // declare table name using in this class 
    public $empTable = 'employees';
    
    public function addEmp($empId, $name, $designation, $doj, $gender, $phone, $email, $password, $added_on){

        try {
            $sql = "INSERT INTO `employees`
                            (emp_id, name, designation, doj, gender, phone, email, password, added_on) VALUES
                            ('$empId', '$name', '$designation', '$doj', '$gender', '$phone', '$email', '$password', '$added_on')";
            // echo $sql.$this->conn->error;

            $res = $this->conn->query($sql);
            return $res;
            
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        
    }


    public function allEmps(){

        $sql = "SELECT * FROM `employees` ORDER BY added_on ASC";
        $res = $this->conn->query($sql);
        $rows = $res->num_rows;
        if ($rows > 0 ) {
            while ($result = $res->fetch_object()) {
                $data[] = $result;
            }
            return $data;
        }
    }


    public function getEmpImage($empId){

        $sql = "SELECT image FROM `employees` WHERE emp_id = '$empId'";
        $res = $this->conn->query($sql);
        $rows = $res->num_rows;
        if ($rows == 1 ) {
            $result = $res->fetch_object();
            return json_encode($result);
        }
    }

    public function deleteEmp($empId){

        // first deleting the image
        $img = $this->getEmpImage($empId);
        $img = json_decode($img)->image;
        $deleted = $this->unlinkFile(EMP_IMG_DIR.$img);

        // after successfully deletion of the image 
        if ($deleted == 'SU001') {
            $sql = "DELETE FROM `employees` WHERE emp_id = '$empId'";
            $res = $this->conn->query($sql);
            if ($res == 1 ) {
                return 'SU001';
            }
        }

        return 'ER001';
    }


    function lastEmpId(){
        
        $sql = $this->conn->query("SELECT emp_id AS last_id FROM `employees` ORDER BY emp_id DESC LIMIT 1");
        $row = $sql->fetch_assoc();
        $lastInsertedID = $row['last_id'];
        return $lastInsertedID;
    }

    function empIdGenerate(){

        $idPrefex = 'LEE';

        $sql = $this->conn->query("SELECT emp_id FROM `employees`");
        while ($result = $sql->fetch_object()) {
            $numsOfId = preg_replace("/[^0-9]/", '', $result->emp_id);
            $idNumsArry[] = $numsOfId;
            sort($idNumsArry);
        }
        $lastIdNum = end($idNumsArry);
        $newEmpId = $idPrefex.$lastIdNum+1;
        return $newEmpId;
    }


    // this function van be used to delete any data from the given path
    function unlinkFile($path){
        try {
            if ($path != '') {
                if (is_file($path)) {
                    unlink($path);
                    return 'SU001';
                } else {
                    return 'ER001';
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            return 'ER002';
        }
	}
}