<?php
if(isset($_POST['login'])){
    include_once "../conn.php";
    
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $pwd = mysqli_real_escape_string($conn,$_POST['pwd']);
    
    if(empty($username) || empty($pwd)){
        header("Location: ../../login.php?error=emptyfield");
    }else{
        $username = ENC($username);
        $pwd = ENC($pwd);
        $sql = "SELECT * FROM login WHERE User_name = '{$username}' || Email = '{$username}'";
        $result = mysqli_query($conn,$sql) or die("Query Unsuccessful".mysqli_error($sql));
        if(mysqli_num_rows($result) > 0){
            while($rows = mysqli_fetch_assoc($result)){
                if($rows['Pwd'] == $pwd){
                    session_start();
                    $_SESSION['user_id'] = $rows['ID'];
                    $_SESSION['username'] = $rows['User_name'];
                    header("Location: ../../index.php?success=login");
                }else{
                    $sql1 = "SELECT * FROM admin WHERE Email = '{$username}';";
                    $result1 = mysqli_query($conn,$sql1) or die("Query Unsuccessful".mysqli_error($sql1));
                    if(mysqli_num_rows($result1) > 0){
                        while($rows1 = mysqli_fetch_assoc($result1)){
                            if($rows1['Pwd'] == $pwd){
                                session_start();
                                $_SESSION['role'] = $rows1['Role'];
                                header("Location: ../../index.php?success=login");
                            }else{
                                header("Location: ../../login.php?error=incorrectpass");
                            }
                        }
                        
                    }else{
                        header("Location: ../../login.php?error=wrongusername");
                    }
                }
            }
        }else{
            $sql1 = "SELECT * FROM admin WHERE Email = '{$username}';";
            $result1 = mysqli_query($conn,$sql1) or die("Query Unsuccessful".mysqli_error());
            if(mysqli_num_rows($result1) > 0){
                while($rows1 = mysqli_fetch_assoc($result1)){
                    if($rows1['Pwd'] == $pwd){
                        session_start();
                        $_SESSION['role'] = $rows1['Role'];
                        header("Location: ../../index.php?success=Adminlogin");
                    }else{
                        header("Location: ../../login.php?error=incorrectpass");
                    }
                }
                
            }else{
                header("Location: ../../login.php?error=wrongusername");
            }
        
        }  
    }

}else{
    header("Location: ../../login.php");
}