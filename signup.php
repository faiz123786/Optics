<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
      <!-- ======================================NAVBAR================================= -->
      <?php
    include_once "includes/nav.php";
    ?>

        <div class="outer-con p-4" style="margin-top:4rem;">
            <div class="container  bg-light px-5 pb-5 pt-3 rounded inner-con">
                <h1 class="pb-3 text-center ">Sign Up</h1>
                <form action="dbh/signup_handler/signup_handler.php" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputfname" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="fname" id="exampleInputfname">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputlname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="lname" id="exampleInputlname">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="exampleInputUsername">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" name="pwd" id="exampleInputPassword">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputConfirmPwd" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="con-pwd" id="exampleInputConfirmPwd">
                    </div>
                    <button type="submit" class="btn btn-info text-center" name="signup">Submit</button>
                    <?php
                    if(isset($_GET['error'])){
                        if($_GET['error'] == 'emptyfield'){
                            echo "<p class='msg' style = 'color: red'>All Fields are Required*</p>";
                        }
                        if($_GET['error'] == 'pwdnotmatch'){
                            echo "<p class='msg' style='color:red;'>Password doesn't match</p>";
                        }
                        if($_GET['error'] == 'invaliduid'){
                            echo "<p class='msg' style='color:red;'>Invalid Username</p>";
                        }
                        if($_GET['error'] == 'emailalreadyexists'){
                            echo "<p class='msg' style='color:red;'>Email id already exists</p>";
                        }
                        if($_GET['error'] == 'usernametaken'){
                            echo "<p class='msg' style='color:red;'>Username Already taken</p>";
                        }
                        if($_GET['error'] == 'success'){
                            echo "<p class='msg' style='color:green;'>Signup Successful</p>";
                        }
                    }
                    ?>
                </form>
                <p class="mb-0 text-center">
                    <a href="login.php ">Have an account?Login in</a>
                </p>
            </div>
        </div>
        <!-- ==========================================FOOTER============================================= -->
        <?php 
    include_once "includes/footer.php ";
    ?>
        </body>
        <script src="js/fontawsome.js "></script>

</html>