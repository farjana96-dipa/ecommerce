<?php
 
?>
<?php
    class Cart{
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function addToCart($qn,$id){
            $qn = $this->fm->validation($qn);
            $qn = mysqli_real_escape_string($this->db->link,$qn);

            $pid = mysqli_real_escape_string($this->db->link,$id);

            $sid = session_id();

            $squery = "SELECT *FROM tbl_product WHERE productId = '$pid' ";
            $sres = $this->db->select($squery);
            $pres = $sres->fetch_assoc();
            
           $pdname = $pres['productName'];
           $image = $pres['image'];
           $price = $pres['price'];

            $chquery = "SELECT *FROM tbl_cart WHERE productId = '$pid' AND sId = '$sid' ";
            $chres = $this->db->select($chquery);
            if($chres){
                $msg = "Prodcut Already Added !!";
                return $msg;
            }
            else{
                $query = "INSERT INTO tbl_cart(sId,productId,productName,price,quantity,image) VALUES('$sid','$pid','$pdname','$price','$qn','$image') ";

                $insertRow = $this->db->insert($query);
                if($insertRow){
                     header('Location:cart.php');
                }
                else{
                 header('Location:404.php');
                }
            }
          
        }

        public function cartProduct(){
            $sid = session_id();
            $query = "SELECT *FROM tbl_cart WHERE  sId = '$sid' ";
            $res = $this->db->select($query);
            return $res;
        }

        public function cartListId($id){
            $query = "SELECT *FROM tbl_cart WHERE cartId = '$id' ";
            $res = $this->db->select($query);
            return $res;
        }

        public function updateCartId($qn,$id){
            if($qn < 0 ) {
                $qn = 0;
            }
            $query = "UPDATE tbl_cart SET quantity = '$qn' WHERE cartId = '$id' ";
            $update = $this->db->update($query);
            if(!$update){
                $upmsg = "<div style='color:red;font-size:18px;'><strong>Something went wrong !! </strong></div>";
                return $upmsg;
            }
            else{
                header('Location:cart.php');
            }
        }


        public function deleteCart($delid){
            $query = "DELETE FROM tbl_cart WHERE cartId = '$delid' ";
            $del_res = $this->db->delete($query);
            if($del_res){
                $delmsg = "<div style='color:green;font-size:18px;'><strong>Product Deleted Successfully !! </strong></div>";
                return $delmsg;
            }
            else{
                $delmsg = "<div style='color:red;font-size:18px;'><strong>Something went wrong !! </strong></div>";
                return $delmsg;
            }
        }


        public function checkCart(){
            $sid = session_id();
            $query = "SELECT *FROM tbl_cart WHERE  sId = '$sid' ";
            $res = $this->db->select($query);
            return $res;
        }
}