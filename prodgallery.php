<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gallery</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <!-- ====================================== NAVBAR ================================= -->
    <?php
    include_once "includes/nav.php";
    ?>
    <section style="margin-top:4rem;">
    <?php
            $sub_catg_id = $_GET['sub_catg_id'];
            $sql1 = "SELECT * FROM sub_categories  sc
            INNER JOIN categories c
            ON sc.Catg_ID = c.ID
            WHERE sc.ID = {$sub_catg_id}";
            $result1 = mysqli_query($conn, $sql1);
            if(mysqli_num_rows($result1) > 0){
                while($rows1 = mysqli_fetch_assoc($result1)){
                    echo '<div class="demo-banner">
                            <div class="container-fluid d-flex align-items-center">
                                <div class="col-12 my-auto">
                                    <h1 class="text-center">'.ENC($rows1['Categories_name'],'decrypt').'</h1>
                                </div>
                            </div>
                          </div>';
                }
            }
            ?>
        <div class="container"  >
            
            <div class="row align-items-center mb-4">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card-columns p-2">
                        <?php
                      
                        $sql = "SELECT * FROM products WHERE Sub_catg_ID = {$sub_catg_id};";
                        // echo $sql;
                        // die();
                        $result = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result) > 0){
                            while($rows = mysqli_fetch_assoc($result)){
                                echo "<div class='cards shadow'><a href='preview.php?id=".$rows['ID']."'><img src='uploads/".ENC($rows['Img_name'],'decrypt')."'class='img-fluid'></a></div>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="js/fontawsome.js"></script>
</html>