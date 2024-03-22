<?php
    include '../lib/Session.php';
    include '../helpers/format.php';
    include '../lib/Database.php';
    Session::checkLogin();
?>

<?php
    class Adminlogin{
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }


        public function adminLogin($adminUser,$adminPass){

            $adminUser  = $this->fm->validation($adminUser);
            $adminPass = $this->fm->validation($adminPass);

            $adminUser = mysqli_real_escape_string($this->db->link,$adminUser);
            $adminPass = mysqli_real_escape_string($this->db->link,$adminPass);

            if(empty($adminUser) || empty($adminPass)){
                $loginmsg = "<div style='color:red;font-size:18px;'><strong>Field must not be empty !! </strong></div>";
                return $loginmsg;
            }
            else{
                $query = "SELECT *FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass='$adminPass' ";
                $result = $this->db->select($query);
                if($result != FALSE){
                    $val = $result->fetch_assoc();
                    Session::set("login",true);
                    Session::set("adminUser",$val['adminUser']);
                    Session::set("adminPass",$val['adminPass']);
                    Session::set("adminName",$val['adminName']);
                    Session::set("adminId",$val['adminId']);
                    Session::set("adminEmail",$val['adminEmail']);
                    Session::set("adminLabel",$val['label']);
                    header('Location:index.php');
                }
                else{
                    $loginmsg = "Username or Password not match !";
                    return $loginmsg;
                }
            }
        }
    }

?>