<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
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
            <div class="container bg-light px-5 pb-5 pt-3 rounded inner-con">
                <h1 class="pb-3 text-center ">Login</h1>

                <form action="dbh/login_handler/login_handler.php" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputUsername" class="form-label">Email address/Username</label>
                        <input type="text" class="form-control" name="username" id="exampleInputUsername">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" name="pwd" id="exampleInputPassword">
                    </div>
                    <button type="submit" class="btn btn-info text-center" name="login">Submit</button>
                    <?php
                    if(isset($_GET['error'])){
                        if($_GET['error'] == 'emptyfield'){
                            echo "<p class='msg' style = 'color: red'>All Fields are Required*</p>";
                        }
                        if($_GET['error'] == 'incorrectpass'){
                            echo "<p class='msg' style = 'color: red'>Incorrect Password</p>";
                        }
                        if($_GET['error'] == 'wrongusername'){
                            echo "<p class='msg' style = 'color: red'>Incorrect Username or Password</p>";
                        }
                    }
                    ?>
                </form>
                <p class="mb-0 mt-3 text-center">
                    <a href="../login/index.php ">Don't have an account?Sign up</a>
                </p>
                <p class=" mb-0 text-center">
                    <a href=" ">Forgot Password?</a>
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