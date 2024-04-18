<?php include 'inc/header.php';?>
<?php
 $lg = Session::get("cuslogin");
 if($lg == false){
     header('Location:login.php');
 }
?>

<style>
    .tblone{
        width: 50%;
        margin: 10px auto;
        border: 2px solid lightblue;
    }

    .tblone tr td{
        text-align: left;
    }
    .tblone input[type="text"],.tblone input[type="email"]{
        width:350px;
        padding:5px;
        font-size:16px;
    }
</style>
<?php
    $id = Session::get("cusid");
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
        $updCus = $cmr->updateCus($_POST,$id);
        
    }
?>
<div class="main">
    <div class="content">
        <div class="section group">

        <!-- get customer data from database -->
        <?php
            $id = Session::get('cusid');
            //echo $id;
            $cus = $cmr->customer_data_by_id($id);
            if($cus){
                //echo "Data is found";
                while($value = $cus->fetch_assoc()){
            
        ?>
        <form action="" method="post">
        <table class="tblone">
            <?php 
                if(isset($updCus)){
                    echo $updCus;
                }
            ?>
            <tr>
                <td colspan="3">Update Profile Details</td>
            </tr>
            <tr>
                <td width="30%">Name</td>
               
                <td><input type="text" name="name" value="<?php echo $value['name']; ?>"></td>
            </tr>

            <tr>
                <td>Phone</td>
               
                <td><input type="text" name="phone" value="<?php echo $value['phone']; ?>"></td>
            </tr>

            <tr>
                <td>Email</td>
                
                <td><input type="email" name="email" value="<?php echo $value['email']; ?>"></td>
            </tr>
           

        

            <tr>
                <td>Country</td>
               
                <td><input type="text" name="country" value="<?php echo $value['country']; ?>"></td>
            </tr>

            <tr>
                <td>City</td>
               
                <td><input type="text" name="city" value="<?php echo $value['city'] ?>"></td>
            </tr>

            <tr>
                <td>Address</td>
               
                <td><input type="text" name="address" value="<?php echo $value['address']; ?>"></td>
            </tr>

            <tr>
                <td>Zip Code</td>
                <td><input type="text" name="zip" value="<?php echo $value['zip']; ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="submit" value="Update"></td>
            </tr>
        </table>
        </form>
<?php } } ?>
        
           
        </div>
        
    </div>
</div>

<?php include 'inc/footer.php'; ?>