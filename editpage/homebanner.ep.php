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
        <title>Home Banner</title>
        <link rel="stylesheet" href="../css/dash.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>

    <body>
        <div class="container-fluid h-100 w-100 fixed-top d-flex align-items-center justify-content-center editpg">
            <div class="container w-auto h-auto  bg-primary box p-0">
                <form action="../operations/update.php" method="POST" class="p-5 d-flex rounded-1 align-items-center justify-content-center flex-column" enctype="multipart/form-data">
                    <div class="p-2 text-center">
                        <?php
                        $id = $_GET['id'];
                        $sql = "SELECT * FROM home_banner WHERE ID = {$id}";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result)){
                            while($rows = mysqli_fetch_assoc($result)){

                         
                        ?>
                        <i class="fal fa-times cancel"></i>
                        <label for="img" class="form-label d-inline-block label">Image &nbsp;: </label>
                        <input type="hidden" class="form-control input" name="id" value="<?php echo $id ?>">
                        <input type="file" class="form-control input" name="img">
                        <input type="hidden" class="form-control input" name="img_name" value="<?php echo ENC($rows['Img_name'],'decrypt')?>">
                        <br><br>
                        <img style="width:150px" src="../uploads/<?php echo ENC($rows['Img_name'],'decrypt')?>" alt="">
                    </div>
                    <button type="submit" class="btn btn-light insertbtn " name="update_homeBanner">Submit</button>
                </form>
                <?php
                   }
                }
                ?>
            </div>
        </div>
    </body>

    </html>
    <?php
    }
    ?>