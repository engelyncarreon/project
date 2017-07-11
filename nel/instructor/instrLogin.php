<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="UTF-8" />

        <title>NTU | Login</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

        <link href="styles/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

        <link href="../homepage/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <link href="../homepage/styles/style.min.css" rel="stylesheet">

        <link rel = "stylesheet" href = "styles/loginSignUp.css"/>

        <link rel = "stylesheet" href = "styles/checkError.css"/>

        <link rel = "icon" href = "image/ntu-logo.png">

    </head>

    <body>

        <?php

        require('database/db.php');
        session_start();

        if(isset($_POST['submit'])){

            $username = stripslashes($_POST['username']);
            $username = mysqli_real_escape_string($con,$username); 
            $password = stripslashes($_POST['password']);
            $password = mysqli_real_escape_string($con,$password);

            $query = "SELECT instr_username, instr_password, instr_status FROM instructor WHERE instr_username = '$username' and instr_password = '".md5($password)."'";

            $result = mysqli_query($con,$query) or die (mysql_error());
            $rows = mysqli_num_rows($result);

            $resultStat = mysqli_query($con,$query);
            $result2 = mysqli_fetch_assoc($resultStat);
            $status = $result2 ['instr_status'];

            if($rows == 1 && $status == 'Activate'){

                $_SESSION['instr_username'] = $username;
                $_SESSION['instr_password'] = $password;
                header("Location:pages/instrDashboard.php");

            }else if ($rows==1 && $status=='Deactivate'){

                echo "<div class = 'ban'>

                        <div class = 'icon'> 

                            <i class = 'fa fa-times-circle-o fa-5x'></i>

                        </div>

                        Your account has been deactivated by the admin. <br/>

                        <a href = 'instructorlogin.php'><i class = 'fa fa-arrow-circle-left'></i>Back</a>

                      </div>";
                

                }else{

                    echo "<div class = 'ban'>

                            <div class = 'icon'> 

                                <i class = 'fa fa-times-circle fa-5x'></i>

                            </div>

                            Your username and password is incorrect.</h3><br/>Click here to <a href = 'instructorlogin.php'><i class = 'fa fa-sign-in'></i> Login</a> again

                            </div>";

                }

        }else{

        ?>

        <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">

          <div class="container">

              <div class="navbar-header page-scroll">

                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">

                      <span class="sr-only">Toggle navigation</span><i class="fa fa-bars"></i>

                  </button>

                  <img id = "logo" src = "image/ntu-logo.png" width="50" height="50">

                  <a class="navbar-brand" href="#page-top">NTU Training Institute</a>

              </div>

              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                  <ul class="nav navbar-nav ">

                      <li class="page-scroll">

                          <a href="../homepage/homepage.php">Home</a>

                      </li>

                      <li class="page-scroll">

                          <a href="../homepage/homepage#courses">Courses</a>

                      </li>

                      <li class="page-scroll">

                          <a href="../homepage/homepage#about">About</a>

                      </li>

                  </ul>

                  <?php 

                    require('database/db.php');                                    
                    
                    if(!empty( $_SESSION['instr_username'])){  
                        $user =  $_SESSION['instr_username'];
                        $pass = md5($_SESSION['instr_password']);
                        $query = "Select * from instructor where instr_username = '$user' ";
                        $result = mysqli_query($con , $query);
                        $row = mysqli_fetch_assoc($result);
                          ?>   
                        <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="../instructor/instructorDashboard.php">

                                    <i class="fa fa-user fa-fw"></i> 

                                     <?php

                                    echo $row['instr_firstName'] . ' ' . $row['instr_lastName'];

                                    ?> 

                                    <i class="fa fa-caret-down"></i>

                                </a>

                                <ul class="dropdown-menu dropdown-user">

                                  <li><a href ="pages/instrDashboard.php"><i class = 'fa fa-dashboard'></i> Dashboard</a>
                                  </li>

                                    <li><a href="../instructor/instructorProfile.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                                    </li>

                                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                                    </li>

                                    <li class="divider"></li>

                                    <li><a href="instrLogout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                                    </li>

                                </ul>
                        </li>
                        </ul>

                   <?php  
                    } else { 

                    ?>

                    <ul class="nav navbar-nav navbar-right">                                   
                    <li><a href="../instructor/instrLogin.php">Log-in</a></li>
                    <li><a href="../instructor/instrSignUp.php">Sign up</a></li>
                   
                    <?php 

                      }

                     ?>

                    </ul>

              </div>

          </div>

      </nav>

        <div class="module login form-module">

            <div class="cta">

                <h2>Login to your account</h2>

                 <form action="instrLogin.php" method = "POST">

                    <input class = "input" type="text" name="username" placeholder="Username" required />

                    <input class = "input" type="password" name="password" placeholder="Password" required />

                    <input id = "button" type="submit" name="submit" value = "Login">

                </form>

                <div class="cta">Don't have an account?<a href="instrSignUp.php"> Register</a> Here</div>

            </div>

        </div>

        <?php } ?>

    </body>

</html>