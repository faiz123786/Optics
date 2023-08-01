<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Signup</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>

<?php
include_once 'includes/nav.php';
?>

    <div class="outer-con p-4">
            <div class="container bg-light px-5 pb-5 pt-3 rounded" style="
            width: 40% !important;
            ">
                <h1 class="pb-3 text-center ">Admin</h1>

                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" name="pwd" id="exampleInputPassword">
                    </div>
                    <button type="submit" class="btn btn-info text-center" name="submit">Submit</button>
                </form>
                <?php 
 include_once 'dbh/conn.php';
if(isset($_POST['submit'])){
    
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $pwd = mysqli_real_escape_string($conn,$_POST['pwd']);

    if(empty($email) || empty($pwd)){
        echo "<p class='msg' style = 'color: red'>All Fields are Required*</p>";
    }else{
        $email = ENC($email);
        $pwd = ENC($pwd);
        $sql = "SELECT * FROM admin WHERE Email = '{$email}'";
        $result = mysqli_query($conn,$sql)or die("Query unsuccessfull".mysqli_error($conn));
        if(mysqli_num_rows($result) > 0){
            while($rows = mysqli_fetch_assoc($result)){
                if ($rows['Email'] == $email) {
                    echo "<p class='msg' style='color:red;'>Email id already exists</p>";
                }
            }
        }else{
            $sql1 = "INSERT INTO admin(Email,Pwd,Role) values('{$email}','{$pwd}','Admin')";
            if(!mysqli_query($conn,$sql1)){
               echo "Query Unsuccessful".mysqli_error($conn).$sql1;
            }else{
                $sql2 = "SELECT * FROM admin WHERE Email = '{$email}'";
                $result2 = mysqli_query($conn,$sql2)or die("Query unsuccessfull".mysqli_error($conn));
                if(mysqli_num_rows($result2) > 0){
                    while($rows2 = mysqli_fetch_assoc($result2)){
                        // $_SESSION['role'] = $rows2['Role'];
                        echo "<p class='msg' style='color:green;'>Successful registered</p>";
                        // header("Location: index.php?Success");
                    }
                }
            }
        }
    }
}
?>
            </div>
        </div>



 <!-- =======================================FOOTER=========================================== -->
 <?php 
    include_once "includes/footer.php";
    ?>
    
    

</body>
<script src="js/main.js"></script>
<script src="js/fontawsome.js"></script>
</html>
