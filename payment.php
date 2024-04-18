<?php include 'inc/header.php';?>
<?php
 $lg = Session::get("cuslogin");
 if($lg == false){
     header('Location:login.php');
 }
?>
<style>
    .payment{
        width:500px;
        min-height:200px;
        border:1px solid #ddd;
        padding:15px;
        margin:0 auto;
        text-align: center;
    }
    .payment h2{
        font-size:22px;
        font-weight: bold;
        text-align:center;
        border-bottom:1px solid #ddd;
        margin-bottom:60px;
        padding-bottom: 10px;
        
    }
    .payment a{
        background-color: red;
        border-radius: 5px;
        padding:12px 30px;
        color:white;
        margin-top:20px;

    }
    .button{
        width:150px;
        margin:0 auto;
        margin-top:20px;
    }
    .button a{
        background-color: #414045;
        border-radius: 5px;
        padding:8px 20px;
        color:white;
        
    }
</style>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="payment">
                <h2>Choose Payment Option</h2>
                <a href="offline.php">Offline Payment</a>
                <a href="online.php">Online Payment</a>
            </div>
            <div class="button"><a href="cart.php">Previous</a></div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>