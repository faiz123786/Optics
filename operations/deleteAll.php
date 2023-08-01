<?php
include_once "../dbh/conn.php";
if(isset($_POST['deleteAllt1'])){
    $sql = "DELETE FROM categories;";
        if(mysqli_query ($conn,$sql)){
            header("Location: ../admin/dashboard.php");
            
        }else{
            echo "ERROR: Could not able to execute .$sql".mysqli_error($conn); 
        }
}else if(isset($_POST['deleteAllt2'])){
    $sql = "DELETE FROM sub_categories;";
        if(mysqli_query ($conn,$sql)){
            header("Location: ../admin/dashboard.php");
            
        }else{
            echo "ERROR: Could not able to execute .$sql".mysqli_error($conn); 
        }
}else if(isset($_POST['deleteAll_products'])){
    $sql = "DELETE FROM products;";
        if(mysqli_query ($conn,$sql)){
            header("Location: ../admin/products.php");
            
        }else{
            echo "ERROR: Could not able to execute .$sql".mysqli_error($conn); 
        }
}else{
    header("Location: ../login.php");
}