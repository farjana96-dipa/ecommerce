<?php header('Content-Type: text/html; charset=utf-8'); ?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Featured Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
		
	      <div class="section group">
				<?php
					$getpd = $pd->featuredProduct();
					if($getpd){
						while($feproduct = $getpd->fetch_assoc()){
				?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php?proid=<?php echo $feproduct['productId']; ?>"><img src="admin/<?php echo $feproduct['image']; ?>" alt="" /></a>
					 <h2><?php echo $feproduct['productName']; ?> </h2>
					 <p><?php echo $feproduct['body']; ?></p>
					 <p><span class="price"><?php echo $feproduct['price']; ?></span></p>
				     <div class="button"><span><a href="preview.php?proid=<?php echo $feproduct['productId']; ?>" class="details">Details</a></span></div>
				</div>
				<?php } } ?>
				
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
			<?php
					$getpd = $pd->newProduct();
					if($getpd){
						while($newproduct = $getpd->fetch_assoc()){
				?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview.php?newid=<?php echo $newproduct['productId']; ?>"><img src="admin/<?php echo $newproduct['image']; ?>" alt="" height="250px" width="220px"/></a>
					 <h2><?php echo $newproduct['productName']; ?> </h2>
					 <p><span class="price"><?php echo $newproduct['price']; ?></span></p>
				     <div class="button"><span><a href="preview.php?proid=<?php echo $newproduct['productId']; ?>" class="details">Details</a></span></div>
				</div>
				<?php } } ?>
			
			</div>
    </div>
 </div>
</div>

<?php include 'inc/footer.php'; ?>
  