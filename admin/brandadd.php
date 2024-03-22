<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php'; ?>
<?php
    $bb = new Brand();
?>
<?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $brandName = $_POST['brandName'];

        $brandChk = $bb->addBrand($brandName);       
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 
                 <form action="" method="post">
                    <?php
                         if(isset($brandChk)){
                            echo $brandChk;
                        }
                    ?>
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name = "brandName" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>