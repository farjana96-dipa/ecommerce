<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php'; ?>
<?php
    $bb = new Brand();
?>
<?php
	if(isset($_GET['delid'])){
		$delid = $_GET['delid'];
		$del_res = $bb->brandDelete($delid);
		if($del_res){
			echo $del_res;
		}
	}
	
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$resoflist = $bb->brandList();
						if($resoflist){
							$i=0;
							while($listval = $resoflist->fetch_assoc()){
						    $i++;
					?>
						<tr class="even gradeC">
							<td><?php echo $i; ?></td>
							<td><?php echo $listval['brandName']; ?></td>
							<td><a href="brandedit.php?brandid=<?php echo $listval['brandId']; ?>">Edit</a> || <a onclick = "return confirm('Are you sure to delete it?');" href="?delid=<?php echo $listval['brandId']; ?>" >Delete</a></td>
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

