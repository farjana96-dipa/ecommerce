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
</style>

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

        <table class="tblone">
            <tr>
                <td colspan="3">Your Profile Details</td>
            </tr>
            <tr>
                <td width="30%">Name</td>
                <td width="5%">:</td>
                <td><?php echo $value['name']; ?></td>
            </tr>

            <tr>
                <td>Phone</td>
                <td>:</td>
                <td><?php echo $value['phone']; ?></td>
            </tr>

            <tr>
                <td>Email</td>
                <td>:</td>
                <td><?php echo $value['email']; ?></td>
            </tr>

        

            <tr>
                <td>Country</td>
                <td>:</td>
                <td><?php echo $value['country']; ?></td>
            </tr>

            <tr>
                <td>City</td>
                <td>:</td>
                <td><?php echo $value['city']; ?></td>
            </tr>

            <tr>
                <td>Address</td>
                <td>:</td>
                <td><?php echo $value['address']; ?></td>
            </tr>

            <tr>
                <td>Zip Code</td>
                <td>:</td>
                <td><?php echo $value['zip']; ?></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><a href="editprofile.php">Update Profile</a></td>
            </tr>
        </table>
<?php } } ?>
        
           
        </div>
        
    </div>
</div>

<?php include 'inc/footer.php'; ?>