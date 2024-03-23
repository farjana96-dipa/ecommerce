<?php
    
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

            //$pdbody = $this->fm->validation($data['body']);
            $pdbody = mysqli_real_escape_string($this->db->link,$data['body']);
            

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
            $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName FROM tbl_product
                      INNER JOIN tbl_category
                      ON tbl_product.catId = tbl_category.catId
                      INNER JOIN tbl_brand
                      ON tbl_product.brandId = tbl_brand.brandId 
                      ORDER BY tbl_product.productId DESC";
            $res = $this->db->select($query);
            return $res;
        }

        public function productListId($id){
            $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName FROM tbl_product
            INNER JOIN tbl_category
            ON tbl_product.catId = tbl_category.catId
            INNER JOIN tbl_brand
            ON tbl_product.brandId = tbl_brand.brandId
            WHERE productId = '$id' ";
            $res = $this->db->select($query);
            return $res;
        }

        public function productUpdate($data,$file,$pdId){
            $pdName = $this->fm->validation($data['productName']);
            $pdName = mysqli_real_escape_string($this->db->link,$pdName);

            $pdPrice = $this->fm->validation($data['price']);
            $pdPrice = mysqli_real_escape_string($this->db->link,$pdPrice);

            $pdtype = $this->fm->validation($data['type']);
            $pdtype = mysqli_real_escape_string($this->db->link,$pdtype);

           // $pdbody = $this->fm->validation($data['body']);
            $pdbody = mysqli_real_escape_string($this->db->link,$data['body']);

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
            else{
                if(!empty($file_name)){
                    if($file_size > 1000000){
                        $pdmsg = "<div style='color:red;'><strong>Image size should be less than 1MB.</strong></div>";
                        return $pdmsg;
                    }
                    else if(in_array($file_ext,$permit)===false){
                        $pdmsg = "<div style='color:red;'><strong>You can upload only".implode(',',$permit)."</strong></div>";
                        return $pdmsg;
                    }
                    else{
                        move_uploaded_file($file_tmp,$folder);
                        $query = "UPDATE tbl_product SET
                                  productName = '$pdName',
                                  catId       = '$catId',
                                  brandId     = '$brandId',
                                  price       = '$pdPrice',
                                  body        = '$pdbody',
                                  type        = '$pdtype',
                                  image       = '$folder'
                                  WHERE productId = '$pdId' ";
                        $res = $this->db->update($query);
                        if($res){
                            $pdmsg = "<div style='color:white;font-size:18px;'><strong>Product Updated Successfully !! </strong></div>";
                            return $pdmsg;
                        }
                        else{
                            $pdmsg = "<div style='color:red;font-size:18px;'><strong>Something went wrong !! </strong></div>";
                            return $pdmsg;
                        }
                    }
                }
                else{
                   
                    $query = "UPDATE tbl_product SET
                                  productName = '$pdName',
                                  catId       = '$catId',
                                  brandId     = '$brandId',
                                  price       = '$pdPrice',
                                  body        = '$pdbody',
                                  type        = '$pdtype'
                                  WHERE productId = '$pdId' ";
                        $res = $this->db->update($query);
                        if($res){
                            $pdmsg = "<div style='color:white;font-size:18px;'><strong>Product Updated Successfully !! </strong></div>";
                            return $pdmsg;
                        }
                        else{
                            $pdmsg = "<div style='color:red;font-size:18px;'><strong>Something went wrong !! </strong></div>";
                            return $pdmsg;
                        }
                }
            }
        
          
          
        }

        public function productDelete($id){
            $select = "SELECT *FROM tbl_product WHERE productId = '$id'";
            $select_res = $this->db->select($select);
            if($select_res){
                while($select_val = $select_res->fetch_assoc()){
                    $delimg = $select_val['image'];
                    unlink($delimg);
                }
            }

            $query = "DELETE FROM tbl_product WHERE productId = '$id' ";
            $res = $this->db->delete($query);
            return $res;
        }

        public function featuredProduct(){
            $select = "SELECT *FROM tbl_product WHERE type = 'Featured' limit 4";
            $select_res = $this->db->select($select);
            return $select_res;
        }
        
        public function newProduct(){
            $select = "SELECT *FROM tbl_product WHERE type = 'General' limit 4";
            $select_res = $this->db->select($select);
            return $select_res;
        }


        public function getIphone(){
            $select = "SELECT *FROM tbl_product WHERE brandId = '5' limit 1";
            $select_res = $this->db->select($select);
            return $select_res;
        }
        public function getAcer(){
            $select = "SELECT *FROM tbl_product WHERE brandId = '1' limit 1";
            $select_res = $this->db->select($select);
            return $select_res;
        }
        public function getSamsung(){
            $select = "SELECT *FROM tbl_product WHERE brandId = '4' limit 1";
            $select_res = $this->db->select($select);
            return $select_res;
        }
        public function getCanon(){
            $select = "SELECT *FROM tbl_product WHERE brandId = '2' limit 1";
            $select_res = $this->db->select($select);
            return $select_res;
        }

    }
?>


