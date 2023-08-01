<?php
include_once "../dbh/conn.php";

if(isset($_POST['delete_catg'])){
    $id = $_POST['id'];

    $sql = "DELETE FROM categories WHERE ID = '$id';";
    if(mysqli_query ($conn,$sql)){
    header("Location: ../admin/dashboard.php");
    
    }else{
        header("Refresh: 5; url= ../admin/dashboard.php");
        echo "ERROR: Could not able to execute .$sql".mysqli_error($conn); 
    }

}else if(isset($_POST['delete_sub_catg'])){
    $id = $_POST['id'];
    $catg_id = $_POST['catg_id'];
    $sql = "DELETE FROM sub_categories WHERE ID = '$id';";
    $sql .= "UPDATE categories SET totalSub_catg = totalSub_catg - 1 WHERE ID= {$catg_id};";
    
    if(mysqli_multi_query ($conn,$sql)){
        header("Location: ../admin/dashboard.php");
        
        }else{
            header("Refresh: 5; url= ../admin/dashboard.php");
            echo "ERROR: Could not able to execute .$sql".mysqli_error($conn); 
        }
    
}else if(isset($_POST['delete_products'])){
    $id = $_POST['id'];
    $sub_catg_id = $_POST['sub_catg_id'];
    $img = $_POST['img'];
    $sql = "DELETE FROM products WHERE ID = '$id';";
    $sql .= "UPDATE sub_categories SET totalProducts = totalProducts - 1 WHERE ID = {$sub_catg_id};";
    if(mysqli_multi_query ($conn,$sql)){
        if(unlink('../uploads/'.$img)){
            header("Location: ../admin/products.php");
        }else{
            header("Refresh: 0; url= ../admin/products.php");
            echo "ERROR: Could not able to delete the Img .$sql".mysqli_error($conn); 
        }
        }else{
            header("Refresh: 5; url= ../admin/products.php");
            echo "ERROR: Could not able to execute .$sql".mysqli_error($conn); 
        }
    
}else if(isset($_POST['delete_cart'])){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $cust_id = mysqli_real_escape_string($conn, $_POST['cust_id']);

    $sql = "DELETE FROM addtocart WHERE ID = '$id';";
    if(mysqli_query ($conn,$sql)){
        header("Location: ../addtocart.php?cust_id=$cust_id");
        
        }else{
            header("Refresh: 5; url= ../addtocart.php?cust_id=$cust_id");
            echo "ERROR: Could not able to execute .$sql".mysqli_error($conn); 
        }
    
}else if(isset($_POST['delete_order'])){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $cust_id = mysqli_real_escape_string($conn, $_POST['cust_id']);

    $sql = "DELETE FROM orders WHERE ID = '$id';";
    if(mysqli_query ($conn,$sql)){
        header("Location: ../orders.php?cust_id=$cust_id");
        
        }else{
            header("Refresh: 5; url= ../orders.php?cust_id=$cust_id");
            echo "ERROR: Could not able to execute .$sql".mysqli_error($conn); 
        }
    
}else if(isset($_POST['delete_homeBanner'])){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $img = mysqli_real_escape_string($conn, $_POST['img']);

    $sql = "DELETE FROM home_banner WHERE ID = '$id';";
    if(mysqli_query ($conn,$sql)){
        if(unlink('../uploads/'.$img)){
            header("Location: ../admin/banner.php");
        }else{
            header("Refresh: 0; url= ../admin/banner.php");
            echo "ERROR: Could not able to delete the Img .$sql".mysqli_error($conn); 
        }        
        }else{
            header("Refresh: 5; url= ../admin/banner.php");
            echo "ERROR: Could not able to execute .$sql".mysqli_error($conn); 
        }
    
}else if(isset($_POST['delete_adsBanner'])){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $img = $_POST['img'];
    $sql = "DELETE FROM ads_banner WHERE ID = '$id';";
    if(mysqli_query ($conn,$sql)){
        if(unlink('../uploads/'.$img)){
            header("Location: ../admin/banner.php");
        }else{
            header("Refresh: 0; url= ../admin/banner.php");
            echo "ERROR: Could not able to delete the Img .$sql".mysqli_error($conn); 
        }
        
        }else{
            header("Refresh: 5; url= ../admin/banner.php");
            echo "ERROR: Could not able to execute .$sql".mysqli_error($conn); 
        }
    
}else{
    header("Location: ../login.php");
    }

