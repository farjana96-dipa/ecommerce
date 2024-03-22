<?php
   
?>
<?php
    class Category{
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function addCat($catName){
            $catName = $this->fm->validation($catName);
            $catName = mysqli_real_escape_string($this->db->link,$catName);

            if(empty($catName)){
                $catmsg = "<div style='color:red;font-size:18px;'><strong>Field must not be empty !! </strong></div>";
                return $catmsg;
            }
            else{
                $query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
                $res = $this->db->insert($query);
                if($res){
                    $catmsg = "<div style='color:green;font-size:18px;'><strong>Category Name Inserted Successfully !! </strong></div>";
                    return $catmsg;
                }
                else{
                    $catmsg = "<div style='color:red;font-size:18px;'><strong>Something went wrong !! </strong></div>";
                    return $catmsg;
                }
            }
        }


        public function catList(){
            $query = "SELECT *FROM tbl_category ORDER BY catId DESC";
            $res = $this->db->select($query);
            return $res;
        }

        public function catListId($id){
            $query = "SELECT *FROM tbl_category WHERE catId = '$id' ";
            $res = $this->db->select($query);
            return $res;
        }

        public function catUpdate($id,$name){
            $name = $this->fm->validation($name);
            $name = mysqli_real_escape_string($this->db->link,$name);

            if(empty($name)){
                $catmsg = "<div style='color:red;font-size:18px;'><strong>Field must not be empty !! </strong></div>";
                return $catmsg;
            }
            else{
                $query = "UPDATE tbl_category SET catName = '$name' WHERE catId = '$id' ";
                $res = $this->db->update($query);
                if($res){
                    $catmsg = "<div style='color:green;font-size:18px;'><strong>Category Name Updated Successfully !! </strong></div>";
                    return $catmsg;
                }
                else{
                    $catmsg = "<div style='color:red;font-size:18px;'><strong>Something went wrong !! </strong></div>";
                    return $catmsg;
                }
            }
          
        }

        public function catDelete($id){
            $query = "DELETE FROM tbl_category WHERE catId = '$id' ";
            $res = $this->db->delete($query);
            return $res;
        }


    }
?>


