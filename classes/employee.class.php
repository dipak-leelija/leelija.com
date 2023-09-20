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

    // public function getEmpById($empId) {
    //     $data = array(); // Initialize an array to store the data
    
    //     // Prepare the SQL query with a WHERE clause to select a specific employee by emp_id
    //     $sql = "SELECT * FROM `employees` WHERE emp_id = ?";
    //     $stmt = $this->conn->prepare($sql);
    //     if (!$stmt) {
    //         return json_encode(array('error' => 'Error preparing SQL statement: ' . $this->conn->error));
    //     }
    
    //     // Bind the emp_id parameter
    //     $stmt->bind_param("s", $empId);
        
    //     // Execute the query
    //     $stmt->execute();
    //     $res = $stmt->get_result();
    
    //     if ($res->num_rows > 0) {
    //         // Fetch the data for the specific employee
    //         $result = $res->fetch_object();
    //         $data['status'] = true;
    //         $data['message'] = "Customer data retrieved successfully.";
    //         $data['employee'] = $result;
    //     } else {
    //         $data['status'] = false;
    //         $data['message'] = "Customer not found.";
    //         $data['employee'] = '';
    //     }
    
    //     // Close the statement
    //     $stmt->close();
    
    //     // Convert the data to JSON format
    //     return json_encode($data);
    // }

    public function getEmpById($empId) {
        // Initialize an array to store the data
        $data = array();
    
        // Prepare the SQL query with a LEFT JOIN to select data from both tables
        $sql = "SELECT employees.*, employee_address.*, employee_address.updated_on AS address_update 
                FROM `employees`
                LEFT JOIN `employee_address`
                ON employees.emp_id = employee_address.emp_id
                WHERE employees.emp_id = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            return json_encode(array('error' => 'Error preparing SQL statement: ' . $this->conn->error));
        }
    
        // Bind the emp_id parameter
        $stmt->bind_param("s", $empId);
    
        // Execute the query
        $stmt->execute();
        $res = $stmt->get_result();
    
        if ($res->num_rows > 0) {
            // Fetch the data for the specific employee
            $result = $res->fetch_assoc();
            $data['status'] = true;
            $data['message'] = 'Employee data retrive successfuly.';
            $data['employee'] = $result;
        } else {
            $data['status'] = false;
            $data['message'] = 'Employee data not found.';
        }
    
        // Close the statement
        $stmt->close();
    
        // Convert the data to JSON format
        return json_encode($data);
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
        $this->unlinkFile(EMP_IMG_DIR.$img);

        /**
         * it will execute if the image is not even exist or not delete
         */
        $sql = "DELETE FROM `employees` WHERE emp_id = '$empId'";
        $res = $this->conn->query($sql);
        if ($res == 1 ) {
            return 'SU001';
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

    function featuredEmp($limit){

        $sql = "SELECT name, emp_id, image FROM `employees` ORDER BY RAND() LIMIT $limit";
        $query  = $this->conn->query($sql);
        if ($query->num_rows > 0) {
            while ($data = $query->fetch_assoc()) {
                $response[] = $data;
            }
            return json_encode($response);
        }
        return;
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