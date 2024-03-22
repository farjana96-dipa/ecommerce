<?php
    include_once '../lib/Database.php';
    include_once '../helpers/format.php';
?>
<?php
    class Product{
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function productAdd($data,$file){
            $pdName = $this->fm->validation($data['productName']);
            $pdName = mysqli_real_escape_string($this->db->link,$pdName);

            $pdPrice = $this->fm->validation($data['price']);
            $pdPrice = mysqli_real_escape_string($this->db->link,$pdPrice);

            $pdtype = $this->fm->validation($data['type']);
            $pdtype = mysqli_real_escape_string($this->db->link,$pdtype);

            $pdbody = $this->fm->validation($data['body']);
            $pdbody = mysqli_real_escape_string($this->db->link,$pdbody);

            $brandId = $this->fm->validation($data['brandId']);
            $brandId = mysqli_real_escape_string($this->db->link,$brandId);

            $catId = $this->fm->validation($data['catId']);
            $catId = mysqli_real_escape_string($this->db->link,$catId);

             // Image upload
             $permit = array('jpg','jpeg','png','gif','webp','svg','avif');
             $file_name = $file['image']['name'];
             $file_size = $file['image']['size'];
             $file_tmp = $file['image']['tmp_name'];
             $explode = explode('.',$file_name);
             $file_ext = strtolower(end($explode));
             $unique_image = substr(md5(time()),0,8).'.'.$file_ext;
             $folder = "upload/".$unique_image;
             
            
             //Image upload End

            if(empty($catId) || empty($brandId) || empty($pdName) || empty($folder) || empty($pdbody) || empty($pdPrice) || empty($pdtype)){
                $pdmsg = "<div style='color:red;font-size:18px;'><strong>Field must not be empty !! </strong></div>";
                return $pdmsg;
            }
            else if($file_size > 1000000){
                $pdmsg = "<div style='color:red;'><strong>Image size should be less than 1MB.</strong></div>";
                return $pdmsg;
            }
            else if(in_array($file_ext,$permit)===false){
                $pdmsg = "<div style='color:red;'><strong>You can upload only".implode(',',$permit)."</strong></div>";
                return $pdmsg;
            }
            else{
                move_uploaded_file($file_tmp,$folder);
                $query = "INSERT INTO tbl_product(productName,catId,brandId,body,price,image,type) VALUES('$pdName','$catId','$brandId','$pdbody','$pdPrice','$folder','$pdtype')";
                $res = $this->db->insert($query);
                if($res){
                    $pdmsg = "<div style='color:white;font-size:18px;'><strong>Product Inserted Successfully !! </strong></div>";
                    return $pdmsg;
                }
                else{
                    $pdmsg = "<div style='color:red;font-size:18px;'><strong>Something went wrong !! </strong></div>";
                    return $pdmsg;
                }
            }
        }


        public function productList(){
            $query = "SELECT *FROM tbl_product ORDER BY productId DESC";
            $res = $this->db->select($query);
            return $res;
        }

        public function catListId($id){
            $query = "SELECT *FROM tbl_product WHERE productId = '$id' ";
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
                $query = "UPDATE tbl_product SET productName = '$name' WHERE productId = '$id' ";
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


