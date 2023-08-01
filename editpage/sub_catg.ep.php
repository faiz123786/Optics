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
    <body>
    <div class="container-fluid h-100 w-100 fixed-top d-flex align-items-center justify-content-center editpg">
            <div class="container w-auto h-auto  bg-primary box p-0">
                <form action="../operations/update.php" method="post" class="p-5 d-flex align-items-center justify-content-center flex-column">
                    <div class="p-2 text-center text-md-start">
                    <?php
                        $id = $_GET['id'];
                        $sql = "SELECT * FROM sub_categories WHERE ID = {$id}";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result)){
                            while($rows = mysqli_fetch_assoc($result)){

                         
                        ?>
                          
                        <i class="fas fa-times cancelt2"></i>
                        <label for="select" class="form-label d-inline-block label">Categories</label>
                        <select name="catg_select"  class="input" style="width:160px;">
                            <option disabled>select</option>
                            <?php
                            $sql2 = "SELECT * FROM   categories;";
                            $result2 = mysqli_query($conn, $sql2);
                            
                            if(mysqli_num_rows($result2) > 0){
                                while($rows2 = mysqli_fetch_assoc($result2)){
                                    if($rows['Catg_ID'] == $rows2['ID']){
                                        $selected = 'selected';
                                    }else{
                                        $selected = '';
                                    }
                                    echo "<option ".$selected." value='".$rows2['ID']."'>".ENC($rows2['Categories_name'],'decrypt')."</option>";
                                }
                                echo '<input type="hidden" name="old_catg_id" value="'. $rows['Catg_ID'].'">';
                            }
                            ?>
                            
                        </select>
                        <br><br>
                        <label for="name" class="form-label d-inline-block label" >Sub Categories </label>
                        <input type="hidden" class="form-control input" name="id" value="<?php echo $rows['ID']?>">
                        <input type="text" class="form-control input" name="name" value="<?php echo ENC($rows['Sub_catg_name'],'decrypt')?>">
                    </div>
                    <button type="submit" class="btn btn-light insertbtn" name="update_sub_catg_t1">Submit</button>
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