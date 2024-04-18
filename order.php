<?php include 'inc/header.php';?>
<?php
 $lg = Session::get("cuslogin");
 if($lg == false){
     header('Location:login.php');
 }
?>
<style>
    .notfound{
        padding-top:120px;
        padding-bottom:150px;
    }
    .notfound h2{
        font-size:100px;
        line-height:130px;
        text-align:center;
    }
    .notfound h2 span{
        display:block;
        color:red;
        font-size:170px;
    }
</style>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="notfound">
                <h2><span>Order</span>Page</h2>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>