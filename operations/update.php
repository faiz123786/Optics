<?php
include_once "../dbh/conn.php";
if(isset($_POST['update_catg_t1'])){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    if(empty($id) || empty($name)){
        echo "<h1>Empty Fields are not Excepted</h1>"; 
        header("Refresh:10; url= ../admin/dashboard.php");
    }else{
        $name = ENC($name);
        $sql = "UPDATE categories SET categories_name = '{$name}' WHERE ID = {$id};";
        if(mysqli_query ($conn,$sql)){
            header("Location: ../admin/dashboard.php");
            
        }else{
            echo "ERROR: Could not able to execute .$sql".mysqli_error($conn); 
            header("Refresh: 5; url: ../admin/dashboard.php");
        }
    }
}else if(isset($_POST['update_sub_catg_t1'])){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $catg_id = mysqli_real_escape_string($conn, $_POST['catg_select']);
    $old_catg_id = mysqli_real_escape_string($conn, $_POST['old_catg_id']);
    $sub_catg_name = mysqli_real_escape_string($conn, $_POST['name']);
    if(empty($id) || empty($catg_id ) || empty($sub_catg_name)){
        echo "<h1>Empty Fields are not Excepted</h1>"; 
        header("Refresh:10; url= ../admin/dashboard.php");
    }else{
        $sub_catg_name = ENC($sub_catg_name);
        $sql = "UPDATE sub_categories SET Catg_ID = {$catg_id} , Sub_catg_name = '{$sub_catg_name}' WHERE ID = {$id};";
        if($old_catg_id != $catg_id){
            $sql .= "UPDATE categories SET totalSub_catg = totalSub_catg - 1 WHERE ID = {$old_catg_id};";
            $sql .= "UPDATE categories SET totalSub_catg = totalSub_catg + 1 WHERE ID = {$catg_id};";
        }
        if(mysqli_multi_query ($conn,$sql)){
            header("Location: ../admin/dashboard.php");
            
        }else{
            echo "ERROR: Could not able to execute .$sql".mysqli_error($conn); 
            header("Refresh: 10; url: ../admin/dashboard.php");
        }
    }
}else if(isset($_POST['update_products'])){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $Catg_ID = mysqli_real_escape_string($conn,$_POST['catg_select']);
    $Sub_catg_ID = mysqli_real_escape_string($conn,$_POST['sub_catg_select']);
    $old_sub_id = mysqli_real_escape_string($conn, $_POST['old_sub_id']);
    $P_Name = mysqli_real_escape_string($conn,$_POST['name']);
    $P_Desc = mysqli_real_escape_string($conn,$_POST['desc']);
    $P_Price = mysqli_real_escape_string($conn,$_POST['price']);
    $color = mysqli_real_escape_string($conn,$_POST['color']);
    $image_name = mysqli_real_escape_string($conn,$_POST['img_name']);
   
    if(empty($Catg_ID) || empty($Sub_catg_ID) || empty($P_Name) || empty($P_Desc) || empty($P_Price) || empty($color)){
        echo "<h1>Empty Fields are not Excepted</h1>.$color"; 
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
                        $fileEncName = ENC($fileNewName);

                        $sql1 = "UPDATE products SET Sub_catg_ID = {$Sub_catg_ID},  P_Name = '{$P_Name}', P_Desc = '{$P_Desc}', P_price = '{$P_Price}',Img_name = '{$fileEncName}',color = '{$color}' WHERE ID = {$id};";
                        if($old_sub_id != $Sub_catg_ID ){
                            $sql1 .= "UPDATE sub_categories SET totalProducts = totalProducts - 1 WHERE ID = {$old_sub_id};";
                            $sql1 .= "UPDATE sub_categories SET totalProducts = totalProducts + 1 WHERE ID = {$Sub_catg_ID};";
                        }
                        if(mysqli_multi_query($conn, $sql1)){
                            move_uploaded_file($fileTmpName, $fileDestination);
                            if(unlink('../uploads/'.$image_name)){
                                header("Location: ../admin/products.php");
                            }else{
                                header("Refresh: 0; url= ../admin/products.php");
                                echo "ERROR: Could not able to delete the Img .$sql".mysqli_error($conn); 
                            }   
                        }else{
                            echo "<h1>Error in Sql Query</h1>".$sql1.mysqli_error($conn); 
                            header("Refresh:10; url= ../admin/products.php");
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
}else if(isset($_POST['update_homeBanner'])){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $image_name = mysqli_real_escape_string($conn, $_POST['img_name']);

        $sql = "SELECT * FROM home_banner WHERE ID = '{$id}' ";
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
                        
                        $fileEncName = ENC($fileNewName);

                        $sql1 = "UPDATE home_banner SET Img_name = '{$fileEncName}' WHERE ID = {$id};";
                        
                        if(mysqli_query($conn, $sql1)){
                            move_uploaded_file($fileTmpName, $fileDestination);
                            if(unlink('../uploads/'.$image_name)){
                                header("Location: ../admin/banner.php");
                            }else{
                                header("Refresh: 0; url= ../admin/banner.php");
                                echo "ERROR: Could not able to delete the Img .$sql1".mysqli_error($conn); 
                            }   
                        }else{
                            echo "<h1>Error in Sql Query</h1>".$sql1.mysqli_error($conn); 
                            header("Refresh:10; url= ../admin/banner.php");
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
            echo "<b>NO SUCH RECORDS ARE PRESENT</b><br><br>";
            header("Refresh:10; url= ../admin/banner.php");
        }
    
}else if(isset($_POST['update_adsBanner'])){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $image_name = mysqli_real_escape_string($conn, $_POST['img_name']);

        $sql = "SELECT * FROM ads_banner WHERE ID = '{$id}' ";
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
                        
                        $fileEncName = ENC($fileNewName);

                        $sql1 = "UPDATE ads_banner SET Img_name = '{$fileEncName}' WHERE ID = {$id};";
                        
                        if(mysqli_query($conn, $sql1)){
                            move_uploaded_file($fileTmpName, $fileDestination);
                            if(unlink('../uploads/'.$image_name)){
                                header("Location: ../admin/banner.php");
                            }else{
                                header("Refresh: 0; url= ../admin/banner.php");
                                echo "ERROR: Could not able to delete the Img .$sql1".mysqli_error($conn); 
                            }  
                        }else{
                            echo "<h1>Error in Sql Query</h1>".$sql1.mysqli_error($conn); 
                            header("Refresh:10; url= ../admin/banner.php");
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
            echo "<b>NO SUCH RECORDS ARE PRESENT</b><br><br>";
            header("Refresh:10; url= ../admin/banner.php");
        }
    
}else{
    header("Location: ../login.php");
}

