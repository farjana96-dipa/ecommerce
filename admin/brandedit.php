<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php'; ?>
<?php
    $bb = new Brand();
?>
<?php
    if(isset($_GET['brandid'])){
        $brandId = $_GET['brandid'];  
        $res = $bb->brandListId($brandId);
    }


    
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 
                 <form action="" method="post">
                    <?php
                       if($_SERVER['REQUEST_METHOD']=='POST'){
                        $bname = $_POST['brandName'];
                        $update = $bb->brandUpdate($brandId,$bname);
                        if($update){
                            echo $update;
                        }
                        } 
                    ?>
                    <?php
                         
                         if($res){
                            while($valselect = $res->fetch_assoc()){
                         
                    ?>
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name = "brandName" value="<?php echo $valselect['brandName']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    <?php } } ?>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>