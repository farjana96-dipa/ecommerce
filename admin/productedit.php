<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php'; ?>
<?php include '../classes/Category.php'; ?>
<?php include '../classes/Product.php'; ?>
<?php
    if(isset($_GET['id'])){
        $pdId = $_GET['id'];
    }
    else{
        header('Location:productlist.php');
    }
?>
<?php
    $pd = new Product();
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
        $pres = $pd->productUpdate($_POST,$_FILES,$pdId);
        if($pres){
            echo $pres;
        }
    }

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block">               
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               <?php 
                    $select = $pd->productListId($pdId);
                    if($select){
                        while($selres = $select->fetch_assoc()){
                    
               ?>
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $selres['productName']; ?>" class="medium" name="productName"/>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="catId">
                            <option>Select Category</option>
                            <?php 
                                $cat = new Category();
                                $res = $cat->catList();
                                if($res){
                                    while($catval = $res->fetch_assoc()){
                                
                            ?>
                            <option 
                            <?php if($selres['catId'] == $catval['catId']){ ?> selected = "selected"; <?php } ?> 
                            value="<?php echo $catval['catId']; ?>"><?php echo $catval['catName']; ?></option>
                            <?php } } ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brandId">
                            <option>Select Brand</option>
                            <?php
                              $bb = new Brand();
                              $res = $bb->brandList();
                              if($res){
                                  while($bbval = $res->fetch_assoc()){  
                            ?>
                            <option 
                            <?php if($selres['brandId'] == $bbval['brandId']) { ?> selected = "selected"; <?php } ?>
                            value="<?php echo $bbval['brandId']; ?>"><?php echo $bbval['brandName'];  ?></option>
                            <?php } } ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body" ><?php echo $selres['body']; ?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $selres['price']; ?>" class="medium" name="price"/>
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="<?php echo $selres['image']; ?>" alt="" height="70px" width="120px"><br>
                        <input type="file" name="image"/>
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <?php if($selres['type']=='Featured'){ ?>
                            <option value="Featured" selected="selected">Featured</option>
                            <option value="General">General</option>
                            <?php } else { ?>
                                <option value="Featured">Featured</option>
                                <option value="General" selected="selected">General</option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
                <?php } } ?>
            </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


