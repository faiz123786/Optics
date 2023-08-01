<?php
 session_start();
 include_once '../dbh/conn.php';
 if(!isset($_SESSION['role'])){
    header("Location: ../login.php");
 }else{
?>
<!DOCTYPE html>
    <html lang="en" style="height:100vh;background-color: #dfe7fd">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Products</title>
        <link rel="stylesheet" href="../css/dash.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>

    <body class="h-100">
        <!-- ======================
     Insert Box For Table 1
    ======================= -->
        
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="
    background: #115ed2;
    color: white;
">
      <div class="modal-header">
        <h5 class="modal-title ms-4" id="exampleModalLabel">Insert Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="../operations/insert.php" method="post" class="ms-4" enctype="multipart/form-data">
                <div class="mb-3 row">
                    <label for="catg_select" class="col-sm-4 col-form-label">Categories</label>
                    <div class="col-sm-8">
                        <select class="form-control form-select " aria-label="Default select example" name="catg_select">
                            <option selected disabled>Select menu</option>
                            <?php
                            $sql2 = "SELECT * FROM   categories;";   
                            $result2 = mysqli_query($conn, $sql2);
                            
                            if(mysqli_num_rows($result2) > 0){
                                while($rows2 = mysqli_fetch_assoc($result2)){
                                    echo "<option value='".$rows2['ID']."'>".ENC($rows2['Categories_name'],'decrypt')."</option>";
                                }
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
                        $sql3 = "SELECT * FROM   sub_categories;";   
                        $result3 = mysqli_query($conn, $sql3);
                        if(mysqli_num_rows($result3) > 0){
                            while($rows3 = mysqli_fetch_assoc($result3)){
                                echo "<option value='".$rows3['ID']."'>".ENC($rows3['Sub_catg_name'],'decrypt')."</option>";
                            }
                        }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="name" class="col-sm-4 col-form-label">Product_name</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="name">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="desc" class="col-sm-4 col-form-label">Product_desc</label>
                    <div class="col-sm-8">
                    <textarea type="text" class="form-control" name="desc"></textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="price" class="col-sm-4 col-form-label">Product_price</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="price">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="color" class="col-sm-4 col-form-label">Product_color</label>
                    <div class="col-sm-8">
                    <input type="text" class="form-control" name="color">
                    </div>
                </div>
                
                <div class="mb-3 row">
                    <label for="img" class="col-sm-4 col-form-label">Upload Image</label>
                    <div class="col-sm-8">
                     <input  class="form-control" type="file" name="img">
                    </div>
                </div>
             </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-light" name="insert_products">Insert</button>
            </div>
        </form>
    </div>
  </div>
</div>

    <!-- ======================
     DeleteAll Warning Box For Table 1
    ======================= -->
    <!-- <div class="container-fluid  w-100 fixed-top d-flex align-items-center justify-content-center bg-light deleteAll-con ">
      <div class="container w-auto h-auto  bg-infox p-0 mess-box">
          <div class="mess p-4 mt-5">
                <i class="fas fa-times d-cancel"></i>
                <span class="text text-center">Warning! By clicking confirm All the Data will be Deleted</span>
                <form action="../operations/deleteAll.php" method="POST">
                    <button name="deleteAll_products" class="mt-4 fs-5" value="submit" style="border: 2px solid red;color: red;">Confirm</button>
                </form>
            </div>
        </div>
    </div> -->
        <!-- ======================
        Main Box
        ====================== -->
        <div class="main h-100" style="background-color: #dfe7fd;">
        <!-- =============================
        Navbar
        ============================= -->
        <?php 
        include_once '../includes/slidebar.php';
        ?>
            <!-- ============================
            tables
            ============================ -->
            <div class="container-fluid">
                <div class="row w-100 d-flex align-items-start justify-content-center ">
                    <!-- =========================== First Table======================= -->
                    <div class="col-12 t-overflow">
                        <p class="h1">Products</p>
                        <div class="buttons">
                            <button class="ms-3 outterbutton insert" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fal fa-plus-circle align-middle"></i></button>
                        </div>
                        <table class="table" cellspacing="0" style="box-shadow: none;border: 2px solid #0d6efd;">
                            <tr class="bg-primary">
                                <th class="text-center">ID</th>
                                <th class="text-center">Categories</th>
                                <th>Sub_Categories</th>
                                <th>Product Name</th>
                                <th class="text-center">Product Desc</th>
                                <th class="text-center">Product Price</th>
                                <th class="text-center">Product Color</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                            <?php
                            if(isset($_GET['page'])){
                                $page = $_GET['page'];
                            }else{
                                $page = 1;
                            }
                            $limit = 2;
                            $offset = ($page - 1) * $limit;

                            $sql = "SELECT
                            cg.ID as prod_id,
                            sc.ID sub_id,
                            c.Categories_name,
                            sc.Sub_catg_name,
                            cg.P_Name,
                            cg.P_Desc,
                            cg.P_price,
                            cg.color,
                            cg.Img_name
                        FROM
                            products cg
                        INNER JOIN sub_categories sc ON
                            cg.Sub_catg_ID = sc.ID
                        INNER JOIN categories c ON
                            sc.Catg_ID = c.ID
                        LIMIT  {$offset},{$limit};";
                            $result = mysqli_query($conn,$sql) or die("Query Unsuccessfull".$sql);
                            if(mysqli_num_rows($result) > 0){
                                while($rows = mysqli_fetch_assoc($result)){
                            ?>
                            <tr>
                                <td class="text-center align-middle"><?php echo $rows['prod_id']?></td>
                                <td class="text-center align-middle"><?php echo ENC($rows['Categories_name'],'decrypt')?></td>
                                <td class="text-center align-middle"><?php echo ENC($rows['Sub_catg_name'],'decrypt')?></td>
                                <td class="text-center align-middle"><?php echo ENC($rows['P_Name'],'decrypt')?></td>
                                <td class="text-centerr align-middle"><?php echo ENC($rows['P_Desc'],'decrypt')?></td>
                                <td class="text-center align-middle"><?php echo ENC($rows['P_price'],'decrypt')?></td>
                                <td class="text-center align-middle"><?php echo ENC($rows['color'],'decrypt')?></td>
                                <td class="text-center align-middle"><img class="align-middle"src="../uploads/<?php echo ENC($rows['Img_name'],'decrypt')?>" alt="" srcset="" width=70px></td>
                                <td class="d-flex justify-content-center align-items-center align-middle text-center h-100 p-4">
                                    <a href="../editpage/products.ep.php?id=<?php echo $rows['prod_id']; ?>" class="innerbutton"><i class="far fa-pen-alt edit"></i></a>
                                    <form action="../operations/delete.php" method="POST" class="delete-form ms-2">
                                        <input type="hidden"  value="<?php echo $rows['prod_id'] ?>" name="id">
                                        <input type="hidden"  value="<?php echo $rows['sub_id'] ?>" name="sub_catg_id">
                                        <input type="hidden"  value="<?php echo ENC($rows['Img_name'],'decrypt') ?>" name="img">
                                        <button name="delete_products" value="submit" class="innerbutton"><i class="far fa-eraser delete"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                                }
                            }else if(mysqli_num_rows($result) == 0){
                                $sql1 = "ALTER TABLE products AUTO_INCREMENT = 1;";
                                mysqli_query($conn,$sql1) or die("Query Unsuccessfull");
                            }
                            ?>
                        </table>
                        <!-- ========================Pagination========================= -->
                        <?php
                        $sql1 = "SELECT * FROM products;";
                        $result1 = mysqli_query($conn,$sql1) or die("Query Unsuccessfull");
                        if(mysqli_num_rows($result1) > 0){
                            $totalrecords = mysqli_num_rows($result1);
                            $totalpages = ceil($totalrecords / $limit);
                            echo'<nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">';
                            if($page > 1){
                                echo '<li class="page-item active"><a class="page-link" href="products.php?page='.($page - 1).'">Prev</a></li>';
                            }else{
                                echo '<li class="page-item disabled" ><a class="page-link" href="#">Prev</a></li>';
                            }
                            for($i = 1; $i <= $totalpages; $i++){
                                if($page == $i){
                                    $active = 'active';
                                }else{
                                    $active = '';
                                }
                                echo '<li class="page-item '.$active.'"><a class="page-link" href="products.php?page='.$i.'">'.$i.'</a></li>';
                            }
                            if($page < $totalpages){
                                echo '<li class="page-item active"><a class="page-link" href="products.php?page='.($page + 1).'">Next</a></li>';
                            }else{
                                echo '<li class="page-item disabled" ><a class="page-link" href="#">Next</a></li>';
                            }
                            echo '   </ul>
                            </nav>';
                        }
                        ?>
                    </div>
                </div>
            </div>
    </body>
    <script src="../js/catg.js"></script>
    <script src="../js/fontawsome.js"></script>

    </html>
    <?php
    }
    ?>