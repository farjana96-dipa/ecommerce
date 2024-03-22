<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Product.php'; ?>

<?php
	$fm = new Format();
	$pd = new Product();
?>

<?php
	if(isset($_GET['delid'])){
		$delid = $_GET['delid'];
		$delres = $pd->productDelete($delid);
		if($delres){
			echo $delres;
		}
		
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>
        <div class="block">  
			
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th width="5px">Serial Number</th>
					<th width="15px">Product Name</th>
					<th width="5px">Category</th>
					<th width="5px">Brand</th>
					<th width="35px">Prodcut Description</th>
					<th width="5px">Price</th>
					<th width="25px">Image</th>
					<th width="5px">Type</th>
					<th width="5px">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$res = $pd->productList();
					if($res){
						$i = 0;
						while($pdres = $res->fetch_assoc()){
							$i++;
					
				?>
				<tr class="odd gradeX">
					<td ><?php echo $i; ?></td>
					<td><?php echo $fm->textShorten($pdres['productName'],30); ?></td>
					<td><?php echo $pdres['catName']; ?></td>
					<td class="center"><?php echo $pdres['brandName']; ?></td>
					<td class="center"><?php echo $fm->textshorten($pdres['body'],80); ?></td>
					<td class="center"> <?php echo $pdres['price']; ?></td>
					<td class="center"><img src="<?php echo $pdres['image']; ?>" alt="" height="50px" width="50px"> </td>
					<td class="center"> <?php echo $pdres['type']; ?></td>
					<td><a href="productedit.php?id=<?php echo $pdres['productId']; ?>">Edit</a> ||
					<a onclick = "return confirm('Are you sure to delete it?');" href="?delid=<?php echo $pdres['productId']; ?>" >Delete</a></td>
				</tr>
			<?php } } ?>
			</tbody>
		</table>
		
       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
