<?php
session_start();
if(!isset($_SESSION['user_id'])){
    // include_once "dbh/conn.php";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Preview </title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/dash.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
     <!-- ======================================NAVBAR================================= -->
     <?php
    include_once "includes/nav.php";
    // include "dbh/conn.php";
    ?>

    <!-- ==========================================Preview Box================================== -->
    <section class="wrapper p-5" style="margin-top:4rem;">
    <div class="container">
        <div class="row">
         <?php
            $id = mysqli_real_escape_string($conn,$_GET['id']);
            $sql = "SELECT * FROM products WHERE ID = {$id};";
            $result = mysqli_query($conn, $sql) or die("Query Unsuccessfull".$sql);
            if(mysqli_num_rows($result) > 0 ){
                while($rows = mysqli_fetch_assoc($result)){
                  $catg_id = $rows['Sub_catg_ID'];
                  $sql1 = "SELECT * FROM sub_categories WHERE ID = {$catg_id}";
                  $result1 = mysqli_query($conn, $sql1) or die("Query Unsuccessfull".$sql1);
                  if(mysqli_num_rows($result1) > 0 ){
                    while($rows1 = mysqli_fetch_assoc($result1)){
                      
         ?>
                <div class="col-lg-6 col-sm-12 col-12 d-flex align-items-center justify-content-center">
                    <div class="img" style="width: 450px;">
                        <img src="uploads/<?php echo ENC($rows['Img_name'],'decrypt')?>" class="img-fluid" style="width: 500px;border-radius: 40px;">
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12 col-12 d-flex flex-column align-items-start justify-content-center pt-5">
                    <div class="row  border border-dark ms-lg-5 ms-md-5 w-100">
                        <div class="col-12 p-3">
                            <h1 class="p-2"> Preview </h1>
                            <h3 class="p-1">
                                <!-- Product Name -->
                                <?php echo ENC($rows['P_Name'],'decrypt')?>
                                <p style="font-size: 17px;">(<?php echo ENC($rows1['Sub_catg_name'],'decrypt')?>)</p>
                            </h3>
                            <h4 class="p-2" id="price"> &#x20B9;<?php echo ENC($rows['P_price'],'decrypt')?></h4>
                            <div class="d-grid gap-2 d-md-block m-2 mb-4">
                            <form class="d-inline-block" method="POST" action="operations/insert.php">
                              <?php 
                                if(isset($_SESSION['user_id'])){
                                echo "<input type='hidden' name='cust_id' value='".$_SESSION['user_id']."'>";
                                }
                              ?>
                                <input type="hidden" name="prod_id" value="<?php echo $rows['ID']?>">
                                <button class="btn btn-primary me-md-0 me-lg-2 w-100" type="submit" name="addtocart">Add to cart</button>
                            </form>
                            <!-- Button trigger modal -->
                            <!-- <button type="button" class="btn btn-success ms-0 ms-md-2" data-bs-toggle="modal" data-bs-target="#exampleModalCenteredScrollable">Order Now</button> -->
                            <div class="mt-4 d-flex align-items-center" style="width:100%;height:auto">
                                <div class="me-4" style="width:30px;height:30px;background:black;border-radius:50%;border: 2px solid #ccc;cursor:pointer"></div>
                                <div class="me-4" style="width:30px;height:30px;background:blue;border-radius:50%;border: 2px solid #ccc;cursor:pointer"></div>
                                <div class="me-4" style="width:30px;height:30px;background:red;border-radius:50%;border: 2px solid #ccc;cursor:pointer"></div>
                                <div class="me-4" style="width:30px;height:30px;background:yellow;border-radius:50%;border: 2px solid #ccc;cursor:pointer"></div>
                                <div style="width:30px;height:30px;background:green;border-radius:50%;border: 2px solid #ccc;cursor:pointer"></div>
                            </div>
                            <P class="pt-3">Description : <?php echo ENC($rows['P_Desc'],'decrypt')?></P>
                            <?php
                            if(isset($_SESSION['user_id'])){ ?>
                                <div class="modal fade" id="exampleModalCenteredScrollable" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content" style="background: #0bbee2;color: white;">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <?php  
                                                $sql2 = "SELECT * FROM login WHERE ID = {$_SESSION['user_id']};";
                                                $result2 = mysqli_query($conn,$sql2) or die("Unsuccessful query".mysqli_error($sql2));
                                                if(mysqli_num_rows($result2) > 0){
                                                    while($rows2 = mysqli_fetch_assoc($result2)){
                                                    ?>
                                                        <!-- -----------------Form------------------ -->
                                                        <form action="operations/insert.php" method="post">
                                                            <input type="hidden"  class="form-control" name="cust_id" value="<?php echo $_SESSION['user_id'] ?>">
                                                            <input type="hidden"  class="form-control" name="prod_id" value="<?php echo $_GET['id'] ?>">
                                                            <div class="mb-3 row">
                                                                <label for="fname" class="col-sm-4 col-form-label">First Name</label>
                                                                <div class="col-sm-8">
                                                                <input type="text"  class="form-control" name="fname"  value="<?php echo ENC($rows2['F_name'],'decrypt') ?>" >
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="lname" class="col-sm-4 col-form-label">Last Name</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text"  class="form-control" value="<?php echo ENC($rows2['L_name'],'decrypt') ?>" name="lname">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="Email" class="col-sm-4 col-form-label">Email</label>
                                                                <div class="col-sm-8">
                                                                <input type="email"  class="form-control" value="<?php echo ENC($rows2['Email'],'decrypt') ?>" name="email">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="mob" class="col-sm-4 col-form-label">Mobile no.</label>
                                                                <div class="col-sm-8">
                                                                <input type="text"  class="form-control"  name="mobile">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="address" class="col-sm-4 col-form-label">Address</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text"  class="form-control"  name="address">
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-light" name="insert_orders">Confirm</button>
                                                            </div>
                                                        </form>
                                            <?php   }
                                                }   ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }else{  ?>
                                <div class="modal fade" id="exampleModalCenteredScrollable" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title fw-bold" id="exampleModalLabel" style="color:red;" >You have not Logged in yet!</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="login.php" type="button" class="btn btn-primary">Login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php  } ?>

                    </div>
                </div>
                    </div>
                </div>
              
            <?php
               }
                 }
              }
            }
            ?>
        </div>
    </div>
    </section>
    <?php 
    include_once "includes/footer.php";
    ?>
</body>
<script src="js/fontawsome.js"></script>

</html>