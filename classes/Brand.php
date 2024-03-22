<?php
  
?>
<?php
    class Brand{
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function addBrand($brandName){
            $brandName = $this->fm->validation($brandName);
            $brandName = mysqli_real_escape_string($this->db->link,$brandName);

            if(empty($brandName)){
                $brndmsg = "<div style='color:red;font-size:18px;'><strong>Field must not be empty !! </strong></div>";
                return $brndmsg;
            }
            else{
                $query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
                $res = $this->db->insert($query);
                if($res){
                    $brndmsg = "<div style='color:green;font-size:18px;'><strong>Category Name Inserted Successfully !! </strong></div>";
                    return $brndmsg;
                }
                else{
                    $brndmsg = "<div style='color:red;font-size:18px;'><strong>Something went wrong !! </strong></div>";
                    return $brndmsg;
                }
            }
        }


        public function brandList(){
            $query = "SELECT *FROM tbl_brand ORDER BY brandId DESC";
            $res = $this->db->select($query);
            return $res;
        }

        public function brandListId($id){
            $query = "SELECT *FROM tbl_brand WHERE brandId = '$id' ";
            $res = $this->db->select($query);
            return $res;
        }

        public function brandUpdate($id,$name){
            $name = $this->fm->validation($name);
            $name = mysqli_real_escape_string($this->db->link,$name);

            if(empty($name)){
                $brndmsg = "<div style='color:red;font-size:18px;'><strong>Field must not be empty !! </strong></div>";
                return $brndmsg;
            }
            else{
                $query = "UPDATE tbl_brand SET brandName = '$name' WHERE brandId = '$id' ";
                $res = $this->db->update($query);
                if($res){
                    $brndmsg = "<div style='color:green;font-size:18px;'><strong>Category Name Updated Successfully !! </strong></div>";
                    return $brndmsg;
                }
                else{
                    $brndmsg = "<div style='color:red;font-size:18px;'><strong>Something went wrong !! </strong></div>";
                    return $brndmsg;
                }
            }
          
        }

        public function brandDelete($id){
            $query = "DELETE FROM tbl_brand WHERE brandId = '$id' ";
            $res = $this->db->delete($query);
            return $res;
        }


    }
?>


