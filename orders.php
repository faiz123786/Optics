<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
}else{
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Orders</title>
        <link rel="stylesheet" href="css/style.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>

    <body>

        <!-- ====================================== NAVBAR ================================= -->
        <?php
        include_once "includes/nav.php";
        // include "dbh/conn.php";
        ?>
        <div class="container" style="margin-top:6rem;">
            <p class="bg-info text-center h1 m-0">My Orders</p>
            <?php  
            $cust_id = mysqli_real_escape_string($conn, $_GET['cust_id']);
            $sql = "SELECT * FROM orders WHERE Cust_ID = {$cust_id}";
            $result= mysqli_query($conn, $sql) or die("Query Unsuccessfull".$sql);
            if(mysqli_num_rows($result) > 0){
                while($rows = mysqli_fetch_assoc($result)){
                    $prod_id = $rows['Prod_ID'];
                    $sql1 = "SELECT * FROM products WHERE ID = {$prod_id}";
                    $result1 = mysqli_query($conn, $sql1) or die("Query Unsuccessfull".$sql1);
                    if(mysqli_num_rows($result1) > 0){
                        while($rows1 = mysqli_fetch_assoc($result1)){
                            $catg_id =  $rows1['Sub_catg_ID'];
                            $sql2 = "SELECT * FROM sub_categories WHERE ID = {$catg_id}";
                            $result2 = mysqli_query($conn, $sql2) or die("Query Unsuccessfull".$sql2);
                            if(mysqli_num_rows($result2) > 0 ){
                            while($rows2 = mysqli_fetch_assoc($result2)){
                        ?>
            
                                <div class="row border-bottom border-2 p-4">
                                    <div class="col-lg-3 col-md-3 col-4 text-sm-start text-start text-md-center text-center m-start m-md  mt-sm-3 mt-md-0"><img src="uploads/<?php echo ENC($rows1['Img_name'],'decrypt') ?>" class="img-fluid addimg" ></div>
                                    <div class="col-lg-5 col-md-5 col-8 m-end  mt-sm-3 mt-md-0">
                                        <p class="h4 p-1"><?php echo ENC($rows1['P_Name'],'decrypt')?></p>
                                        <p class="h6 p-1"><?php echo ENC($rows2['Sub_catg_name'],'decrypt')?></p>
                                        <p class="h6 p-1"> &#x20B9; <?php echo ENC($rows1['P_price'],'decrypt')?></p>
                                        <p class="h6 p-1 mb-3">Quantity : &nbsp;<span class="p-1 rounded-2 border border-dark"><?php echo $rows['Quantity']?></span></p>
                                        <form action="operations/delete.php" method="post" class="d-inline-block">
                                            <input type="hidden" name="cust_id" value="<?php echo $rows['Cust_ID'] ;?>">
                                            <input type="hidden" name="id" value="<?php echo $rows['ID'] ;?>">
                                            <button class="btn btn-danger" type="submit" name="delete_order">Cancel Order</button>
                                        </form>
                                        <p style="font-size: 14px;color: green;" class="fw-bold ">(We will contact you for the eye readings)</p>
                                    </div>
                                    <!-- <div class="col-lg-4 col-md-4 col-10 m-auto mt-sm-3 mt-md-0 d-sm-none d-none d-md-block">
                                        <p class="h5">Description : </p>
                                        <ul>
                                            <li class="p-1">Name :  <span><?php echo ENC($rows1['P_Name'],'decrypt')?></span></li>
                                            <li class="p-1">Color : <span><?php echo  ENC($rows1['color'],'decrypt')?></span></li>
                                            <li class="p-1">R(-) :  <span><?php echo ENC($rows1['R_minus'],'decrypt')?></span></li>
                                            <li class="p-1">L(-) :  <span><?php echo ENC($rows1['L_minus'],'decrypt')?></span></li>
                                            <li class="p-1">R(+) :  <span><?php echo ENC($rows1['R_plus'],'decrypt')?></span></li>
                                            <li class="p-1">L(+) :  <span><?php echo ENC($rows1['L_plus'],'decrypt')?></span></li>
                                        </ul>
                                    </div> -->
                                </div>
                                   <?php
                                }
                            }
                        }
                    }
                }
            }else{
                echo '<div class="img-box text-center w-100"><img class="img-fluid pt-5" style="width:40%;" src="img/emptyCart.svg"></div>';
            }
            ?>
        </div>
    </body>
    <script src="js/fontawsome.js"></script>

    </html>
<?php
    }
?>