<?php
if(isset($_POST['signup'])){
    include_once "../conn.php";
    
    $f_name = mysqli_real_escape_string($conn,$_POST['fname']);
    $l_name = mysqli_real_escape_string($conn,$_POST['lname']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $pwd = mysqli_real_escape_string($conn,$_POST['pwd']);
    $con_pwd = mysqli_real_escape_string($conn,$_POST['con-pwd']);
    
        if(empty($f_name) || empty($l_name) || empty($email) ||empty($username) || empty($pwd) || empty($con_pwd)){
            header("Location: ../../signup.php?error=emptyfield");
        }else if($pwd !== $con_pwd){
            header("Location: ../../signup/index.php?error=pwdnotmatch");
        }else if(!preg_match("/^[a-zA-Z0-9]*$/",$username)){
            header("Location: ../../signup.php?error=invaliduid");
        }else{
            $f_name = ENC($f_name);
            $l_name = ENC($l_name);
            $email = ENC($email);
            $username = ENC($username);
            $pwd = ENC($pwd);
            $sql = "SELECT * FROM login WHERE Email = '{$email}' OR User_name = '$username'";
            $result = mysqli_query($conn,$sql)or die("Query unsuccessfull".mysqli_error($conn));
            if(mysqli_num_rows($result) > 0){
                while($rows = mysqli_fetch_assoc($result)){
                    if ($rows['Email'] == $email) {
                        header("Location: ../../signup.php?error=emailalreadyexists");
                    }else if($rows['User_name'] == $username){
                        header("Location: ../../signup.php?error=usernametaken");
                    }
                }
            }else{
                $sql1 = "INSERT INTO login(F_name,L_name,Email,User_name,Pwd) values('{$f_name}','{$l_name}','{$email}','{$username}','{$pwd}')";
                if(!mysqli_query($conn,$sql1)){
                   echo "Query Unsuccessful".mysqli_error($conn).$sql1;
                }else{
                    $sql2 = "SELECT * FROM login WHERE Email = '{$email}' OR User_name = '$username'";
                    $result2 = mysqli_query($conn,$sql2)or die("Query unsuccessfull".mysqli_error($conn));
                    if(mysqli_num_rows($result2) > 0){
                        while($rows2 = mysqli_fetch_assoc($result2)){
                            session_start();
                            $_SESSION['user_id'] = $rows2['ID'];
                            $_SESSION['username'] = $rows2['User_name'];
                            header("Location: ../../index.php?success");
                        }
                    } 
                }
            }
        }
   
    }
else{
    header("Location: ../../signup/index.php?not");
}