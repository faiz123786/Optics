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
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Orders List</title>
        <link rel="stylesheet" href="../css/dash.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>

    <body class="h-100">
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
                        <p class="h1">Orders List</p>
                        <!-- <div class="buttons">
                            <button class="ms-3 outterbutton insert"><i class="fal fa-plus-circle align-middle"></i></button>
                            <button class="ms-1 outterbutton deleteAll"><i class="fal fa-trash-alt"></i></button>
                        </div> -->
                        <table class="table" cellspacing="0" style="box-shadow: none;border: 2px solid #0d6efd;">
                            <tr class="bg-primary">
                                <th class="text-center">ID</th>
                                <th class="text-center">Name</th>
                                <th>Product Name</th>
                                <th>Categories</th>
                                <th>Sub_Categories</th>
                                <th>R(-)</th>
                                <th>L(-)</th>
                                <th>R(+)</th>
                                <th>L(+)</th>
                                <th>Quantity</th>
                                <th class="text-center">Mobile no.</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Address</th>
                                <!-- <th>Actions</th> -->
                            </tr>
                            <?php
                            if(isset($_GET['page'])){
                                $page = $_GET['page'];
                            }else{
                                $page = 1;
                            }
                            $limit = 5;
                            $offset = ($page - 1) * $limit;

                            // $sql = "SELECT ord.ID,ord.F_name,ord.L_name,ord.Email,ord.Prod_ID,ord.Contact_no,ord.Address FROM orders ord
                            // INNER JOIN  login log
                            // ON ord.Cust_ID = log.ID
                            //  LIMIT {$offset},{$limit};";
                            $sql = "SELECT * FROM orders LIMIT {$offset},{$limit};";
                            $result = mysqli_query($conn,$sql) or die("Query Unsuccessfull".$sql);
                            if(mysqli_num_rows($result) > 0){
                                while($rows = mysqli_fetch_assoc($result)){
                                    $sql2 = "SELECT * FROM products WHERE ID = {$rows['Prod_ID']};";
                                    $result2 = mysqli_query($conn,$sql2) or die("Query Unsuccessfull".$sql2);
                                    if(mysqli_num_rows($result2) > 0){
                                        while($rows2 = mysqli_fetch_assoc($result2)){
                                            $sql3 = "SELECT * FROM sub_categories WHERE ID = {$rows2['Sub_catg_ID']};";
                                            $result3 = mysqli_query($conn,$sql3) or die("Query Unsuccessfull".$sql3);
                                            if(mysqli_num_rows($result3) > 0){
                                                while($rows3 = mysqli_fetch_assoc($result3)){
                                                    $sql4 = "SELECT * FROM categories WHERE ID = {$rows3['Catg_ID']};";
                                                    $result4 = mysqli_query($conn,$sql4) or die("Query Unsuccessfull".$sql4);
                                                    if(mysqli_num_rows($result4) > 0){
                                                        while($rows4 = mysqli_fetch_assoc($result4)){
                                                            ?>
                                                                <tr>
                                                                    <td class="text-center align-middle"><?php echo $rows['ID']?></td>
                                                                    <td class="text-center align-middle"><?php echo ENC($rows['F_name'],'decrypt')?>&nbsp;<?php echo ENC($rows['L_name'],'decrypt')?></td>
                                                                    <td class="text-center align-middle"><?php echo ENC($rows2['P_Name'],'decrypt')?></td>
                                                                    <td class="text-center align-middle"><?php echo ENC($rows4['Categories_name'],'decrypt')?></td>
                                                                    <td class="text-center align-middle"><?php echo ENC($rows3['Sub_catg_name'],'decrypt')?></td>
                                                                    <td class="text-center align-middle"><?php echo ENC($rows['L_minus'],'decrypt')?></td>
                                                                    <td class="text-center align-middle"><?php echo ENC($rows['R_plus'],'decrypt')?></td>
                                                                    <td class="text-center align-middle"><?php echo ENC($rows['L_plus'],'decrypt')?></td>
                                                                    <td class="text-center align-middle"><?php echo ENC($rows['color'],'decrypt')?></td>
                                                                    <td class="text-center align-middle"><?php echo $rows['Quantity']?></td>
                                                                    <td class="text-center align-middle"><?php echo $rows['Contact_no']?></td>
                                                                    <td class="text-center align-middle"><?php echo ENC($rows['Email'],'decrypt')?></td>
                                                                    <td class="text-center align-middle"><?php echo ENC($rows['Address'],'decrypt')?></td>
                                                                    
                                                                    <!-- <td class="d-flex justify-content-center align-items-center align-middle text-center h-100 p-4">
                                                                        <a href="../editpage/products.ep.php?id=<?php echo $rows['ID']; ?>" class="innerbutton"><i class="far fa-pen-alt edit"></i></a>
                                                                        <form action="../operations/delete.php" method="POST" class="delete-form ms-2">
                                                                            <input type="text" hidden value="<?php echo $rows['ID'] ?>" name="id">
                                                                            <button name="delete_products" value="submit" class="innerbutton"><i class="far fa-eraser delete"></i></button>
                                                                        </form>
                                                                    </td> -->
                                                                </tr>
                                                            <?php
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }else if(mysqli_num_rows($result) == 0){
                                $sql1 = "ALTER TABLE orders AUTO_INCREMENT = 1;";
                                mysqli_query($conn,$sql1) or die("Query Unsuccessfull");
                            }
                            ?>
                        </table>
                        <!-- ========================Pagination========================= -->
                        <?php
                        $sql1 = "SELECT * FROM orders;";
                        $result1 = mysqli_query($conn,$sql1) or die("Query Unsuccessfull");
                        if(mysqli_num_rows($result1) > 0){
                            $totalrecords = mysqli_num_rows($result1);
                            $totalpages = ceil($totalrecords / $limit);
                            echo'<nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">';
                            if($page > 1){
                                echo '<li class="page-item active"><a class="page-link" href="adminorders.php?page='.($page - 1).'">Prev</a></li>';
                            }else{
                                echo '<li class="page-item disabled" ><a class="page-link" href="#">Prev</a></li>';
                            }
                            for($i = 1; $i <= $totalpages; $i++){
                                if($page == $i){
                                    $active = 'active';
                                }else{
                                    $active = '';
                                }
                                echo '<li class="page-item '.$active.'"><a class="page-link" href="adminorders.php?page='.$i.'">'.$i.'</a></li>';
                            }
                            if($page < $totalpages){
                                echo '<li class="page-item active"><a class="page-link" href="adminorders.php?page='.($page + 1).'">Next</a></li>';
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