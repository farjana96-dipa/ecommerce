<?php include 'inc/header.php'; ?>
<?php
	if(isset($_GET['delid'])){
		$delid = $_GET['delid'];
		$delcart = $ct->deleteCart($delid);
		if($delcart){
			echo $delcart;
		}
	
	}
?>

<?php
	if(!isset($_GET['id'])){
		echo "<meta http-equiv='refresh' content='0;URL=?id=live'/>";
	}
?>

<?php
if($_SERVER['REQUEST_METHOD'] =='POST' ){
	$quantity = $_POST['quantity'];
	$cartId = $_POST['cartId'];
	$cartup = $ct->updateCartId($quantity,$cartId);
}
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
						<?php 
							if(isset($cartup)){
								echo $cartup;
							}
						?>
						<table class="tblone">
							
							<tr>
								<th width="5%">Serial No</th>
								<th width="20%">Product Name</th>
								<th width="15%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
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
								<td><img src="admin/<?php echo $cartres['image']; ?>" alt="" height="180px" width="180px"/></td>
								<td><?php echo $cartres['price']; ?></td>
								<td>
									<form action="" method="post">
									<input type="hidden" name="cartId" value="<?php echo $cartres['cartId']; ?>">
										<input type="number" name="quantity" value="<?php echo $cartres['quantity']; ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td><?php 
									$z = $cartres['quantity'] * $cartres['price'];
									
									echo $z;
								?></td>
								<td><a href="?delid=<?php echo $cartres['cartId']; ?>">X</a></td>
								
							</tr>
							<?php $sum = $sum + $z;
									$qt = $qt + $cartres['quantity'];
									Session::set("quantity",$qt);
									Session::set("sum",$sum);
							?>
							<?php } }?>
							
						</table>
						<?php
							$chk = $ct->checkCart();
							if($chk){
						?>
						<table style="float:right;text-align:left;" width="40%">
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
					   <?php } else{
						 echo "<strong style='color:red'>Cart Empty ! Please Shop Now. </strong>";
					   } ?>
					  
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="login.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
  <?php include 'inc/footer.php'; ?>