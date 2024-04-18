<?php include 'inc/header.php';?>
<?php
 $lg = Session::get("cuslogin");
 if($lg == false){
     header('Location:login.php');
 }
?>
<style>
    .division1{
        width:60%;
        float:left;
    }
    .division2{
        width:40%;
        float:right;
    }
    .tblone{
        width: 80%;
        margin: 10px auto;
        border: 2px solid lightblue;
    }
    .tblone tr th{
        text-align:left;
        font-size:20px;
        
    }
    .tblone tr td{
        text-align: left;
        font-size:16px;
    }
    .tbl-two{
        width:80%;
        margin:10px auto;
        border:2px solid #ddd;
    }
    .tbl-two tr td{
        padding:5px 10px;
    }
</style>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="division1">
            <table class="tblone">
							
							<tr>
								<th width="5%">Serial No</th>
								<th width="45%">Product Name</th>
								
								<th width="20%">Price</th>
								<th width="5%">Quantity</th>
								<th width="25%">Total Price</th>
								
							</tr>
							<?php
								$cart = $ct->cartProduct();
								if($cart){
									$i = 0;
									$sum = 0;
									$qt = 0;
									while($cartres = $cart->fetch_assoc()){
										$i++;
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $cartres['productName']; ?></td>
								
								<td><?php echo $cartres['price']; ?></td>
								
								<td><?php echo $cartres['quantity']; ?></td>
                                <td>
                                    <?php
                                        $total = $cartres['price'] * $cartres['quantity'];
                                        echo $total;
                                    ?>
                                </td>
								
							</tr>
							<?php 
                            $sum = $sum + $total;
							$qt = $qt + $cartres['quantity'];
									
							?>
							<?php } }?>
							
						</table>
						
						<table class="tbl-two" >
							<tr>
								<th>Sub Total : </th>
								<td>TK.<?php echo $sum; ?></td>
							</tr>
							<tr>
								<th>VAT 10% : </th>
								<td>TK.<?php $vat = (($sum * 10 )/ 100); echo $vat;?></td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>TK. <?php echo ($vat + $sum); ?> </td>
							</tr>
					   </table>
            </div>
            <div class="division2">
     

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
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>