<?php
 
?>
<?php
    class Customer{
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function customerReg($data){
            $name = mysqli_real_escape_string( $this->db->link, $data["name"] );
            $email = mysqli_real_escape_string( $this->db->link, $data["email"] );  
            $password = mysqli_real_escape_string( $this->db->link, $data["pass"] );
            $city = mysqli_real_escape_string( $this->db->link, $data["city"] );
            $zip = mysqli_real_escape_string( $this->db->link, $data["zip"] );
            $country = mysqli_real_escape_string( $this->db->link, $data["country"] );
            $address = mysqli_real_escape_string( $this->db->link, $data["address"] );
            $phone = mysqli_real_escape_string( $this->db->link, $data["phone"] );
            
            if(empty($name) || empty($email) || empty($password) || empty($city) || empty($zip) || empty($country) || empty($address) || empty($phone)){
                $msg = "<div style='color:red;font-size:18px;'><strong>Field must not be empty !! </strong></div>";
            
                return $msg;
            }

            $mailquery = "SELECT *FROM tbl_customer WHERE email = '$email' LIMIT 1";
            $mailchk = $this->db->select($mailquery);
            if($mailchk != false){
                $msg = "<div style='color:red;font-size:18px;'><strong>Email already exist !! </strong></div>";
                return $msg;
            }
            else{
                $query = "INSERT INTO tbl_customer(name,address,city,country,zip,phone,email,pass) VALUES('$name','$address','$city','$country','$zip','$phone','$email','$password')";
                $res = $this->db->insert($query);
                if($res!=false){
                    $pdmsg = "<div style='color:green;font-size:18px;'><strong>Data Inserted Successfully !! </strong></div>";
                    return $pdmsg;
                }
                else{
                    $pdmsg = "<div style='color:red;font-size:18px;'><strong>Something went wrong !! </strong></div>";
                    return $pdmsg;
                }
            }

        }

        public function customerLog($data){
            $email = mysqli_real_escape_string( $this->db->link, $data["email"] );  
            $password = mysqli_real_escape_string( $this->db->link, $data["pass"] );

            if(empty($email) || empty($password) ){
                $msg = "<div style='color:red;font-size:18px;'><strong>Field must not be empty !! </strong></div>";
                return $msg;
            }

            $logquery = "SELECT *FROM tbl_customer WHERE email = '$email' AND pass='$password' ";
            $logchk = $this->db->select($logquery);
            if($logchk != false){
                $value = $logchk->fetch_assoc();
                Session::set("cuslogin",true);
                Session::set("cusname",$value['name']);
                Session::set("cusid",$value['id']);
                header('Location:order.php');
            }

        }


        //get customer data by id
        public function customer_data_by_id($id){
            $query = "SELECT *FROM tbl_customer WHERE id = '$id' ";
            $res = $this->db->select($query);
            return $res;
            
        }

        //Update Customer Profile

        public function updateCus($data,$id){
            $name = mysqli_real_escape_string( $this->db->link, $data["name"] );
            $email = mysqli_real_escape_string( $this->db->link, $data["email"] );  
            
            $city = mysqli_real_escape_string( $this->db->link, $data["city"] );
            $zip = mysqli_real_escape_string( $this->db->link, $data["zip"] );
            $country = mysqli_real_escape_string( $this->db->link, $data["country"] );
            $address = mysqli_real_escape_string( $this->db->link, $data["address"] );
            $phone = mysqli_real_escape_string( $this->db->link, $data["phone"] );
            
            if(empty($name) || empty($email) || empty($city) || empty($zip) || empty($country) || empty($address) || empty($phone)){
                $msg = "<div style='color:red;font-size:18px;'><strong>Field must not be empty !! </strong></div>";
            
                return $msg;
            }
            else{
                $query = "UPDATE tbl_customer SET 
                name = '$name',
                email = '$email',
                phone = '$phone',
                country = '$country',
                city = '$city',
                address = '$address',
                zip = '$zip'
                WHERE id = '$id' ";

                $upd = $this->db->update($query);
                if($upd){
                    $msg = "<div style='color:green;font-size:18px;'><strong>Data Updated Successfully !! </strong></div>";
                    return $msg;
                }
                else{
                    $msg = "<div style='color:red;font-size:18px;'><strong>Something Went Wrong !! </strong></div>";
                    return $msg;
                }
            }
        }

    }