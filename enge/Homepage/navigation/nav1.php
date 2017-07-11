
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

                          <a href="homepage.php">Home</a>

                      </li>

                      <li class="page-scroll active">

                          <a href="homepage#courses">Courses</a>

                      </li>

                      <li class="page-scroll">

                          <a href="homepage#about">About</a>

                      </li>

                  </ul>

                  <?php 

                    require('database/db.php');                                    
                    
                    if(!empty( $_SESSION['stud_username'])){  
                        $user =  $_SESSION['stud_username'];
                        $pass = md5($_SESSION['stud_password']);
                        $query = "Select * from student where stud_username = '$user' ";
                        $result = mysqli_query($con , $query);
                        $row = mysqli_fetch_assoc($result);
                          ?>   
                        <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="../Student/StudentDashboard.php">

                                    <i class="fa fa-user fa-fw"></i> 

                                     <?php

                                    echo $row['stud_firstName'] . ' ' . $row['stud_lastName'];

                                    ?> 

                                    <i class="fa fa-caret-down"></i>

                                </a>

                                <ul class="dropdown-menu dropdown-user">

                                  <li><a href ="../student/pages/StudentDashboard.php"><i class = 'fa fa-dashboard'></i> Dashboard</a>
                                  </li>

                                    <li><a href="../Student/StudentProfile.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                                    </li>

                                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                                    </li>

                                    <li class="divider"></li>

                                    <li><a href="../Student/studentlogout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                                    </li>

                                </ul>
                        </li>

                   <?php  

                    }   else { 

                    ?>

                        <ul class="nav navbar-nav navbar-right">                                   
                        <ul class="nav navbar-nav navbar-right">                                   
                      <li id="lesson"><a href = "#">Login</a></li>

                       <!-- The Modal -->

                        <div id="myModal" class="modal">

                          <!-- Modal content -->

                          <div class="modal-content">

                            <span class="close">&times;</span>

                              <h3 id = 'loginAs'>Login As</h3>

                            <form action="" method="post" class="ajax">

                                <div class = "container">

                                  <div class="left-div left-text"><i class = "fa fa-user fa-5x"></i><br/>

                                    <li class = "sub"><a href = "../Student/studentlogin.php"> Student</a></li>

                                    </div>

                                    <div class="right-div right-text">

                                      <i class = "fa fa-graduation-cap fa-5x"></i>

                                        <li class = "sub"><a href = "../instructor/instrLogin.php"> Instructor</a></li>

                                    </div>

                                    </div>
                                
                            </form>

                          </div>
                            
                        </div>

                        <li id="lesson"><a href = "#">Sign Up</a></li>

                       <!-- The Modal -->

                        <div id="myModal" class="modal">

                          <!-- Modal content -->

                          <div class="modal-content">

                            <span class="close">&times;</span>

                              <h4>Sign Up As</h4>

                            <form action="" method="post" class="ajax">

                                <div class = "container">

                                  <div class="left-div left-text"><i class = "fa fa-user"></i><br/>

                                    <li><a href = "../Student/studentsignup.php"> Student</a></li>

                                    </div>

                                    <div class="right-div right-text">

                                      <i class = "fa fa-graduation-cap"></i>

                                        <li><a href = "../instructor/instrSignUp.php"> Instructor</a></li>

                                    </div>

                                    </div>
                                
                            </form>
                            
                          </div>
                            
                        </div>
                   
                    <?php 

                      }
                      
                    ?>

                    </ul>

              </div>

          </div>

      </nav>