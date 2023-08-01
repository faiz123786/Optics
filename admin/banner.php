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
        <title>Banner</title>
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
                <form action="../operations/insert.php" method="POST" class=" p-5 d-flex align-items-center justify-content-center flex-column" enctype="multipart/form-data">
                    <div class="p-2 text-center text-md-start">
                        <i class="fal fa-times cancel"></i>
                        <label for="name" class="form-label d-inline-block label">Image &nbsp;: </label>
                        <input type="file" class="form-control input" required name="img">
                    </div>
                    <button type="submit" class="btn btn-light insertbtn " name="insert_homeBanner">Submit</button>
                </form>
            </div>
        </div>
        <!-- ======================
     Insert Box For Table 2
    ======================= -->
        <div class="container-fluid h-100 w-100 fixed-top d-flex align-items-center justify-content-center insert-cont2 ">
            <div class="container w-auto h-auto  bg-primary box p-0 rounded-1">
                <form action="../operations/insert.php" method="post" class="p-5 d-flex align-items-center justify-content-center flex-column" enctype="multipart/form-data">
                    <div class="p-2 text-center text-md-start">
                        <i class="fal fa-times cancelt2"></i>
                        <label for="img" class="form-label d-inline-block label">Image &nbsp;: </label>
                        <input type="file" class="form-control input" required name="img">
                    </div>
                    <button type="submit" class="btn btn-light insertbtn" name="insert_adsBanner">Submit</button>
                </form>
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
                        <p class="h1">Home Banner</p>
                        <div class="buttons">
                            <button class="ms-3 outterbutton insert"><i class="fal fa-plus-circle align-middle"></i></button>
                        </div>
                        <table class="table " cellspacing="0">
                            <tr class="bg-primary">
                                <th class="text-center">ID</th>
                                <th>Image</th>
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

                            $sql = "SELECT * FROM home_banner;";
                            $result = mysqli_query($conn,$sql) or die("Query Unsuccessfull".$sql);
                            if(mysqli_num_rows($result) > 0){
                                while($rows = mysqli_fetch_assoc($result)){
                            ?>
                            <tr>
                                <td class="text-center align-middle"><?php echo $rows['ID']?></td>
                                <td class="text-center align-middle"><img class="align-middle"src="../uploads/<?php echo ENC($rows['Img_name'],'decrypt')?>" alt="" srcset="" width=140px></td>
                                <td class="d-flex justify-content-center">
                                    <a href="../editpage/homebanner.ep.php?id=<?php echo $rows['ID']; ?>" class="innerbutton"><i class="far fa-pen-alt edit"></i></a>
                                    <form action="../operations/delete.php" method="POST" class="delete-form ms-2">
                                        <input type="hidden"  value="<?php echo $rows['ID'] ?>" name="id">
                                        <input type="hidden"  value="<?php echo ENC($rows['Img_name'],'decrypt') ?>" name="img">
                                        <button name="delete_homeBanner" value="submit" class="innerbutton"><i class="far fa-eraser delete"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                                }
                            }else if(mysqli_num_rows($result) == 0){
                                $sql1 = "ALTER TABLE home_banner AUTO_INCREMENT = 1;";
                                mysqli_query($conn,$sql1) or die("Query Unsuccessfull");
                            }
                            ?>
                        </table>
                    </div>
                    <!-- =========================== Second Table======================= -->
                    <div class="col-lg-5 col-md-10 col-sm-11 col-11 mt-lg-0 mt-5 t2-overflow">
                        <p class="h1">Ads Banner</p>
                        <div class="buttons">
                            <button class="ms-3 outterbutton insert2"><i class="fal fa-plus-circle align-middle"></i></button>
                        </div>
                        <table class="table">
                            <tr class="bg-primary">
                                <th class="text-center">ID</th>
                                <th>Image</th>
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
                            *
                            FROM
                            ads_banner;";
                            $result = mysqli_query($conn,$sql);
                            if(mysqli_num_rows($result) > 0){
                                while($rows = mysqli_fetch_assoc($result)){
                            ?>
                            <tr>
                                <td class="text-center align-middle"><?php echo $rows['ID']?></td>
                                <td class="text-center align-middle"><img class="align-middle"src="../uploads/<?php echo ENC($rows['Img_name'],'decrypt')?>" alt="" srcset="" width=140px></td>
                                <td class="d-flex justify-content-center">
                                    <a href="../editpage/adsbanner.ep.php?id=<?php echo $rows['ID']; ?>" class="innerbutton"><i class="far fa-pen-alt edit"></i></a>
                                    <form action="../operations/delete.php" method="POST" class="delete-form ms-2">
                                        <input type="hidden"   value="<?php echo $rows['ID'] ?>" name="id">
                                        <input type="hidden"   value="<?php echo ENC($rows['Img_name'],'decrypt') ?>" name="img">
                                        <button name="delete_adsBanner" value="submit" class="innerbutton"><i class="far fa-eraser delete"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                                }
                            }else if(mysqli_num_rows($result) == 0){
                                $sql1 = "ALTER TABLE ads_banner AUTO_INCREMENT = 1;";
                                mysqli_query($conn,$sql1) or die("Query Unsuccessfull");
                            }
                            ?>
                        </table>
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