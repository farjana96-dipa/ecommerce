<?php include 'inc/header.php'; ?>
<style>
	.span_3_of_2 h2{
		margin-top:50px !important;
	}
	.product-desc ul{
		margin-top:10px;
	}
	.product-desc ul li{
		line-height:25px;
		font-size:16px;
	}
	.product-desc h3{
		font-size:28px;
		font-weight:bold;
		
	}
</style>
<?php
	if(isset($_GET['proid'])){
		$proid = $_GET['proid'];
	}
	else{
		header('Location:404.php');
	}
?>
<?php
	if($_SERVER['REQUEST_METHOD'] =='POST' ){
		$quantity = $_POST['quantity'];
		$cart = $ct->addToCart($quantity,$proid);
	}
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
			<?php
				$getpd = $pd->productListId($proid);
				if($getpd){
					while($respd = $getpd->fetch_assoc()){
				
			?>
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="admin/<?php echo $respd['image']; ?>" alt="" />
					</div>
					<div class="desc span_3_of_2">
							<h2><?php echo $respd['productName']; ?></h2>
											
						<div class="price">
								<p>Price: <span><?php echo $respd['price']; ?></span></p>
								<p>Category: <span><?php $respd['catName']; ?></span></p>
								<p>Brand:<span><?php echo $respd['brandName']; ?></span></p>
						</div>
								<div class="add-cart">
									<form action="" method="post">
										
										<input type="number" class="buyfield" name="quantity" value="1"/>
										<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
									</form>				
								</div>
								<span style="color:red;">
								<?php
								 if(isset($cart)) {echo $cart;}
								 ?>
								</span>
				</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<p><?php echo $respd['body']; ?></p>
	       </div>
				
	</div>
	<?php } } ?>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<?php
						$getcat = $cat->catList();
						if($getcat){
							while($get_cat = $getcat->fetch_assoc()){
					?>
					<ul>
				      <li><a href="productbycat.php"><?php echo $get_cat['catName']; ?></a></li>
				      
    				</ul>
					<?php } } ?>
 				</div>
 		</div>
 	</div>
	</div>
   <?php include 'inc/footer.php'; ?>