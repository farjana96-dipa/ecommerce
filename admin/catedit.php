<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php'; ?>
<?php
    $cat = new Category();
?>
<?php
    if(isset($_GET['catid'])){
        $catId = $_GET['catid'];  
        $res = $cat->catListId($catId);
    }


    
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 
                 <form action="" method="post">
                    <?php
                       if($_SERVER['REQUEST_METHOD']=='POST'){
                        $cname = $_POST['catName'];
                        $update = $cat->catUpdate($catId,$cname);
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
                                <input type="text" name = "catName" value="<?php echo $valselect['catName']; ?>" class="medium" />
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