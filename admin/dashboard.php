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
        <title>Dashboard</title>
        <link rel="stylesheet" href="../css/dash.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>

    <body class="h-100">
        <!-- ======================
     Insert Box For Table 1
    ======================= -->
        <div class="container-fluid h-100 w-100 fixed-top d-flex align-items-center justify-content-center insert-con ">
            <div class="container w-auto h-auto  bg-primary box p-0 rounded-1">
                <form action="../operations/insert.php" method="POST" class=" p-5 d-flex align-items-center justify-content-center flex-column">
                    <div class="p-2 text-center text-md-start">
                        <i class="fal fa-times cancel"></i>
                        <label for="name" class="form-label d-inline-block label">Categories &nbsp;: </label>
                        <input type="text" class="form-control input" name="name">
                    </div>
                    <button type="submit" class="btn btn-light insertbtn " name="insert_catg_t1">Submit</button>
                </form>
            </div>
        </div>
        <!-- ======================
     Insert Box For Table 2
    ======================= -->
        <div class="container-fluid h-100 w-100 fixed-top d-flex align-items-center justify-content-center insert-cont2 ">
            <div class="container w-auto h-auto  bg-primary box p-0 rounded-1">
                <form action="../operations/insert.php" method="post" class="p-5 d-flex align-items-center justify-content-center flex-column">
                    <div class="p-2 text-center text-md-start">
                        <i class="fal fa-times cancelt2"></i>
                        <label for="select" class="form-label d-inline-block label">Categories</label>
                        <select name="select" id="" class="input" style="width:160px;">
                            <option disabled selected>select</option>
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
                        <br><br>
                        <label for="name" class="form-label d-inline-block label">Sub Categories &nbsp;: </label>
                        <input type="text" class="form-control input" name="name">
                    </div>
                    <button type="submit" class="btn btn-light insertbtn" name="insert_catg_t2">Submit</button>
                </form>
            </div>
        </div>
    <!-- ======================
     DeleteAll Warning Box For Table 1
    ======================= -->
    <div class="container-fluid  w-100 fixed-top d-flex align-items-center justify-content-center bg-light deleteAll-con ">
      <div class="container w-auto h-auto  p-0 mess-box">
          <div class="mess p-4 mt-5">
                <i class="fas fa-times d-cancel"></i>
                <span class="text text-center">Warning! By clicking confirm All the Data will be Deleted</span>
                <form action="../operations/deleteAll.php" method="POST">
                    <button name="deleteAllt1" class="mt-4 fs-5" value="submit" style="border: 2px solid red;color: red;">Confirm</button>
                </form>
            </div>
        </div>
    </div>
    <!-- ======================
     DeleteAll Warning Box For Table 2
    ======================= -->
    <div class="container-fluid  w-100 fixed-top d-flex align-items-center justify-content-center bg-light deleteAll-cont2 ">
      <div class="container w-auto h-auto  p-0 mess-box">
          <div class="mess p-4 mt-5">
                <i class="fas fa-times d-cancelt2"></i>
                <span class="text text-center">Warning! By clicking confirm All the Data will be Deleted</span>
                <form action="../operations/deleteAll.php" method="POST">
                    <button name="deleteAllt2" class="mt-4 fs-5" value="submit" style="border: 2px solid red;color: red;">Confirm</button>
                </form>
            </div>
        </div>
    </div>
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
                <div class="row w-100 d-flex align-items-start justify-content-center">
                    <!-- =========================== First Table======================= -->
                    <div class="col-lg-4 col-md-9 col-sm-10 col-11 ">
                        <p class="h1">Categories</p>
                        <div class="buttons">
                            <button class="ms-3 outterbutton insert"><i class="fal fa-plus-circle align-middle"></i></button>
                        </div>
                        <table class="table " cellspacing="0">
                            <tr class="bg-primary">
                                <th class="text-center">ID</th>
                                <th>Categories Name</th>
                                <th>Actions</th>
                            </tr>
                            <?php
                            if(isset($_GET['page'])){
                                $page = $_GET['page'];
                            }else{
                                $page = 1;
                            }
                            $limit = 6;
                            $offset = ($page - 1) * $limit;

                            $sql = "SELECT * FROM categories LIMIT {$offset},{$limit};";
                            $result = mysqli_query($conn,$sql) or die("Query Unsuccessfull".$sql);
                            if(mysqli_num_rows($result) > 0){
                                while($rows = mysqli_fetch_assoc($result)){
                            ?>
                            <tr>
                                <td class="text-center align-middle"><?php echo $rows['ID']?></td>
                                <td class="text-start align-middle"><?php echo ENC($rows['Categories_name'],'decrypt')?></td>
                                <td class="d-flex justify-content-center">
                                    <a href="../editpage/categories.ep.php?id=<?php echo $rows['ID']; ?>" class="innerbutton"><i class="far fa-pen-alt edit"></i></a>
                                    <form action="../operations/delete.php" method="POST" class="delete-form ms-2">
                                        <input type="hidden"  value="<?php echo $rows['ID'] ?>" name="id">
                                        <button name="delete_catg" value="submit" class="innerbutton"><i class="far fa-eraser delete"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                                }
                            }else if(mysqli_num_rows($result) == 0){
                                $sql1 = "ALTER TABLE categories AUTO_INCREMENT = 1;";
                                mysqli_query($conn,$sql1) or die("Query Unsuccessfull");
                            }
                            ?>
                        </table>
                        <!-- ========================Pagination========================= -->
                        <?php
                        $sql1 = "SELECT * FROM categories;";
                        $result1 = mysqli_query($conn,$sql1) or die("Query Unsuccessfull");
                        if(mysqli_num_rows($result1) > 0){
                            $totalrecords = mysqli_num_rows($result1);
                            $totalpages = ceil($totalrecords / $limit);
                            echo'<nav aria-label="Page navigation example">
                            <ul class="pagination mt-4 mb-5 justify-content-center">';
                            if($page > 1){
                                echo '<li class="page-item active"><a class="page-link" href="dashboard.php?page='.($page - 1).'">Prev</a></li>';
                            }else{
                                echo '<li class="page-item disabled" ><a class="page-link" href="#">Prev</a></li>';
                            }
                            for($i = 1; $i <= $totalpages; $i++){
                                if($page == $i){
                                    $active = 'active';
                                }else{
                                    $active = '';
                                }
                                echo '<li class="page-item '.$active.'"><a class="page-link" href="dashboard.php?page='.$i.'">'.$i.'</a></li>';
                            }
                            if($page < $totalpages){
                                echo '<li class="page-item active"><a class="page-link" href="dashboard.php?page='.($page + 1).'">Next</a></li>';
                            }else{
                                echo '<li class="page-item disabled" ><a class="page-link" href="#">Next</a></li>';
                            }
                            echo '   </ul>
                            </nav>';
                        }
                        ?>
                    </div>
                    <!-- =========================== Second Table======================= -->
                    <div class="col-lg-5 col-md-10 col-sm-11 col-11 mt-lg-0 mt-5 t2-overflow">
                        <p class="h1">Sub_Categories</p>
                        <div class="buttons">
                            <button class="ms-3 outterbutton insert2"><i class="fal fa-plus-circle align-middle"></i></button>
                        </div>
                        <table class="table">
                            <tr class="bg-primary">
                                <th class="text-center">ID</th>
                                <th class="text-center">Catg_ID</th>
                                <th>Categories Name</th>
                                <th>Actions</th>
                            </tr>
                            <?php
                            if(isset($_GET['pageb'])){
                                $pageb = $_GET['pageb'];
                            }else{
                                $pageb = 1;
                            }
                            $limit1 = 6;
                            $offset1 = ($pageb - 1) * $limit1;
                            $sql = "SELECT
                            sc.ID as sub_id,
                            c.ID as catg_id,
                            sc.Sub_catg_name,
                            c.Categories_name
                            FROM
                            sub_categories sc
                            INNER JOIN categories c
                            ON sc.catg_ID = c.ID
                            LIMIT {$offset1},{$limit1};";
                            $result = mysqli_query($conn,$sql);
                            if(mysqli_num_rows($result) > 0){
                                while($rows = mysqli_fetch_assoc($result)){
                            ?>
                            <tr>
                                <td class="text-center align-middle"><?php echo $rows['sub_id']?></td>
                                <td class="text-center align-middle"><?php echo ENC($rows['Categories_name'],'decrypt')?></td>
                                <td class="text-start align-middle"><?php echo ENC($rows['Sub_catg_name'],'decrypt')?></td>
                                <td class="d-flex justify-content-center">
                                    <a href="../editpage/sub_catg.ep.php?id=<?php echo $rows['sub_id']; ?>" class="innerbutton"><i class="far fa-pen-alt edit"></i></a>
                                    <form action="../operations/delete.php" method="POST" class="delete-form ms-2">
                                        <input type="hidden"   value="<?php echo $rows['sub_id'] ?>" name="id">
                                        <input type="hidden"   value="<?php echo $rows['catg_id'] ?>" name="catg_id">
                                        <button name="delete_sub_catg" value="submit" class="innerbutton"><i class="far fa-eraser delete"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                                }
                            }else if(mysqli_num_rows($result) == 0){
                                $sql1 = "ALTER TABLE sub_categories AUTO_INCREMENT = 1;";
                                mysqli_query($conn,$sql1) or die("Query Unsuccessfull");
                            }
                            ?>
                        </table>
                         <!-- ========================Pagination========================= -->
                         <?php
                        $sql1 = "SELECT * FROM sub_categories;";
                        $result1 = mysqli_query($conn,$sql1) or die("Query Unsuccessfull");
                        if(mysqli_num_rows($result1) > 0){
                            $totalrecords1 = mysqli_num_rows($result1);
                            $totalpages1 = ceil($totalrecords1 / $limit1);
                            echo'<nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">';
                            if($pageb > 1){
                                echo '<li class="page-item active"><a class="page-link" href="dashboard.php?pageb='.($pageb - 1).'">Prev</a></li>';
                            }else{
                                echo '<li class="page-item disabled" ><a class="page-link" href="#">Prev</a></li>';
                            }
                            for($i = 1; $i <= $totalpages1; $i++){
                                if($pageb == $i){
                                    $active = 'active';
                                }else{
                                    $active = '';
                                }
                                echo '<li class="page-item '.$active.'"><a class="page-link" href="dashboard.php?pageb='.$i.'">'.$i.'</a></li>';
                            }
                            if($pageb < $totalpages1){
                                echo '<li class="page-item active"><a class="page-link" href="dashboard.php?pageb='.($pageb + 1).'">Next</a></li>';
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
    <script src="../js/main.js"></script>
    <script src="../js/fontawsome.js"></script>

    </html>
    <?php
    }
    ?>