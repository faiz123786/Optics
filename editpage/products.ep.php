<?php
 session_start();
 include_once '../dbh/conn.php';
 if(!isset($_SESSION['role'])){
    header("Location: ../login.php");
 }else{
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Products</title>
        <link rel="stylesheet" href="../css/dash.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>
<body>
        <!-- Modal -->
<div class="modal d-block"  tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content"style="background: #115ed2;color: white;">
      <div class="modal-header">
        <h5 class="modal-title ms-4" id="exampleModalLabel">Update Data</h5>
      </div>
      <div class="modal-body">
          <form action="../operations/update.php" method="post" class="ms-4" enctype="multipart/form-data">
                <?php
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM products WHERE ID = {$id}";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result)){
                        while($rows = mysqli_fetch_assoc($result)){
                ?>
                <input type="hidden" name="id" value="<?php echo $id ;?>">
                <div class="mb-3 row">
                    <label for="catg_select" class="col-sm-4 col-form-label">Categories</label>
                    <div class="col-sm-8">
                        <select class="form-control form-select " aria-label="Default select example" name="catg_select">
                            <option selected disabled>Select menu</option>
                            <?php
                        $sql2 = "SELECT * FROM   categories;";   
                        $result2 = mysqli_query($conn, $sql2);
                        
                        if(mysqli_num_rows($result2) > 0){
                            $sub_catg_id  = $rows['Sub_catg_ID'];
                            while($rows2 = mysqli_fetch_assoc($result2)){
                                $sql3 = "SELECT * FROM sub_categories WHERE ID = {$sub_catg_id};";   
                                $result3 = mysqli_query($conn, $sql3) or die("Query Unsuccessfull".mysqli_error($sql3));
                                if(mysqli_num_rows($result3) > 0){
                                    while($rows3 = mysqli_fetch_assoc($result3)){
                                        if($rows3['Catg_ID'] == $rows2['ID']){
                                            $selected = "selected";
                                        }else{
                                            $selected = "";
                                        }
                                        echo "<option ".$selected." value='".$rows2['ID']."'>".ENC($rows2['Categories_name'],'decrypt')."</option>";
                                    }
                                }
                            }
                            echo '<input type="hidden" name="old_sub_id" value="'. $rows['Sub_catg_ID'].'">';
                        }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="sub_catg_select" class="col-sm-4 col-form-label">Sub_Categories</label>
                    <div class="col-sm-8">
                        <select class="form-control form-select " aria-label="Default select example" name="sub_catg_select">
                            <option selected disabled>Select menu</option>
                            <?php
                        $sql4 = "SELECT * FROM   sub_categories;";   
                        $result4 = mysqli_query($conn, $sql4);
                        
                        if(mysqli_num_rows($result4) > 0){
                            while($rows4 = mysqli_fetch_assoc($result4)){
                                if($rows['Sub_catg_ID'] == $rows4['ID']){
                                    $selected = "selected";
                                }else{
                                    $selected = "";
                                }
                                echo "<option ".$selected." value='".$rows4['ID']."'>".ENC($rows4['Sub_catg_name'],'decrypt')."</option>";
                            }
                        }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="name" class="col-sm-4 col-form-label">Product_name</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="name" value="<?php echo ENC($rows['P_Name'],'decrypt'); ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="desc" class="col-sm-4 col-form-label">Product_desc</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="desc" value="<?php echo ENC($rows['P_Desc'],'decrypt');?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="price" class="col-sm-4 col-form-label">Product_price</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="price" value="<?php echo ENC($rows['P_price'],'decrypt'); ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="color" class="col-sm-4 col-form-label">Product_color</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="color" value="<?php echo ENC($rows['color'],'decrypt'); ?>">
                    </div>
                </div>
               
                <div class="mb-3 row">
                    <label for="img" class="col-sm-4 col-form-label">Upload Image</label>
                    <div class="col-sm-8">
                     <input  class="form-control" type="file" name="img" value="<?php echo ENC($rows['Img_name'],'decrypt'); ?>">
                     <input  class="form-control" type="hidden" name="img_name" value="<?php echo ENC($rows['Img_name'],'decrypt'); ?>">
                    </div>
                </div>
             </div>
            <div class="modal-footer">
                <a href="../admin/products.php" type="button" class="btn btn-light">Close</a>
                <button type="submit" class="btn btn-light" name="update_products">Update</button>
            </div>
        </form>
        <?php
            }
        }
        ?>
    </div>
  </div>
</div>

        </body>
        </html>
        <?php
    }
    ?>