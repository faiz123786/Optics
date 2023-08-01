<nav class="navbar navbar-expand-lg navbar-dark bg-info fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand ms-3 ms-md-5" href="index.php">O P T I C S</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <i class="fad fa-bars" style="color:white;"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto  dark">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    
                    <?php
                    include 'dbh/conn.php';
                     $sql1 = "SELECT * FROM categories WHERE totalSub_catg > 0 LIMIT 0,4;";
                     $result1 = mysqli_query($conn, $sql1);
                     if(mysqli_num_rows($result1) > 0){
                        while($rows1 = mysqli_fetch_assoc($result1)){
                           
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo ENC($rows1['Categories_name'],'decrypt');?></a>
                        <ul class="dropdown-menu bg-info" aria-labelledby="navbarDropdownMenuLink dp">
                            <?php 
                             $sql2 = "SELECT * FROM sub_categories WHERE Catg_ID = totalProducts > 0;";
                             $result2 = mysqli_query($conn, $sql2);
                             if(mysqli_num_rows($result2) > 0){
                             while($rows2 = mysqli_fetch_assoc($result2)){
                            ?>
                            <li><a class="dropdown-item" href="prodgallery.php?sub_catg_id=<?php echo $rows2['ID']?>"><?php echo ENC($rows2['Sub_catg_name'],'decrypt')?></a></li>
                            <?php
                                }
                            }
                            ?>
                        </ul>
                    </li>
                    
                    <?php
                      }
                    }
                    ?>
                </ul>
                <!-- Button trigger modal -->
                <div class="nav-end">
                    <?php 
                   
                    if(isset($_SESSION['user_id'])){
//                    
                        $sql = "SELECT * FROM orders WHERE Cust_ID = {$_SESSION['user_id']};";
                        $result = mysqli_query($conn, $sql);
                        $i = 0;
                        $i = mysqli_num_rows($result);
                        echo '<a  href="orders.php?cust_id='.$_SESSION["user_id"].'" class="position-relative px-2 nav-btn ms-2" style="width:85px" aria-current="true">Orders
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        '.$i.'
                         <span class="visually-hidden">unread messages</span>
                       </span></a>';


                        $sql = "SELECT * FROM addtocart WHERE Cust_ID = {$_SESSION['user_id']};";
                        $result = mysqli_query($conn, $sql);
                        $count = 0;
                        $count = mysqli_num_rows($result);
// 
                        echo '<a type="button" class="position-relative px-2  nav-btn" style="width:55px;" href="addtocart.php?cust_id='.$_SESSION["user_id"].'">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                         '.$count.'
                          <span class="visually-hidden">unread messages</span>
                        </span>
                      </a>';
// 
                        echo '<a  href="logout.php" class="nav-btn " style="width:55px;" aria-current="true"><i class="fas fa-sign-out-alt"></i></a>';
                    }else if(isset($_SESSION['role'])){
                        echo '<a  href="admin/dashboard.php" class="nav-btn" aria-current="true">Dashboard</a>';                             
                        echo '<a  href="logout.php" class="nav-btn" aria-current="true">Logout</a>';
                    }else{
                      echo  '<a  href="login.php" class="nav-btn" aria-current="true">Login</a>';
                      echo '<a  href="signup.php" class="nav-btn" aria-current="true">Sign Up</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>