<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="UTF-8" />

        <title>NTU | Login</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

        <link href="../otherFiles/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

        <link href="../otherFiles/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <link href="../otherFiles/styles/style.min.css" rel="stylesheet">

        <link href="../otherFiles/styles/modal.css" rel="stylesheet">

        <link rel = "stylesheet" href = "../otherFiles/styles/loginSignUp.css"/>

        <link rel = "stylesheet" href = "../otherFiles/styles/checkError.css"/>

        <link rel = "icon" href = "../otherFiles/image/logo/ntu-logo.png">

    </head>

    <body>

        <?php

        require('../otherFiles/database/db.php');
        session_start();

        if(isset($_POST['submit'])){

            $username = stripslashes($_POST['username']);
            $username = mysqli_real_escape_string($con,$username); 
            $password = stripslashes($_POST['password']);
            $password = mysqli_real_escape_string($con,$password);

            $query = "SELECT stud_username, stud_password, stud_status FROM student WHERE stud_username = '$username' and stud_password = '".md5($password)."'";

            $result = mysqli_query($con,$query) or die (mysql_error());
            $rows = mysqli_num_rows($result);

            $resultStat = mysqli_query($con,$query);
            $result2 = mysqli_fetch_assoc($resultStat);
            $status = $result2 ['stud_status'];

            if($rows == 1 && $status == 'Activate'){

                $_SESSION['stud_username'] = $username;
                $_SESSION['stud_password'] = $password;
                
                header("Location:StudentDashboard.php");

            }else if ($rows==1 && $status=='Deactivate'){

                echo "<div class = 'contentfs'>

                        <div> 

                            <i class = 'fa fa-times-circle-o fa-5x fail'></i>

                        </div>

                        Your account has been deactivated by the admin. <br/>

                        <a href = 'studentlogin.php'><i class = 'fa fa-arrow-circle-left fail'></i>Back</a>

                      </div>";
                

                }else{

                    echo "<div class = 'contentfs'>

                            <div> 

                                <i class = 'fa fa-times-circle fa-5x fail'></i>

                            </div>

                            Your username and password is incorrect.</h3><br/>Click here to <a href = 'studentlogin.php' class = 'fail'><i class = 'fa fa-sign-in fail'></i> Login</a> again

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

                  <img id = "logo" src = "../otherFiles/image/logo/ntu-logo.png" width="50" height="50">

                  <a class="navbar-brand" href="#page-top">NTU Training Institute</a>

              </div>

              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                  <ul class="nav navbar-nav ">

                      <li class="page-scroll">

                          <a href="../homepage.php">Courses</a>

                      </li>

                      <li class="page-scroll">

                          <a href="../homepage#about">About</a>

                      </li>

                  </ul>

                  <?php 

                    require('../otherFiles/database/db.php');                                    
                    
                    if(!empty( $_SESSION['stud_username'])){  

                        $user =  $_SESSION['stud_username'];
                        $pass = md5($_SESSION['stud_password']);
                        $query = "Select * from student where stud_username = '$user' ";
                        $result = mysqli_query($con , $query);
                        $row = mysqli_fetch_assoc($result);

                    ?>   

                    <ul class="nav navbar-nav navbar-right">

                    <li class="dropdown">

                      <a class="dropdown-toggle user" data-toggle="dropdown" href="StudentDashboard.php">

                          <i class="fa fa-user fa-fw"></i>

                           <?php

                           
                            echo $row['stud_firstName'] . ' ' . $row['stud_lastName'];

                          ?> 

                          <i class="fa fa-caret-down"></i>

                      </a>

                  <ul class="dropdown-menu dropdown-user">

                    <li><a id = "link" href ="StudentDashboard.php"><i class = 'fa fa-dashboard'></i> Dashboard</a>
                    </li>

                    <li><a id = "link" href="StudentProfile.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>

                    <li class="divider"></li>

                    <li><a id = "link" href="studentlogout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>

                  </ul>

                </li>

                </ul>

                   <?php  
                    } else { 

                    ?>

                <ul class="nav navbar-nav navbar-right">             
                            
                  <li><a href="#view1" data-toggle="modal" >Login</a></li>


                  <li><a href="#view" data-toggle="modal" >Sign Up</a></li>
       
                </ul>

                <?php

                  }

                ?>

                </div>

              </div>

            </nav>

          <div  id="view" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="view1Label" aria-hidden="true" >

          <div class="modal-dialog" >

            <div class="modal-content" >

               <div class="modal-body" >

                   <button class="close" data-dismiss="modal">&times;</button>

               <h3 class="text-center">Sign Up As</h3>

            <form action="" method="post" class="ajax">
                
                <div class="row">

                  <div class="col-lg-6 text-center">

                      <div class="card">

                          <a href = "studentsignup.php">
                              
                              <div class="card-block">

                                  <div class="card-title fa fa-user fa-5x">

                                    <p class = 'studInstr'>Student</p>

                                  </div>

                              </div>

                          </a>

                      </div>
               
                    </div>

                    <div class="col-lg-6 text-center">

                        <div class="card">

                            <a href = "../instructor/instrSignUp.php">
                              
                              <div class="card-block">

                                  <div class="card-title fa fa-graduation-cap fa-5x"> 

                                    <p class = 'studInstr'>Instructor</p>

                                  </div>

                              </div>

                              </a>

                      </div>
                     
                       
                    </div>

                </div>
                
            </form>
            
            </div>

          </div>

        </div>
            
        </div>

        <div  id="view1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="view1Label" aria-hidden="true" >

          <!-- Modal content -->
          <div class="modal-dialog" >

            <div class="modal-content" >

               <div class="modal-body" >

                <button class="close" data-dismiss="modal">&times;</button>

              <h3 class="text-center">Login As</h3>

            <form action="" method="post" class="ajax">

               <div class="row">

                  <div class="col-lg-6 text-center">

                      <div class="card">

                          <a href = "studentlogin.php">
                              
                              <div class="card-block">

                                  <div class="card-title fa fa-user fa-5x">

                                    <p class = 'studInstr'>Student</p>

                                  </div>

                              </div>

                            </a>

                      </div>
               
                    </div>

                    <div class="col-lg-6 text-center">

                        <div class="card">

                          <a href = "../instructor/instrLogin.php">
                              
                              <div class="card-block">

                                  <div class="card-title fa fa-graduation-cap fa-5x"> 

                                    <p class = 'studInstr'>Instructor</p>

                                  </div>

                              </div>

                          </a>

                        </div>
                     
                    </div>

                </div>
                
            </form>
            
            </div>

          </div>

        </div>
            
      </div>

        <div class="module login form-module">

            <div class="cta">

                <i class = 'fa fa-user fa-5x'></i>

                <h2>Login to your account</h2>

                 <form action="studentLogin.php" method = "POST">

                    <input class = "input" type="text" name="username" placeholder="Username" required />

                    <input class = "input" type="password" name="password" placeholder="Password" required />

                    <input id = "button" type="submit" name="submit" value = "Login">

                </form>

                <div class="cta">Don't have an account?<a href="studentsignup.php"> Register</a> Here</div>

                <div class="cta"><a href="#">Forgot Password?</a></div>

            </div>

        </div>

        <footer class="text-center"> 

            <div class="footer-below">

                <div class="container">

                    <div class="row">

                        <div>

                            Copyright &copy; NTU Training Institute 2017

                        </div>

                    </div>

                </div>

            </div>

          </footer>

        <?php 

          } 

        ?>

        <script src = "../otherFiles/jquery/jquery.min.js"></script>
        <script src = "../otherFiles/js/bootstrap.min.js"></script>
        <script src = "../otherFiles/js/modal.js"></script>

    </body>

</html>