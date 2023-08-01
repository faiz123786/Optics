<?php
session_start();
// if(!isset($_SESSION['user_id'])){
//     include_once "dbh/conn.php";
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>

    <!-- ======================================NAVBAR================================= -->
    <?php
    include_once "includes/nav.php";
    ?>
    <!-- ======================================Banner====================================== -->
    <div class="banner" style="margin-top:4rem;">
        <div class="
          container
          d-flex
          justify-content-center
          align-items-center align-content-center
        ">
            <div class="row">
                <div class="
              col-lg-5
              order-2 order-lg-1
              con-1
              d-flex
              justify-content-end
              align-items-center align-content-center
            ">
                    <p class="h1 text-center text-lg-end mb-auto title-text">
                        best glasses at cheapest price
                    </p>
                </div>

                <div class="col-lg-7 order-sm-1 order-lg-2">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php $sql4 = "SELECT * FROM home_banner;";
                            $result4 = mysqli_query($conn, $sql4);
                            if (mysqli_num_rows($result4) > 0) {
                                $i = 0;
                                foreach ($result4 as $rows) {
                                    $active = '';
                                    if ($i == 0) {
                                        $active = 'active';
                                    }
                            ?>
                                    <div class="carousel-item <?php echo $active ?>">
                                        <img src="uploads/<?php echo ENC($rows['Img_name'], 'decrypt'); ?>" class="d-block w-100 img-fluid" alt="..." />
                                    </div>
                            <?php
                                    $i++;
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="section-1 mt-5">
        <div class="container">
            <?php $sql1 = "SELECT * FROM categories WHERE totalSub_catg > 0 LIMIT 0,4;";
            $result1 = mysqli_query($conn, $sql1);
            if (mysqli_num_rows($result1) > 0) {
                while ($rows1 = mysqli_fetch_assoc($result1)) {
            ?>
                    <h1 class="text-center p-3"><?php echo ENC($rows1['Categories_name'], 'decrypt') ?></h1>
                    <div class="row align-items-center mb-4">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card-columns p-2">
                                <?php
                                $sql2 = "SELECT * FROM sub_categories WHERE Catg_ID = {$rows1['ID']} AND totalProducts > 0";
                                $result2 = mysqli_query($conn, $sql2) or die("Query Unsuccessfull");
                                if (mysqli_num_rows($result2) > 0) {
                                    while ($rows2 = mysqli_fetch_assoc($result2)) {
                                        $sql3 = "SELECT * FROM products WHERE Sub_catg_ID = {$rows2['ID']}";
                                        $result3 = mysqli_query($conn, $sql3) or die("Query Unsuccessfull");
                                        if (mysqli_num_rows($result3) > 0) {
                                            while ($rows3 = mysqli_fetch_assoc($result3)) {
                                                echo "<div class='cards shadow'><a href='preview.php?id=" . $rows3['ID'] . "'><img src='uploads/" . ENC($rows3['Img_name'], 'decrypt') . "' class='img-fluid'></a></div>";
                                            }
                                        }
                                    }
                                }

                                ?>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
    <div class="section-2 my-5">
        <div class="row template mx-auto">
            <div class="container">
                <div class="col-12">
                    <?php
                    $sql5 = "SELECT * FROM ads_banner LIMIT 0,1;";
                    $result5 = mysqli_query($conn, $sql5);
                    if (mysqli_num_rows($result5) > 0) {
                        while ($rows5 = mysqli_fetch_assoc($result5)) {
                            echo '<img src="uploads/' . ENC($rows5['Img_name'], 'decrypt') . '" class="img-fluid" alt="" />';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- ==========================================FOOTER============================================= -->
    <?php
    include_once "includes/footer.php";
    ?>

</body>
<script src="js/fontawsome.js"></script>

</html>