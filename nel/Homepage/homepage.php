<!DOCTYPE html>
<html lang="en">

  <head>

      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>NTU Training Institute</title>

      <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

      <link href="styles/style.min.css" rel="stylesheet">

      <link href = "styles/modal.css" rel = "stylesheet">

      <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

      <link href = "image/ntu-logo.png" rel = "icon"/>

  </head>

  <body id="page-top" class="index">

    <?php

      require('database/db.php');
      session_start();

      $query = "Select * from courses Natural join instructor";
      $result = mysqli_query($con , $query);
    
    ?>

      <!-- Start Navigitaion -->

        
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

                          <a href="#page-top">Home</a>

                      </li>

                      <li class="page-scroll">

                          <a href="#courses">Courses</a>

                      </li>

                      <li class="page-scroll">

                          <a href="#about">About</a>

                      </li>

                  </ul>

                  <?php 

                    require('database/db.php');                                    
                    
                    if(isset( $_SESSION['stud_username'])){

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
                        </ul>

                   <?php

                    }else if(isset( $_SESSION['instr_username'])){

                        $user =  $_SESSION['instr_username'];
                        $pass = md5($_SESSION['instr_password']);
                        $query = "Select * from instructor where instr_username = '$user' ";
                        $result = mysqli_query($con , $query);
                        $row = mysqli_fetch_assoc($result);

                    ?>   

                        <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">

                                <a class="dropdown-toggle" data-toggle="dropdown" href="../Student/StudentDashboard.php">

                                    <i class="fa fa-user fa-fw"></i>

                                     <?php

                                     
                                      echo $row['instr_firstName'] . ' ' . $row['instr_lastName'];

                                    ?> 

                                    <i class="fa fa-caret-down"></i>

                                </a>

                                <ul class="dropdown-menu dropdown-user">

                                  <li><a href ="../instructor/pages/instrDashboard.php"><i class = 'fa fa-dashboard'></i> Dashboard</a>
                                  </li>

                                    <li><a href="../instructor/instrProfile.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                                    </li>

                                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                                    </li>

                                    <li class="divider"></li>

                                    <li><a href="../instructor/instrLogout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                                    </li>

                                </ul>
                        </li>
                        </ul>

                   <?php

                    } else { 

                    ?>

                    <ul class="nav navbar-nav navbar-right">                                   
                      <li id="login"><a href = "#">Login</a></li>

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

                        <li id="sign"><a href = "#">Sign Up</a></li>

                       <!-- The Modal -->

                        <div id="myModal1" class="modal">

                          <!-- Modal content -->

                          <div class="modal-content">

                            <span class="close1">&times;</span>

                              <h3 id = 'loginAs'>Sign Up</h3>

                            <form action="" method="post" class="ajax">

                                <div class = "container">

                                  <div class="left-div left-text"><i class = "fa fa-user fa-5x"></i><br/>

                                    <li class = "sub"><a href = "../Student/studentsignup.php"> Student</a></li>

                                    </div>

                                    <div class="right-div right-text">

                                      <i class = "fa fa-graduation-cap fa-5x"></i>

                                        <li class = "sub"><a href = "../instructor/instrSignUp.php"> Instructor</a></li>

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

      <!-- End of Nav -->

      <!-- Header -->
      <header>

          <div>

            <div id="myCarousel" class="carousel slide" data-ride="carousel">

              <ol class="carousel-indicators">

                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>

                <li data-target="#myCarousel" data-slide-to="1"></li>

                <li data-target="#myCarousel" data-slide-to="2"></li>

              </ol>

              <div class="carousel-inner">

                <div class="item active">

                  <img src="image/banner1.jpg" alt="" style="width:100%;">

                  <!-- <div class="carousel-caption">

                    <h3>Learn Database</h3>
                    <p>Enroll Now!</p>

                  </div> -->

                </div>

                <div class="item">

                  <img src="image/banner1.jpg" alt="" style="width:100%;">

                  <!-- <div class="carousel-caption">

                    <h3>Learn Database</h3>
                    <p>Enroll Now!</p>

                  </div> -->

                </div>
              
                <div class="item">

                  <img src="image/banner1.jpg" alt="" style="width:100%;">

                  <!-- <div class="carousel-caption">

                    <h3>Learn Database</h3>
                    <p>Enroll Now!</p>

                  </div> -->

                </div>
            
              </div>

              <!-- Left and right controls -->
              <a class="left carousel-control" href="#myCarousel" data-slide="prev">

                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>

              </a>

              <a class="right carousel-control" href="#myCarousel" data-slide="next">

                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>

              </a>

            </div>

          </div>

      </header>

      <section id = "courses">

          <div class = "container">

              <div class = "row">

                  <div class = "col-lg-12 text-center">

                      <h3>Courses Offered</h3>
                      <br/></br/>

                  </div>

              </div>

              <!-- <div id="display"> -->

              <div>

                  <?php

                    include('viewMore/homeCourse.php');

                  ?>

              </div>

              </div>
              
      </section>

      <footer class="text-center" id = 'about'>

          <div class="footer-above">

              <div class="container">

                  <div class="row">

                      <div class="footer-col col-md-4">

                          <h3>Location</h3>
                          <p>Loakan Road, Baguio City Economic Zone, PEZA
                              <br>Baguio City, PH 2600</p>

                      </div>

                      <div class="footer-col col-md-4">
                          <h3>Follow Us On</h3>

                          <ul class="list-inline">

                              <li>

                                  <a href="#" class="btn-social btn-outline"><span class="sr-only">Facebook</span><i class="fa fa-fw fa-facebook"></i></a>

                              </li>

                              <li>

                                  <a href="#" class="btn-social btn-outline"><span class="sr-only">Skype</span><i class="fa fa-skype"></i></a>

                              </li>

                              <li>

                                  <a href="#" class="btn-social btn-outline"><span class="sr-only">Twitter</span><i class="fa fa-fw fa-twitter"></i></a>

                              </li>

                          </ul>

                      </div>

                      <div class="footer-col col-md-4">

                          <h3>About NTU Training Institute</h3>

                          <p></p>

                      </div>

                  </div>

              </div>

          </div>

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

      <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
      <div class="scroll-top page-scroll hidden-sm hidden-xs hidden-lg hidden-md">

          <a class="btn btn-primary" href="#page-top">

              <i class="fa fa-chevron-up fa-5x"></i>

          </a>

      </div>

      <script src="jquery/jquery.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/jqBootstrapValidation.js"></script>
      <script src="js/style.min.js"></script>
      <script src = "js/modal.js"></script>

  </body>

</html>
