
<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
			<?php
				$get = $pd->getIphone();
				if($get){
					while($getIphone = $get->fetch_assoc()){		
			?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.php"> <img src="admin/<?php echo $getIphone['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						
						<h2>Apple</h2>
						<p><?php echo $getIphone['productName']; ?></p>
						<div class="button"><span><a href="preview.php">Add to cart</a></span></div>
				   </div>
			   </div>	
			   <?php } } ?>		
			   <?php
				$get = $pd->getSamsung();
				if($get){
					while($getS = $get->fetch_assoc()){		
					?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="preview.php"><img src="admin/<?php echo $getS['image']; ?>" alt="" / ></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Samsung</h2>
						  <p><?php echo $getS['productName']; ?></p>
						  <div class="button"><span><a href="preview.php">Add to cart</a></span></div>
					</div>
				</div>
				<?php } } ?>	
			</div>
			<div class="section group">
			<?php
				$get = $pd->getAcer();
				if($get){
					while($getA = $get->fetch_assoc()){		
					?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="preview.php"> <img src="admin/<?php echo $getA['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Acer</h2>
						<p><?php echo $getA['productName']; ?></p>
						<div class="button"><span><a href="preview.php">Add to cart</a></span></div>
				   </div>
			   </div>
			   <?php } } ?>	
			   <?php
				$get = $pd->getCanon();
				if($get){
					while($getC = $get->fetch_assoc()){		
					?>			
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="preview.php"><img src="admin/<?php echo $getC['image']; ?>" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Canon</h2>
						  <p><?php echo $getC['productName']; ?></p>
						  <div class="button"><span><a href="preview.php">Add to cart</a></span></div>
					</div>
				</div>
				<?php } } ?>	
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/1.jpg" alt=""/></li>
						<li><img src="images/2.jpg" alt=""/></li>
						<li><img src="images/3.jpg" alt=""/></li>
						<li><img src="images/4.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>