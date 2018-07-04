<nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">

    <div class="container">

    <div class="navbar-header page-scroll">

    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">

        <span class="sr-only">Toggle navigation</span><i class="fa fa-bars"></i>

    </button>

    <img id = "logo" src = "otherFiles/image/logo/ntu-logo.png" width="50" height="50">

    <a class="navbar-brand" href="#page-top">NTU Training Institute</a>

    </div>

    <div class="collapse navbar-collapse navbar-custom" id="bs-example-navbar-collapse-1">

    <ul class="nav navbar-nav ">

        <li class="page-scroll">

            <a href="index.php">Courses</a>

        </li>

        <li class="page-scroll">

            <a href="index.php#about">About</a>

        </li>

    </ul>

    <?php 

      require('otherFiles/database/db.php');                                    
      
      if(isset( $_SESSION['stud_username'])){

          $user =  $_SESSION['stud_username'];
          $pass = md5($_SESSION['stud_password']);
          $query = "Select * from student where stud_username = '$user' ";
          $result = mysqli_query($con , $query);
          $row = mysqli_fetch_assoc($result);

      ?>   

          <ul class="nav navbar-nav navbar-top-links navbar-right">

          <li class="dropdown">

                  <a class="dropdown-toggle user" data-toggle="dropdown" href="#">

                      <i class="fa fa-user fa-fw"></i>

                       <?php

                       
                        echo $row['stud_firstName'] . ' ' . $row['stud_lastName'];

                      ?> 

                      <i class="fa fa-caret-down"></i>

                  </a>

                  <ul class="dropdown-menu dropdown-user">

                    <li><a id = "link" href ="student/StudentDashboard.php"><i class = 'fa fa-dashboard'></i> Dashboard</a>
                    </li>

                    <li><a id = "link" href="student/StudentProfile.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>

                    <li class="divider"></li>

                    <li><a id = "link" href="student/studentlogout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>

                  </ul>
          </li>
          </ul>

     <?php

      }else if(isset( $_SESSION['instr_username'])){

          $user =  $_SESSION['instr_username'];
          $pass = md5($_SESSION['instr_password']);
          $query = "Select * from instructor where instr_username = '$user' ";
          $result = mysqli_query($con , $query);
          $row = mysqli_fetch_assoc($result);

      ?>   

          <ul class="nav navbar-nav navbar-top-links navbar-right">

            <li class="dropdown">

                  <a class="dropdown-toggle user" data-toggle="dropdown" href="#">

                      <i class="fa fa-user fa-fw"></i>

                       <?php

                       
                        echo $row['instr_firstName'] . ' ' . $row['instr_lastName'];

                      ?> 

                      <i class="fa fa-caret-down"></i>

                  </a>

                  <ul class="dropdown-menu dropdown-user">

                    <li><a id = "link" href ="instructor/instrDashboard.php"><i class = 'fa fa-dashboard'></i> Dashboard</a>
                    </li>

                    <li><a id = "link" href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>

                    <li class="divider"></li>

                    <li><a id = "link" href="instructor/instrLogout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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

                          <a href = "Student/studentsignup.php">
                              
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

                            <a href = "instructor/instrSignUp.php">
                              
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

                          <a href = "student/studentlogin.php">
                              
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

                          <a href = "instructor/instrLogin.php">
                              
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