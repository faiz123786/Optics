<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert</title>
    <link rel="stylesheet" href="../css/style.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    
<?php
include_once "../dbh/conn.php";
$url = $_SERVER["HTTP_REFERER"];
session_start();

if(isset($_POST['insert_catg_t1'])){
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    if(empty($name)){
        echo "<h1>Empty Fields are not Excepted</h1>"; 
        header("Refresh:10; url= ../admin/dashboard.php");
    }else{
        $name = ENC($name);
        $sql = "INSERT INTO categories(categories_name) values('{$name}')";
        if(!mysqli_query($conn, $sql)){
         echo "<h1>ERROR: Could not able to execute</h1>.$sql".mysqli_error($conn); 
         header("Refresh:10; url= ../admin/dashboard.php");
        }else{
         header("Location: ../admin/dashboard.php");
        }

    }
}else if(isset($_POST['insert_catg_t2'])){
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $Catg_ID = mysqli_real_escape_string($conn,$_POST['select']);
    if(empty($name) || empty($Catg_ID)){
        echo "<h1>Empty Fields are not Excepted</h1>"; 
        header("Refresh:10; url= ../admin/dashboard.php");
    }else{
        $name = ENC($name);
        $sql = "INSERT INTO sub_categories(Catg_ID,Sub_catg_name) values('{$Catg_ID}','{$name}');";
        $sql .= "UPDATE categories SET totalSub_catg = totalSub_catg + 1 WHERE ID = {$Catg_ID};";
        if(!mysqli_multi_query($conn, $sql)){
         echo "<h1>ERROR: Could not able to execute</h1>.$sql".mysqli_error($conn); 
         header("Refresh:10; url= ../admin/dashboard.php");
        }else{
         header("Location: ../admin/dashboard.php");
        }
       
    }
   
}else if(isset($_POST['insert_products'])){
    $Catg_ID = mysqli_real_escape_string($conn,$_POST['catg_select']);
    $Sub_catg_ID = mysqli_real_escape_string($conn,$_POST['sub_catg_select']);
    $P_Name = mysqli_real_escape_string($conn,$_POST['name']);
    $P_Desc = mysqli_real_escape_string($conn,$_POST['desc']);
    $P_Price = mysqli_real_escape_string($conn,$_POST['price']);
    $color = mysqli_real_escape_string($conn,$_POST['color']);
   
    if(empty($Catg_ID) || empty($Sub_catg_ID) || empty($P_Name) || empty($P_Desc) || empty($P_Price) || empty($color)){
        echo "<h1>Empty Fields are not Excepted</h1>"; 
        header("Refresh:10; url= ../admin/products.php");
    }else{
        $sql = "SELECT * FROM sub_categories WHERE ID = '{$Sub_catg_ID}' AND Catg_ID = '{$Catg_ID}'";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0){
            $file = $_FILES['img'];

            $fileName = $_FILES['img']['name'];
            $fileTmpName = $_FILES['img']['tmp_name'];
            $fileSize = $_FILES['img']['size'];
            $fileError = $_FILES['img']['error'];
            $fileType = $_FILES['img']['type'];
            $fileExt = explode('.',$fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg','jpeg','webp','pnd','svg');
            if(in_array($fileActualExt, $allowed)){
                if($fileError === 0){
                    if($fileSize < 2000000){
                        $fileNewName = uniqid('',true).".".$fileActualExt;
                        $fileDestination = '../uploads/'.$fileNewName;
                
                        $P_Name = ENC($P_Name);
                        $P_Desc = ENC($P_Desc);
                        $P_Price = ENC($P_Price);
                        $color = ENC($color);
                        $fileNameENC = ENC($fileNewName);
                        $sql1 = "INSERT INTO products(Sub_catg_ID, P_Name, P_Desc, P_price,color,Img_name) values({$Sub_catg_ID}, '{$P_Name}', '{$P_Desc}', '{$P_Price}', '{$color}','{$fileNameENC}');";
                        
                        $sql1 .= "UPDATE sub_categories SET totalProducts = totalProducts + 1 WHERE ID = {$Sub_catg_ID}";
                        echo $sql1;
                        if(mysqli_multi_query($conn, $sql1)){
                            move_uploaded_file($fileTmpName, $fileDestination);
                            header("Location: ../admin/products.php");
                        }else{
                            echo "<h1>Error in Sql Query</h1>".$sql1.mysqli_error($conn); 
                            // header("Refresh:10; url= ../admin/products.php");
                        }
                    }else{
                        echo "<h1>File SIze is too Big</h1>"; 
                        header("Refresh:10; url= ../admin/products.php");
                    }
                }else{
                    echo "<h1>Some Error occured</h1>"; 
                    header("Refresh:10; url= ../admin/products.php");
                }
            }else{
                echo "<h1>You Cannot upload a file of these types!</h1>"; 
                header("Refresh:10; url= ../admin/products.php");
            }

        }else{
            echo "<b>NO SUCH RECORDS ARE PRESENT</b><br><br>";
            header("Refresh:10; url= ../admin/products.php");
        }
    }
}else if(isset($_POST['addtocart'])){
    if(isset($_SESSION['user_id'])){
        $prod_id = mysqli_real_escape_string($conn, $_POST['prod_id']);
        $cust_id = mysqli_real_escape_string($conn, $_POST['cust_id']);
        if(empty($prod_id) || empty($cust_id)){
            echo "<h1>Empty values are not Excepted</h1>"; 
            header("Refresh:10; url= ../preview.php?id=$prod_id");
        }else {
            $sql1 = "SELECT * FROM addtocart WHERE Cust_ID = {$cust_id} and Prod_ID = {$prod_id};";
            $result1 = mysqli_query($conn, $sql1);
            if(mysqli_num_rows($result1) > 0){
                $sql = "UPDATE addtocart SET Quantity = Quantity + 1 WHERE Cust_ID = {$cust_id} and Prod_ID = {$prod_id};";
                if(!mysqli_query($conn, $sql)){
                    echo "<h1>ERROR: Could not able to execute</h1>.$sql".mysqli_error($conn); 
                    header("Refresh:10; url= ../preview.php?id=$prod_id");
                }else{
                 header("Location: ../addtocart.php?cust_id=$cust_id");
                }
            }else{
                $sql = "INSERT INTO addtocart(prod_ID,Cust_ID) values({$prod_id},{$cust_id});";
                $sql .= "UPDATE addtocart SET Quantity = Quantity + 1 WHERE Cust_ID = {$cust_id} and Prod_ID = {$prod_id};";
                if(!mysqli_multi_query($conn, $sql)){
                    echo "<h1>ERROR: Could not able to execute</h1>.$sql".mysqli_error($conn); 
                    header("Refresh:10; url= ../preview.php?id=$prod_id");
                }else{
                  header("Location: ../addtocart.php?cust_id=$cust_id");
                }
            }
        }
    }else{
        header("Location: ../login.php");
    }
  
   
}else if(isset($_POST['insert_orders'])){
    $prod_id = mysqli_real_escape_string($conn, $_POST['prod_id']);
    $cust_id = mysqli_real_escape_string($conn, $_POST['cust_id']);
    $f_name = mysqli_real_escape_string($conn, $_POST['fname']);
    $l_name = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $contact = mysqli_real_escape_string($conn, $_POST['mobile']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    if(empty($prod_id) || empty($cust_id) || empty($f_name) || empty($l_name) || empty($email) || empty($address) || empty($contact)){
        echo "<h1>Empty values are not Excepted</h1>".mysqli_error($conn); 
        header("Refresh:10; url= ../preview.php?id=$prod_id");
    }else{
        $sql1 = "SELECT * FROM orders WHERE Cust_ID = {$cust_id} and Prod_ID = {$prod_id};";
        $result1 = mysqli_query($conn, $sql1);

        if(mysqli_num_rows($result1) > 0){
            $f_name = ENC($f_name);
            $l_name = ENC($l_name);
            $email = ENC($email);
            $address = ENC($address);
            $sql = "UPDATE addtocart SET Quantity = Quantity + 1 WHERE Cust_ID = {$cust_id} and Prod_ID = {$prod_id};";
            $sql.="DELETE FROM addtocart WHERE Prod_ID =  {$prod_id};";
            if(!mysqli_multi_query($conn, $sql)){
                echo "<h1>ERROR: Could not able to execute</h1>.$sql".mysqli_error($conn); 
                header("Refresh:10; url= ../preview.php?id=$prod_id");
            }else{
                echo '
                <div class="container fixed-top w-100 d-flex align-items-center justify-content-center h-100" style="background: #0dcaf0ad; opacity: 0.2;"><img class="img-fluid opacity-25 w-75 p-5" src="../img/orderConfirmed.svg"></div>
                <!-- Modal -->
                <div class="modal d-block" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" style="border:2px solid #0dcaf040;">
                        <div class="modal-header" style="background-color:#0dcaf040;">
                            <h5 class="modal-title fw-bold">Order Confirmed!</h5>
                        </div>
                        <div class="modal-body">
                            <p class="fw-bold"> Your Order has been placed successfully our team will contact you with in 12hours!</p>
                        </div>
                        <div class="modal-footer">
                        <a href="../orders.php?cust_id='.$cust_id.'" type="button" class="btn btn" style="background:#0dcaf040;" >Ok</a>
                        </div>
                        </div>
                    </div>
                </div>';
            }
        }else{
            $f_name = ENC($f_name);
            $l_name = ENC($l_name);
            $email = ENC($email);
            $address = ENC($address);
            $r_minus = "empty";
            $l_minus = "empty";
            $r_plus = "empty";
            $l_plus = "empty";
            $color = "same as image";
            if(isset($_POST['r_minus'])){
                $r_minus = mysqli_real_escape_string($conn, $_POST['r_minus']);
                if(empty($r_minus)){
                    $r_minus = "NULL";
                }
            }
            if(isset($_POST['l_minus'])){
                $l_minus = mysqli_real_escape_string($conn, $_POST['l_minus']);
                if(empty($l_minus)){
                    $l_minus = "NULL";
                }
            }
            if(isset($_POST['r_minus'])){
                $r_plus = mysqli_real_escape_string($conn, $_POST['r_plus']);
                if(empty($r_plus)){
                    $r_plus = "NULL";
                }
            }
            if(isset($_POST['r_minus'])){
                $l_plus = mysqli_real_escape_string($conn, $_POST['l_plus']);
                if(empty($l_plus)){
                    $l_plus = "NULL";
                }
            }
            if(isset($_POST['r_minus'])){
                $color = mysqli_real_escape_string($conn, $_POST['color']);
                if(empty($color)){
                    $color = "Same as image";
                }
            }
            $sql = "INSERT INTO orders(prod_ID,Cust_ID,F_name,L_name,Address,Contact_no,email,R_minus,L_minus,R_plus,L_plus,color,Quantity) values({$prod_id},{$cust_id},'{$f_name}','{$l_name}','{$address}',{$contact},'{$email}',{$r_minus},{$l_minus},{$r_plus},{$l_plus},'{$color}',{$quantity});";
            $sql.="DELETE FROM addtocart WHERE Prod_ID = {$prod_id};";
            if(!mysqli_multi_query($conn, $sql)){
            echo "<h1>ERROR: Could not able to execute</h1>.$sql".mysqli_error($conn); 
            header("Refresh:10; url= ../preview.php?id=$prod_id");
            }else{
                echo '
                <div class="container fixed-top w-100 d-flex align-items-center justify-content-center h-100" style="background: #0dcaf0ad; opacity: 0.2;"><img class="img-fluid opacity-25 w-75 p-5" src="../img/orderConfirmed.svg"></div>
                <!-- Modal -->
                <div class="modal d-block" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" style="border:2px solid #0dcaf040;">
                        <div class="modal-header" style="background-color:#0dcaf040;">
                            <h5 class="modal-title fw-bold">Order Confirmed!</h5>
                        </div>
                        <div class="modal-body">
                            <p class="fw-bold"> Your Order has been placed successfully our team will contact you with in 12hours!</p>
                        </div>
                        <div class="modal-footer">
                        <a href="../orders.php?cust_id='.$cust_id.'" type="button" class="btn btn" style="background:#0dcaf040;" >Ok</a>
                        </div>
                        </div>
                    </div>
                </div>';
            }
        }
        
    }
     
}else if(isset($_POST['insert_homeBanner'])){
    $file = $_FILES['img'];
    $fileName = $_FILES['img']['name'];
    $fileTmpName = $_FILES['img']['tmp_name'];
    $fileSize = $_FILES['img']['size'];
    $fileError = $_FILES['img']['error'];
    $fileType = $_FILES['img']['type'];
    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg','jpeg','webp','pnd','svg');
    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize < 2000000){
                $fileNewName = uniqid('',true).".".$fileActualExt;
                $fileDestination = '../uploads/'.$fileNewName;
                $fileNameENC = ENC($fileNewName);
                $sql1 = "INSERT INTO home_banner(Img_name) values('{$fileNameENC}');";
                echo $sql1;
                if(mysqli_multi_query($conn, $sql1)){
                    move_uploaded_file($fileTmpName, $fileDestination);
                    header("Location: ../admin/banner.php");
                }else{
                    echo "<h1>Error in Sql Query</h1>".$sql1.mysqli_error($conn); 
                    // header("Refresh:10; url= ../admin/banner.php");
                }
            }else{
                echo "<h1>File SIze is too Big</h1>"; 
                header("Refresh:10; url= ../admin/banner.php");
            }
        }else{
            echo "<h1>Some Error occured</h1>"; 
            header("Refresh:10; url= ../admin/banner.php");
        }
    }else{
        echo "<h1>You Cannot upload a file of these types!</h1>"; 
        header("Refresh:10; url= ../admin/banner.php");
    }
}else if(isset($_POST['insert_adsBanner'])){
    $file = $_FILES['img'];
    $fileName = $_FILES['img']['name'];
    $fileTmpName = $_FILES['img']['tmp_name'];
    $fileSize = $_FILES['img']['size'];
    $fileError = $_FILES['img']['error'];
    $fileType = $_FILES['img']['type'];
    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg','jpeg','webp','pnd','svg');
    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize < 2000000){
                $fileNewName = uniqid('',true).".".$fileActualExt;
                $fileDestination = '../uploads/'.$fileNewName;
                $fileNameENC = ENC($fileNewName);
                $sql1 = "INSERT INTO ads_banner(Img_name) values('{$fileNameENC}');";
                echo $sql1;
                if(mysqli_multi_query($conn, $sql1)){
                    move_uploaded_file($fileTmpName, $fileDestination);
                    header("Location: ../admin/banner.php");
                }else{
                    echo "<h1>Error in Sql Query</h1>".$sql1.mysqli_error($conn); 
                    // header("Refresh:10; url= ../admin/banner.php");
                }
            }else{
                echo "<h1>File SIze is too Big</h1>"; 
                header("Refresh:10; url= ../admin/banner.php");
            }
        }else{
            echo "<h1>Some Error occured</h1>"; 
            header("Refresh:10; url= ../admin/banner.php");
        }
    }else{
        echo "<h1>You Cannot upload a file of these types!</h1>"; 
        header("Refresh:10; url= ../admin/banner.php");
    }
}else{
    header("Location: ../login.php");
}
?>
</body>
</html>
