
<?php include 'inc/header.php'; ?>
<?php 
	

?>
<?php 
	if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['login'])){
		$log = $cmr->customerLog($_POST);
		
	}
?>
 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        		<form action="" method="post" id="member">
					<input type="text" placeholder="Email" name="email">
					<input type="password" placeholder="Password" name="pass">
					<div class="buttons"><div><button class="grey" name="login">Sign In</button></div></div>
             	</form>
		 </div>

                 
<?php 
if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['register'])){
		$reg = $cmr->customerReg($_POST);
	}
?>                   
    	<div class="register_account">
			<?php 
				if($reg){
					echo $reg;
				}
			?>
    		<h3>Register New Account</h3>
    		<form action="" method="post">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Name">
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="City">
							</div>
							
							<div>
								<input type="text" name="zip" placeholder="Zip-Code">
							</div>
							<div>
								<input type="text" name="email" placeholder="Email">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Address">
						</div>
		    		<div>
						<input type="text" name="country" placeholder="Country">
				 </div>		        
	
		           <div>
		          <input type="text" name="phone" placeholder="Phone">
		          </div>
				  
				  <div>
					<input type="text" name="pass" placeholder="Password">
				</div>
				
				
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><button class="grey" name="register">Create Account</button></div></div>
		   <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
  <?php include 'inc/footer.php'; ?>