
 <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Add to Cart</title>
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/dash.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>

    <body>
        <?php
    session_start();
    include_once 'dbh/conn.php';
    $url = $_SERVER["HTTP_REFERER"];
    if(isset($_SESSION['user_id'])){ 
        if(isset($_POST['ordernow'])){?>
            <div class="modal d-block" >
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content" style="
                                background: #0bbee2;
                                color: white;
                        ">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                        </div>
                        <div class="modal-body">
                        <?php  
                         $r_minus = "";
                         $l_minus = "";
                         $r_plus = "";
                         $l_plus = "";
                         $color = "";
                        $catg_id = $_POST['catg_id'];
                        if(isset($_POST['r_minus'])){
                            $r_minus = mysqli_real_escape_string($conn, $_POST['r_minus']);
                        }
                        if(isset($_POST['l_minus'])){
                            $l_minus = mysqli_real_escape_string($conn, $_POST['l_minus']);
                        }
                        if(isset($_POST['r_minus'])){
                            $r_plus = mysqli_real_escape_string($conn, $_POST['r_plus']);
                        }
                        if(isset($_POST['r_minus'])){
                            $l_plus = mysqli_real_escape_string($conn, $_POST['l_plus']);
                        }
                        if(isset($_POST['r_minus'])){
                            $color = mysqli_real_escape_string($conn, $_POST['color']);
                        }
                            $sql2 = "SELECT * FROM login WHERE ID = {$_SESSION['user_id']};";
                            $result2 = mysqli_query($conn,$sql2) or die("Unsuccessful query".mysqli_error($sql2));
                            if(mysqli_num_rows($result2) > 0){
                                while($rows2 = mysqli_fetch_assoc($result2)){
                                ?>
                                    <!-- -----------------Form------------------ -->
                                    <form action="operations/insert.php" method="post">
                                        <input type="hidden"  class="form-control" name="cust_id" value="<?php echo $_SESSION['user_id'] ?>">
                                        <input type="hidden"  class="form-control" name="r_minus" value="<?php echo $l_minus ?>">
                                        <input type="hidden"  class="form-control" name="l_minus" value="<?php echo $r_minus ?>">
                                        <input type="hidden"  class="form-control" name="l_plus" value="<?php echo $r_plus ?>">
                                        <input type="hidden"  class="form-control" name="r_plus" value="<?php echo $l_plus ?>">
                                        <input type="hidden"  class="form-control" name="color" value="<?php echo $color ?>">
                                        <input type="hidden"  class="form-control" name="prod_id" value="<?php echo $_POST['prod_id'] ?>">
                                        <div class="mb-3 row">
                                            <label for="fname" class="col-sm-4 col-form-label">First Name</label>
                                            <div class="col-sm-8">
                                            <input type="text" required class="form-control" name="fname"  value="<?php echo ENC($rows2['F_name'],'decrypt') ?>" >
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="lname" class="col-sm-4 col-form-label">Last Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" required class="form-control" value="<?php echo ENC($rows2['L_name'],'decrypt') ?>" name="lname">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="Email" class="col-sm-4 col-form-label">Email</label>
                                            <div class="col-sm-8">
                                            <input type="email" required class="form-control" value="<?php echo ENC($rows2['Email'],'decrypt') ?>" name="email">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="mob" class="col-sm-4 col-form-label">Mobile no.</label>
                                            <div class="col-sm-8">
                                            <input type="text" required class="form-control"  name="mobile">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="address" class="col-sm-4 col-form-label">Address</label>
                                            <div class="col-sm-8">
                                                <input type="text" required class="form-control"  name="address">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="quantity" class="col-sm-4 col-form-label">Products Qty : </label>
                                            <div class="col-sm-8">
                                                <input type="text" required class="form-control"  name="quantity">
                                            </div>
                                        </div>
                                    
                                        <div class="modal-footer">
                                            <a href="addtocart.php?cust_id=<?php echo $_SESSION['user_id']; ?>" type="button" class="btn btn-light" data-bs-dismiss="modal">Close</a>
                                            <button type="submit" class="btn btn-light" name="insert_orders">Confirm</button>
                                        </div>
                                    </form>
                        <?php   }
                            }   ?>
                    </div>
                </div>
            </div>
            <?php
        }else{
        header("Location: $url");
        }    
    }else{
        header("Location: login.php");
    }
    ?>
        </body>
    <script src="js/fontawsome.js"></script>

    </html>